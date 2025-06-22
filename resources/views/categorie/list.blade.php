@extends('layouts.app')

@section('categ')
<style>
       
    .table-container {
 width: 100%;
 display: flex;
 justify-content: center;
}

table {
 width: 100%;
 border-collapse: collapse;
 background-color: #fff;
 box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
 border-radius: 10px;
}

th,
td {
 padding: 15px;
 text-align: left;
 border-bottom: 1px solid #ddd;
}

th {
 background-color: #62a1d9;
 color: #fff;
 font-weight: bold;
}

tr:hover {
 background-color: #f2f2f2;
}

.actions a,
.actions button {
 padding: 5px 10px;
 margin-right: 5px;
 border: none;
 border-radius: 5px;
 background-color: #62a1d9;
 color: #fff;
 text-decoration: none;
 cursor: pointer;
 transition: background-color 0.3s ease;
}

.actions button {
 background-color: #dc3545; /* red color */
}

.actions a:hover,
.actions button:hover {
 background-color: #62a1d9; /* dark green color */
}
/* Style for the select element */
select {
 padding: 10px; /* Add padding to the select element */
 border-radius: 5px; /* Add border-radius for rounded corners */
 border: 1px solid #ccc; /* Add border for visual distinction */
 background-color: #fff; /* Set background color */
 color: #333; /* Set text color */
 width: 100%; /* Set width to 100% */
}

/* Style for the select element when hovered */
select:hover {
 border-color: #62A1D9; /* Change border color on hover */
}

/* Style for the select element when focused */
select:focus {
 outline: none; /* Remove default outline */
 border-color: #62A1D9; /* Change border color when focused */
 box-shadow: 0 0 5px rgba(98, 161, 217, 0.5); /* Add box shadow when focused */
}


 .actions a, .actions button {
     padding: 5px 10px;
     margin-right: 5px;
     border: none;
     border-radius: 5px;
     background-color: #62A1D9;
     color: #fff;
     text-decoration: none;
     cursor: pointer;
     transition: background-color 0.3s ease;
 }

 .actions button {
     background-color: #dc3545; /* couleur rouge */
 }
 .ajout{
     background-color: #62A1D9; 
     padding: 5px 10px;
     margin-right: 5px;
     border: none;
     border-radius: 5px;
     background-color: #62A1D9;
     color: #fff;
     text-decoration: none;
     cursor: pointer;
     transition: background-color 0.3s ease;
 }
 .actions a:hover, .actions button:hover {
     background-color: #62A1D9; /* couleur vert foncé */
 }
</style>
@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <center><h3 class="card-title">Liste des catégories</h3></center>
                </div>
                <div class="">
                    <div class="">
                        <table class="">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>nomCategorie</th>
                                  
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listCategorie as $c)
                                <tr>
                                    <td>{{ $c->id }}</td>
                                    <td>{{ $c->nomCategorie }}</td>
                                   
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('editcategorie', ['id' => $c->id]) }}" class="btn btn-warning" >
                                                <i class="fa fa-edit"></i>
                                            </a>                                    
                                            <a href="{{ route('deletecategorie', ['id'=> $c->id ]) }}" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection
