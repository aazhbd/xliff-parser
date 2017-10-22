<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload XLIFF file</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
            <li><a href="display/">View contents</a></li>
            <li><a href="export/">Export contents</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong>{{ $message }}</strong>
                    @if ($file = Session::get('file'))
                        <strong>Click here to <a href="import-file/{{ $file }}">import the file content</a>.</strong>
                    @endif
                </div>
            @endif

            @if ($inserted = Session::get('inserted'))
                <div class="alert alert-success alert-block">
                    <strong></strong>
                </div>
            @endif

            {!! Form::open(array('route' => 'xliff.post','files'=>true)) !!}
            <div class="row">
                <div class="col-md-4 form-group">
                    {!! Form::file('file', array('class' => 'form-control')) !!}
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn">Upload</button>
                </div>
            </div>
            {!! Form::close() !!}

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    Error occurred.
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>
