$(document).ready(function () {
    let formModificato = false;
    let dataConfirmFlag = true;
    let $message = document.querySelector('.leave-message');

    if (typeof window.addEventListener === 'undefined') {
        window.addEventListener = function (e, callback) {
            return window.attachEvent('on' + e, callback);
        }
    }

    document.querySelectorAll('form textarea, form input[type="text"], form select').forEach(function (elem) {
        elem.addEventListener('focus', function () {
            if (!formModificato) {
                formModificato = true;
            }
        })
    });

    $(document).on('shown.bs.modal', function (event) {
        let $dataConfirmUndo = $(event.target).find('.btn-default');
        let $dataConfirmOk = $(event.target).find('.btn-warning');

        $dataConfirmOk.on('click', function () {
            dataConfirmFlag = false;
        });

        $dataConfirmUndo.on('click', function () {
            dataConfirmFlag = true;
        });
    });

    function manageExitForm(linkElement, e) {
        if (formModificato) {
            // e.preventDefault();
            // $('.confirm-exit-modal-btn').attr('href', linkElement.attr('href'));
            $('#modalExitFormId').modal('show');
            return false;
        }
    }

    $('.manage-privileges-widget-btn').on('click', function (e) {
        return manageExitForm($(this), e);
    });

    $('.facilitator-id>p>a').on('click', function (e) {
        return manageExitForm($(this), e);
    });

    $('.btn-cambia-password').on('click', function (e) {
        return manageExitForm($(this), e);
    });

    $('.btn-spedisci-credenziali').on('click', function (e) {
        return manageExitForm($(this), e);
    });

    $('#user-contacts-widget-associa-btn-id').on('click', function (e) {
        return manageExitForm($(this), e);
    });

    $('#community-network-widget-associa-btn-id').on('click', function (e) {
        return manageExitForm($(this), e);
    });

    $('#user-organizzazioni-grid a.btn-primary').on('click', function (e) {
        return manageExitForm($(this), e);
    });

    $('#user-sedi-grid a.btn-primary').on('click', function (e) {
        return manageExitForm($(this), e);
    });

    $('.send-message-btn').on('click', function (e) {
        return manageExitForm($(this), e);
    });

    $('.btn-connect-to-user').on('click', function (e) {
        return manageExitForm($(this), e);
    });

    $('.btn-delete-relation').on('click', function (e) {
        return manageExitForm($(this), e);
    });

    $('.btn-join-community').on('click', function (e) {
        return manageExitForm($(this), e);
    });
});