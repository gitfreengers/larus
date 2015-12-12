/**
 * Created by ekontiki89 on 19/10/15.
 */

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    window.apps = {
        delete: function (url) {
            $.ajax({
                url:url,
                type:'GET'
            }).done(function () {
                window.location.reload();
            });
        },
        confirmation : function (selector) {
            $( selector === undefined ? '[data-toggle="confirmation"]' : selector ).confirmation({
                title:'¿Esta seguro que desea eliminar?',
                popout:true,
                singleton:true,
                btnOkClass: 'btn-xs btn-success ',
                btnOkIcon: 'fa fa-check',
                btnOkLabel: 'Si',
                btnCancelClass: 'btn-xs btn-danger',
                btnCancelIcon: 'fa fa-times',
                btnCancelLabel: 'No',
                onConfirm: function () {
                    if( $(this).data('btn-type') && $(this).data('btn-type') === 'delete' ) {
                        apps.delete($(this).data('url'));
                    }
                }
            });
        },
        setup: function () {
            this.confirmation();
        }
    }

    apps.setup();
    // data tables
    $("#datatable").DataTable({
        "language": {
            "url": "bower_components/admin-lte/plugins/datatables/lang/spanish.json"
        }
    });
})