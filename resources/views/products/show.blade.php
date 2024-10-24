<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .bg {
        background: linear-gradient(to right, darkslateblue, salmon);
    }

    #card-img  {
    background-color: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.3);
    }

    #typing5 p {
    color: white;
    }

    .btn{
        color: white;
        border: 2px solid white;
    }

    .btn:hover {
        background: white;
        color: black;
    }
</style>
<body class="bg">
    
    <div class="container mt-5 mb-5">
        <div class="row">
            <h3 style="color: white">Show Product</h3>
            <hr>
            <div class="col-md-4">
                <div class="card border-0 shadow-5m rounded">
                    <div class="card-body">
                        <img src="{{ asset('/storage/images/'.$product->image) }}" class="rounded" style="width: 100%;" >
                    </div>
                </div>
            </div>
                <div class="col-md-8">
                    <div class="card border-0 shadow-5m rounded" id="card-img">
                        <div class="card-body">
                            <h3 id="typing">{{ $product->title }}</h3>
                            <hr/>
                            <p id="typing2">Category : {{ $product->product_category_name }}</p>
                            <hr/>
                            <p id="typing3">Supplier : {{ $product->nama_supplier }}</p>
                            <hr/>
                            <p id="typing4">{{ "Rp " . number_format($product->price,2,',','.') }}</p>
                            <code id="typing5">
                                <p>{!! $product->description !!}</p>
                            </code>
                            <hr/>
                            <p id="typing6">Stock : {{ $product->stock }}</p>
                            <hr/>
                            <a href="{{ route('products.index') }}" class="btn ">Kembali</a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
          document.addEventListener("DOMContentLoaded", function () {
        new TypeIt(document.querySelector('h3'), {
        strings: [],
        speed: 50
        }).go();

        new TypeIt("#typing", {
        strings: [],
        speed: 50
        }).go();

        new TypeIt("#typing2", {
        strings: [],
        speed: 50
        }).go();

        new TypeIt("#typing3", {
        strings: [],
        speed: 50
        }).go();

        new TypeIt("#typing4", {
        strings: [],
        speed: 50
        }).go();

        new TypeIt("#typing5", {
        strings: [],
        speed: 50
        }).go();

        new TypeIt("#typing6", {
        strings: [],
        speed: 50
        }).go();

        
        });
    </script>
</body>
</html>