<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{ url('home') }}" class="logo d-flex align-items-center me-auto me-lg-0">
            <h1>{{trans('slidebar.YallaRehlla')}}<span>.</span></h1>
        </a>

        <nav id="navbar" class="navbar">
            <ul>

                <li><a href="#hero"> </a></li>
                <li><a href="#why-us">{{trans('slidebar.Servies')}} </a></li>
                <li><a href="#available-tour"></a></li>
                <li><a href="#gallery">{{trans('slidebar.Owner Tours')}} </a></li>
                <li><a href="#contact"></a></li>


                <li><a href="{{ url('home') }}"> {{trans('slidebar.HOME')}}</a></li>
                <li><a href="{{ url('home#available-tour') }}">{{trans('slidebar.Available tours')}}</a></li>
                <li><a href="{{ url('home#gallery') }}">{{trans('slidebar.Suggested friends')}}</a></li>
                <li><a href="#contact">{{trans('slidebar.Contact')}}</a></li>


                <li class="nav-item dropdown">
                    <a> <i class="fa-solid fa-earth-americas"></i> </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL('ar') }}">{{trans('slidebar.Arabic')}}</a>
                        </li>
                        <li><a class="dropdown-item"
                                href=" {{ LaravelLocalization::getLocalizedURL('en') }}">{{trans('slidebar.English')}}</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End nav -->


        <nav class="navbar navbar2 navbar-expand-lg ">

            {{-- notification --}}
            <button id="btn-notefication" class="notefication container justify-content-center " onclick="note()">
                <i class=" noteficationIcon fa-solid fa-bell "></i>
            </button>
            @include('notification.index')


            {{-- wishList --}}
            @if (count($listWishListTour) > 0)
                <button id="btn-WishList" class="wishlist container justify-content-center " onclick="wishListPop()">
                    <!-- <i class="fa-solid fa-user-plus AddUser"></i> -->
                    <i class="WishlistIcon fa-solid fa-heart"></i>
                </button>
                @include('wishList.index')
            @endif

            {{-- Booking --}}
            <button id="btn-WishList" class="wishlist container justify-content-center "
                onclick="BookingPop()">
                <i class="WishlistIcon fa-solid fa-clipboard-check"></i>
            </button>
            @include('tours.advertisedTour')

            {{-- chat --}}
            <a class="notefication container justify-content-center " href="{{ url('chatify') }}">
                <i class="iconadmin fa-solid fa-message" style="color: #fafafa;"></i>
            </a>



            @if ($user->type == 'admin')
                <button id="btn-WishList" class="notefication container justify-content-center "
                    onclick="editMainAdminPop()">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                @include('brief.editBreif')

                <a class="notefication container justify-content-center " href="{{ url('curdUsers') }}"> <i
                        class="fa-solid fa-circle-info me-1 iconadmin"></i></a>
            @endif


            @if ($user->type == 'tour_owner')
                <a class="notefication container justify-content-center" href="{{ url('curdTours') }}"> <i
                        class="fa-solid fa-circle-info me-1 iconadmin"></i></a>
            @endif


            <div class="container-fluid SettingProfileINheader">
                <ul>
                    <!-- this line impo -->
                    <li class="nav-item dropdown">
                        <img class="rounded-circle header_imgProfile" src="{{ asset('storage/' . $user->image) }}"
                            alt="Client_img">
                        <ul class="profileInNave">
                            <li><a href="{{ url("users/AnyProfile/$user->id") }}">{{trans('slidebar.Profile')}}</a></li>
                            <li><a href="{{ route('/logout') }}">{{trans('slidebar.Logout')}}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>


    </div>
</header>
