<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>Todo list</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <input type="search" name="search" id="serachTodo" class="form-control" placeholder="enter your serach....">
                 <div id="todolist">
            
        </div>
        <div id="modals">
        </div>
            </div>
        </div>
    </div>
       

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function()
        {
            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
         $.get('{{URL::to("tasks")}}',function(data)
         {
           $('#todolist').empty().append(data);
         });
         $('#todolist').on('click','#btnAddTask',function()
         {
            $.get('{{URL::to("todo/create")}}',function(data)
         {
           $('#modals').empty().append(data);
           $('#addTodoTask').modal('show');
         });
         });
          $('#todolist').on('click','.btnManage',function()
         {
            var id=$(this).data('task');
            $.get('{{URL::to("todo/edit")}}/'+id,function(data)
         {
           $('#modals').empty().append(data);
           $('#editTodoTask').modal('show');
         });
         });
           $('#modals').on('click','#btnDelete',function()
         {
            var id=$(this).data('task');
            $.get('{{URL::to("todo/destroy")}}/'+id,function(data)
         {
            $('#todolist').empty().append(data);
         });
         });
         $('#modals').on('submit','#frmAddTask',function(e)
         {
           e.preventDefault();
           var frmData=$(this).serialize();
           // $.post('{{URL::to("todo/save")}}',frmData,function(data,xhrStatus,xhr)
           // {
           //   $('#todolist').empty().append(data);
           // });
           $.ajax({
            url:'{{URL::to("todo/save")}}',
            type:'POST',
            data:frmData,
          })
            .done(function(data)
            {
              $("#modals #errors").empty().append('<li class="alert alert-success">Task added successfully</li>');
              $('#todolist').empty().append(data);
            })
            .fail(function(error){
              var error=error.responseJSON;
              $("#modals #errors").empty();
              error.name.forEach(function(element,index)
              {
                $("#modals #errors").append('<li class="alert alert-danger">'+element+'</li>');
              });
            });
           });
                  $('#modals').on('submit','#frmEditTask',function(e)
         {
           e.preventDefault();
           var frmData=$(this).serialize();
           $.post('{{URL::to("todo/update")}}',frmData,function(data,xhrStatus,xhr)
           {
             $('#todolist').empty().append(data);
           });
         });
                  $('#todolist').on('click','.pagination a',function(e)
                  {
                    e.preventDefault();
                    var url=$(this).attr('href');
                    $.get(url,function(data)
         {
           $('#todolist').empty().append(data);
         });
                  })
        });
        $( function() {
    
    $( "#serachTodo" ).autocomplete({
      source: "{{URL::to('todo/search')}}"
    });
  } );
    </script>
</body>

</html>



type:"POST",
            url:"{{url('/studentadd')}}",
            data:$('#addform').serialize(),