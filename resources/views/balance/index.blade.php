<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Hello, {{ Auth::user()->name }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('balance') }}">Prepaid Balance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product') }}">Product Page</a>
                </li>
            </ul>
            <span class="navbar-text">
                <a href="{{ route('logout') }}" class="btn btn-danger float-right">Logout</a>
            </span>
        </div>
    </nav>

    <div class="container">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3>Prepaid Balance</h3>
                </div>
                <form action="{{ route('balance') }}" method="post">
                @csrf
                    <div class="card-body">
                        @if(session('errors'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Something it's wrong:
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for=""><strong>Mobile</strong></label>
                            <input type="text" name="mobile" class="form-control" placeholder="Mobile Number">
                        </div>
                        <div class="form-group">
                            <label for=""><strong>Value</strong></label>
                            <input type="text" name="value" class="form-control" placeholder="Value">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>