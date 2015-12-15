/**
 * Created by ekontiki89 on 28/10/15.
 */
$(function () {
    var url_task = "";
    var task_id;
    var modal = $('#task-modal');
    var form = $('#task-update');


    $('[data-toggle="modal"]').click(function(e) {
        e.preventDefault();
        url_task = $(this).attr('data-url');
        task_id = $(this).attr('data-id');



        $.get(url_task).success(function (data) {

            console.log(data)
            if(data['data']['status'] == 'done'){
                $('[data-toggle="task-complete"]').addClass('hide');
                $('[data-toggle="task-note-save"]').addClass('hide');
                $('#task-update').addClass('hide');
            }else{
                $('[data-toggle="task-complete"]').removeClass('hide');
                $('[data-toggle="task-note-save"]').removeClass('hide');
                $('#task-update').removeClass('hide');
            }

            modal.find('.modal-title').html(data['data']['name']);
            modal.find('#name').append(data['data']['name']);
            modal.find('#status').append(data['data']['status']);
            modal.find('#start_date').append(data['data']['start_date']);
            modal.find('#due_date').append(data['data']['due_date']);
            modal.find('#description').append(data['data']['description']);

            modal.find('.notes').html(notes(data['data']['notes']));
            form.find('[name="task_id"]').val(task_id);
            modal.modal('show');
        });
    });

    $('[data-toggle="task-note-save"]').on('click', function () {

        var url = form.attr('action');
        $.post(url,form.serialize() + '&type=note').done(function () {
            $.get(url_task).success(function (data) {
                modal.find('#name').html("");
                modal.find('#status').html("");
                modal.find('#start_date').html("");
                modal.find('#due_date').html("");
                modal.find('#description').html("");

                /*if(data['data']['status'] == 'done'){
                 $('[data-toggle="task-complete"]').addClass('hide');
                 $('[data-toggle="task-note-save"]').addClass('hide');
                 $('#task-update').addClass('hide');
                 }else{
                 $('[data-toggle="task-complete"]').removeClass('hide');
                 $('[data-toggle="task-note-save"]').removeClass('hide');
                 $('#task-update').removeClass('hide');
                 }*/
                modal.find('.modal-title').html(data['data']['name']);
                modal.find('#name').append(data['data']['name']);
                modal.find('#status').append(data['data']['status']);
                modal.find('#start_date').append(data['data']['start_date']);
                modal.find('#due_date').append(data['data']['due_date']);
                modal.find('#description').append(data['data']['description']);
                modal.find('.notes').html(notes(data['data']['notes']));
                form.find('[name="task_id"]').val(task_id);
                $('#note').val('');

                modal.find('a[href="#notes"]').trigger('click');
            });


        });

    });

    $('[data-toggle="task-complete"]').on('click', function () {
        $.post(form.attr('action'),form.serialize() + '&type=complete').done(function () {
            $.get(url_task).success(function (data) {
                modal.find('#name').html("");
                modal.find('#status').html("");
                modal.find('#start_date').html("");
                modal.find('#due_date').html("");
                modal.find('#description').html("");
                /*if(data['data']['status'] == 'done'){
                 $('[data-toggle="task-complete"]').addClass('hide');
                 $('[data-toggle="task-note-save"]').addClass('hide');
                 $('#task-update').addClass('hide');
                 }else{
                 $('[data-toggle="task-complete"]').removeClass('hide');
                 $('[data-toggle="task-note-save"]').removeClass('hide');
                 $('#task-update').removeClass('hide');
                 }*/
                modal.find('.modal-title').html(data['data']['name']);
                modal.find('#name').append(data['data']['name']);
                modal.find('#status').append(data['data']['status']);
                modal.find('#start_date').append(data['data']['start_date']);
                modal.find('#due_date').append(data['data']['due_date']);
                modal.find('#description').append(data['data']['description']);
                modal.find('.notes').html(notes(data['data']['notes']));
                form.find('[name="task_id"]').val(task_id);
                $('#note').val('');

                modal.find('a[href="#task"]').trigger('click');
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
        $(this).find('#name').html("");
        $(this).find('#status').html("");
        $(this).find('#start_date').html("");
        $(this).find('#due_date').html("");
        $(this).find('#description').html("");
        window.location.reload();
    });

})