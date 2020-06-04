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
              <div class="container">
        <button class="btn btn-success btn-sm product_cart_button addcart" data-toggle="modal" data-target="#cartModal">Add New</button>
    </div>
                 <div id="todolist">
            
        </div>
        <div id="modals">
        </div>
            </div>
        </div>
    </div>
       


    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Product Quick View</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
       <form id="addform">
        {{csrf_field()}}
    <div class="form-group">
      <label>Name</label>
      <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group">
      <label>Description</label>
      <input type="text" class="form-control" name="description">
    </div>
  <div class="form-group">
    <label>Address</label>
    <input type="text" class="form-control" name="address" placeholder="1234 Main St">
  </div>
  <button type="submit" class="btn btn-primary">Insert</button>
</form>
</div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>



    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!--
|--------------------------------------------------------------------------
| EDIT and update
|--------------------------------------------------------------------------
 -->
      <script>
$(document).ready(function(){
           $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  $('#todolist').on('click','.editbtn',function()
         {
            var id=$(this).data('task');
            $.get('{{URL::to("crud/edit")}}/'+id,function(data)
         {
           $('#modals').empty().append(data);
           $('#editTodoTask').modal('show');
         });
         });

        $('#modals').on('submit','#frmEditTask',function(e)
         {
           e.preventDefault();
           var frmData=$(this).serialize();
           $.post('{{URL::to("crud/update")}}',frmData,function(data,xhrStatus,xhr)
           {
             $('#todolist').empty().append(data);
           });
         });
});
      </script>




<!--
|--------------------------------------------------------------------------
| Insert and view functionality
|--------------------------------------------------------------------------
 -->
    <script type="text/javascript">
    $(document).ready(function(){

$.get('{{URL::to("crud")}}',function(data)
         {
           $('#todolist').empty().append(data);
         });
    $('#addform').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"{{url('/studentadd')}}",
            data:$('#addform').serialize(),
          })
            .done(function(data)
            {
$('#cartModal form :input').val("");              
$('#todolist').empty().append(data);
alert('data saved');
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


    });
</script>


<!--
|--------------------------------------------------------------------------
| Delete functionality
|--------------------------------------------------------------------------
 -->
<script>
$(document).ready(function(){
  $('#modals').on('click','#btnDelete',function()
         {
            var id=$(this).data('task');
            $.get('{{URL::to("crud/destroy")}}/'+id,function(data)
         {
            $('#todolist').empty().append(data);
         });
         });
});
</script>

<!--
|--------------------------------------------------------------------------
| Pagination
|--------------------------------------------------------------------------
 -->
<!-- <script>
$(document).ready(function(){
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
</script> -->


<!--
|--------------------------------------------------------------------------
| Live search
|--------------------------------------------------------------------------
 -->
<script>
$(document).ready(function(){
 
});
</script>


</body>

</html>