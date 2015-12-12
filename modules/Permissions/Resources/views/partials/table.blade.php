@foreach($permissions as $permission)
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ $permission->module_name}}</h3>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-striped">
                    <tr>
                        <th>Display name</th>
                        <th>Acción</th>
                    </tr>
                    @foreach($permission->permissions as $action)
                        @if(isset($roles->permissions[$action->permission]))
                            <?php $value = $roles->permissions[$action->permission]; ?>
                        @else
                            <?php $value = 0; ?>
                        @endif
                        <tr>
                            <td> {{ $action->display_name }} </td>
                            <td>
                                <label>
                                    <input
                                        value="{{$action->permission}}"
                                        type="checkbox"
                                        class="minimal"
                                        {{ ($value == 1)? 'checked': '' }}>
                                </label>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
@endforeach