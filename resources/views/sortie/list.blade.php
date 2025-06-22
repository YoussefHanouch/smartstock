@extends('layouts.app')

@section('sortie')
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
@if(!empty($sms))
<p class="alert alert-success h5" role="alert">
    {{ $sms }}
</p>
@endif
<div class="container mt-2">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  

                   <center></center> <h3 class="m-0">Liste des sorties de produits(Factures)</h3>
                 <button type="button" class="ajout" data-toggle="modal" data-target="#exampleModal">
                        <a href="/sortie/add" style="color:#fff">  <i class="fa fa-plus"></i> Ajouter</a> 
                    </button>
                </div>

                <div class="">
                    <div class="">
                        <table class="">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix</th>
                                    <th>Date de sortie</th>
                                    <th>Agent</th>
                                    <th>nom Client</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listeSortie as $ls)
                                <tr>
                                    <td>{{ $ls->id }}</td>
                                    <td>{{ $ls->nomProduit }}</td>
                                    <td>{{ $ls->quantite }}</td>
                                    <td>{{ $ls->prix }}</td>
                                    <td>{{ $ls->dateSortie }}</td>
                                    <td>{{ $ls->nameUser }}</td>
                                    <td>{{ $ls->nom_client }}</td>
                                    <td style="vertical-align: top;">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('editsortie',$ls->id) }}" class="btn btn-warning">
                                                <i class="fa fa-edit align-middle"></i> 
                                            </a>
                                            <form action="{{ route('destroysortie', $ls->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">
                                                    <i class="fa fa-trash align-middle"></i> 
                                                </button>
                                            </form>
                                            <a href="{{ route('pdfsortie', $ls->id ) }}" class="btn btn-info">
                                                <i class="fa fa-print align-middle"></i> 
                                            </a>
                                        </div>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{$listeSortie->links()}}
                    </div>
                </div>

                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
