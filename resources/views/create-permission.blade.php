<html>

<head>

    <title>Create Permission</title>
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
    <h1>Create Permission</h1>
    <form action="new-permission" method="POST" class="form-group">
        @csrf
        <input type="text" name="name" placeholder="Permission title" class="form-control" autocomplete="off">
        <span style="color: aqua">
        </span>
        <br>
        @foreach ($roles as $role)
            <li>{{ $role['name'] }}</li>
        @endforeach
        <br>
        <input type="submit" name="submit" class="btn btn-primary" value="Create">
    </form>
</div>
</body>

</html>
