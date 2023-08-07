<!-- <p>Username</p> -->
<table class="container">

    <tr>
        <td>
            <span> {{trans('slidebar.Username')}}  &nbsp;&nbsp;&nbsp;&nbsp; </span>
        </td>
        <td>
            <input class="infoSignUp" required name="name" value="{{ old('name', $user->name ?? '') }}"
                placeholder="Enter Username"><br>
            @if ($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </td>
    </tr>
    <br>


    <tr>
        <td>
            <span>{{trans('slidebar.Email')}} &nbsp;&nbsp;&nbsp;&nbsp;</span>
        </td>
        <td>
            <input class="infoSignUp" required type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                placeholder="Enter Email "><br>
            @if ($errors->has('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
            @endif
        </td>
    </tr>
    <br>

    <tr>
        <td>
            <span>{{trans('slidebar.User Photo')}}  &nbsp;&nbsp;&nbsp;&nbsp;</span>
        </td>
        <td>
            <input type="file" value="{{ old('image', $user->image ?? '') }}" name="image"
                class="form-control mb-3 infoSignUp">
            @if ($errors->has('image'))
                <p class="text-danger">{{ $errors->first('image') }}</p>
            @endif
        </td>
    </tr>
    <br>

    <tr>
        <td>
            <span>{{trans('slidebar.phone')}} &nbsp;&nbsp;&nbsp;&nbsp;</span>
        </td>
        <td>
            <input class="infoSignUp" required type="text" name="phone_number"
                value="{{ old('phone_number', $user->phone_number ?? '') }}" placeholder="Enter Phone Number"><br>
            @if ($errors->has('phone_number'))
                <p class="text-danger">{{ $errors->first('phone_number') }}</p>
            @endif

        </td>
    </tr>
    <br>


    <tr>
        <td>
            <!-- <p>Password</p> -->
            <span>{{trans('slidebar.Password')}} </span>
        </td>
        <td>
            <input class="infoSignUp" required type="password" name="password" placeholder="Enter new Password"><br>
            @if ($errors->has('password'))
                <p class="text-danger">{{ $errors->first('password') }}</p>
            @endif

        </td>
    </tr>
    <br>

    <tr>
        <td>
            <span> {{trans('slidebar.Privacy')}} &nbsp;&nbsp;&nbsp;&nbsp;</span>
        </td>
        <td>
            <input required {{ old('setting', $user->setting ?? '') }} type="radio" id="public" name="setting"
                value="public">
            <label for="public">{{trans('slidebar.public')}}</label>
            <input required {{ old('setting', $user->setting ?? '') }} type="radio" id="private" name="setting"
                value="private">
            <label for="private">private</label>
            @if ($errors->has('setting'))
                <p class="text-danger">{{ $errors->first('setting') }}</p>
            @endif
        </td>
    </tr>
    <br>

</table>
