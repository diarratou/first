@extends('welcome')

@section('content')
<div class="modern-stats-container">
    <!-- Header Section -->
    <div class="header-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-4">
                <div>
                    <h1 class="main-title">📊 Dashboard</h1>
                    <p class="subtitle">IPP BURGER Analytics</p>
                </div>
                <div class="date-badge">
                    <span>{{ date('d M Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Section -->
    <div class="container py-4">
        <div class="row g-3 mb-5">
            <!-- Commandes en cours -->
            <div class="col-6 col-md-4">
                <div class="stat-card pending">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $commandesEnCours->count() }}</h3>
                        <p>En cours</p>
                    </div>
                    <div class="stat-trend">
                        <span class="trend-up">+12%</span>
                    </div>
                </div>
            </div>

            <!-- Commandes validées -->
            <div class="col-6 col-md-4">
                <div class="stat-card completed">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $commandesValidees->count() }}</h3>
                        <p>Validées</p>
                    </div>
                    <div class="stat-trend">
                        <span class="trend-up">+8%</span>
                    </div>
                </div>
            </div>

            <!-- Recette journalière -->
            <div class="col-12 col-md-4">
                <div class="stat-card revenue">
                    <div class="stat-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ number_format($recetteJournaliere / 1000, 1) }}K</h3>
                        <p>FCFA Aujourd'hui</p>
                        <small class="full-amount">{{ number_format($recetteJournaliere, 0, ',', ' ') }} FCFA</small>
                    </div>
                    <div class="stat-trend">
                        <span class="trend-up">+25%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row g-4">
            <!-- Main Chart -->
            <div class="col-lg-8">
                <div class="chart-card">
                    <div class="card-header">
                        <h5>📈 Commandes par mois</h5>
                        <div class="chart-controls">
                            <button class="btn-filter active" data-period="week">7j</button>
                            <button class="btn-filter" data-period="month">30j</button>
                            <button class="btn-filter" data-period="year">1an</button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="commandesChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Side Stats -->
            <div class="col-lg-4">
                <!-- Résumé Mensuel -->
                <div class="chart-card mb-4">
                    <div class="card-header">
                        <h5>📊 Résumé du mois</h5>
                    </div>
                    <div class="monthly-summary">
                        <div class="summary-item">

                        </div>
                        <div class="summary-item">
                            <div class="summary-icon orders-icon">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <div class="summary-content">
                                <span class="summary-label">Total commandes</span>
                                <span class="summary-value">{{ $commandesEnCours->count() + $commandesValidees->count() }}</span>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>

                <!-- Performance Chart -->

                </div>
            </div>
        </div>

        <!-- Quick Actions -->

    </div>
</div>

<style>
.modern-stats-container {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d1b69 100%);
    min-height: 100vh;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

.header-section {
    background: linear-gradient(135deg, #e91e63 0%, #ad1457 100%);
    color: white;
    position: relative;
    overflow: hidden;
}

.header-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    z-index: 1;
}

.main-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin: 0;
    background: linear-gradient(45deg, #fff, #ffeb3b);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    position: relative;
    z-index: 2;
}

.subtitle {
    font-size: 1rem;
    opacity: 0.9;
    margin: 0;
    position: relative;
    z-index: 2;
}

.date-badge {
    background: rgba(255, 255, 255, 0.2);
    padding: 8px 16px;
    border-radius: 20px;
    backdrop-filter: blur(10px);
    font-weight: 600;
    font-size: 0.9rem;
    position: relative;
    z-index: 2;
}

.stat-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    border-radius: 20px;
    padding: 24px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(233, 30, 99, 0.3);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
}

.stat-card.pending::before {
    background: linear-gradient(90deg, #ff9800, #f57c00);
}

.stat-card.completed::before {
    background: linear-gradient(90deg, #4caf50, #2e7d32);
}

.stat-card.revenue::before {
    background: linear-gradient(90deg, #e91e63, #ad1457);
}

.stat-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    border-radius: 15px;
    background: linear-gradient(135deg, #e91e63, #ad1457);
    color: white;
    font-size: 1.2rem;
    margin-bottom: 16px;
}

.stat-content h3 {
    font-size: 2.2rem;
    font-weight: 800;
    color: white;
    margin: 0;
    line-height: 1;
}

.stat-content p {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.7);
    margin: 4px 0 0 0;
}

.full-amount {
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.5);
    display: block;
    margin-top: 4px;
}

.stat-trend {
    position: absolute;
    top: 20px;
    right: 20px;
}

.trend-up {
    background: rgba(76, 175, 80, 0.2);
    color: #4caf50;
    padding: 4px 8px;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
}

.chart-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    border-radius: 24px;
    padding: 0;
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    overflow: hidden;
}

