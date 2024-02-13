@if (count($errors) > 0)
<div class="card text-left">
    <div class="card-header bg-warning p-2"><strong><i class="fa fa-exclamation-triangle"></i> Por favor modifique lo siguiente!</strong></div>
    <div class="card-body border border-warning p-1" style="border-width: 0px 3px 3px 3px !important; border-radius: 0px 0px 5px 5px;">
        <ul>
            @foreach ($errors->all() as $error)
            <li class="mb-1" style="font-size: 0.9rem;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
