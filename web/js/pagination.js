
var active = $('.active > a');

active.removeAttr('href');

if(active.text() == 1)
{
    $('.chevron-gauche').removeAttr('href');
}