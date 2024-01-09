<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('CSS/login&register/login.css')}}">

</head>



<body>


   <div class="transparence"></div>
    <div class="box">
        <div class="borderLine"></div>
        <form method="POST" action="{{ route('login') }}">
            <h2>Sign in </h2>
            @csrf

            <div class="inputBox">


                <input type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                <span>Enter your new email </span>
                <i></i>

                @error('email')
                <span class="error">
                    {{ $message }}
                </span>
                @enderror

            </div>

            <div class="inputBox">


                <input type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                <span>Enter Your new password</span>
                <i></i>
                @error('password')
                <span class="error">
                    {{ $message }}
                </span>
                @enderror

            </div>
            <div class="link">
                <a href="{{ route('register') }}">Sign up</a>
            </div>

            <input type="submit" value="Login" />





        </form>


    </div>
<h3>To show The Movies You
    <br> Should Login First ...</h3>



</body>



</html>