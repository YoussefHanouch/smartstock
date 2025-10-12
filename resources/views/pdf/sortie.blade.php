<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture #{{ $sortie->id }} - NajiMatique</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: white;
            color: #333;
            line-height: 1.6;
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: #3498db;
            padding: 40px;
            text-align: center;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.2);
        }
        
        .company-name {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .invoice-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .invoice-number {
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 600;
            display: inline-block;
            margin-top: 15px;
        }
        
        .content {
            padding: 40px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .info-card {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border-left: 4px solid #3498db;
        }
        
        .info-card.client {
            border-left-color: #2ecc71;
        }
        
        .info-card.agent {
            border-left-color: #e74c3c;
        }
        
        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-title::before {
            content: "📄";
            font-size: 1.2rem;
        }
        
        .info-card.client .card-title::before {
            content: "👤";
        }
        
        .info-card.agent .card-title::before {
            content: "🛒";
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 500;
            color: #6c757d;
        }
        
        .info-value {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .product-section {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-title::before {
            content: "📦";
        }
        
        .product-details {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .product-header {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 20px;
            padding: 20px;
            background: #34495e;
            color: white;
            font-weight: 600;
        }
        
        .product-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 20px;
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .product-row:last-child {
            border-bottom: none;
        }
        
        .total-section {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .total-label {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        .total-amount {
            font-size: 3rem;
            font-weight: 700;
        }
        
        .footer {
            text-align: center;
            padding: 30px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
        }
        
        .badge {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .badge-success {
            background: #d4edda;
            color: #155724;
        }
        
        .badge-primary {
            background: #d1ecf1;
            color: #0c5460;
        }
        
        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .product-header,
            .product-row {
                grid-template-columns: 1fr;
                gap: 10px;
            }
            
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- En-tête -->
        <div class="header">
            <div class="company-name">NajiMatique</div>
            <div class="invoice-title">FACTURE</div>
            <div class="invoice-number">#{{ $sortie->id }}</div>
        </div>

        <!-- Contenu principal -->
        <div class="content">
            <!-- Informations générales -->
            <div class="info-grid">
                <div class="info-card">
                    <div class="card-title">
                        Informations Facture
                    </div>
                    <div class="info-item">
                        <span class="info-label">Numéro:</span>
                        <span class="info-value">#{{ $sortie->id }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Date:</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($sortie->dateSortie)->format('d/m/Y') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Heure:</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($sortie->created_at)->format('H:i') }}</span>
                    </div>
                </div>

                <div class="info-card client">
                    <div class="card-title">
                        Informations Client
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nom:</span>
                        <span class="info-value">{{ $sortie->nom_client }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Référence:</span>
                        <span class="info-value">CL-{{ str_pad($sortie->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Statut:</span>
                        <span class="info-value">
                            <span class="badge badge-success">Payé</span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Détails du produit -->
            <div class="product-section">
                <div class="section-title">
                    Détails de la Vente
                </div>
                <div class="product-details">
                    <div class="product-header">
                        <div>Produit</div>
                        <div>Quantité</div>
                        <div>Prix Unitaire</div>
                        <div>Total</div>
                    </div>
                    
                    <div class="product-row">
                        <div>
                            <strong>{{ $sortie->nomProduit }}</strong>
                            <div style="color: #6c757d; font-size: 0.9rem; margin-top: 5px;">
                                Réf: PROD-{{ str_pad($sortie->id, 4, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                        <div>{{ $sortie->quantite }} unités</div>
                        <div>{{ number_format($sortie->prix, 2, ',', ' ') }} DH</div>
                        <div>
                            <strong>{{ number_format($sortie->prix * $sortie->quantite, 2, ',', ' ') }} DH</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Total -->
            <div class="total-section">
                <div class="total-label">MONTANT TOTAL À PAYER</div>
                <div class="total-amount">{{ number_format($sortie->prix * $sortie->quantite, 2, ',', ' ') }} DH</div>
            </div>

            <!-- Informations agent -->
            <div class="info-card agent">
                <div class="card-title">
                    Agent de Vente
                </div>
                <div class="info-item">
                    <span class="info-label">Nom:</span>
                    <span class="info-value">{{ $sortie->nameUser }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Code agent:</span>
                    <span class="info-value">AGT-{{ str_pad($sortie->user_id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Mode de paiement:</span>
                    <span class="info-value">
                        <span class="badge badge-primary">Espèces</span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Pied de page -->
        <div class="footer">
            <div style="margin-bottom: 10px;">
                Merci pour votre confiance !
            </div>
            <div>
                Facture générée le {{ now()->format('d/m/Y à H:i') }} • NajiMatique &copy; {{ now()->year }}
            </div>
        </div>
    </div>
</body>
</html>