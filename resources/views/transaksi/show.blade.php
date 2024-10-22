<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Transaction </title>
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
<div class="container">
    <h1>Detail Transaksi Penjualan</h1>
    <div class="card">
        <div class="card-header">
            Transaksi ID: {{ $transaksi->id }}
        </div>
        <div class="card-body">
            <p><strong>Tanggal:</strong> {{ $transaksi->tanggal_transaksi }}</p>
            <p><strong>Total:</strong> {{ number_format($transaksi->total, 0, ',', '.') }}</p>

            <h4>Detail Produk</h4>
            @if($transaksi->details->isEmpty())
                <p>Tidak ada detail transaksi.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah Pembelian</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $total=0;?>
                        @foreach($transaksi->details as $detail)
                        <tr>
                            <td>{{ $detail->product->title }}</td>
                            <td>{{ $detail->product->price }}</td>
                            <td>{{ $detail->jumlah_pembelian }}</td>
                            <td>{{ $detail->jumlah_pembelian*$detail->product->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
