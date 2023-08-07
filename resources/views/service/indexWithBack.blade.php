@extends('layout')


@section('contant')
    <br><br><br><br>


    <!-- ======= Serviec ======= -->
    <section id="why-us" class="why-us">
        <div class="section-header">
            <h2>About Us</h2>
            <p>Learn More <span>Our Servieces</span></p>
        </div>
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 ">
                    <div class="row ">


                        @foreach ($services as $service)
                            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                    <i class="{{ $service->icon }}"></i>
                                    <h4>{{ $service->title }}</h4>
                                    <p>{{ $service->description }}</p>
                                </div>
                            </div><!-- End Icon Box -->
                        @endforeach



                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Why Us Section -->

    <br><br><br><br>
@endsection





