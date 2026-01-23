<?php require_once __DIR__ . '/header.php'; ?>
<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<div class="dashboard-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Mes Rendez-vous</h1>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <section>
        <?php if (empty($appointments)): ?>
            <p style="text-align: center; color: #6B7280; padding: 2rem;">Vous n'avez pas encore de rendez-vous.</p>
        <?php else: ?>
            <div class="city-grid">
                <?php foreach ($appointments as $app): ?>
                    <div class="city-card">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <h3><?= htmlspecialchars($app['professional_name']) ?></h3>
                            <span class="status-badge status-<?= $app['status'] ?>" style="
                                padding: 0.25rem 0.5rem; 
                                border-radius: 9999px; 
                                font-size: 0.75rem; 
                                font-weight: 700;
                                text-transform: uppercase;
                                <?php
                                    if ($app['status'] === 'accepted') echo "background: #D1FAE5; color: #065F46;";
                                    elseif ($app['status'] === 'declined') echo "background: #FEE2E2; color: #991B1B;";
                                    else echo "background: #FEF3C7; color: #92400E;";
                                ?>
                            ">
                                <?= $app['status'] ?>
                            </span>
                        </div>
                        <p><strong>Type:</strong> <?= $app['professional_type'] ?></p>
                        <p><strong>Date:</strong> <?= date('d/m/Y', strtotime($app['day'])) ?></p>
                        <p><strong>Heure:</strong> <?= date('H:i', strtotime($app['horaire'])) ?></p>
                        <p><strong>Mode:</strong> <?= $app['is_online'] ? '🌐 En ligne' : '📍 Présentiel' ?></p>
                        
                        <?php if ($app['is_online'] && $app['status'] === 'accepted' && $app['meeting_link']): ?>
                            <a href="<?= htmlspecialchars($app['meeting_link']) ?>" target="_blank" class="booking-btn" style="text-align: center; display: block; background: #10B981; margin-top: 1rem;">Rejoindre la consultation</a>
                        <?php elseif ($app['is_online'] && $app['status'] === 'accepted'): ?>
                            <p style="margin-top: 1rem; color: #6B7280; font-style: italic; font-size: 0.9rem;">Le lien de consultation sera disponible bientôt.</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
