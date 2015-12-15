/**
 * Created by ekontiki89 on 29/10/15.
 */
$(function () {
    var url_task = "";
    var task_id;

    $('[data-toggle="modal"]').click(function(e) {
        e.preventDefault();
        url_task = $(this).attr('data-url');
        var modal = $('#task-modal');
        var form = $('#task-update');
        task_id = $(this).attr('data-id');
        $.get(url_task).success(function (data) {
            modal.find('.notes').html(notes(data['data']['notes']));
            form.find('[name="task_id"]').val(task_id);
            modal.modal('show');
        });
    });

    $('[data-toggle="task-note-save"]').on('click', function () {
        var form = $('#task-update');
        var url = form.attr('action');
        //var data = form.serialize();
        var modal = $('#task-modal');

        $.post(url,form.serialize() + '&type=note').done(function () {
            $.get(url_task).success(function (data) {
                modal.find('.notes').html(notes(data['data']['notes']));
                form.find('[name="task_id"]').val(task_id);
                $('#note').val('');
                modal.find('a[href="#notes"]').trigger('click');
            });


        });

    });



    function notes(data){
        html = '';
        $.each(data,function(index, value){
            html += '<div class="form-group">';
            html += '<label>'+ value['users'][0]['first_name']+'- <small>'+ value['created_at']+'</small></label>';
            html += '<p>'+ value['comment'] +'</p>';
            html += '</div>';
        });
        return html;
    }


    $('#task-modal').on('hidden.bs.modal', function () {
        $(this).find('a[href="#task"]').trigger('click');
    });

})