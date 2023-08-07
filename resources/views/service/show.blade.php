@extends('layout')


@section('title')
    All servie
@endsection

@section('contant')
    <h2>ALL servie </h2>



    <div class="">

        <table class="table">
            <tbody>

                <tr>
                    <td>icon</td>
                    <td>title </td>
                    <td>description</td>
                    <td>Action</td>
                </tr>


                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->icon }}</td>
                        <td>{{ $service->title }}</td>
                        <td>{{ $service->description }}</td>


                        <td>
                            <form method="post" action="{{ url('service/delete') }}">
                                @csrf
                                @method('delete')
                                <input name="service_id" type="hidden" value="{{ $service->id }}">
                                <input type="submit" value="delete">
                            </form>

                            <a href="{{ url("service/edit/$service->id") }}">update </a>

                        </td>

                    </tr>
                @endforeach
            </tbody>
            {{-- {{$service->links()}} --}}
        </table>
        <input class="Submit_Join container" type="submit" name="submit" value="Allservies" action="{{ url('service') }}">



    </div>
@endsection
