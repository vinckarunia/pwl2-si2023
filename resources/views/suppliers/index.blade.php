<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Suppliers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
          font-family: "Poppins", sans-serif;
          background: #DDDDDD;
        }

    .navbar {
            padding: 10px 5%;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            color: black;
        }

        .supplier-list {
            padding: 10px 7%;

        }

        .nav-color {
            background-color: white;
            transition: all ease-in-out 0.3s;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 2rem;
            color: black;
        }

        .navbar-brand span {
            color: #FF6347;
        }

        .navbar-brand:hover {
        color: black; 
        text-decoration: none;
        }

        .nav-link {
            color: black;
            margin: 16px;
            font-size: 1.2rem;
        }

        .nav-link:hover {
            color: #FF6347;
            margin: 16px;
            font-size: 1.2rem;
        }

        #hero {
        background-image: url(storage/public/images/suppliers.jpg);
        height: 60vh;
        width: 100%;
        background-size: cover;
        background-position: top 25% right 0;
        padding: 0 80px;
        justify-content: center;
        align-items: center; 
        display: flex;
        flex-direction: column;
        color: black;
        text-align: center;
    }

    #hero::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    height:60vh;
    background-color: rgba(0, 0, 0, 0.2); 
    z-index: 1; 

    }

    #hero h3 {
        position: relative;
        font-size: 80px;
        z-index: 2; /* Agar teks muncul di atas overlay */
    }

        
   


    #card {
        background-color: white;
    }

    .table {
    background-color: rgba(255, 255, 255, 0.1); 
    backdrop-filter: blur(10px); 
    border-radius: 10px; 
    border: 1px solid rgba(255, 255, 255, 0.3); 
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
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    #btn{
        color: black;
        border: 2px solid black;
        margin-bottom: 10px;
        transition: 0.2s;
    }

    #btn:hover{
        color: white;
        background: black;
    }

    #show {
        background: #394867;
        color: white;
        transition: 0.2s;
        border:none;
    }

    #show:hover {
        background: #212A3E;
        border:none;
    }

    #edit {
        color: white;
        background-color: #6A5ACD;
        transition: 0.2s;
        margin-left:10px;
        transition: 0.2s;
        border:none;
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
        border:none;
        
    }

    #hapus:hover {
        border: none;
        background:  #FF6347;
    }
    
</style>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-transparent" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">5th <span>Apparrel</span></a>
           
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{ route('products.index') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('suppliers.index') }}">Supplier</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('transaksi.index') }}">Transaksi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="hero">
        <h3 id="typing" style="color:white; font-weight: 700;"></h3>
    </section>


    <section class="supplier-list">
        <h3>Our Suppliers List</h3>
    </section>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded" id="card">
                    <div class="card-body" >
                        <a href="{{ route('suppliers.create') }}" class="btn btn-md  mb-3" id="btn">ADD SUPPLIER</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    
                                    <th scope="col" id="type1">Nama Supplier</th>
                                    <th scope="col" id="type2">Alamat Supplier</th>
                                    <th scope="col" id="type3">PIC SUPPLIER</th>
                                    <th scope="col" id="type4">No Hp PIC Supplier</th>
                                    <th scope="col" style="width: 20%" id="type5">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->nama_supplier }}</td>
                                    <td>{{ $supplier->alamat_supplier }}</td> 
                                    <td>{{ $supplier->pic_supplier }}</td>
                                    <td>{{ $supplier->no_hp_pic_supplier }}</td>
                                    <td class="text-center">
                                    
                                        <form>
                                            <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-sm btn-dark" id="show">SHOW</a>
                                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-primary" id="edit">EDIT</a>
                                            @csrf

                                            <button type="submit" class="btn btn-sm" id="hapus">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Suppliers belum Tersedia.
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $suppliers->links() }}
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
        new TypeIt("#typing", {
        strings: ["SUPPLIERS"],
        speed: 50
        }).go();

        new TypeIt("#type1", {
        strings: [],
        speed: 200
        }).go();

        new TypeIt("#type2", {
        strings: [],
        speed: 200
        }).go();

        new TypeIt("#type3", {
        strings: [],
        speed: 200

        }).go();
        new TypeIt("#type4", {
        strings: [],
        speed: 200
        }).go();

        new TypeIt("#type5", {
        strings: [],
        speed: 200
        }).go();

        new TypeIt(".supplier-list", {
        strings: [],
        speed: 50
        }).go();
        
        });


        const navbar = document.getElementsByTagName('nav')[0];
        window.addEventListener('scroll', function() {
            if (window.scrollY > 1) {
                navbar.classList.replace('bg-transparent', 'nav-color')
            } else if (this.window.scrollY <= 0) {
                navbar.classList.replace('nav-color', 'bg-transparent')
            }
        })
        

       

        
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