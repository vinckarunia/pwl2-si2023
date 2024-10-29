<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Transaction </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
   #kembali {
        background: #394867;
        color: white;
        transition: 0.2s;
        border:none;
    }

    #kembali:hover {
        background: #212A3E;
        border:none;
    }
</style>
<body style="background:  #f8f9fa">


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
                            <td>Rp{{ number_format($detail->product->price, 2, ',', '.') }}</td>
                            <td>{{ $detail->jumlah_pembelian }}</td>
                            <td>Rp{{ number_format($detail->jumlah_pembelian*$detail->product->price, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary" id="kembali">Kembali</a>
        </div>
    </div>
</div>
</div>
<script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<script>
   document.addEventListener("DOMContentLoaded", function () {
        new TypeIt(document.querySelector('h1'), {
        strings: [],
        speed: 50
        }).go();

      });
</script>
</body>
</html>
