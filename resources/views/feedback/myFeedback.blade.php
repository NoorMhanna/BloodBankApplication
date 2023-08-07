{{-- {{dd($Myfeedback)}} --}}
@if (count($Myfeedback) > 0)

    @for ($i = 0; count($Myfeedback) > $i; $i++)
        <div class="itemPrevFeedbackperson  d-flex justify-content-start">
            @php
                $t = \App\Models\tour::find($Myfeedback[$i]->tour_id);
                // dd($t);
            @endphp
            <img class="mt-4 mb-4" src="{{ asset('storage/' . $user->image) }}" alt="">
            <!-- <button class="suggestApproved "><i class="fa-solid fa-clipboard-check"></i></button> -->
            <div class="infoFeedbackTour ">
                <p class=" ms-3 mb-1  ">Tour Name :
                    {{ $t->name }}</p>
                <p class="ms-3 mb-1 ">Review rating:
                    @for ($x = 0; $x < $Myfeedback[$i]->star; $x++)
                        <span class="fa fa-star checked"></span>
                    @endfor
                </p>
                <p class="ms-3">comment : {{ $Myfeedback[$i]->comment }} </p>
            </div>
        </div>
    @endfor
@else
    <div class=" text-center justify-content-center">

No feedBack Yet!
</div>
@endif
