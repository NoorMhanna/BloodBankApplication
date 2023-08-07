@if (Session::has('msg'))
        <div class="alert alert-success" role="alert"> {{ Session::get('msg')}} </div>
@endif
