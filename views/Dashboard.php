<?php require_once __DIR__ . '/header.php'; ?>

<div class="dashboard-wrapper">
    <header class="dashboard-header">
        <div>
            <h1>Tableau de Bord Analytique</h1>
            <p class="subtitle">Aperçu en temps réel des activités et performances</p>
        </div>
        <a href="index.php?controller=admin&action=validationCompte" class="btn-validate">📋 Valider Comptes</a>
    </header>

    <section class="stats-section">
        <h2 class="section-title"><i class="icon-performance"></i> Mes Performances</h2>
        <div class="stats-grid">
            <div class="stat-card revenue">
                <div class="stat-info">
                    <span class="stat-label">Chiffre d'affaires</span>
                    <div class="stat-value"><?= htmlspecialchars($totalChiffre) ?> <span class="currency">DH</span>
                    </div>
                </div>
                <div class="stat-icon">💰</div>
            </div>

            <div class="stat-card requests">
                <div class="stat-info">
                    <span class="stat-label">Demandes reçues</span>
                    <div class="stat-value"><?= !empty($totalDemand) ? $totalDemand : "0" ?></div>
                </div>
                <div class="stat-icon">📩</div>
            </div>

            <div class="stat-card clients">
                <div class="stat-info">
                    <span class="stat-label">Clients uniques</span>
                    <div class="stat-value">18</div>
                </div>
                <div class="stat-icon">👤</div>
            </div>

            <div class="stat-card hours">
                <div class="stat-info">
                    <span class="stat-label">Heures de travail</span>
                    <div class="stat-value">120h <span class="minutes">45m</span></div>
                </div>
                <div class="stat-icon">⏱️</div>
            </div>
        </div>
    </section>

    <div class="main-content-grid">
        <div class="chart-container">
            <h2 class="section-title">Répartition par ville</h2>
            <div class="chart-wrapper">
                <canvas id="cityChart"></canvas>
            </div>

            <div class="pagination-container">
                <p>Page <strong><?= $page ?></strong> sur <?= $totalPages ?></p>
                <div class="pagination-buttons">
                    <a href="?controller=dashboard&action=dashboard&page=<?= max(1, $page - 1) ?>"
                        class="btn-page <?= ($page <= 1) ? 'disabled' : '' ?>">« Précédent</a>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?controller=dashboard&action=dashboard&page=<?= $i ?>"
                            class="btn-page <?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>

                    <a href="?controller=dashboard&action=dashboard&page=<?= min($totalPages, $page + 1) ?>"
                        class="btn-page <?= ($page >= $totalPages) ? 'disabled' : '' ?>">Suivant »</a>
                </div>
            </div>
        </div>

        <div class="table-container">
            <h2 class="section-title">Élite par Expérience</h2>
            <div class="table-responsive">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Expert</th>
                            <th>Expérience</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($topAvocats as $avocat): ?>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar"><?= substr(htmlspecialchars($avocat['name']), 0, 1) ?>
                                        </div>
                                        <span><?= htmlspecialchars($avocat['name']) ?></span>
                                    </div>
                                </td>
                                <td><span class="badge-exp"><?= htmlspecialchars($avocat['years_of_experiences']) ?>
                                        ans</span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="global-counts">
                <div class="count-item">
                    <span>Total Avocats:</span> <strong><?= $totalAvocats ?></strong>
                </div>
                <div class="count-item">
                    <span>Total Huissiers:</span> <strong><?= $totalHuissiers ?></strong>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-navy: #0F2A44;
        --secondary-gold: #C9A24D;
        --bg-light: #F4F7F9;
        --text-dark: #2D3748;
        --white: #FFFFFF;
        --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    body {
        background-color: var(--bg-light);
        font-family: 'Inter', sans-serif;
        color: var(--text-dark);
    }

    .dashboard-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .dashboard-header {
        margin-bottom: 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dashboard-header h1 {
        font-size: 2rem;
        color: var(--primary-navy);
        margin-bottom: 5px;
    }

    .btn-validate {
        background-color: var(--secondary-gold);
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        transition: opacity 0.3s;
    }
    .btn-validate:hover {
        opacity: 0.9;
    }

    .subtitle {
        color: #718096;
        font-size: 1rem;
    }

    .section-title {
        font-size: 1.2rem;
        color: var(--primary-navy);
        margin-bottom: 20px;
        border-left: 4px solid var(--secondary-gold);
        padding-left: 15px;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: var(--white);
        padding: 25px;
        border-radius: 12px;
        box-shadow: var(--shadow);
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-label {
        font-size: 0.9rem;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-navy);
        margin-top: 5px;
    }

    .stat-value .currency,
    .stat-value .minutes {
        font-size: 1rem;
        color: var(--secondary-gold);
    }

    .stat-icon {
        font-size: 2.2rem;
        opacity: 0.8;
    }

    /* Content Layout */
    .main-content-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 30px;
    }

    .chart-container,
    .table-container {
        background: var(--white);
        padding: 30px;
        border-radius: 12px;
        box-shadow: var(--shadow);
    }

    /* Table Styling */
    .styled-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .styled-table thead tr {
        background-color: var(--primary-navy);
        color: var(--white);
        text-align: left;
    }

    .styled-table th,
    .styled-table td {
        padding: 15px;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #edf2f7;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        background: var(--secondary-gold);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .badge-exp {
        background: #EBF8FF;
        color: #2B6CB0;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* Pagination */
    .pagination-container {
        margin-top: 30px;
        border-top: 1px solid #eee;
        padding-top: 20px;
        text-align: center;
    }

    .pagination-buttons {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 10px;
    }

    .btn-page {
        padding: 8px 16px;
        border-radius: 6px;
        border: 1px solid #E2E8F0;
        text-decoration: none;
        color: var(--text-dark);
        font-size: 0.9rem;
        transition: 0.3s;
    }

    .btn-page.active {
        background: var(--primary-navy);
        color: white;
        border-color: var(--primary-navy);
    }

    .btn-page:hover:not(.disabled, .active) {
        background: var(--bg-light);
        border-color: var(--secondary-gold);
    }

    .btn-page.disabled {
        pointer-events: none;
        opacity: 0.4;
    }

    .global-counts {
        margin-top: 25px;
        display: flex;
        gap: 20px;
        font-size: 0.9rem;
        color: #4A5568;
    }

    @media (max-width: 992px) {
        .main-content-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const statsData = <?= json_encode(array_values($statsCity)); ?>;
    const ctx = document.getElementById('cityChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: statsData.map(item => item.ville),
            datasets: [
                {
                    label: 'Avocats',
                    data: statsData.map(item => item.avocats),
                    backgroundColor: '#0F2A44',
                    borderRadius: 6
                },
                {
                    label: 'Huissiers',
                    data: statsData.map(item => item.huissiers),
                    backgroundColor: '#C9A24D',
                    borderRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
            },
            scales: {
                y: { beginAtZero: true, grid: { color: '#F0F0F0' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>

<?php require_once __DIR__ . '/footer.php'; ?>