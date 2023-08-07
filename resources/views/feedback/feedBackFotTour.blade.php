@php
    $AllUser = json_decode($UserFeedBackForMyTour);
    $feedBackIndex = count($AllUser) / 2;
@endphp

{{-- {{dd($AllUser)}} --}}

@for ($i = 0; count($AllUser) / 2 > $i; $i++, $feedBackIndex++)
    <div class="itemPrevFeedbackperson  d-flex justify-content-start">
        @php
            $t = \App\Models\tour::find($AllUser[$feedBackIndex]->tour_id);
            $name = $AllUser[$i]->name ;
            // dd($t);
        @endphp
        <img class="mt-4 mb-4" src="{{ asset('storage/' . $AllUser[$i]->image) }}" alt="">
        <!-- <button class="suggestApproved "><i class="fa-solid fa-clipboard-check"></i></button> -->
        <div class="infoFeedbackTour ">
            <p class="mt-4 ms-3 mb-1 ">Made by :
                {{ $name}} </p>
            <p class=" ms-3 mb-1  ">Tour Name :
                {{ $t->name }}</p>
            <p class="ms-3 mb-1 ">Review rating:
                @for ($x = 0; $x < $AllUser[$feedBackIndex]->star; $x++)
                    <span class="fa fa-star checked"></span>
                @endfor
            </p>
            <p class="ms-3">comment : {{ $AllUser[$feedBackIndex]->comment }} </p>
        </div>
    </div>
@endfor
