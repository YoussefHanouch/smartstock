@extends('layouts.app')

@section('user')
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
            
                    <div class="card-header d-flex justify-content-between align-items-center">
                       <center></center> <h3 class="card-title">Liste des admins</h3>
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
                                    <th>Prénom & nom</th>
                                    <th>Email</th>
                                    <th>Etat</th>
                                    @if(auth()->user()->role === 'super_admin')
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listUser as $lu)
                                <tr>
                                    <td>{{ $lu->id }}</td>
                                    <td>{{ $lu->name }}</td>
                                    <td>{{ $lu->email }}</td>
                                    <td>{{ $lu->role }}</td>
                                    @if(auth()->user()->role === 'super_admin')
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('editutilisateur', $lu->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <form action="{{ route('deleteutilisateur', ['id' => $lu->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>                                            
                                        </td>
                                    @endif
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


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajoute admin </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('persistutilisateur') }}">
                @csrf
                <div class="card border">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" >Prénom & nom</label>
                            <input id="name" type="text" class="@error('name') is-invalid @enderror form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="@error('email') is-invalid @enderror form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Role') }}</label>

                            <select name="role">

                                <option value="admin">Admin</option>
                                <option value="super_admin">Super Admin</option>
                            </select>
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="@error('password') is-invalid @enderror form-control" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                       
                       
                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                            <button type="reset" class="btn btn-danger"  value="Annuler" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
      </div>
    </div>
  </div>

@endsection


