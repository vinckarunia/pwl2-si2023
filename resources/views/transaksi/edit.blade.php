
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Products </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .edit h1 {
        text-align: center;
        color: black;
        font-weight: 700;
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

    #perbarui {
        color: white;
        background-color: #6A5ACD;
        transition: 0.2s;
        margin-left:10px;
        transition: 0.2s;
        border:none;
    }

    #perbarui:hover {
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


    <section class="edit">
        <h1>EDIT TRANSACTION</h1>
    </section>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tanggal">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" class="form-control" id="tanggal_transaksi" value="{{ $transaksi->tanggal_transaksi }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email_pembeli" class="form-control" id="email_pembeli" value="{{ $transaksi->email_pembeli }}" required>
            @error('email_pembeli')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        <h4 class="mt-4">Detail Transaksi</h4>
        <div id="details">
            @foreach($transaksi->details as $index => $detail)
            <div class="detail-item mb-3">
                <div class="row">
                    <div class="col">
                        <label>Product</label>
                        <select name="details[{{ $index }}][product_id]" class="form-control" required>
                            <option value="">Pilih Produk</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ $detail->product_id == $product->id ? 'selected' : '' }}>
                                    {{ $product->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label>Jumlah Pembelian</label>
                        <input type="number" name="details[{{ $index }}][jumlah_pembelian]" class="form-control" min="1" value="{{ $detail->jumlah_pembelian }}" required>
                    </div>
                    <div class="col-1 d-flex align-items-end">
                        <button type="button" class="btn remove-detail" id="hapus">Hapus</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <button type="button" id="add-detail" class="btn btn-secondary mt-3">Tambah Detail</button>
        <button type="submit" class="btn  mt-3" id="perbarui">Perbarui</button>
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
        new TypeIt(".edit", {
        strings: [],
        speed: 50
        }).go();

      });

    let detailIndex = {{ count($transaksi->details) }};

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

     // message with sweetalert
     @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'BERHASIL',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'GAGAL',
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
</script>
</body>
</html>