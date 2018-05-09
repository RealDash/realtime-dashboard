<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Task</title>
</head>
<body>

    <form action="{{ route('create-task') }}" method="POST" role="form">
        <legend>New Task</legend>

        <div class="form-group">
            <label for="">title</label>
            <input type="text" class="form-control" id="" placeholder="Input field">
        </div>
        <div class="form-group">
            <label for="">title</label>
            <input type="text" class="form-control" id="" placeholder="Input field">
        </div>
        <div class="form-group">
            <label for="">title</label>
            <input type="text" class="form-control" id="" placeholder="Input field">
        </div>
        <div class="form-group">
            <label for="">title</label>
            <input type="text" class="form-control" id="" placeholder="Input field">
        </div>



        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</body>
</html>