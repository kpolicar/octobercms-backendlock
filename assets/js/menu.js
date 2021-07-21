(function() {
    let layoutMainMenu =
        document.querySelector('#layout-mainmenu');

// ---

    let itemsTemplate =
        document.querySelector('template#kpolicar_backendlock_mainmenu-items-extension');

    let previewButton =
        layoutMainMenu.querySelector('.main-menu-container .navbar ul.mainmenu-items[data-main-menu] > li.mainmenu-item.mainmenu-preview');

    let templateContent = itemsTemplate.content.cloneNode(true);
    previewButton.parentNode.prepend(templateContent)



    let loginModalTemplate =
        document.querySelector('template#template_kpolicar_backendlock_modal-login');

    let loginTemplateContent = loginModalTemplate.content.cloneNode(true);
    $('body').append(loginTemplateContent);


    let $loginModal = $('#kpolicar_backendlock_modal-login');
    $loginModal.on('hide.bs.modal', function (event) {
        if (!$(this).data('allow-hide')) {
            event.preventDefault()
        }
    });

    $loginModal.on('shown.bs.modal', function () {
        $(this).find('input[type=password]').focus()
    });

    $loginModal.find('form').on('ajaxSuccess', function () {
        let $modal = $(this).closest('.modal')
        $modal.data('allow-hide', true);
        $modal.modal('hide');
        $modal.find('input[type=password]').val('')
        $modal.data('allow-hide', false);
    })
}());
