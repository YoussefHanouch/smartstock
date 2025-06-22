@extends('layouts.app')

@section('entre')
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
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                <center></center>    <h3 class="card-title">Liste des entrées de produits</h3>
                    <button type="button" class="ajout" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa fa-plus"></i> Ajouter
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
                                    <th>Date</th>
                                    <th>Agent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listentree as $e)
                                <tr>
                                    <td>{{ $e->id }}</td>
                                    <td>{{ $e->nomProduit }}</td>
                                    <td>{{ $e->quantite }}</td>
                                    <td>{{ $e->prix }}</td>
                                    <td>{{ $e->dateEntree }}</td>
                                    <td>{{ $e->nameUser }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route ('editentree', ['id'=> $e->id ]) }}" class="btn btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form id="deleteForm" action="{{ route('destroyEntree', $e->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                            
                                            <script>
                                                function confirmDelete() {
                                                    if (confirm("Êtes-vous sûr de vouloir supprimer cette entrée ?")) {
                                                        // Soumettre le formulaire si l'utilisateur clique sur OK
                                                        document.getElementById('deleteForm').submit();
                                                    }
                                                    // Empêcher la soumission du formulaire si l'utilisateur clique sur Annuler
                                                    return false;
                                                }
                                            </script>
                                            
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {{$listentree->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajoute liste des produits entree</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('persistentree') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="produit">Produit</label>
                    <select name="produit" id="" class="form-control">
                        @foreach($listproduit as $p)
                            <option value="{{ $p->id }}">{{ $p->libelle }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="prix">Prix unitaire</label>
                    <input type="number" name="prix" min="100" class="form-control" required placeholder="Le prix unitaire ...">
                </div>
                <div class="form-group">
                    <label for="prix">Quantité</label>
                    <input type="number" name="quantite" min="0" class="form-control" required placeholder="Quantité ...">
                </div>
                <div class="form-group">
                    <label for="prix">Date d'entrée</label>
                    <input type="date" name="dateEntree" class="form-control" required>
                </div>
                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-danger"  value="Annuler" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="enregistrer" class="btn btn-success">enregistrer</button>
        </div>
    </form>

      </div>
    </div>
  </div>


@endsection

