
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Products - </title>
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
                    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tanggal">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" class="form-control" id="tanggal" required>
        </div>

        <h4 class="mt-4">Detail Transaksi</h4>
        <div id="details">
            <div class="detail-item mb-3">
                <div class="row">
                    <div class="col">
                        <label>Product</label>
                        <select name="details[0][product_id]" class="form-control" required>
                            <option value="">Pilih Produk</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label>Jumlah Pembelian</label>
                        <input type="number" name="details[0][jumlah_pembelian]" class="form-control" min="1" required>
                    </div>
                    <div class="col-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-detail">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" id="add-detail" class="btn btn-secondary mt-3">Tambah Detail</button>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<script>
    let detailIndex = 1;

    document.getElementById('add-detail').addEventListener('click', function() {
        let details = document.getElementById('details');
        let newDetail = document.createElement('div');
        newDetail.classList.add('detail-item', 'mb-3');
        newDetail.innerHTML = `
            <div class="row">
                <div class="col">
                    <label>Product</label>
                    <select name="details[${detailIndex}][product_id]" class="form-control" required>
                        <option value="">Pilih Produk</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>Jumlah Pembelian</label>
                    <input type="number" name="details[${detailIndex}][jumlah_pembelian]" class="form-control" min="1" required>
                </div>
                <div class="col-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-detail">Hapus</button>
                </div>
            </div>
        `;
        details.appendChild(newDetail);
        detailIndex++;
    });

    document.getElementById('details').addEventListener('click', function(e) {
        if(e.target && e.target.classList.contains('remove-detail')) {
            e.target.closest('.detail-item').remove();
        }
    });
</script>
</body>
</html>
