<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Login</title>
</head>

<body>
    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="main" method="POST" action="{{ route('login') }}">
        @csrf
        <p class="login">Login</p>
        {{-- <label for="email">Email:</label> --}}
        <input class="pass" type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Email">

        {{-- <label for="password">Password:</label> --}}
        <input class="pass" type="password" id="password" name="password" required placeholder="Password">

        <button class="submit" type="submit">Login</button>

        <p class="regis"><a href="{{ route('register') }}">Register</a></p>
    </form>

</body>

    <style>
        body {
            background-color: #F3EBF6;
            font-family: 'Ubuntu', sans-serif;
        }
        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
        }
        form{
            &.main{
                background-color: #FFFFFF;
                width: 400px;
                height: 400px;
                margin: 7em auto;
                border-radius: 1.5em;
                box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
                & .pass{
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
                & .login {
                    padding-top: 40px;
                    color: #8C55AA;
                    font-family: 'Ubuntu', sans-serif;
                    font-weight: bold;
                    font-size: 30px;
                    text-align: center;
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
                .regis{
                    text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
                    color: #E1BEE7;
                    padding-top: 15px;
                    text-align: center;
                    & a {
                        text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
                        color: #E1BEE7;
                        text-align: center;
                    }
                }
            }
        @media (max-width: 600px) {
        .main {
            border-radius: 5px;
        }
        }
    </style>
</html>
