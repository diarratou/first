@extends('welcome')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #ff416c 0%, #ff4757 100%);
        font-family: 'Inter', 'Segoe UI', sans-serif;
        min-height: 100vh;
    }

    .archives-container {
        background: linear-gradient(135deg, #ff416c 0%, #ff4757 100%);
        min-height: 100vh;
        padding: 30px 0;
    }

    .page-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        margin: 0 15px 30px 15px;
        padding: 30px;
        box-shadow: 0 8px 32px rgba(255, 65, 108, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.3);
        text-align: center;
    }

    .page-title {
        color: #2d3436;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .page-subtitle {
        color: #636e72;
        font-size: 1rem;
        font-weight: 500;
    }

    .content-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        margin: 0 15px;
        padding: 30px;
        box-shadow: 0 8px 32px rgba(255, 65, 108, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-icon {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-title {
        color: #636e72;
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .empty-description {
        color: #81868b;
        font-size: 1rem;
        line-height: 1.5;
    }

    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: transparent;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(255, 65, 108, 0.1);
    }

    .table-header {
        background: linear-gradient(135deg, #ff416c, #ff4757);
        color: white;
    }

    .table-header th {
        padding: 18px 16px;
        font-weight: 700;
        font-size: 0.9rem;
        text-align: center;
        border: none;
        position: relative;
    }

    .table-header th:first-child {
        border-top-left-radius: 16px;
    }

    .table-header th:last-child {
        border-top-right-radius: 16px;
    }

    .table-body tr {
        background: rgba(248, 249, 250, 0.8);
        transition: all 0.3s ease;
    }

    .table-body tr:nth-child(even) {
        background: rgba(255, 255, 255, 0.9);
    }

    .table-body tr:hover {
        background: rgba(255, 65, 108, 0.05);
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(255, 65, 108, 0.1);
    }

    .table-body td {
        padding: 16px;
        text-align: center;
        border: none;
        color: #2d3436;
        font-weight: 500;
        vertical-align: middle;
    }

    .table-body tr:last-child td:first-child {
        border-bottom-left-radius: 16px;
    }

    .table-body tr:last-child td:last-child {
        border-bottom-right-radius: 16px;
    }

    .burger-name {
        font-weight: 700;
        color: #ff416c;
        font-size: 1rem;
    }

    .burger-price {
        font-weight: 600;
        color: #2d3436;
        font-size: 0.95rem;
    }

    .burger-image {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .burger-image:hover {
        transform: scale(1.1);
    }

    .burger-description {
        color: #636e72;
        font-size: 0.85rem;
        line-height: 1.4;
        max-width: 200px;
        margin: 0 auto;
    }

    .stock-badge {
        background: rgba(0, 184, 148, 0.1);
        color: #00b894;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        border: 1px solid rgba(0, 184, 148, 0.2);
    }

    .btn-unarchive {
        background: linear-gradient(135deg, #00b894, #00a085);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 8px 16px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 184, 148, 0.3);
    }

    .btn-unarchive:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 184, 148, 0.4);
        color: white;
    }

    .back-section {
        text-align: center;
        margin-top: 30px;
        padding: 0 15px;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        padding: 12px 24px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        backdrop-filter: blur(10px);
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
        box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
    }

    .alert {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: none;
        border-radius: 16px;
        padding: 20px;
        margin: 0 15px 20px 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border-left: 4px solid #0984e3;
        color: #0984e3;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.6rem;
            flex-direction: column;
            gap: 8px;
        }

        .content-section,
        .page-header {
            margin: 0 10px 20px 10px;
            padding: 20px;
        }

        .modern-table {
            font-size: 0.85rem;
        }

        .table-header th,
        .table-body td {
            padding: 12px 8px;
        }

        .burger-image {
            width: 50px;
            height: 50px;
        }

        .burger-description {
            max-width: 150px;
            font-size: 0.8rem;
        }

        .btn-unarchive {
            padding: 6px 12px;
            font-size: 0.8rem;
        }
    }

    @media (max-width: 576px) {
        .table-header th:nth-child(3),
        .table-body td:nth-child(3),
        .table-header th:nth-child(4),
        .table-body td:nth-child(4) {
            display: none;
        }
    }
</style>

<div class="archives-container">
    <!-- En-tête de page -->
    <div class="page-header">
        <h2 class="page-title">
            📦 Burgers Archivés
        </h2>
        <p class="page-subtitle">
            Gérez vos burgers temporairement retirés de la vente
        </p>
    </div>

    <!-- Messages d'alerte -->
    @if(session("message"))
        <div class="alert">
            <strong>✅ Succès!</strong> {{ session("message") }}
        </div>
    @endif

    <!-- Contenu principal -->
    <div class="content-section">
        @if($burgers->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">📦</div>
                <h3 class="empty-title">Aucun burger archivé</h3>
                <p class="empty-description">
                    Vous n'avez actuellement aucun burger dans vos archives.<br>
                    Les burgers archivés apparaîtront ici.
                </p>
            </div>
        @else
            <div class="table-responsive">
                <table class="modern-table">
                    <thead class="table-header">
                        <tr>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach($burgers as $burger)
                            <tr>
                                <td>
                                    <div class="burger-name">{{ $burger->nom }}</div>
                                </td>
                                <td>
                                    <div class="burger-price">
                                        {{ number_format($burger->prix, 0, ',', ' ') }} FCFA
                                    </div>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/'.$burger->image) }}"
                                         alt="{{ $burger->nom }}"
                                         class="burger-image">
                                </td>
                                <td>
                                    <div class="burger-description">
                                        {{ Str::limit($burger->description, 50) }}
                                    </div>
                                </td>
                                <td>
                                    <span class="stock-badge">
                                        {{ $burger->stock }} unités
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('burgers.desarchiver', $burger->id) }}"
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-unarchive"
                                                onclick="return confirm('Désarchiver ce burger ?')">
                                            Désarchiver
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Bouton retour -->
    <div class="back-section">
        <a href="{{ route('burger') }}" class="btn-back">
            ← Retour aux Burgers
        </a>
    </div>
</div>

@endsection
