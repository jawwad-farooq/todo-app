<html>

<head>

    <title>All Users</title>
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
        input.form-control, tr {
            background: transparent !important;
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
    <h1>All Users</h1>
    <table class="table table-striped">
        <tr>
            <th>User</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        @foreach ($user as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td></td>
                <td>
                    <button class="btn btn-danger">Delete</button>
                    <button class="btn btn-primary">Edit</button>
                </td>
            </tr>
        @endforeach

    </table>
    
</div>
</body>

</html>
