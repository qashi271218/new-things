<div class="modal fade" id="editTodoTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Todo Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="{{URL::to('todo/update')}}" id="frmEditTask" method="POST" enctype="multipart/form-data">
      {{csrf_field()}}
      <input type="hidden" name="id" value="{{$task->id}}">
      <div class="modal-body">
      <div class="form-group">
        <label for="txtName">Enter Todo Task</label>
        <input type="text" name="name" id="txtName" class="form-control" value="{{$task->name}}" required/>
      </div>
      </div>
      <div class="modal-footer">
        <button type="submit" data-dismiss="modal" aria-hidden="true" data-task="{{$task->id}}" id="btnDelete" class="btn btn-danger">Delete</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>