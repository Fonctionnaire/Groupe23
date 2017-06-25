

//script for modals
$(function () {
    $("a.openmodal").click(function (e) {
        e.preventDefault();

        $("#modal .modal-content").load(this.href, function () {
            $("#modal").modal();
        })
    })
});

//script for datatables
$(document).ready(function () {
    $('#myTable').dataTable({
        "order": [[0, "asc"]],
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.15/i18n/French.json"
        }
    });
});

//FONCTION PUR LE FORMULAIRE D'EXPORT
$('#modal').on('show.bs.modal', function (e) {
    if
    (!navigator.userAgent.match(/(android|iphone|windows phone|ipad|edge|Chrome|CrOS|CriOS|Edge|Opera)/gi))
    {
        //On utilise Datepicker Jquery
        $(".datepicker").datepicker(
            {
                maxDate: new Date()
            }).attr("readonly", "readonly");;

    }
    else {

        $(".datepicker").attr("type", "date");
    }
    $('#app_bundle_observation_filter_type_taxref').hide();
    $("label[for='app_bundle_observation_filter_type_taxref']").hide();

    $('#app_bundle_observation_filter_type_especeFilter').click(function(){
        if($('#app_bundle_observation_filter_type_especeFilter').prop('checked')){
            $('#app_bundle_observation_filter_type_taxref').show();
            $("label[for='app_bundle_observation_filter_type_taxref']").show();
        }else{
            $('#app_bundle_observation_filter_type_taxref').hide();
            $("label[for='app_bundle_observation_filter_type_taxref']").hide();
        }
    });
});



jQuery.datetimepicker.setLocale('fr');
jQuery('.datetimepicker').datetimepicker({
    format: 'd/m/Y H:i'
});



