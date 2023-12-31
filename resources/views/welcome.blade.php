<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <h1 style="display: none;">{{ $user = Session::get('user') }} </h1>

<head>
  <title>welcome</title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  
  <script>
      $(document).ready(function(){
         $.ajaxSetup({
            headers:{
               'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
         });

         
         var userID = $('.user_id').val();
         
         function displayData() {
            $.ajax({
               type: 'GET',
               url: '/showtask/'+userID,
               dataType : 'json',
               success: function (response) {
                     var tbody = $('#getdata');
                     tbody.empty();
                     var roles = response.roles.map(function (role) {
                        return role.name;
                     });
                     $.each(response.current, function (key, item) {
                        var isChecked = item.check ? 'checked' : 'noCheck';
                        var deleteButton = '';
                        var checkBox = '';

                        if (roles.includes('admin')) {
                           deleteButton = '<button class="del-btn btn btn-danger" value="' + item.id + '">delete</button>';
                        }

                        if (roles.includes('editor') || roles.includes('admin')) {
                           checkBox = '<input type="checkbox" name="checkmark" class="check-mark" value="done" data-task-id="'+item.id+'" '+isChecked+'>';
                        }

                        tbody.append('<tr><td>' + item.taskname + '</td>\
                           <td>' + checkBox + '</td>\
                           <td>' + deleteButton + '</td></tr>');
                     });
               },
               error: function (xhr, status, error) {
                     console.error(error);
               }
            });
         }

         displayData();

         
         console.log(userID);
         function displayUserID(){
            $.ajax({
               type:'GET',
               url:'showuserid/'+userID,
               success:function(response){
                  $.each(response, function (key, item) {
                     $('#us').append('<a>'+item.user_id+'</a><a>'+item.taskname+'</a>');
                  });
                  console.log(response);
               }
            });
         }
         displayUserID();

         $("#addpost").on('submit',function(event){
            event.preventDefault();
            $.ajax({
               type:'POST',
               url:"{{url('newtask')}}",
               data:$('#addpost').serialize(),
               success:function(data) {
                  $('#addpost')[0].reset();
               }
            });
            displayData();
         });

        
         $(document).on('click', '.del-btn', function(e) {
            e.preventDefault();

            var id = $(this).val();
            $.ajax({
               type:'DELETE',
               url:'/deletetask/' + id,
               dataType:'json',
               success:function(result){
                  console.log("Task deleted successfully:", result);
                  displayData(); 
               },
               error: function(xhr, status, error) {
                     console.error("Error deleting task:", error);
               }
            });
         });

         $(document).on('click', '.check-mark', function() {
            var isChecked = $(this).prop('checked');
            var taskId = $(this).data('task-id');
            $.ajax({
               type:'POST',
               url:'/updatetask/' + taskId,
               data: {
                  _token: $('meta[name="csrf-token"]').attr('content'),
                  isCheckedy: isChecked
               },
               success:function(result){
                  console.log("Task updated successfully:", result);
                  displayData(); 
               },
               error: function(xhr, status, error) {
                     console.error("Error updating task:", error);
               }
            });
         });
     });
  </script>

<style>
   body {
       background-color: #12151d !important;
       color: #fff;
       font-family: Tahoma;
       text-transform: capitalize;
       padding: 3em 0px;
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
       max-width: 1440px;
       width: 80%;
       margin: auto;
       padding: 25px;
       border-radius: 20px;
       box-shadow: 0 0 17px black;
   }
   .top-line {
      display: flex;
      justify-content: space-between;
   }
</style>
</head>
<body>

   <div class="card">
      <div class="top-line">
   <h1>{{ $user->name }} Create Task </h1>
   <a href="{{url('logout')}}" class="btn btn-danger" style="margin-bottom: auto; margin-top: auto;">Logout</a></div>
   {{-- @php
      $userRoles = $user->roles->pluck('name')->toArray();
   @endphp --}}

      
      <form action="{{url('newtask')}}" method="POST" id="addpost">
         @csrf
         <input type="hidden" name="user_id" value="{{$user->id}}" class="user_id">
         @if ($user->roles->contains('name', 'creator') || $user->roles->contains('name', 'admin'))
            <input type="text" name="task_name" class="form-control" placeholder="Enter Task Name">
            <input type="submit" value="Add" class="btn btn-primary" style="margin-top: 20px">
         @endif
      </form>
   
</div>


<div class="card">
      <table class="table table-striped">
         <thead>
            <tr>
               <th>task name</th>
               <th>status</th>
               <th>action</th>
            </tr>
         </thead>
         <tbody id="getdata">
            
         </tbody>
      </table>
      <h1 id="us"></h1>
    </div>
   </body>
</html>
