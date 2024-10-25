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
    .bg {
        background: linear-gradient(to right, darkslateblue, salmon);
    }

    #card {
        background-color: rgba(255, 255, 255, 0.1);
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
        color: white;
        border: 2px solid white;
        margin-bottom: 10px;
        transition: 0.2s;
    }

    #btn:hover{
        color: black;
        background: white;
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
<body class="bg">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4" id="typing" style="color:white;"></h3>
                    <hr>
                </div>
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