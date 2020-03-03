<!DOCTYPE HTML>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	 @include('layouts.header');
	<div class="container">
		<div class="row">
			@if(session()->has('admin_email'))
			<div class="col-12"><a href="{{ route('trip.create') }}" class="btn btn-primary">Create</a></div>
			@endif
			<div class="col-12">
				<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">SL</th>
				      <th scope="col">Day</th>
				      <th scope="col">Time</th>
				      <th scope="col">Bus</th>
				      <th scope="col">Helper</th>
				      <th scope="col">From</th>
				      <th scope="col">via</th>
				      <th scope="col">destination</th>
				      <th scope="col">Driver</th>
				       @if(session()->has('admin_email'))
				      <th scope="col">Action</th>
				      @endif
				    </tr>
				  </thead>
				  <tbody>
				  	<?php $i=1; ?>
				  	@foreach($trip as $b)
				    <tr id="{{$i}}" onmousemove="showCoords(event,this.id)" onmouseout="hide(this.id)" style="position: relative;">
				      <th scope="row">{{ $i }}</th>
				      <td>{{$b->day}}</td>
				      <td>{{$b->start_time}}</td>
				      <td>{{$b->bus()}}</td>
				      <td>{{$b->helper()->name}}</td>
				      <td>{{$b->route()->start}}</td>
				      <td>{{$b->route()->via}}</td>
				      <td>{{$b->route()->destination}}</td>
				      <td>{{$b->driver()->name}}</td>
				       @if(session()->has('admin_email'))
				      <td>
				      	<a href="{{ route('trip.edit',$b->id) }}" class="btn btn-primary">Update</a>
				      	<a href="{{ route('trip.destroy',$b->id) }}" class="btn btn-warning">Delete</a>
				      
				      </td>
				      @endif
				    </tr>
				    <tr id="{{$i++}}1" style="display:none; position: absolute;background-color:rgb(17, 226, 71);">
				    	<td>
				    		{{$b->driver()->name}}:{{$b->driver()->contact}}<br>
				    		{{$b->helper()->name}}:{{$b->helper()->contact}}
				    	</td>
				    </tr>
				   @endforeach
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</body>
<script>
function showCoords(event,getid) {
    var id1=document.getElementById(getid+"1");
    var x = event.clientX;
     if (x < 1045) {
    id1.style.display="block";
    id1.style.marginLeft=x+"px";
    }
    else{
    	hide(getid);
    }

}
function hide(getid){
	getid=getid+"1";
 	var id1=document.getElementById(getid);
    id1.style.display="none";
    id1.style.marginLeft="0";
}
</script>