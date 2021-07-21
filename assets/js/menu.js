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

}());
