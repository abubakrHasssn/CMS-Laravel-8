@if(session()->has('success'))
    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
@endif
@if(session()->has('warning'))
    <div class="alert alert-warning">
        {{session()->get('warning')}}
    </div>
@endif
