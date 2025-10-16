<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des Produits</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { color: #3B82F6; margin: 0; }
        .header p { color: #6B7280; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #3B82F6; color: white; padding: 10px; text-align: left; }
        td { padding: 8px; border-bottom: 1px solid #E5E7EB; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 10px; }
        .badge-success { background-color: #10B981; color: white; }
        .badge-warning { background-color: #F59E0B; color: white; }
        .badge-danger { background-color: #EF4444; color: white; }
        .footer { margin-top: 30px; text-align: center; color: #6B7280; font-size: 10px; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Liste des Produits</h1>
        <p>Généré le : {{ now()->format('d/m/Y à H:i') }}</p>
        <p>Total : {{ $produits->count() }} produits</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du Produit</th>
                <th>Catégorie</th>
                <th class="text-center">Stock</th>
                <th class="text-center">Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produits as $produit)
            <tr>
                <td>#{{ $produit->id }}</td>
                <td>{{ $produit->libelle }}</td>
                <td>
             @if(isset($categories[$produit->categories_id]))    
                        {{ $categories[$produit->categories_id]->nomCategorie }}
                @else
                        <span style="color: #EF4444;">Non catégorisé</span>
                 @endif
                </td>
                <td class="text-center">{{ $produit->stock }}</td>
                <td class="text-center">
                    @if($produit->stock > 20)
                        <span class="badge badge-success">En stock</span>
                    @elseif($produit->stock > 0)
                        <span class="badge badge-warning">Stock faible</span>
                    @else
                        <span class="badge badge-danger">Rupture</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="padding: 20px; color: #6B7280;">
                    Aucun produit trouvé
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Document généré par StockFlow - Page 1/1</p>
    </div>
</body>
</html>