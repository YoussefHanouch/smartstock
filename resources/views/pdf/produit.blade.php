<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des Produits - NajiMatique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #334155;
            line-height: 1.6;
        }
        
        .container-fluid {
            max-width: 210mm;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 10px;
        }
        
        .logo {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            border: 3px solid rgba(255,255,255,0.2);
            padding: 5px;
            background: rgba(255,255,255,0.1);
        }
        
        .company-name {
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .document-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 10px;
        }
        
        .document-subtitle {
            color: #64748b;
            font-size: 1rem;
            margin-bottom: 20px;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .card-header {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 20px 25px;
            border-bottom: none;
        }
        
        .card-header h3 {
            margin: 0;
            font-weight: 600;
            font-size: 1.4rem;
        }
        
        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 0;
        }
        
        .table thead {
            background: #f1f5f9;
        }
        
        .table thead tr {
            background: linear-gradient(135deg, #475569, #334155);
            color: white;
        }
        
        .table th {
            padding: 15px 12px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }
        
        .table td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }
        
        .table tbody tr {
            transition: all 0.2s ease;
        }
        
        .table tbody tr:hover {
            background-color: #f8fafc;
            transform: translateY(-1px);
        }
        
        .table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }
        
        .table tbody tr:nth-child(even):hover {
            background-color: #f1f5f9;
        }
        
        .badge-stock {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .stock-high {
            background: #dcfce7;
            color: #166534;
        }
        
        .stock-medium {
            background: #fef3c7;
            color: #92400e;
        }
        
        .stock-low {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .footer {
            margin-top: 40px;
            padding: 20px;
            text-align: center;
            border-top: 2px solid #e2e8f0;
        }
        
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px dashed #cbd5e1;
        }
        
        .signature-line {
            width: 200px;
            border-bottom: 1px solid #94a3b8;
            padding-top: 40px;
            text-align: center;
        }
        
        .metadata {
            background: #f8fafc;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #3b82f6;
        }
        
        .metadata-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        
        .metadata-label {
            font-weight: 500;
            color: #475569;
        }
        
        .metadata-value {
            font-weight: 600;
            color: #1e293b;
        }
        
        @media print {
            body {
                background: white !important;
            }
            
            .card {
                box-shadow: none !important;
                border: 1px solid #e2e8f0 !important;
            }
            
            .header {
                background: #334155 !important;
                -webkit-print-color-adjust: exact;
            }
            
            .table thead tr {
                background: #475569 !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- En-tête -->
        <div class="header">
            <div class="logo-container">
                <img src="image/logo.PNG" alt="NajiMatique" class="logo">
                <div class="company-name">NajiMatique</div>
            </div>
            <div class="text-center">
                <div class="document-title">📦 Inventaire des Produits</div>
                <div class="document-subtitle">Liste complète des produits en stock</div>
            </div>
        </div>

        <!-- Métadonnées -->
        <div class="metadata">
            <div class="row">
                <div class="col-md-4">
                    <div class="metadata-item">
                        <span class="metadata-label">Date de génération:</span>
                        <span class="metadata-value">{{ now()->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metadata-item">
                        <span class="metadata-label">Total produits:</span>
                        <span class="metadata-value">{{ $produit->count() }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metadata-item">
                        <span class="metadata-label">Stock total:</span>
                        <span class="metadata-value">{{ $produit->sum('stock') }} unités</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des produits -->
        <div class="card">
            <div class="card-header">
                <h3>📋 Liste des Produits</h3>
            </div>

            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="35%">Libellé</th>
                            <th width="25%">Catégorie</th>
                            <th width="20%">Stock</th>
                            <th width="10%">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produit as $p)
                        <tr>
                            <td><strong>#{{ $p->id }}</strong></td>
                            <td>{{ $p->libelle }}</td>
                            <td>
                                <span style="background: #e0e7ff; color: #3730a3; padding: 4px 8px; border-radius: 6px; font-size: 0.85rem;">
                                    {{ $p->categorie }}
                                </span>
                            </td>
                            <td>
                                <strong>{{ $p->stock }}</strong> unités
                            </td>
                            <td>
                                @php
                                    $stockClass = 'stock-high';
                                    $stockText = 'Bon';
                                    if($p->stock < 10) {
                                        $stockClass = 'stock-low';
                                        $stockText = 'Faible';
                                    } elseif($p->stock < 50) {
                                        $stockClass = 'stock-medium';
                                        $stockText = 'Moyen';
                                    }
                                @endphp
                                <span class="badge-stock {{ $stockClass }}">
                                    {{ $stockText }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Résumé -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="background: linear-gradient(135deg, #10b981, #059669);">
                        <h3 style="color: white; margin: 0;">📊 Résumé</h3>
                    </div>
                    <div class="card-body">
                        <div class="metadata-item">
                            <span class="metadata-label">Produits totaux:</span>
                            <span class="metadata-value">{{ $produit->count() }}</span>
                        </div>
                        <div class="metadata-item">
                            <span class="metadata-label">Stock total:</span>
                            <span class="metadata-value">{{ $produit->sum('stock') }} unités</span>
                        </div>
                        <div class="metadata-item">
                            <span class="metadata-label">Catégories:</span>
                            <span class="metadata-value">{{ $produit->unique('categorie')->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pied de page -->
        <div class="footer">
            <div class="signature-section">
                <div class="signature-line">
                    Responsable Inventaire
                </div>
                <div class="signature-line">
                    Direction NajiMatique
                </div>
            </div>
            <div class="mt-4 text-muted">
                Document généré le {{ now()->format('d/m/Y') }} • NajiMatique © {{ now()->year }}
            </div>
        </div>
    </div>
</body>
</html>