<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }

        .container {
            max-width: 900px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        h4 {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border: 1px solid #ced4da;
            padding: 10px;
            font-size: 14px;
        }

        .image-preview {
            width: 100%;
            height: auto;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #333;
            border-color: #333;
            color: #FFFFFF;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
        }

        .btn-primary:hover {
            background-color: #555;
            color: #FFFFFF;
            border: none;
        }
    </style>
</head>
<body>

    <div class="container mt-5 mb-5">
        <h4>Edit Product</h4>
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <!-- Image preview -->
                    <img src="{{ $data['product']->image ? asset('storage/public/images/' . $data['product']->image) : 'mug.jpeg' }}" class="image-preview" id="imagePreview" alt="Product Image">
                </div>
                <div class="col-md-6">
                    <form action="{{ route('products.update', $data['product']->id) }}" method="POST" enctype="multipart/form-data" id="productsForm">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">IMAGE</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="imageInput" accept="image/*">
                            
                            <!-- error message untuk image -->
                            @error('image')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="product_category_id">Product Category</label>
                            <select class="form-control" name="product_category_id" id="product_category_id">
                                <option value="">-- Select Category Product --</option>
                                @foreach ($data['categories'] as $category)
                                    <option value="{{ $category->id }}" 
                                    @if(old('product_category_id', $data['product']->product_category_id) == $category->id) selected @endif>
                                    {{ $category->product_category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="supplier_id">Supplier</label>
                            <select class="form-control" name="supplier_id" id="supplier_id">
                                <option value="">-- Select Supplier --</option>
                                @foreach ($data['suppliers'] as $supplier)
                                    <option value="{{ $supplier->id }}" 
                                    @if(old('supplier_id', $data['product']->supplier_id) == $supplier->id) selected @endif>
                                    {{ $supplier->nama_supplier }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">TITLE</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $data['product']->title) }}" placeholder="Masukkan Judul Product">
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">DESCRIPTION</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" id="descriptionEditor" placeholder="Masukkan Deskripsi Product">{{ old('description', $data['product']->description) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">PRICE</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $data['product']->price) }}" placeholder="Masukkan Harga Product">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">STOCK</label>
                                    <input type="text" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock', $data['product']->stock) }}" placeholder="Masukkan Stock Product">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                        <button type="button" class="btn btn-md btn-warning" onclick="resetform()">RESET</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    
    <script>
          document.addEventListener("DOMContentLoaded", function () {
        new TypeIt(document.querySelector('h4'), {
        strings: [],
        speed: 50
        }).go();

    });
        // CKEditor Initialization
        CKEDITOR.replace('descriptionEditor');

        // Preview Image Saat User Memilih Gambar Baru
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('imagePreview').src = URL.createObjectURL(file);
            }
        });

        // Function untuk Reset Form dan Mengembalikan Isi Default
        function resetform() {
            document.getElementById('productsForm').reset();
            CKEDITOR.instances['descriptionEditor'].setData('{{ old('description', $data['product']->description) }}');
            document.getElementById('imagePreview').src = "{{ $data['product']->image ? asset('storage/' . $data['product']->image) : 'mug.jpeg' }}";
        }
    </script>

</body>
</html>
