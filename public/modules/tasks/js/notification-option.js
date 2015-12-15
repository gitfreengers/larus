/**
 * Created by ekontiki89 on 25/08/15.
 */
$(function () {





    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
    $(".select2").select2();
    $(".select3").select2();




    $('#start_date').datetimepicker({
        locale: 'es',
        format: 'YYYY-MM-DD HH:mm',
        sideBySide: true
    });

    $('#due_date').datetimepicker({
        locale:'es',
        format: 'YYYY-MM-DD HH:mm',
        sideBySide: true,
        useCurrent: false//Important! See issue #1075

    });
    $("#start_date").on("dp.change", function (e) {
        $('#due_date').data("DateTimePicker").minDate(e.date);
    });
    $("#due_date").on("dp.change", function (e) {
        $('#start_date').data("DateTimePicker").maxDate(e.date);
    });
    $('#status option:eq(0)').attr('disabled', 'disabled').css('color', 'grey');

    $('input:radio[name="optionsRadios"]').change(
        function () {
            if (this.checked && this.value == 'roles' ) {
                $("#selectUser").find('option:selected').removeAttr("selected");
                $('#selectUser').find('option:first-child').attr("selected", "selected");
                $('#selectUser').find('option:first-child').attr("disabled", "disabled");
                $('#divUser').css('display', 'none');
                $('#divRol').css('display', 'block');

            } else {
                $("#selectRol").find('option:selected').removeAttr("selected");
                $('#selectRol').find('option:first-child').attr("selected", "selected");
                $('#selectRol').find('option:first-child').attr("disabled", "disabled");
                console.log('user')
                $('#divUser').css('display', 'block');
                $('#divRol').css('display', 'none');

            }

        });

    });
