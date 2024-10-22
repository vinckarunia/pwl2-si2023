<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Products </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="padding-left:30px">
  <ul class="navbar-nav">
    <a class="navbar-brand" href="#">Sales</a>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('products') }}">Product</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('suppliers') }}">Suplier</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('transaksi') }}">Transaction</a>
    </li>
  </ul>
</nav>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <img src="{{ asset('/storage/'.$product->image) }}" class="rounded" style="width: 100%">
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h3>{{ $product->title }}</h3>
                    <hr/>
                    <p>{{ "Rp " . number_format($product->price,2,',','.') }}</p>
                    <code>
                        <p>{!! $product->description !!}</p>
                    </code>
                    <hr/>
                    <p>Stock : {{ $product->stock }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
