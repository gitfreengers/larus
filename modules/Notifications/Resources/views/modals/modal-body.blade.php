
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <p class="form-control-static" id="name">{{$notification->name}}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="url">URL</label>
                    <p class="form-control-static" id="url"><a href="{{$notification->url}}" target="_blank">{{$notification->url}}</a></p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <p class="form-control-static" id="description">{{$notification->description}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
