$(document).ready(function() {
    var currentPath = window.location.pathname.split('/').slice(0, 4).join('/');
    console.log("Current Path:", currentPath);

    $('.menu-item a').each(function() {
        var href = $(this).attr('href'); 
        if (!href) return; 

        var linkPath = new URL(href, window.location.origin).pathname; 
        console.log("Checking link path:", linkPath);

        if (currentPath === linkPath) {
            var accordion = $(this).closest('.menu-accordion');
            accordion.removeClass('hidden').addClass('show'); 
            $(this).addClass('menu-item-active');
        } else {
            $(this).removeClass('menu-item-active');
        }
    });

    $('.menu-link').on('click', function(e) {
        e.stopPropagation();

        var accordion = $(this).next('.menu-accordion');

        $('.menu-accordion.show').not(accordion).not(':has(.menu-item-active)').removeClass('show').addClass('hidden');

        accordion.toggleClass('hidden').toggleClass('show');
    });
});