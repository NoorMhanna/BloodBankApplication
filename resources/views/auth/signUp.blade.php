

<div id="contentsignUp" class="contentsignUp">
    <div class="infoSign"><span class="close" onclick="closeSignIn()">&times;</span>
        <!-- recheck  -->
        <h2 class="container text-center"><span class="join">Join Us</span></h2>
        <div class="create-account-box" id="create-account-box">

            <h2 class="container text-center"> To Show All tours and more
                became a member !</h2>

            <div class="imageSign form_SignUp">
                <img src="{{ asset('storage/Journey-pana.png') }}">

            </div>
            <div class="form_SignUp">
                <form class="infoDataSignUp container" method="POST" action="{{ url('signUp') }}"
                    enctype="multipart/form-data">
                    @csrf
                    {{--  --}}
                    @include('users._form')
                    {{--  --}}

                    <input class="username login_info text-center " type="submit" name="submit" value="join">
                </form>

                <div class="account-login">
                    {{-- <p>Already have an account? <a href="{{ url('login') }}">  <button id="login-link">Login</button> </a></p> --}}
                    <p>Already have an account?
                    <button  onclick="login()" >Login</button></p>
                </div>

            </div>
        </div>
    </div>
</div>
