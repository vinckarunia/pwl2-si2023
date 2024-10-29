<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,200;0,300;0,400;1,300;1,500;1,800;1,900&family=Poppins:wght@400;600&family=Rancho&display=swap');
        .bg {
            background: #DDDDDD;
        }

        .container {
            max-width: 900px;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        h3 {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        .btn {
            color: black;
            border: 2px solid black;
            background-color: ##FF7F50;
        }

        .btn:hover {
            color: black;
            background: #FF6347;
        }

        .btn-danger {
            color: black;
            border: 2px solid black;
            background: white;
        }

        .btn-danger:hover {
            color: rgb(252, 252, 252);
            background: rgb(171, 0, 0);
        }

        .text-show {
            color: #ff6347;
        }

        .text-supplier {
            color: #000000;
        }
    </style>
</head>

<body class="bg">
    <div class="container mt-5 mb-5">
        <div class="row">
            <h3 class="title">
                <span class="text-show">Show</span> 
                <span class="text-supplier">Supplier</span>
            </h3>
            <hr>
            <div class="col-md-4">
                <div class="card border-0 shadow-5m rounded">
                </div>
            </div>
            <div>
                <div class="card border-0 shadow-5m rounded" id="card">
                    <div class="card-body">
                        <h3 class="nama">{{ $supplier->nama_supplier }}</h3>
                        <hr/>
                        <p class="alamat">Alamat Supplier: {{ $supplier->alamat_supplier }}</p>
                        <hr/>
                        <p class="pic">PIC Supplier: {{ $supplier->pic_supplier }}</p>
                        <hr/>
                        <p class="no_hp">No HP PIC: {{ $supplier->no_hp_pic_supplier }}</p>
                        <hr/>
                        <a href="{{ route('suppliers.index') }}" class="btn ">Kembali</a>
                        <a href="{{ route('suppliers.destroy', $supplier->id) }}" 
                           class="btn btn-danger" 
                           onclick="event.preventDefault(); 
                           document.getElementById('delete-form').submit();">
                           Hapus
                        </a>

                        <form id="delete-form" action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new TypeIt(".title", { speed: 50 }).go();
            new TypeIt(".nama", { speed: 50 }).go();
            new TypeIt(".alamat", { speed: 50 }).go();
            new TypeIt(".pic", { speed: 50 }).go();
            new TypeIt(".no_hp", { speed: 50 }).go();
        });
    </script>
</body>
</html>