<html>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <title>Ajax Example</title>
      
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
      
      {{-- <script>
         function getMessage() {
            $.ajax({
               type:'POST',
               url:'/getmsg',
               data:'_token = <?php echo csrf_token() ?>',
               success:function(data) {
                  $("#msg").html(data.msg);
               }
            });
         }
      </script>
   </head> --}}
   
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
         <input type="submit" name="submit" class="btn btn-primary">
      </form>

      <h1>Login</h1>
      <form action="login" method="POST" class="form-group">
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
         <input type="submit" name="Login" class="btn btn-primary">
      </form>
   </body>

</html>