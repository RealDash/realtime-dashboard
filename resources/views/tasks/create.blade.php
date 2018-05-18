<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Create Task</title>
</head>
<body>

<div class="container">

    <form action="{{ route('new-task') }}" method="POST" role="form">
    <legend>New Task</legend>
    @if(!empty($errors))
          @if($errors->any())
              <ul class="alert alert-danger" style="list-style-type: none">
                  @foreach($errors->all() as $error)
                      <li>{!! $error !!}</li>
                  @endforeach
              </ul>
          @endif
      @endif

        {{ csrf_field() }}

        <div class="form-group">
            <label for="">title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}" id="" placeholder="task title">
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <input type="text" class="form-control" name="descrip" value="{{ old('descrip') }}" id="" placeholder="task description">
        </div>
        <div class="form-group">
            <label for="">Start Date</label>
            <input type="text" class="form-control" name="start_date" value="{{ old('start_date') }}" id="" placeholder="DD/MM/YYYY">
        </div>
        <div class="form-group">
            <label for="">End Date</label>
            <input type="text" class="form-control" name="end_date" value="{{ old('end_date') }}" id="" placeholder="DD/MM/YYYY">
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category" value="{{ old('category') }}" id="">
                @foreach(\App\Model\Category::all() as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>



        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>