@extends('welcome')

@section('content')
<div class="modern-invoice-container">
    <!-- Header Section -->
    <div class="invoice-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-4">
                <div class="brand-section">
                    <h1 class="brand-title">🧾 Factures</h1>
                    <p class="brand-subtitle">IPP BURGER</p>
                </div>
                <div class="header-actions">
                    <button class="btn-action" onclick="window.print()">
                        <i class="fas fa-print"></i>
                        <span>Imprimer tout -> pdf</span>
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">
        @foreach ($commandes as $index => $commande)
            <div class="invoice-card mb-4">
                <!-- Invoice Header -->
                <div class="invoice-card-header">
                    <div class="invoice-info">
                        <div class="invoice-number">
                            <span class="label">Facture N°</span>
                            <span class="number">#{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="invoice-status">
                            <span class="status-badge {{ $commande->statut ?? 'completed' }}">
                                <i class="fas fa-check-circle"></i>
                                {{ ucfirst($commande->statut ?? 'Complétée') }}
                            </span>
                        </div>
                    </div>
                    <div class="invoice-actions">
                        <button class="btn-icon" onclick="toggleInvoice({{ $index }})" title="Replier/Déplier">
                            <i class="fas fa-chevron-down" id="chevron-{{ $index }}"></i>
                        </button>
                        <button class="btn-icon" onclick="printInvoice({{ $commande->id }})" title="Imprimer">
                            <i class="fas fa-print"></i>
                        </button>
                        <button class="btn-icon" onclick="shareInvoice({{ $commande->id }})" title="Partager">
                            <i class="fas fa-share-alt"></i>
                        </button>
                    </div>
                </div>

                <!-- Invoice Details -->
                <div class="invoice-details" id="invoice-{{ $index }}">
                    <!-- Client & Date Info -->
                    <div class="invoice-meta">
                        <div class="meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <div class="meta-content">
                                <span class="meta-label">Date de commande</span>
                                <span class="meta-value">{{ $commande->date_commande ?? $commande->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-user"></i>
                            <div class="meta-content">
                                <span class="meta-label">Client</span>
                                <span class="meta-value">{{ $commande->user->name ?? 'Client anonyme' }}</span>
                            </div>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="meta-content">
                                <span class="meta-label">Livraison</span>
                                <span class="meta-value">{{ $commande->adresse_livraison ?? 'Sur place' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Items Table -->
                    <div class="invoice-table-container">
                        <table class="invoice-table">
                            <thead>
                                <tr>
                                    <th>
                                        <i class="fas fa-hamburger"></i>
                                        Produit
                                    </th>
                                    <th class="text-center">
                                        <i class="fas fa-hashtag"></i>
                                        Qté
                                    </th>
                                    <th class="text-end">
                                        <i class="fas fa-tag"></i>
                                        Prix unit.
                                    </th>
                                    <th class="text-end">
                                        <i class="fas fa-calculator"></i>
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($commande->burger as $burger)
                                    <tr class="table-row">
                                        <td class="product-cell">
                                            <div class="product-info">
                                                <div class="product-icon">🍔</div>
                                                <div class="product-details">
                                                    <span class="product-name">{{ $burger->nom }}</span>
                                                    <span class="product-description">{{ $burger->description ?? 'Délicieux burger maison' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="quantity-badge">{{ $burger->pivot->quantite ?? 1 }}</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="price">{{ number_format($burger->prix, 0, ',', ' ') }}</span>
                                            <span class="currency">FCFA</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="total-price">
                                                {{ number_format($burger->prix * ($burger->pivot->quantite ?? 1), 0, ',', ' ') }}
                                                <span class="currency">FCFA</span>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Invoice Footer -->
                    <div class="invoice-footer">
                        <div class="payment-info">
                            <div class="payment-method">
                                <i class="fas fa-credit-card"></i>
                                <span>Paiement: {{ $commande->mode_paiement ?? 'Espèces' }}</span>
                            </div>
                            <div class="payment-status">
                                <i class="fas fa-check-circle text-success"></i>
                                <span>Payé</span>
                            </div>
                        </div>
                        <div class="total-section">
                            <div class="subtotal">
                                <span>Sous-total:</span>
                                <span>{{ number_format($commande->total * 0.85, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="tax">
                                <span>TVA (15%):</span>
                                <span>{{ number_format($commande->total * 0.15, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="total">
                                <span>Total:</span>
                                <span>{{ number_format($commande->total, 0, ',', ' ') }} FCFA</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Download Button -->
            </div>
        @endforeach

        <!-- Summary Cards -->
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="summary-card">
                    <div class="summary-icon revenue">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="summary-content">
                        <h3>{{ number_format($commandes->sum('total'), 0, ',', ' ') }}</h3>
                        <p>Total des factures</p>
                        <span class="currency">FCFA</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card">
                    <div class="summary-icon orders">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <div class="summary-content">
                        <h3>{{ $commandes->count() }}</h3>
                        <p>Factures générées</p>
                        <span class="period">Ce mois</span>
                    </div>
                </div>
            </div>
    </div>
</div>

<style>
.modern-invoice-container {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d1b69 100%);
    min-height: 100vh;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

.invoice-header {
    background: linear-gradient(135deg, #e91e63 0%, #ad1457 100%);
    color: white;
    position: relative;
    overflow: hidden;
}

.invoice-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 200px;
    height: 200px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.brand-title {
    font-size: 2.2rem;
    font-weight: 800;
    margin: 0;
    background: linear-gradient(45deg, #fff, #ffeb3b);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.brand-subtitle {
    font-size: 1rem;
    opacity: 0.9;
    margin: 0;
}

.header-actions {
    display: flex;
    gap: 12px;
}

.btn-action {
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
    padding: 10px 16px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 0.9rem;
}

.btn-action:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

.invoice-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    overflow: hidden;
    transition: all 0.3s ease;
}

.invoice-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(233, 30, 99, 0.2);
}

.invoice-card-header {
    padding: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.invoice-info {
    display: flex;
    align-items: center;
    gap: 24px;
}

.invoice-number .label {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.6);
    display: block;
}

.invoice-number .number {
    font-size: 1.3rem;
    font-weight: 800;
    color: white;
}

.status-badge {
    background: linear-gradient(135deg, #4caf50, #2e7d32);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
}

.status-badge.pending {
    background: linear-gradient(135deg, #ff9800, #f57c00);
}

.status-badge.cancelled {
    background: linear-gradient(135deg, #f44336, #c62828);
}

.invoice-actions {
    display: flex;
    gap: 8px;
}

.btn-icon {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: rgba(255, 255, 255, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-icon:hover {
    background: linear-gradient(135deg, #e91e63, #ad1457);
    color: white;
    transform: scale(1.05);
}

.invoice-details {
    padding: 0 24px 24px;
    transition: all 0.3s ease;
}

.invoice-meta {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 24px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.meta-item i {
    color: #e91e63;
    font-size: 1.1rem;
}

.meta-content {
    display: flex;
    flex-direction: column;
}

.meta-label {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.6);
}

.meta-value {
    font-size: 0.95rem;
    color: white;
    font-weight: 600;
}

.invoice-table-container {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 24px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.invoice-table {
    width: 100%;
    border-collapse: collapse;
}

.invoice-table th {
    color: rgba(255, 255, 255, 0.8);
    font-weight: 700;
    font-size: 0.9rem;
    padding: 12px 16px;
    text-align: left;
    border-bottom: 2px solid rgba(255, 255, 255, 0.1);
}

.invoice-table th i {
    margin-right: 8px;
    color: #e91e63;
}

.table-row:hover {
    background: rgba(255, 255, 255, 0.03);
}

.invoice-table td {
    padding: 16px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    vertical-align: middle;
}

.product-cell {
    min-width: 250px;
}

.product-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.product-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #e91e63, #ad1457);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.product-details {
    display: flex;
    flex-direction: column;
}

.product-name {
    color: white;
    font-weight: 600;
    font-size: 0.95rem;
}

.product-description {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.8rem;
}

.quantity-badge {
    background: linear-gradient(135deg, #2196f3, #1565c0);
    color: white;
    padding: 4px 10px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.85rem;
}

.price, .total-price {
    color: white;
    font-weight: 700;
    font-size: 0.95rem;
}

.total-price {
    font-size: 1.05rem;
}

.currency {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.8rem;
    margin-left: 4px;
}

.invoice-footer {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    padding: 20px;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 12px;
    margin-bottom: 20px;
}

.payment-info {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.payment-method, .payment-status {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
}

.payment-method i, .payment-status i {
    color: #e91e63;
}

.total-section {
    text-align: right;
    min-width: 200px;
}

.subtotal, .tax {
    display: flex;
    justify-content: space-between;
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
    margin-bottom: 8px;
}

.total {
    display: flex;
    justify-content: space-between;
    color: white;
    font-weight: 800;
    font-size: 1.2rem;
    padding-top: 12px;
    border-top: 2px solid rgba(255, 255, 255, 0.2);
}

.invoice-download {
    padding: 24px;
    text-align: center;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.download-btn {
    background: linear-gradient(135deg, #e91e63, #ad1457);
    color: white;
    padding: 14px 28px;
    border-radius: 16px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.download-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(233, 30, 99, 0.4);
    color: white;
}

.btn-gradient {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.download-btn:hover .btn-gradient {
    left: 100%;
}

.summary-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    border-radius: 20px;
    padding: 24px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all 0.3s ease;
}

.summary-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(233, 30, 99, 0.2);
}

.summary-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    color: white;
}

.summary-icon.revenue {
    background: linear-gradient(135deg, #e91e63, #ad1457);
}

.summary-icon.orders {
    background: linear-gradient(135deg, #2196f3, #1565c0);
}

.summary-icon.avg {
    background: linear-gradient(135deg, #ff9800, #f57c00);
}

.summary-content h3 {
    font-size: 1.8rem;
    font-weight: 800;
    color: white;
    margin: 0;
}

.summary-content p {
    color: rgba(255, 255, 255, 0.7);
    margin: 4px 0 0 0;
    font-size: 0.9rem;
}

.summary-content .currency,
.summary-content .period {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.5);
}

@media (max-width: 768px) {
    .brand-title {
        font-size: 1.8rem;
    }

    .header-actions {
        flex-direction: column;
        gap: 8px;
    }

    .invoice-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .invoice-meta {
        grid-template-columns: 1fr;
    }

    .invoice-footer {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }

    .invoice-table-container {
        overflow-x: auto;
    }

    .product-cell {
        min-width: 200px;
    }
}

/* Animation pour les chevrons */
.chevron-rotated {
    transform: rotate(180deg);
}

/* Animation pour replier/déplier */
.invoice-collapsed {
    max-height: 0;
    overflow: hidden;
    padding: 0 24px;
}
</style>

@endsection

@section('scripts')
<script>
// Fonction pour replier/déplier une facture
function toggleInvoice(index) {
    const details = document.getElementById(`invoice-${index}`);
    const chevron = document.getElementById(`chevron-${index}`);

    if (details.classList.contains('invoice-collapsed')) {
        details.classList.remove('invoice-collapsed');
        chevron.classList.remove('chevron-rotated');
    } else {
        details.classList.add('invoice-collapsed');
        chevron.classList.add('chevron-rotated');
    }
}

// Fonction pour imprimer une facture spécifique
function printInvoice(commandeId) {
    window.open(`/commandes/${commandeId}/print`, '_blank');
}

// Fonction pour partager une facture
function shareInvoice(commandeId) {
    if (navigator.share) {
        navigator.share({
            title: `Facture IPP BURGER #${commandeId.toString().padStart(6, '0')}`,
            text: 'Voici votre facture IPP BURGER',
            url: window.location.href
        });
    } else {
        // Fallback: copier le lien dans le presse-papiers
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Lien copié dans le presse-papiers !');
        });
    }
}

// Fonction pour exporter toutes les factures en PDF
function exportAllPDF() {
    alert('Export de toutes les factures en cours...');
    // Ici vous pouvez ajouter la logique pour exporter toutes les factures
}

// Animation d'entrée pour les cartes
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.invoice-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
@endsection
