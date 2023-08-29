<html>

<head>

    <title>SignUp</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        body {
            display: flex;
            flex-wrap: wrap;
            background-color: #12151d !important;
            color: #fff;
            font-family: Tahoma;
            text-transform: capitalize;
        }
        h1 {
            color:red;
            margin: 0px 0px 20px;
        }
        input.form-control {
            background: transparent;
            color: #fff;
        }
        .card {
            max-width: 600px;
            width: 100%;
            margin: auto;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 0 17px black;
        }
    </style>
</head>


<body>
    <div class="card">
    <h1>SignUp</h1>
    <form action="user" method="POST" class="form-group">
        @csrf
        <input type="text" name="name" placeholder="Enter name" class="form-control" autocomplete="off">
        <span style="color: aqua">
            @error('name')
                {{ $message }}
            @enderror
        </span>
        <br>
        <input type="email" name="email" placeholder="enter email" class="form-control"  autocomplete="off">
        <span style="color: aqua">
            @error('email')
                {{ $message }}
            @enderror
        </span>
        <br>
        <input type="password" name="password" placeholder="enter password" class="form-control"  autocomplete="off">
        <span style="color: aqua">
            @error('password')
                {{ $message }}
            @enderror
        </span>
        <br>
        <input type="submit" name="submit" class="btn btn-primary" value="Create">
    </form>
    <p>Already have an account ?</p><a href="{{ url('sign-in') }}">SignIn</a>

</div>
</body>

</html>
