<div class="modal fade" id="addTodoTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Todo Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="{{URL::to('todo/save')}}" id="frmAddTask" method="POST" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="modal-body">
        <ul id="errors" class="list-unstyled">
        </ul>
      <div class="form-group">
        <label for="txtName">Enter Todo Task</label>
        <input type="text" name="name" id="txtName" class="form-control" placeholder="Enter New Todo Task" required/>
      </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>