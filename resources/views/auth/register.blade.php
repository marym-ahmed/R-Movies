<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('CSS/login&register/login.css')}}">

</head>



<body>



    <div class="box boxReg">
        <div class="borderLine"></div>

        <form method="POST" action="{{ route('register') }}">
            <h2 class="card-header">sign up</h2>
            @csrf
            <div class="inputBox">


                <input id="name" type="text" class=" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                <span>First Name</span>
                <i></i>

                @error('name')
                <span class="error">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="inputBox">

                <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                <span>Email</span>
                <i></i>

                @error('email')
                <span class="error">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="inputBox">
                <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <span>Enter Your Password</span>
                <i></i>

                @error('password')
                <span class="error">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="inputBox">
                <input type="password" name="password_confirmation" required autocomplete="new-password">
                <span>Confirm Your password</span>
                <i></i>

            </div>

            <div class="link">
                <a href="{{ route('login') }}">Sign in</a>
            </div>
            <input class="mb-5" type="submit" value="Register" />
        </form>


    </div>









</body>



</html>
