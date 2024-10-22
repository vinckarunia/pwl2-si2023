<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Suppliers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, darkslateblue, salmon);
        }

        .card {
            background: linear-gradient(to right, rgba(231, 243, 254, 0.3), rgba(255, 255, 255, 0.3));
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #ffffff;
        }

        .form-control {
            border: 1px solid #ced4da;
            padding: 10px;
            font-size: 14px;
        }

        .btn-primary {
            background-color: #6A5ACD;
            border-color: #007bff;
            color: #FFFFFF;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
        }

        .btn-primary:hover {
            background-color: #4B0082;
            color: #FFFFFF;
            border: none;
        }

        .alert-danger {
            font-size: 12px;
            padding: 5px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title">Add Supplier</h3>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form id="supplierForm" action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label>Nama Supplier</label>
                                <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror" id="supplier_name" name="nama_supplier" placeholder=" ">
                                @error('nama_supplier')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label>Alamat Supplier</label>
                                <input type="text" class="form-control @error('alamat_supplier') is-invalid @enderror" id="alamat_supplier" name="alamat_supplier" placeholder=" ">
                                @error('alamat_supplier')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label>P.I.C Name</label>
                                <input type="text" class="form-control @error('pic_supplier') is-invalid @enderror" id="pic_supplier" name="pic_supplier" placeholder=" ">
                                @error('pic_supplier')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label>Nomor HP P.I.C</label>
                                <input type="text" class="form-control @error('no_hp_pic_supplier') is-invalid @enderror" id="no_hp_pic_supplier" name="no_hp_pic_supplier" placeholder=" ">
                                @error('no_hp_pic_supplier')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Add Details</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
    <script>
        // Combined DOMContentLoaded listener
        document.addEventListener("DOMContentLoaded", function () {
            // TypeIt animation for title
            new TypeIt(".title", {
                strings: [],
                speed: 50
            }).go();

            function typePlaceholder(element, text, speed) {
                let index = 0;
                function type() {
                    if (index < text.length) {
                        element.setAttribute('placeholder', element.getAttribute('placeholder') + text.charAt(index));
                        index++;
                        setTimeout(type, speed);
                    }
                }
                element.setAttribute('placeholder', ''); 
                type();
            }

            typePlaceholder(document.getElementById("supplier_name"), "Masukkan Nama Supplier", 100);
            typePlaceholder(document.getElementById("alamat_supplier"), "Masukkan Alamat Supplier", 100);
            typePlaceholder(document.getElementById("pic_supplier"), "Masukkan Nama P.I.C", 100);
            typePlaceholder(document.getElementById("no_hp_pic_supplier"), "Masukkan Nomor HP", 100);
        });
    </script>
</body>

</html>