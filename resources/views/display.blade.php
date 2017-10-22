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
                </div>
            @endif

            {!! Form::open(array('route' => 'display')) !!}
            <div class="row">
                <div class="col-md-2">
                    <select class="form-control m-bot15" name="language_code">
                    @if (!empty($languages))
                        @foreach($languages as $lang)
                            <option value="{{ $lang->language_code }}">{{ $lang->language_code }}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn">Submit</button>
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

        <div class="panel-body">
            @if (!empty($translations))
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Language</th>
                            <th>Translate ID</th>
                            <th>ResName</th>
                            <th>Text</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($translations as $trans)
                        <tr>
                            <td>{{ $trans->language_code }}</td>
                            <td>{{ $trans->trans_id }}</td>
                            <td>{{ $trans->resname }}</td>
                            <td>{{ $trans->text }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>
