@extends('layout')

@section('custom-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="{{ asset('css/tailwind.output.css') }} " />
@endsection

@section('title')
    Edit Info
@endsection

@section('script-pop')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("editUserInfoPop").style.display = "block";
        });
    </script>
@endsection


@section('contant')
    <!-- ======= Header ======= -->
    @include('navBar')
    <!-- End Header -->


    <div id="editUserInfoPop" class="editUserInfoPop">
        <div id="EditMain" class="EditMain">
            <div id="editInfoUser" class="editInfoUser">
                <span class="close" onclick="closeedEditUserInfoPop()">&times;</span>
                <h3 class=" intro_editing container  ps-5 ">Edit Profile Information </h3>


                {{-- admin./apdateUsers --}}
                <form class="container" method="POST" action="{{ url('users/update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="AddtourInfo">
                        <div class="infoAddTour container">

                                @include('users._form')
                                <input type="hidden" value="{{$user->id}}" name="user_id">
                                <input class="Submit_Join container" type="submit" name="submit" value="update">

                        </div>
                    </div>
                </form>

                <!-- <p class="introfav container text-center">Your favorite tours </p> -->


            </div>
        </div>
    </div>


    <section id="mainAdminCurd" class="mainAdminCurd d-flex justify-content-center">

        <div class="contentCurdPage mt-5">
            <div class="d-flex SeachSection">
                <p class="mt-5 ms-5 center searchP">All users in YallaRehla Site</p>

                {{-- <p class="mt-5 ms-5 searchP">Search</p>
                <form class="d-flex">
                    <input class="autoSearch AdminSearch mt-5 ms-2" placeholder="Search Client OR Owner tour ">
                </form>
                <button class="searchIcon"><i class="fa-solid fa-magnifying-glass"></i></button> --}}

            </div>

            <div class="mt-4 d-flex justify-content-center">

                <div class="flex flex-col flex-1 w-full">

                    <main class="h-full pb-16 overflow-y-auto">
                        <div class="container grid px-6 mx-auto">
                            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                                <div class="w-full overflow-x-auto">
                                    <table class="w-full whitespace-no-wrap">
                                        <thead>
                                            <tr
                                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                                <th class="px-4 py-3">User</th>
                                                <th class="px-4 py-3">Email</th>
                                                <th class="px-4 py-3">Type</th>
                                                <th class="px-4 py-3">phone number</th>
                                                <th class="px-4 py-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                                            {{-- {{dd($allusers )}} --}}
                                            @foreach ($allusers as $client)
                                                {{-- {{dd($user)}} --}}
                                                <tr class="text-gray-700 dark:text-gray-400">
                                                    <td class="px-4 py-3">
                                                        <div class="flex items-center text-sm">
                                                            <!-- Avatar with inset shadow -->
                                                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                                <img class="object-cover w-full h-full rounded-full"
                                                                    src="{{ asset('storage/' . $client->image) }}"
                                                                    alt="" loading="lazy" />
                                                                <div class="absolute inset-0 rounded-full shadow-inner"
                                                                    aria-hidden="true"></div>
                                                            </div>
                                                            <div>
                                                                <p class="font-semibold">{{ $client->name }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3 text-sm">
                                                        {{ $client->email }}
                                                    </td>
                                                    <td class="px-4 py-3 text-xs">

                                                        <span
                                                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                                            {{ $client->type }}
                                                        </span>
                                                    </td>
                                                    <td class="px-4 py-3 text-sm">
                                                        {{ $client->phone_number }}
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        <div class="flex items-center space-x-4 text-sm">
                                                            <form action="{{ url("users/curdUsersToEditUser/$client->id") }}"
                                                                method="get">
                                                                @csrf
                                                                <button
                                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-black-700  dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                                    aria-label="Edit">
                                                                    <svg class="w-5 h-5" aria-hidden="true"
                                                                        fill="currentColor" viewBox="0 0 20 20">
                                                                        <path
                                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                                        </path>
                                                                    </svg>
                                                                </button>
                                                            </form>

                                                            <form action="{{ url("users/delete/$client->id") }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button
                                                                    class="flex items-center justify-between px-2 py-1 font-semibold leading-tight text-red-700   dark:text-red-100 dark:bg-red-700 focus:outline-none focus:shadow-outline-gray"
                                                                    aria-label="Delete">
                                                                    <svg class="w-5 h-5" aria-hidden="true"
                                                                        fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd"
                                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                            clip-rule="evenodd"></path>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                <div
                                    class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                                    <span class="col-span-2"></span>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </section>


    <!-- End #main -->
@endsection


