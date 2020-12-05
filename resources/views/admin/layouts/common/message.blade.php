@if(Session::has('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {!! \Session::get('success') !!}
</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible bg-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {!! \Session::get('error') !!}
</div>
@endif