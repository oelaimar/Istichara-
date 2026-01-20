<?php

use models\Personne;

 require_once __DIR__ . '/header.php'; ?>

<div class="dashboard-container">
    <h1>Rechercher un professionnel</h1>

    <form action="index.php" method="GET" class="search-form" style="background: white; padding: 2rem; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <input type="hidden" name="controller" value="search">
        <input type="hidden" name="action" value="index">
        
        <div class="form-row" style="margin-bottom: 0;">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" placeholder="Nom du professionnel..." value="<?= htmlspecialchars($_GET['nom'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label>Ville</label>
                <select name="city">
                    <option value="">Toutes les villes</option>
                    <?php foreach ($cities as $city): ?>
                        <option value="<?= $city['id'] ?>" <?= (isset($_GET['city']) && $_GET['city'] == $city['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($city['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group" style="justify-content: flex-end;">
                <button type="submit" class="submit-btn" style="width: auto; padding-left: 2rem; padding-right: 2rem;">
                    Rechercher
                </button>
            </div>
        </div>
    </form>

    <?php if (!empty($avocats) || !empty($huissiers)): ?>
        
        <!-- Resultats Avocats -->
        <?php if (!empty($avocats)): ?>
        <section>
            <h2>⚖️ Avocats trouvés (<?= count($avocats) ?>)</h2>
            <div class="city-grid">
                <?php foreach ($avocats as $avocat): ?>
                    <div class="city-card">
                        <h3><?= htmlspecialchars($avocat['name']) ?></h3>
                        <p><strong>Expérience:</strong> <?= $avocat['years_of_experiences'] ?> ans</p>
                        <p><strong>Spécialité:</strong> <?= htmlspecialchars($avocat['specialization']) ?></p>
                        <p><strong>Ville:</strong> <?= htmlspecialchars($avocat['city_name']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- Resultats Huissiers -->
        <?php if (!empty($huissiers)): ?>
        <section>
            <h2>📄 Huissiers trouvés (<?= count($huissiers) ?>)</h2>
            <div class="city-grid">
                <?php foreach ($huissiers as $huissier): ?>
                    <div class="city-card">
                        <h3><?= htmlspecialchars($huissier['name']) ?></h3>
                        <p><strong>Expérience:</strong> <?= $huissier['years_of_experiences'] ?> ans</p>
                        <p><strong>Ville:</strong> <?= htmlspecialchars($huissier['city_name']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

    <?php elseif (isset($_GET['nom'])): ?>
        <p style="text-align: center; font-size: 1.2rem; color: #6B7280;">Aucun professionnel trouvé.</p>
    <?php endif; ?>
        

   

        
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
