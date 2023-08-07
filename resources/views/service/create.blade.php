@extends('layout')


@section('title')
    New brief
@endsection

@section('contant')
    <h2>Add service </h2>

    {{-- Print Error --}}
    @include('errors')

    <div class="form_SignUp">
        <form class="infoDataSignUp container" method="POST" action="{{ url('service/store') }}">
            @csrf


            <!-- <p>Phone</p> -->
            <span>icon &nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input class="infoSignUp" type="text" name="icon" value="{{ old('icon') }}" placeholder="Enter icon"><br><br>

            <span>title &nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input class="infoSignUp" type="text" name="title" value="{{ old('title') }}"
                placeholder="Enter title"><br><br>

            <span>description &nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input class="infoSignUp" type="text" name="description" value="{{ old('description') }}"
                placeholder="Enter description"><br><br>

            <input class="Submit_Join container" type="submit" name="submit" value="add">


        </form>
    </div>
@endsection
