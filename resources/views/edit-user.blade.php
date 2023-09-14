<html>

<head>

    <title>Edit User</title>
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
    <h1>Edit User</h1>
    <form action="{{ url('update-user/'.$user->id) }}" method="POST" class="form-group">
        @csrf
        {{-- @method('PUT') --}}
        <input type="text" name="name" placeholder="User name" class="form-control" autocomplete="off" value="{{ $user->name }}">
        <span style="color: aqua">
            @error('name')
                {{ $message }}
            @enderror
            @if (session('error'))
                {{ session('error') }}
            @endif
        </span>
        <br>
        <input type="email" name="email" placeholder="enter email" class="form-control"  autocomplete="off" value="{{ $user->email }}">
        <span style="color: aqua">
            @error('email')
                {{ $message }}
            @enderror
        </span>
        <br>
        <input type="password" name="password" placeholder="enter password" class="form-control"  autocomplete="off" value="">
        <span style="color: aqua">
            @error('password')
                {{ $message }}
            @enderror
        </span>
        <br>
        @foreach ($roles as $role)
            <label for="">
                <input type="radio" name="role" value="{{ $role['id'] }}"/>
                {{ $role['name'] }}
            </label>
        @endforeach
        <br>
        <input type="submit" name="submit" class="btn btn-primary" value="Update">
    </form>

</div>
</body>

</html>
