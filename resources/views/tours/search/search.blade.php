
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


                @foreach ($tours as $tour)
                    <tr>
                        <td>{{ $tour->name }}</td>
                        {{-- <td> <img src="{{asset("storage/$tour->image")}}" class="w-25"> </td> --}}
                        <td>{{ $tour->source }}</td>
                        <td>{{ $tour->destination }}</td>
                        <td>{{ $tour->description }}</td>
                        <td>{{ $tour->dateOFTour }}</td>
                        <td>{{ $tour->max_participate }}</td>
                        <td>{{ $tour->user_id }}</td>
                        <td>{{ $tour->price }}</td>

                    </tr>
                @endforeach
            </tbody>
            {{-- {{$tours->links()}} --}}
        </table>
        <input class="Submit_Join container" type="submit" name="submit" value="AllTours" action="{{url('tours')}}">



    </div>
@endsection
