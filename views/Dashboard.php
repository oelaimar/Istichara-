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
                    <div class="stat-value"><?= $totalChiffre ?? 0 ?> <span class="currency">DH</span>
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