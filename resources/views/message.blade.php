<html>
   <head>
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
   
   <body>
      <h1>SignUp</h1>
      <form action="user" method="POST">
         @csrf
         <input type="text" name="name" placeholder="Enter name">
         <span style="color: aqua">@error('name')
             {{($message)}}
         @enderror</span>
         <br>
         <input type="text" name="password" placeholder="enter password">
         <span style="color: aqua">@error('password')
            {{($message)}}
         @enderror</span>
         <br>
         <input type="submit" name="submit">
      </form>

      <h1>Login</h1>
      <form action="login" method="POST">
         @csrf
         <input type="text" name="name" placeholder="Enter name">
         <span style="color: aqua">@error('name')
             {{($message)}}
         @enderror</span>
         <br>
         <input type="text" name="password" placeholder="enter password">
         <span style="color: aqua">@error('password')
            {{($message)}}
         @enderror</span>
         <br>
         <input type="submit" name="Login">
      </form>
   </body>

</html>