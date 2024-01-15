var icon = $("#icona");
icon.iconpicker();
$(document).ready(function(){
    $("#icona").on('iconpickerSelected ', function(event){
        $("#icona-icona").attr('class', event.iconpickerValue + ' fa-4x');
    });
});
