@extends('layout')

@section('custom-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="{{ asset('css/tailwind.output.css') }} " />

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("addToursPop").style.display = "block";
        });
    </script>
@endsection

@section('title')
    CURD Tour suggest
@endsection


@section('contant')
    <!-- ======= Header ======= -->
    @include('navBar')
    <!-- End Header -->


    <section id="mainAdminCurd" class="mainAdminCurd d-flex justify-content-center">

        <div class="contentCurdPage mt-5">

            <div class="d-flex SeachSection">
                <p class="mt-5 ms-5 center searchP">All tours organized by {{ $user->name }}</p>
                {{-- <label class="resultPlace" id="resultPlace"> </label> <br> --}}

                <button id="btn-AddTours" class="AddTourOwner "onclick="addToursPop()">
                    <i class="fa-solid fa-plus-square"></i>
                </button>
                <input type="hidden" value="1" name="ifSuggest">
                @include('tours._form')

            </div>

            {{-- Table  --}}
            @include('tours._formCURD')


        </div>
    </section>


    <!-- End #main -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('#AddPlace').click(function(event) {
                event.preventDefault();
                var selectedValue = $('#cityBox').val();
                var labelText = $('#resultPlace').text();
                $('#resultPlace').val(labelText + "-" + selectedValue);
                $('#resultPlace').text(labelText + "-" + selectedValue);
            });


            $('#removePlace').click(function() {
                event.preventDefault(event);
                var labelText = $('#resultPlace').text().trim();
                var lastSpaceIndex = labelText.lastIndexOf('-');
                labelText = labelText.substring(0, lastSpaceIndex - 1);
                $('#resultPlace').text(labelText);
            });


            //  ................


            var counter = 0;
            $('#addActivity').click(function(event) {
                event.preventDefault();
                counter++;
                var newDiv = $('<div>').addClass('item position-relative ps-4 ms-3');
                var h4 = $('<h4>').addClass('fs-5');
                var label = $('<label>', {
                    for: 'appt',
                    text: 'AT '
                });
                var inputTime = $('<input>', {
                    type: 'time',
                    id: 'time',
                    name: 'time[]',
                    required: true
                });
                var p = $('<p>').addClass('act');
                var inputText = $('<input>', {
                    type: 'text',
                    id: 'fname',
                    name: 'activity[]',
                    required: true
                });

                h4.append(label, inputTime);
                p.append(inputText);
                newDiv.append(h4, p);
                // newDiv.append($('<br><br>'));

                $('#container').append(newDiv, $('<br>'));
                $('#numberOfActivity').val(counter + "");

            });

            $('#removeActivity').click(function(event) {
                event.preventDefault();
                if (counter > 1)
                    counter--;
                $('#container').children().last().remove();
                $('#container').children().last().remove();
                $('#numberOfActivity').val(counter + "");
            });

        });
    </script>
@endsection
