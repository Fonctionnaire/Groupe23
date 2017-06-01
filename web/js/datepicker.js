$.datepicker.regional['fr'] = {
    closeText: 'Fermer',
    prevText: 'Précédent',
    nextText: 'Suivant',
    currentText: 'Aujourd\'hui',
    monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
    monthNamesShort: ['Janv.','Févr.','Mars','Avril','Mai','Juin','Juil.','Août','Sept.','Oct.','Nov.','Déc.'],
    dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
    dayNamesShort: ['Dim.','Lun.','Mar.','Mer.','Jeu.','Ven.','Sam.'],
    dayNamesMin: ['D','L','M','M','J','V','S'],
    weekHeader: 'Sem.',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''};

$.datepicker.setDefaults($.datepicker.regional['fr']);

$(function()
{
    //si le navigateur ne prend pas en charge les dates au format HTML5
    if (!navigator.userAgent.match(/(android|iphone|windows phone|ipad|edge|Chrome|CrOS|CriOS|Edge|Opera)/gi)) {
        //On utilise Datepicker Jquery
        $(".datepicker").datepicker(
            {
                maxDate: new Date()
            }).attr("readonly", "readonly");;

    }
    else {

        $(".datepicker").attr("type", "date");
    }

});

