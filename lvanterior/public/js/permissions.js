/**
 * Created by ekontiki89 on 15/07/15.
 */
$("input").on("change", function () {

    var form   = $('#form_permission');
    var url    = form.attr('action');
    var method = $("input[name=_method]").val();
    var token  = $("input[name=_token]").val();
    var data   = $(this).is(':checked');
    var value  = $(this).val();

    $.ajax({
        type: "POST",
        url: url,
        data: {data: data, value: value, _method: method, _token :token},
        success: function(affectedRows) {
            $('.success').show();
            setTimeout(function() {
                $('.success').fadeOut('slow');
            }, 500);

            console.log(affectedRows);

        }
    });

});


