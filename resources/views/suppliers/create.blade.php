
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Supplier - </title>
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
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">

@csrf


<div class="form-group mb-3">
    <label class="font-weight-bold">Nama</label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Supplier">

    <!-- error message untuk title -->
    @error('nama')
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group mb-3">
    <label class="font-weight-bold">Alamat</label>
    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="5" placeholder="Masukkan Alamat Supplier">{{ old('alamat') }}</textarea>

    <!-- error message untuk description -->
    @error('alamat')
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group mb-3">
    <label class="font-weight-bold">Telepon</label>
    <input type="number" class="form-control @error('telepon') is-invalid @enderror" name="telepon" value="{{ old('telepon') }}" placeholder="Masukkan Telepon Supplier">

    <!-- error message untuk title -->
    @error('telepon')
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group mb-3">
    <label class="font-weight-bold">Email</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Masukan Email Supplier">

    <!-- error message untuk title -->
    @error('email')
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
    @enderror
</div>

<button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
<button type="reset" class="btn btn-md btn-warning">RESET</button>

</form>
</div>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

</body>
</html>
