
@extends("dashbord.layout.main")

@section('content')

<div class="card-body">
    <h4 class="card-title">Default form</h4>
    <p class="card-description"> Basic form layout </p>
    <form class="forms-sample" method="POST" action="{{ route("task.store") }}">
      @csrf
      <div class="form-group">
        <div class="form-group mt-3">
            <label for="exampleFormControlSelect2">User</label>
            <select class="form-control" name="user_id" id="exampleFormControlSelect2">
                @foreach ($User as $user)
                <option value="{{ $user->id }}" >{{ $user->name }}</option>
                @endforeach
            </select>
          </div>

        @error('tittle') <p style="color: red" >{{ $message }}</p> @enderror
        <label for="exampleInputUsername1">Tittle</label>
        <input type="text"  name="title" class="form-control" id="exampleInputUsername1" placeholder="Tittle">
      </div>
      <div class="form-group">
        @error('description') <p style="color: red" >{{ $message }}</p> @enderror
        <label for="exampleInputEmail1">description </label>
        <input type="text" name="description" class="form-control" id="exampleInputEmail1" placeholder="description">
      </div>
      <div class="form-group">
        @error('due_date') <p style="color: red" >{{ $message }}</p> @enderror
        <label for="exampleInputUsername1">due_date</label>
        <input type="date" name="due_date" class="form-control" id="exampleInputUsername1" placeholder="Date">
      </div>


      <div class="form-group">
        <label for="exampleSelectGender">is_completed</label>
        @error('is_completed') <p style="color: red" >{{ $message }}</p> @enderror
        <select class="form-control" name="is_completed" id="exampleSelectGender">
          <option value="1">true</option>
          <option value="0">false</option>
        </select>
      </div>



      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
      <button class="btn btn-light">Cancel</button>
    </form>
  </div>

@endsection
