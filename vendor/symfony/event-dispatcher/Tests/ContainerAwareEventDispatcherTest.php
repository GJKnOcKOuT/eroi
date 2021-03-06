<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\EventDispatcher\Tests;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @group legacy
 */
class ContainerAwareEventDispatcherTest extends AbstractEventDispatcherTest
{
    protected function createEventDispatcher()
    {
        $container = new Container();

        return new ContainerAwareEventDispatcher($container);
    }

    public function testAddAListenerService()
    {
        $event = new Event();

        $service = $this->getMockBuilder('Symfony\Component\EventDispatcher\Tests\Service')->getMock();

        $service
            ->expects($this->once())
            ->method('onEvent')
            ->with($event)
        ;

        $container = new Container();
        $container->set('service.listener', $service);

        $dispatcher = new ContainerAwareEventDispatcher($container);
        $dispatcher->addListenerService('onEvent', ['service.listener', 'onEvent']);

        $dispatcher->dispatch('onEvent', $event);
    }

    public function testAddASubscriberService()
    {
        $event = new Event();

        $service = $this->getMockBuilder('Symfony\Component\EventDispatcher\Tests\SubscriberService')->getMock();

        $service
            ->expects($this->once())
            ->method('onEvent')
            ->with($event)
        ;

        $service
            ->expects($this->once())
            ->method('onEventWithPriority')
            ->with($event)
        ;

        $service
            ->expects($this->once())
            ->method('onEventNested')
            ->with($event)
        ;

        $container = new Container();
        $container->set('service.subscriber', $service);

        $dispatcher = new ContainerAwareEventDispatcher($container);
        $dispatcher->addSubscriberService('service.subscriber', 'Symfony\Component\EventDispatcher\Tests\SubscriberService');

        $dispatcher->dispatch('onEvent', $event);
        $dispatcher->dispatch('onEventWithPriority', $event);
        $dispatcher->dispatch('onEventNested', $event);
    }

    public function testPreventDuplicateListenerService()
    {
        $event = new Event();

        $service = $this->getMockBuilder('Symfony\Component\EventDispatcher\Tests\Service')->getMock();

        $service
            ->expects($this->once())
            ->method('onEvent')
            ->with($event)
        ;

        $container = new Container();
        $container->set('service.listener', $service);

        $dispatcher = new ContainerAwareEventDispatcher($container);
        $dispatcher->addListenerService('onEvent', ['service.listener', 'onEvent'], 5);
        $dispatcher->addListenerService('onEvent', ['service.listener', 'onEvent'], 10);

        $dispatcher->dispatch('onEvent', $event);
    }

    public function testHasListenersOnLazyLoad()
    {
        $event = new Event();

        $service = $this->getMockBuilder('Symfony\Component\EventDispatcher\Tests\Service')->getMock();

        $container = new Container();
        $container->set('service.listener', $service);

        $dispatcher = new ContainerAwareEventDispatcher($container);
        $dispatcher->addListenerService('onEvent', ['service.listener', 'onEvent']);

        $service
            ->expects($this->once())
            ->method('onEvent')
            ->with($event)
        ;

        $this->assertTrue($dispatcher->hasListeners());

        if ($dispatcher->hasListeners('onEvent')) {
            $dispatcher->dispatch('onEvent');
        }
    }

    public function testGetListenersOnLazyLoad()
    {
        $service = $this->getMockBuilder('Symfony\Component\EventDispatcher\Tests\Service')->getMock();

        $container = new Container();
        $container->set('service.listener', $service);

        $dispatcher = new ContainerAwareEventDispatcher($container);
        $dispatcher->addListenerService('onEvent', ['service.listener', 'onEvent']);

        $listeners = $dispatcher->getListeners();

        $this->assertArrayHasKey('onEvent', $listeners);

        $this->assertCount(1, $dispatcher->getListeners('onEvent'));
    }

    public function testRemoveAfterDispatch()
    {
        $service = $this->getMockBuilder('Symfony\Component\EventDispatcher\Tests\Service')->getMock();

        $container = new Container();
        $container->set('service.listener', $service);

        $dispatcher = new ContainerAwareEventDispatcher($container);
        $dispatcher->addListenerService('onEvent', ['service.listener', 'onEvent']);

        $dispatcher->dispatch('onEvent', new Event());
        $dispatcher->removeListener('onEvent', [$container->get('service.listener'), 'onEvent']);
        $this->assertFalse($dispatcher->hasListeners('onEvent'));
    }

    public function testRemoveBeforeDispatch()
    {
        $service = $this->getMockBuilder('Symfony\Component\EventDispatcher\Tests\Service')->getMock();

        $container = new Container();
        $container->set('service.listener', $service);

        $dispatcher = new ContainerAwareEventDispatcher($container);
        $dispatcher->addListenerService('onEvent', ['service.listener', 'onEvent']);

        $dispatcher->removeListener('onEvent', [$container->get('service.listener'), 'onEvent']);
        $this->assertFalse($dispatcher->hasListeners('onEvent'));
    }
}

class Service
{
    public function onEvent(Event $e)
    {
    }
}

class SubscriberService implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'onEvent' => 'onEvent',
            'onEventWithPriority' => ['onEventWithPriority', 10],
            'onEventNested' => [['onEventNested']],
        ];
    }

    public function onEvent(Event $e)
    {
    }

    public function onEventWithPriority(Event $e)
    {
    }

    public function onEventNested(Event $e)
    {
    }
}
