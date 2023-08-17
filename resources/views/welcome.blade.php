<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <h1 style="display: none;">{{ $user = Session::get('user') }} </h1>

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
  </script>
  
  <script>
      $(document).ready(function(){
         $.ajaxSetup({
            headers:{
               'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
         });

         displayData();

         function displayData() {
            $.ajax({
               type: 'GET',
               url: "{{url('showtask')}}"+/+{{$user->id}},
               dataType: "json",
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function (response) {
                     var tbody = $('tbody');
                     tbody.empty();
                     $.each(response.task, function (key, item) {
                        var isChecked = item.check ? 'checked' : '';
                        tbody.append('<tr id="'+item.user_id+' / {{$user->id}}"><td>' + item.taskname + '</td>\
                           <td><input type="checkbox" name="checkmark" class="check-mark" value="done" data-task-id="'+item.id+'" '+isChecked+'></td>\
                           <td><button class="del-btn btn btn-danger" value="'+ item.id +'">delete</button> </td></tr>');
                     });
               },
               error: function (xhr, status, error) {
                     console.error("Error fetching data:", error);
               }
            });
         }

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
            // e.preventDefault();
            // var id = $(this).val();
            console.log("ggg");
            var isChecked = $(this).prop('checked');
            var taskId = $(this).data('task-id');
            $.ajax({
               type:'POST',
               url:'/updatetask/' + taskId,
               data: {
                  _token: $('meta[name="csrf-token"]').attr('content'),
                  isChecked: isChecked
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
</head>
<body  style="width: 80%; margin:auto;">

   
   <h1>{{ $user->name }} Create Task</h1>
   <a href="{{url('logout')}}">Logout</a>
{{-- @auth --}}
  <form action="{{url('newtask')}}" method="POST" id="addpost">
    @csrf
    <input type="hidden" name="user_id" value="{{$user->id}}">
    <input type="text" name="task_name" class="form-control" placeholder="Enter Task Name">
    <input type="submit" value="Add" class="btn btn-primary">
  </form>
  {{-- @else
        <p>You are not authenticated.</p>
    @endauth --}}

    <div>
      @section('content')
      <table class="table table-striped">
         <tr>
            <th>task name</th>
            <th>status</th>
            <th>action</th>
         </tr>
         <tbody></tbody>
      </table>
    </div>
   </body>
</html>
