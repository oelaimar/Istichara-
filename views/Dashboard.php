<?php require_once __DIR__ . '/header.php'; ?>

<div class="dashboard-container">
    <h1>Dashboard</h1>

    <section class="personal-stats">
        <h2>Mes Performances</h2>
        <div class="stats-grid">
            <div class="stat-card revenue">
                <div class="stat-info">
                    <h3>Chiffre d'affaires</h3>
                    <div class="number">15 400 DH</div>
                </div>
                <div class="stat-icon">💰</div>
            </div>

            <div class="stat-card requests">
                <div class="stat-info">
                    <h3>Demandes reçues</h3>
                    <div class="number">24</div>
                </div>
                <div class="stat-icon">📩</div>
            </div>

            <div class="stat-card clients">
                <div class="stat-info">
                    <h3>Clients uniques</h3>
                    <div class="number">18</div>
                </div>
                <div class="stat-icon">👤</div>
            </div>

            <div class="stat-card hours">
                <div class="stat-info">
                    <h3>Heures de travail</h3>
                    <div class="number">120h 45m</div>
                </div>
                <div class="stat-icon">⏱️</div>
            </div>
        </div>
    </section>

    <hr> <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Avocats</h3>
                <div class="number"><?= htmlspecialchars($totalAvocats) ?></div>
            </div>
            <div class="stat-icon">⚖️</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Huissiers</h3>
                <div class="number"><?= htmlspecialchars($totalHuissiers) ?></div>
            </div>
            <div class="stat-icon">📄</div>
        </div>
    </div>
    
    <section>
        <h2>Répartition des professionnels par ville</h2>
        <div class="city-grid">
            <?php foreach ($statsCity as $city): ?>
                <div class="city-card">
                    <h3><?= htmlspecialchars($city['ville']) ?></h3>
                    <div class="city-stats">
                        <div class="city-stat">
                            <span class="icon">⚖️</span>
                            <span class="count"><?= $city['avocats'] ?></span>
                            <span class="label">Avocats</span>
                        </div>
                        <div class="city-stat">
                            <span class="icon">📄</span>
                            <span class="count"><?= $city['huissiers'] ?></span>
                            <span class="label">Huissiers</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    
    <section>
        <h2>Top 3 des avocats par années d'expérience</h2>
        <table border="1" style="width:100%; text-align:left; border-collapse:collapse;">
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

<style>
    /* Petit ajout de style pour organiser la nouvelle section */
    .personal-stats {
        margin-bottom: 30px;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }
    .stat-card {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #eee;
    }
    .stat-info h3 { margin: 0; font-size: 0.9rem; color: #666; }
    .stat-info .number { font-size: 1.4rem; font-weight: bold; margin-top: 5px; }
    .stat-icon { font-size: 1.8rem; }
    hr { margin: 40px 0; border: 0; border-top: 1px solid #ddd; }
</style>

<?php require_once __DIR__ . '/footer.php'; ?>