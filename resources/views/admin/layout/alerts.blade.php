<div class="col-lg-12" >
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message')}}
        </div>
    @endif
</div>