<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('CSS/login&register/login.css')}}">

</head>



<body>
    <div class="box">
        <div class="borderLine"></div>
        <form action="{{ route('update.user',$user->id) }}" method="POST" enctype="multipart/form-data">
            <h2>Edit Your Account</h2>
            @csrf
            <div class="inputBox">
                <input type="text" name="name" value="{{ $user->name }}" required="required" />
                <span>user Name</span>
                <i></i>

                @error('name')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="inputBox">
                <input type="email" name="email" value="{{ $user->email }}" required="required" />
                <span>user Email</span>
                <i></i>


                @error('email')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>


            <input type="submit" value="submit" />
    </div>
    </form>
</body>



</html>
