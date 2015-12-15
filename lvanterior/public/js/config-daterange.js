/**
 * Created by ekontiki89 on 24/08/15.
 */
$(document).ready(function(){
    moment.locale('es');
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 1,
        timePicker12Hour: false,
        format: 'MM/DD/YYYY H:mm',
        "locale": {
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "Hasta"
        }
    });
});