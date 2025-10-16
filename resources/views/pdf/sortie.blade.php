<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture #{{ $sortie->id }} - SmartStock</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #2D3748;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .invoice-container {
            max-width: 900px;
            width: 100%;
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            position: relative;
        }

        /* Effet de bordure décorative */
        .invoice-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #3B82F6, #10B981, #EF4444, #F59E0B);
        }
        
        .header {
            background: linear-gradient(135deg, #1E293B 0%, #334155 100%);
            color: white;
            padding: 50px 40px 30px;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .header-content {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        
        .company-info h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #60A5FA, #34D399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .company-tagline {
            color: #CBD5E1;
            font-size: 1.1rem;
            font-weight: 400;
        }
        
        .invoice-meta {
            text-align: right;
        }
        
        .invoice-number {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 10px;
            color: #FBBF24;
        }
        
        .invoice-label {
            color: #94A3B8;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .content {
            padding: 40px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }
        
        .info-card {
            background: #F8FAFC;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid #E2E8F0;
            transition: all 0.3s ease;
        }
        
        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .card-title {
            font-size: 1rem;
            font-weight: 700;
            color: #475569;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .card-title i {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-style: normal;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #F1F5F9;
        }
        
        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .info-label {
            font-weight: 500;
            color: #64748B;
        }
        
        .info-value {
            font-weight: 600;
            color: #1E293B;
        }
        
        .product-section {
            background: linear-gradient(135deg, #F8FAFC, #F1F5F9);
            border-radius: 20px;
            padding: 32px;
            margin-bottom: 32px;
            border: 1px solid #E2E8F0;
        }
        
        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1E293B;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .product-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .table-header {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 20px;
            padding: 20px 24px;
            background: #1E293B;
            color: white;
            font-weight: 600;
        }
        
        .table-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 20px;
            padding: 20px 24px;
            border-bottom: 1px solid #F1F5F9;
            transition: background-color 0.2s ease;
        }
        
        .table-row:hover {
            background: #F8FAFC;
        }
        
        .table-row:last-child {
            border-bottom: none;
        }
        
        .total-section {
            background: linear-gradient(135deg, #059669, #10B981);
            color: white;
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .total-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .total-label {
            font-size: 1.2rem;
            margin-bottom: 12px;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }
        
        .total-amount {
            font-size: 3.5rem;
            font-weight: 800;
            position: relative;
            z-index: 2;
        }
        
        .payment-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }
        
        .payment-card {
            background: #F0FDF4;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #BBF7D0;
            text-align: center;
        }
        
        .payment-icon {
            font-size: 2rem;
            margin-bottom: 12px;
        }
        
        .footer {
            background: #1E293B;
            color: #94A3B8;
            padding: 30px 40px;
            text-align: center;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .company-address {
            text-align: left;
        }
        
        .contact-info {
            text-align: right;
        }
        
        .badge {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .badge-success {
            background: #DCFCE7;
            color: #166534;
        }
        
        .badge-primary {
            background: #DBEAFE;
            color: #1E40AF;
        }
        
        .qr-code {
            width: 100px;
            height: 100px;
            background: #F8FAFC;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            color: #64748B;
            border: 2px dashed #CBD5E1;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }
            
            .invoice-meta {
                text-align: center;
            }
            
            .table-header,
            .table-row {
                grid-template-columns: 1fr;
                gap: 10px;
                text-align: center;
            }
            
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
            
            .company-address,
            .contact-info {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- En-tête moderne -->
        <div class="header">
            <div class="header-content">
                <div class="company-info">
                    <h1>SmartStock</h1>
                    <div class="company-tagline">Votre partenaire de confiance</div>
                </div>
                <div class="invoice-meta">
                    <div class="invoice-label">Facture</div>
                    <div class="invoice-number">#{{ $sortie->id }}</div>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="content">
            <!-- Informations générales -->
            <div class="info-grid">
                <div class="info-card">
                    <div class="card-title">
                        <i>📄</i> Facture
                    </div>
                    <div class="info-item">
                        <span class="info-label">Numéro:</span>
                        <span class="info-value">#{{ $sortie->id }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Date d'émission:</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($sortie->dateSortie)->format('d/m/Y') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Heure:</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($sortie->created_at)->format('H:i') }}</span>
                    </div>
                </div>

                <div class="info-card">
                    <div class="card-title">
                        <i>👤</i> Client
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nom:</span>
                        <span class="info-value">{{ $sortie->nom_client ?? 'Client Général' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Référence:</span>
                        <span class="info-value">CL-{{ str_pad($sortie->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Statut:</span>
                        <span class="info-value">
                            <span class="badge badge-success">✓ Payé</span>
                        </span>
                    </div>
                </div>

                <div class="info-card">
                    <div class="card-title">
                        <i>🛒</i> Vendeur
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nom:</span>
                        <span class="info-value">{{ $sortie->nameUser }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Code:</span>
                        <span class="info-value">AGT-{{ str_pad($sortie->user_id, 3, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Paiement:</span>
                        <span class="info-value">
                            <span class="badge badge-primary">💳 Espèces</span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Détails du produit -->
            <div class="product-section">
                <div class="section-title">
                    📦 Détails de la Transaction
                </div>
                <div class="product-table">
                    <div class="table-header">
                        <div>Description</div>
                        <div>Quantité</div>
                        <div>Prix Unitaire</div>
                        <div>Total</div>
                    </div>
                    
                    <div class="table-row">
                        <div>
                            <strong>{{ $sortie->nomProduit }}</strong>
                            <div style="color: #64748B; font-size: 0.9rem; margin-top: 4px;">
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
                <div class="total-label">MONTANT TOTAL</div>
                <div class="total-amount">{{ number_format($sortie->prix * $sortie->quantite, 2, ',', ' ') }} DH</div>
            </div>

            <!-- Informations de paiement -->
            <div class="payment-info">
                <div class="payment-card">
                    <div class="payment-icon">💰</div>
                    <div style="font-weight: 600; color: #059669;">Paiement Complet</div>
                    <div style="font-size: 0.9rem; color: #64748B;">Solde réglé</div>
                </div>
                <div class="payment-card">
                    <div class="payment-icon">📅</div>
                    <div style="font-weight: 600; color: #059669;">Date d'échéance</div>
                    <div style="font-size: 0.9rem; color: #64748B;">Sur réception</div>
                </div>
                <div class="payment-card">
                    <div class="qr-code">
                        QR Code
                    </div>
                </div>
            </div>
        </div>

        <!-- Pied de page -->
        <div class="footer">
            <div class="footer-content">
                <div class="company-address">
                    <div style="font-weight: 600; color: #F1F5F9; margin-bottom: 8px;">SmartStock SARL</div>
                    <div>123 Avenue Mohammed V, Casablanca</div>
                    <div>contact@SmartStock.ma • +212 5 22 123 456</div>
                </div>
                <div class="contact-info">
                    <div style="margin-bottom: 8px;">Facture générée le {{ now()->format('d/m/Y à H:i') }}</div>
                    <div>SmartStock &copy; {{ now()->year }} - Tous droits réservés</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>