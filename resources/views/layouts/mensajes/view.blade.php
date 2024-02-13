<div class="row m-2">
    <div class="col-sm-12 col-lg-12">
        @switch($valor)
            @case(0)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> {{$mensaje}}</h4>
                </div>
                @break
            @case(1)
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info-circle"></i> {{$mensaje}}</h4>
                </div>
                @break
            @case(2)
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> {{$mensaje}}</h4>
                </div>
                @break
        @endswitch
    </div>
</div>
