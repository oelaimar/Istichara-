<?php require_once __DIR__ . '/header.php'; ?>
<div class="dashboard-container">
    <h1>Dashboard</h1>
    
    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Avocats</h3>
                <div class="number"><?= htmlspecialchars($totalAvocats) ?></div>
            </div>
            <div class="stat-icon">
                ⚖️
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Huissiers</h3>
                <div class="number"><?= htmlspecialchars($totalHuissiers) ?></div>
            </div>
            <div class="stat-icon">
                📄
            </div>
        </div>
    </div>
    
    <!-- Répartition par ville (graphe) -->
    <section>
        <h2>Répartition des professionnels par ville</h2>
        <div style="height:400px;">
            <canvas id="cityChart"></canvas>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    
    const statsData = <?= json_encode(array_values($statsCity)); ?>;
    console.log(statsData);
    
    
    const labels = statsData.map(item => item.ville);
    const avocatsData = statsData.map(item => item.avocats);
    const huissiersData = statsData.map(item => item.huissiers);
    console.log(labels);
    console.log(avocatsData);
    console.log(huissiersData);
    
    const ctx = document.getElementById('cityChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Avocats',
                    data: avocatsData,
                    backgroundColor: '#0F2A44',
                    borderColor: '#0F2A44',
                    borderWidth: 1,
                    borderRadius: 4
                },
                {
                    label: 'Huissiers',
                    data: huissiersData,
                    backgroundColor: '#C9A24D',
                    borderColor: '#C9A24D',
                    borderWidth: 1,
                    borderRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    },
                    grid: {
                        color: '#E5E7EB'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            family: "'Inter', sans-serif",
                            size: 13
                        },
                        usePointStyle: true
                    }
                }
            }
        }
    });
</script>
    </section>
    
    <!-- Top 3 avocats -->
    <section>
        <h2>Top 3 des avocats par années d'expérience</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Années d'expérience</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topAvocats as $avocat): ?>
                    <tr>
                        <td><?= htmlspecialchars($avocat['name']) ?></td>
                        <td><?= htmlspecialchars($avocat['years_of_experiences']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>


<?php require_once __DIR__ . '/footer.php'; ?>