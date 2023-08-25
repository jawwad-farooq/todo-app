<html>

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

 
<body style="width: 80%; margin:auto;">
  <h1>SignUp</h1>
  <form action="user" method="POST" class="form-group">
     @csrf
     <input type="text" name="name" placeholder="Enter name" class="form-control">
     <span style="color: aqua">@error('name')
         {{($message)}}
     @enderror</span>
     <br>
     <input type="text" name="password" placeholder="enter password" class="form-control">
     <span style="color: aqua">@error('password')
        {{($message)}}
     @enderror</span>
     <br>
     <input type="submit" name="submit" class="btn btn-primary" value="Create">
  </form>
  <p>Already have an account ?</p><a href="{{ url('sign-in')}}">SignIn</a>
 </body>
</html>