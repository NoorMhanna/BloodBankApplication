@extends('layout')


@section('title')
    search Tour
@endsection

@section('contant')
    <h2> result for search Tour </h2>



    <div class="">

        <table class="table">
            <tbody>

                <tr>
                    <td>name</td>
                    <td>source </td>
                    <td>destination</td>
                    <td>description</td>
                    <td>dateOFTour</td>
                    <td>max_participate</td>
                    <td>tour_owner_id</td>
                    <td>price</td>
                </tr>

                @foreach ($users as $user)
                {{-- {{$user}} --}}
                    @foreach ($user->toursForOwner as $tour)

                        <tr>
                            {{-- {{$tour}} --}}
                            <td>{{ $tour->name }}</td>
                            <td>{{ $tour->source }}</td>
                            <td>{{ $tour->destination }}</td>
                            <td>{{ $tour->description }}</td>
                            <td>{{ $tour->dateOFTour }}</td>
                            <td>{{ $tour->max_participate }}</td>
                            <td>{{ $tour->user_id }}</td>
                            <td>{{ $tour->price }}</td>

                        </tr>
                    @endforeach
                @endforeach


            </tbody>
            {{-- {{$tours->links()}} --}}
        </table>
        <input class="Submit_Join container" type="submit" name="submit" value="AllTours" action="{{ url('tours') }}">



    </div>
@endsection
