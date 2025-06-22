<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Facture</h1>
    <p>ID : {{ $sortie->id }}</p>
    <p>Nom du produit : {{ $sortie->nomProduit }}</p>
    <p>Quantité : {{ $sortie->quantite }}</p>
    <p>Prix : {{ $sortie->prix }}</p>
    <p>Date de sortie : {{ $sortie->dateSortie }}</p>
    <p>Agent : {{ $sortie->nameUser }}</p>
    <p>Nom du client : {{ $sortie->nom_client }}</p>
</body>
</html>
