<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2>Edit</h2>
    <form  action="{{ url('/Users/update') }}" method="post" enctype="multipart/form-data">
        @csrf

        <input type="hidden" value="{{$data->id}}" name="id">

        <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name" value="{{ $data->name  }}">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail">Email address</label>
            <input type="email" name="email"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $data->email}}">
        </div>
        <div class="form-group">
            <label class="custom-file-label" for="chooseFile">Choose CV </label>
            <input type="file" name="file" class="custom-file-input" id="chooseFile">
        </div>
        <input type="hidden" name="old_file"  value="{{ $data->file  }}">

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>
