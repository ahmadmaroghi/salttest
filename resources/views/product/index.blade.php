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
        <div class="col-md-12 mt-5 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3>Product Page</h3>
                </div>
                <form action="{{ route('product') }}" method="post">
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
                            <label for=""><strong>Product</strong></label>
                            <textarea class="form-control" id="textareaProduct" name="product" rows="3" placeholder="Product"></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><strong>Shipping Address</strong></label>
                            <textarea class="form-control" id="textareaAddress" name="address" rows="3" placeholder="Shipping Address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><strong>Price</strong></label>
                            <input type="text" name="price" class="form-control" placeholder="Price">
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