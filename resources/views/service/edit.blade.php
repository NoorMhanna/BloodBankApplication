@extends('layout')


@section('title')
    Edit service
@endsection

@section('contant')
    <h2>Edit service </h2>

    {{-- Print Error --}}
    @include('errors')

    <div class="form_SignUp">
        <form class="infoDataSignUp container" method="POST" action="{{ url('service/update') }}">
            @csrf
            @method('put')

            <input type="hidden" name="service_id" value="{{ $service->id }}">



            <!-- <p>Phone</p> -->
            <span>icon &nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input class="infoSignUp" type="text" name="icon" value="{{ $service->icon }}"
                placeholder="Enter icon"><br><br>

            <span>title &nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input class="infoSignUp" type="text" name="title" value="{{ $service->title }}"
                placeholder="Enter title"><br><br>

            <span>description &nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input class="infoSignUp" type="text" name="description" value="{{ $service->description }}"
                placeholder="Enter description"><br><br>

            <input class="Submit_Join container" type="submit" name="submit" value="update">


        </form>
    </div>
@endsection
