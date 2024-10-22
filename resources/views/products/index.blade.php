<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .bg{
        background: linear-gradient(to right, darkslateblue, salmon)
    }

    #products{
        color: white;
    }

    #card{
        background:rgba(255, 255, 255, 0.1);
    }

    #btn {
        border: 2px solid white;
        color: white;
        transition: 0.2s;
    }

    #btn:hover {
        color: black ;
        background: white;
    }

    .table {
    background-color: rgba(255, 255, 255, 0.1); /* Transparansi */
    backdrop-filter: blur(10px); /* Blur di belakang elemen */
    border-radius: 10px; /* Membuat sudut tabel melengkung */
    border: 1px solid rgba(255, 255, 255, 0.3); /* Garis transparan */
    }

    .table thead {
    background-color: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
    border-radius: 10px;
    border-bottom: 2px solid rgba(255, 255, 255, 0.3);
    }

    .table tbody tr {
    background-color: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(3px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    }

    .table td {
    background-color: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
   
    }

    .table th {
    background-color: rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(5px);
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Efek bayangan di bawah */
    }

    #show {
        background: #394867;
        color: white;
        transition: 0.2s;
    }

    #show:hover {
        background: #212A3E;
    }



    #edit {
        color: white;
        background-color: #6A5ACD;
        transition: 0.2s;
        margin-left:10px;
        transition: 0.2s;
    }

    #edit:hover {
        background-color: #4B0082;
        border: none;
    }


    #hapus {
        color: white;
        background: #FF7F50;
        transition: 0.2s;
        margin-left: 10px;
        
    }

    #hapus:hover {
        border: none;
        background:  #FF6347;
    }

    
    


</style>
<body  class="bg">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4" id="products">PRODUCTS</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded" id="card">
                    <div class="card-body" style="border: 2px solid white; border-radius: 7px;"  >
                        <a href="{{ route('products.create') }}" class="btn btn-md  mb-3"  id="btn">ADD PRODUCT</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" id="img">IMAGE</th>
                                    <th scope="col" id="nama_supplier">Nama Supplier</th>
                                    <th scope="col" id="title">TITLE</th>
                                    <th scope="col" id="category">CATEGORY</th>
                                    <th scope="col" id="price">PRICE</th>
                                    <th scope="col" id="stock">STOCK</th>
                                    <th scope="col" style="width: 20%" id="action">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/images/' . $product->image) }}" class="rounded" style="width: 150px; box-shadow:  3px 3px 20px black">
                                    </td>
                                    <td>{{ $product->nama_supplier }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->product_category_name }}</td>
                                    <td>{{ "Rp " . number_format($product->price, 2, ',', '.') }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?')" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm" id="show">SHOW</a>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm" id="edit">EDIT</a>
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm" id="hapus">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Products belum Tersedia.
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
         document.addEventListener("DOMContentLoaded", function () {
        new TypeIt("#products", {
        strings: [],
        speed: 50
        }).go();

        new TypeIt("#img", {
        strings: [],
        speed: 200
        }).go();
        
        new TypeIt("#nama_supplier", {
        strings: [],
        speed: 200
        }).go();

        new TypeIt("#title", {
        strings: [],
        speed: 200
        }).go();


        new TypeIt("#category", {
        strings: [],
        speed: 200
        }).go();

        new TypeIt("#price", {
        strings: [],
        speed: 200
        }).go();

        new TypeIt("#stock", {
        strings: [],
        speed: 200
        }).go();

      

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