<div id="login" class="login">
    <div id="login-content" class="login-content">
        <span class="close" onclick="closeLogin()">&times;</span>
        <!-- <div id="register" calss="register"> -->
        <div id="SignIn_intro" class="SignIn_intro">
            <h3 class="container text-center">Welocme Back</h3>
            <p class="glad container text-center">We're glad you're Back Again </p>


            @if (!$errors->has('email') && !$errors->has('password'))
                @include('errors')
            @endif

            <form method="POST" action="{{ route('/login') }}">
                @csrf
                <div class="info_login">
                    <p>Email</p>
                    <input class="username text-center" type="text" name="email" placeholder="Enter Email"
                        value="{{ old('email') }}"><br>

                    @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    @endif


                    <br>
                    <p>Password</p>
                    <input class="username text-center" type="password" name="password" value="{{ old('password') }}"
                        placeholder="Enter Password" required>
                    <br>

                    @if ($errors->has('password'))
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                    @endif
                    <br><br>

                    <input class="username login_info text-center " type="submit" name="submit" value="Login">
                </div>
            </form>


        </div>

        <div class="account-create">
            <span>Don't have an account?</span>
            <!-- ----------------------------- -->
            <button id="btn-SignIn" class="btn-SignIn" onclick="signIn()">Sign up </button>
        </div>
    </div>

    {{--  --}}
    @include('auth.signUp')
    {{--  --}}


</div>
