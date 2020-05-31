<!DOCTYPE html>
<html lang="en">
<head>
  <title>Todo List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">All Todo Tasks List<span class="pull-right mr-4"><button type="button" class="btn btn-success btn-xs" id="btnAddTask">+</button></span></h3>
	</div>
	<div class="panel-body">
		<ul class="list-group">
		@if($tasks->all())
		@foreach($tasks as $task)
		<li class="list-group-item">{{$task->id}} - {{$task->name}}<span class="pull-right"><button type="button" data-task="{{$task->id}}" class="btn btn-success btn-xs btnManage"><i class="glyphicon glyphicon-cog"></i></button></span></li>
		@endforeach
		@else
		<li class="list-group-item alert alert-danger"><strong>No record found</strong></li>
		@endif
	</ul>
	{{$tasks->links()}}
	</div>
	<div class="panel-footer">
	  copyright &copy; 2020 Qasim Sumal
	</div>
</div>
</body>
</html>