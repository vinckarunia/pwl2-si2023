<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <h4>Edit Product</h4>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form action="{{ route('products.update', $data['product']->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">IMAGE</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                            <!-- error message for image -->
                            @error('image')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="product_category_id">Product Category</label>
                            <select class="form-control" id="product_category_id" name="product_category_id">
                                <option value="">-- Select Category Product --</option>
                                @foreach ($data['categories'] as $category)
                                    <option value="{{ $category->id }}" 
                                        @if(old('product_category_id', $data['product']->product_category_id) == $category->id) selected @endif>
                                        {{ $category->product_category_name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- error message for product_category_id -->
                            @error('product_category_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="id_supplier">Supplier</label>
                            <select class="form-control" id="id_supplier" name="id_supplier">
                                <option value="">-- Select Supplier --</option>
                                @foreach ($data['suppliers'] as $supplier)
                                    <option value="{{ $supplier->id }}" 
                                        @if(old("id_supplier", $data['product']->supplier_id) == $supplier->id) selected @endif >
                                        {{ $supplier->supplier_name }}
                                    </option>
                                @endforeach
                            </select>
                            <!-- error message untuk id_supplier -->
                            @error('id_supplier')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">TITLE</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            value="{{ old('title', $data['product']->title) }}" placeholder="Masukkan Judul Product">

                            <!-- error message untuk title -->
                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">DESCRIPTION</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                            name="description" rows="5" placeholder="Masukkan Deskripsi Product">
                            {{ old('description', $data['product']->description) }}</textarea>

                            <!-- error message untuk description -->
                            @error('description')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                <label class="font-weight-bold">PRICE</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price"
                                value="{{ old('price', $data['product']->price) }}" placeholder="Masukkan Harga Product">

                                <!-- error message untuk price -->
                                @error('price')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                <label class="font-weight-bold">STOCK</label>
                                <input type="text" class="form-control @error('stock') is-invalid @enderror" name="stock"
                                value="{{ old('stock', $data['product']->stock) }}" placeholder="Masukkan Stock Product">

                                <!-- error message untuk stock -->
                                @error('stock')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
</body>
</html>