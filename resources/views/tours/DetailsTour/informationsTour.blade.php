


<div class="informationsTour">
    <div class="container Tour-place">
        <p> Palestine › {{ $tour->destination }} </p>
    </div>
    <!-- Carousel -->
    <div id="demo" class="carousel slide " data-bs-ride="carousel">

        @php
            $images = json_decode($tour->images);
        @endphp
        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            @for ($i = 0; count($images) > $i; $i++)
                <button type="button" data-bs-target="#demo" data-bs-slide-to="{{ $i }}"
                    class="{{ $i == 0 ? 'active' : '' }}"></button>
            @endfor
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            @for ($i = 0; count($images) > $i; $i++)
                <div class="{{ $i == 0 ? 'carousel-item active' : 'carousel-item' }} ">
                    <img src="{{ asset('storage/' . $images[$i]) }}" alt="photo tour 1"
                        class="d-block">
                </div>
            @endfor
        </div>


        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>

</div>
