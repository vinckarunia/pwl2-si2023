<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Add New Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, darkslateblue, salmon);
        }
        
        .card {
            background: linear-gradient(to right, rgba(231, 243, 254, 0.3), rgba(255, 255, 255, 0.3));
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h4 {
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

        .btn-warning {
            background-color: #FF7F50;
            border-color: #ffc107;
            color: #FFFFFF;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
        }

        .btn-warning:hover {
            background-color: #FF6347;
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

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="cold-md-12">
                <h4 class="title">Add New Products</h4>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data"class="productForm">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">IMAGE</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                            </div>

                            <div class="form-group mb-3">
                                <label for="product_category_id">Product Category</label>
                                <select class="form-control" id="product_category_id" name="product_category_id">
                                    <option value="">-- Select Category Product --</option>
                                    @foreach ($data['categories'] as $c)
                                        <option value="{{$c->id}}">{{$c->product_category_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="supplier_id">Supplier</label>
                                <select class="form-control" id="supplier_id" name="supplier_id">
                                    <option value="">-- Select Supplier --</option>
                                    @foreach ($data['suppliers'] as $s)
                                        <option value="{{$s->id}}">{{$s->nama_supplier}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">TITLE</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Masukan Judul Product">
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">DESCRIPTION</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="Masukan Deskripsi Product">
                                </textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">PRICE</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Masukan Price Product">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">STOCK</label>
                                        <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" placeholder="Masukan Stock Product">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                            <buttont type="button" id="resetBtn" onclick="resetform()" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
    <script>
        CKEDITOR.replace('description');

        function resetform(){
            document.getEelementById('productsForm').reset(); //Reset semua nilai dalam form

            //reset CKEditor content to empty
            for(var instance in CKEDITPR.instance){
                CKEDITOR.instance[instance].setData(''); //reset CKEditor content
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            new TypeIt(".title", {
            strings: [],
            speed: 50
            }).go();
        });
    </script>
</body>