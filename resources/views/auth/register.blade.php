<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Register</title>
</head>

<body>
    <form action="{{ route('register.into') }}" method="post" class="main">
        @csrf
        {{-- <label for="name">Name:</label> --}}
        <p class="sign">Register</p>
        <input class="pass" type="text" id="name" name="name"  value="{{ old('name') }}" required placeholder="Name">
        @error('name')
            <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- <label for="email">Email:</label> --}}
        <input class="pass" type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Email">
        @error('email')
            <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- <label for="password">Password:</label> --}}
        <input class="pass" type="password" id="password" name="password" required placeholder="Password">
        @error('password')
            <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- <label for="password_confirmation">Confirm Password:</label> --}}
        <input class="pass" type="password" id="password_confirmation" name="password_confirmation" required placeholder="ConfirmPassword">

        <button class="reg" type="submit">Register</button>

        <p class="toLog"><a   href="{{ route('login.form') }}">to login</a></p>
    </form>
</body>

<style>
     body {
        background-color: #F3EBF6;
        font-family: 'Ubuntu', sans-serif;
    }

    .main {
        background-color: #FFFFFF;
        width: 400px;
        height: 500px;
        margin: 7em auto;
        border-radius: 1.5em;
        box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
    }

    .sign {
        padding-top: 40px;
        color: #8C55AA;
        font-family: 'Ubuntu', sans-serif;
        font-weight: bold;
        font-size: 30px;
        text-align: center;
    }


    /* .un {
    width: 76%;
    color: rgb(38, 50, 56);
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 1px;
    background: rgba(136, 126, 126, 0.04);
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    outline: none;
    box-sizing: border-box;
    border: 2px solid rgba(0, 0, 0, 0.02);
    margin-bottom: 50px;
    margin-left: 46px;
    text-align: center;
    margin-bottom: 27px;
    font-family: 'Ubuntu', sans-serif;
    } */

    form.form1 {
        padding: auto;
    }

    .pass {
            width: 76%;
            color: rgb(38, 50, 56);
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1px;
            background: rgba(136, 126, 126, 0.04);
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            outline: none;
            box-sizing: border-box;
            border: 2px solid rgba(0, 0, 0, 0.02);
            margin-bottom: 50px;
            margin-left: 46px;
            text-align: center;
            margin-bottom: 27px;
            font-family: 'Ubuntu', sans-serif;
    }


    .pass:focus, .pass:focus {
        border: 2px solid rgba(0, 0, 0, 0.18) !important;

    }

    .submit {
      cursor: pointer;
        border-radius: 5em;
        color: #fff;
        background: linear-gradient(to right, #9C27B0, #E040FB);
        border: 0;
        padding-left: 40px;
        padding-right: 40px;
        padding-bottom: 10px;
        padding-top: 10px;
        font-family: 'Ubuntu', sans-serif;
        margin-left: 35%;
        font-size: 13px;
        box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
    }
    .reg {
        cursor: pointer;
        border-radius: 5em;
        color: #fff;
        background: linear-gradient(to right, #9C27B0, #E040FB);
        border: 0;
        padding-left: 40px;
        padding-right: 40px;
        padding-bottom: 10px;
        padding-top: 10px;
        font-family: 'Ubuntu', sans-serif;
        margin-left: 35%;
        font-size: 13px;
        box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
    }

    .toLog {
        text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
        color: #E1BEE7;
        padding-top: 15px;
        text-align: center;
    }

    a {
        text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
        color: #E1BEE7;
        text-align: center;
    }

    .error-message {
        color: red;
        font-size: 14px;
        /* margin-left: 40px;
        margin-bottom: 10px; */
        text-align: center;
}

    @media (max-width: 600px) {
        .main {
            border-radius: 0px;
        }
</style>

</html>