.card-header {
    padding: 24px 24px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.card-header h5 {
    color: white;
    font-weight: 700;
    margin: 0;
    font-size: 1.1rem;
}

.chart-controls {
    display: flex;
    gap: 8px;
}

.btn-filter {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: rgba(255, 255, 255, 0.7);
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 0.8rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-filter:hover,
.btn-filter.active {
    background: linear-gradient(135deg, #e91e63, #ad1457);
    color: white;
    border-color: transparent;
}

.chart-container {
    padding: 24px;
    height: 350px;
}

.monthly-summary {
    padding: 24px;
}

.summary-item {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 20px;
}

.summary-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    color: white;
}

.revenue-icon {
    background: linear-gradient(135deg, #e91e63, #ad1457);
}

.orders-icon {
    background: linear-gradient(135deg, #2196f3, #1565c0);
}

.avg-icon {
    background: linear-gradient(135deg, #ff9800, #f57c00);
}

.summary-content {
    display: flex;
    flex-direction: column;
}

.summary-label {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.6);
}

.summary-value {
    font-size: 1.1rem;
    font-weight: 700;
    color: white;
}

.performance-container {
    padding: 24px;
    height: 200px;
}

.actions-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    border-radius: 24px;
    padding: 24px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
}

.actions-card h5 {
    color: white;
    font-weight: 700;
    margin-bottom: 20px;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

.action-btn {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
    padding: 16px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
    text-decoration: none;
    cursor: pointer;
    font-size: 0.95rem;
}

.action-btn:hover {
    background: linear-gradient(135deg, #e91e63, #ad1457);
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(233, 30, 99, 0.3);
    color: white;
}

.action-btn i {
    font-size: 1.2rem;
}

@media (max-width: 768px) {
    .main-title {
        font-size: 2rem;
    }

    .chart-controls {
        flex-wrap: wrap;
    }

    .actions-grid {
        grid-template-columns: 1fr;
    }

    .card-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .stat-content h3 {
        font-size: 1.8rem;
    }
}
</style>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Configuration des couleurs
const colors = {
    primary: '#e91e63',
    secondary: '#ad1457',
    accent: '#ff4081',
    success: '#4caf50',
    warning: '#ff9800',
    info: '#2196f3'
};

// Graphique principal - Commandes par mois (votre code original adapté)
const commandesCtx = document.getElementById('commandesChart').getContext('2d');
const gradient = commandesCtx.createLinearGradient(0, 0, 0, 350);
gradient.addColorStop(0, 'rgba(233, 30, 99, 0.3)');
gradient.addColorStop(1, 'rgba(233, 30, 99, 0.05)');

new Chart(commandesCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($commandesParMois->toArray())) !!},
        datasets: [{
            label: 'Commandes par mois',
            data: {!! json_encode(array_values($commandesParMois->toArray())) !!},
            backgroundColor: gradient,
            borderColor: colors.primary,
            borderWidth: 2,
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                grid: {
                    color: 'rgba(255, 255, 255, 0.1)',
                    borderColor: 'rgba(255, 255, 255, 0.2)'
                },
                ticks: {
                    color: 'rgba(255, 255, 255, 0.7)',
                    font: {
                        size: 12,
                        weight: '600'
                    }
                }
            },
            y: {
                beginAtZero: true,
                precision: 0,
                grid: {
                    color: 'rgba(255, 255, 255, 0.1)',
                    borderColor: 'rgba(255, 255, 255, 0.2)'
                },
                ticks: {
                    color: 'rgba(255, 255, 255, 0.7)',
                    font: {
                        size: 12,
                        weight: '600'
                    }
                }
            }
        },
        interaction: {
            intersect: false,
            mode: 'index'
        }
    }
});

// Graphique de performance - Donut
const performanceCtx = document.getElementById('performanceChart').getContext('2d');
new Chart(performanceCtx, {
    type: 'doughnut',
    data: {
        labels: ['Complétées', 'En cours', 'Annulées'],
        datasets: [{
            data: [{{ $commandesValidees->count() }}, {{ $commandesEnCours->count() }}, 5],
            backgroundColor: [
                colors.success,
                colors.warning,
                '#f44336'
            ],
            borderWidth: 0,
            hoverBorderWidth: 4,
            hoverBorderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '70%',
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: 'rgba(255, 255, 255, 0.8)',
                    usePointStyle: true,
                    padding: 15,
                    font: {
                        size: 11,
                        weight: '600'
                    }
                }
            }
        }
    }
});

// Animation d'entrée pour les cartes
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.stat-card');
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

// Gestion des filtres de période
document.querySelectorAll('.btn-filter').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.btn-filter').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        // Ici vous pouvez ajouter la logique pour filtrer les données
        console.log('Période sélectionnée:', this.dataset.period);
    });
});

// Fonction pour générer un rapport
function generateReport() {
    // Simulation d'une génération de rapport
    alert('Génération du rapport mensuel en cours...');
    // Ici vous pouvez ajouter la logique pour générer et télécharger le rapport
}
</script>
@endsection
