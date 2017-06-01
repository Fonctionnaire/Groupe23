


//script for modals
$(function () {
    $("a.openmodal").click(function (e) {
        e.preventDefault();

        $("#modal .modal-content").load(this.href, function () {
            $("#modal").modal();
        })
    })
});

//FONCTION PUR LE FORMULAIRE D'EXPORT
$('#modal').on('show.bs.modal', function (e) {
    $(".datepicker").datepicker(
        {

        });
    $('#app_bundle_observation_filter_type_taxref').hide();
    $("label[for='app_bundle_observation_filter_type_taxref']").hide();

    $('#app_bundle_observation_filter_type_especeFilter').click(function(){
        if($('#app_bundle_observation_filter_type_especeFilter').prop('checked')){
            $('#app_bundle_observation_filter_type_taxref').show();
            $("label[for='app_bundle_observation_filter_type_taxref']").show();
            console.log('show');
        }else{
            $('#app_bundle_observation_filter_type_taxref').hide();
            $("label[for='app_bundle_observation_filter_type_taxref']").hide();
            console.log('hide');
        }
    });
});
