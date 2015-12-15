/**
 * Created by ekontiki89 on 25/08/15.
 */
$('input:radio[name="optionsRadios"]').change(
    function () {
        if (this.checked && this.value == 'roles') {
            $('#divUser').css('display', 'none');
            $('#divRol').css('display', 'block');


            $("#selectUser").find('option:selected').removeAttr("selected");
            $('#selectUser').find('option:first-child').attr("selected", "selected");
            $('#selectRol').find('option:first-child').attr("selected", "selected");



            $('#selectUser').prop('required',false);
            $('#selectRol').prop('required',true);

        } else {
            $('#divUser').css('display', 'block');
            $('#divRol').css('display', 'none');

            $("#selectRol").find('option:selected').removeAttr("selected");
            $('#selectRol').find('option:first-child').attr("selected", "selected");
            $('#selectUser').find('option:first-child').attr("selected", "selected");


            $('#selectUser').prop('required',true);
            $('#selectRol').prop('required',false);
        }

    });
