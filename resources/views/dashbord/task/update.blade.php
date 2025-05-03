
@extends("dashbord.layout.main")

@section('content')

<div class="card-body">
    <h4 class="card-title">Default form</h4>
    <p class="card-description"> Basic form layout </p>
    <form class="forms-sample" method="POST" action="{{ route("task.update",$task->id) }}">
      @csrf
      @method("PUT")
      <div class="form-group mt-3">
        <label for="exampleFormControlSelect2">User_id</label>
        <select class="form-control" name="user_id" id="exampleFormControlSelect2">
            @foreach ($User as $user)
            <option @selected($user->id==$task->user_id)  value="{{ $user->id }}" >{{ $user->name }}</option>
            @endforeach
        </select>
      </div>
      <div class="form-group">
        @error('title') <p style="color: red" >{{ $message }}</p> @enderror
        <label for="exampleInputUsername1">title</label>
        <input type="text" value="{{ $task->title }}"  name="title" class="form-control" id="exampleInputUsername1" placeholder="title">
      </div>
      <div class="form-group">
        @error('description') <p style="color: red" >{{ $message }}</p> @enderror
        <label for="exampleInputEmail1">description </label>
        <input type="text" value="{{ $task->description }}" name="description" class="form-control" id="exampleInputEmail1" placeholder="description">
      </div>

      <div class="form-group">
        @error('due_date') <p style="color: red" >{{ $message }}</p> @enderror
        <label for="exampleInputUsername1">due_date</label>
        <input type="date"  value="{{ $task->due_date }}" name="due_date" class="form-control" id="exampleInputUsername1" placeholder="due_date">
      </div>

      <div class="form-group">
        <label for="exampleSelectGender">is_completed</label>
        @error('is_completed') <p style="color: red" >{{ $message }}</p> @enderror
        <select class="form-control" name="is_completed" id="exampleSelectGender">
          <option @selected($task->is_completed==1) value="1">true</option>
          <option  @selected($task->is_completed==0) value="0">fasle</option>
        </select>
      </div>



      <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
      <button class="btn btn-light">Cancel</button>
    </form>
  </div>

@endsection
