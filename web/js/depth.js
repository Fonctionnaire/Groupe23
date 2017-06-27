$('.encart_accueil').mouseenter(function () {
   $(this).removeClass('z-depth-2').addClass('z-depth-5');
});

$('.encart_accueil').mouseleave(function () {
    $(this).removeClass('z-depth-5').addClass('z-depth-2');
});