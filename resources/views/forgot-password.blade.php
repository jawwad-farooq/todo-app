<html>
<head>
  <title>SignIn</title>
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
       color: #000;
       font-family: Tahoma;
       text-transform: capitalize;
   }
   h1 {
       color:red;
       margin: 0px 0px 20px;
   }
   input.form-control {
       background: transparent;
       color: #0a0a0a;
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
    <h2>Reset Your Password</h2>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" required>

        <button type="submit">Send Password Reset Link</button>
    </form>
</body>

</html>