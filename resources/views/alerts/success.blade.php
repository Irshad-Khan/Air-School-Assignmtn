@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        <span class="fa fa-check" aria-hidden="true"></span>
        <span class="sr-only">Success:</span>
        {{Session::get('success')}}
    </div>
@endif
