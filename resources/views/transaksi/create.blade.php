
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Products - </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .judul h1 {
        text-align: center;
        font-weight: 700;
        color: black;
        margin-top: 20px;
    }

    #add-detail {
        background: #394867;
        color: white;
        transition: 0.2s;
        border:none;
    }

    #add-detail:hover {
           background: #212A3E;
        border:none;
    }

    #simpan {
        color: white;
        background-color: #6A5ACD;
        transition: 0.2s;
        margin-left:10px;
        transition: 0.2s;
        border:none;
    }

    #simpan:hover {
        background-color: #4B0082;
        border: none;
    }

    #hapus {
        color: white;
        background: #FF7F50;
        transition: 0.2s;
        margin-left: 10px;
        border:none;
        
    }

    #hapus:hover {
        border: none;
        background:  #FF6347;
    }

</style>
<body style="background:  #f8f9fa">

    <section class="judul">
            <h1>Add Transaction</h1>
        </section>


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
                        <button type="button" class="btn  remove-detail" id="hapus">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" id="add-detail" class="btn  mt-3">Tambah Detail</button>
        <button type="submit" id="simpan" class="btn  mt-3" id="simpan">Simpan</button>
    </form>
</div>
</div>
</div>
</div>
</div>
<script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        new TypeIt(".judul", {
        strings: [],
        speed: 50
        }).go();

    });
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
