<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="pdfcss/produit.css">
</head>

<body>
    <div class="container-fluid card">
      <center> 
         <span>
            <img src="image/logo.PNG" alt="" width="40" height="40">
            </span>
            <span class="h1">
            N a j i M a t i q u e 
                
            </span>
    </center> 
    </div>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Liste des produits</h3>
            </div>

            <div class="card-body">
                <table class="table table-striped border mt-2">
                    <tr>
                        <td>N°</td>
                        <td>Libellé</td>
                        <td>Catégorie</td>
                        <td>Stock</td>
                    </tr>

                    @foreach( $produit as $p)
                    <tr>
                        <td> {{ $p->id }} </td>
                        <td>{{ $p->libelle }}</td>
                        <td>{{ $p->categorie }}</td>
                        <td>{{ $p->stock }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <div class="card-footer">

            </div>
        </div>

    </div>

    <div class="row mt-5">
        <div class="col-md-2 offset-7">
            <u>NajiMatique</u>
        </div>
    </div>
</body>
</html>

