<?php require_once __DIR__ . '/header.php'; ?>
<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<div class="dashboard-container">
    <h1>Gérer mes Rendez-vous</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <section>
        <?php if (empty($appointments)): ?>
            <p style="text-align: center; color: #6B7280; padding: 2rem;">Vous n'avez pas encore de demandes de rendez-vous.</p>
        <?php else: ?>
            <div class="city-grid">
                <?php foreach ($appointments as $app): ?>
                    <div class="city-card">
                        <h3>Client: <?= htmlspecialchars($app['client_name']) ?></h3>
                        <p><strong>Date:</strong> <?= date('d/m/Y', strtotime($app['day'])) ?></p>
                        <p><strong>Heure:</strong> <?= date('H:i', strtotime($app['horaire'])) ?></p>
                        <p><strong>Mode:</strong> <?= $app['is_online'] ? '🌐 En ligne' : '📍 Présentiel' ?></p>
                        
                        <div style="margin-top: 1rem; border-top: 1px solid var(--gray); pt: 1rem;">
                            <p><strong>Statut:</strong> <?= ucfirst($app['status']) ?></p>
                            
                            <?php if ($app['status'] === 'pending'): ?>
                                <div style="display: flex; gap: 0.5rem; margin-top: 1rem;">
                                    <form action="index.php?controller=appointment&action=updateStatus" method="POST" style="flex: 1;">
                                        <input type="hidden" name="id" value="<?= $app['id'] ?>">
                                        <input type="hidden" name="status" value="accepted">
                                        <?php if ($app['is_online']): ?>
                                            <input type="url" name="meeting_link" placeholder="Lien de réunion" required style="width: 100%; margin-bottom: 0.5rem; padding: 0.5rem;">
                                        <?php endif; ?>
                                        <button type="submit" class="booking-btn" style="background: #10B981;">Accepter</button>
                                    </form>
                                    
                                    <form action="index.php?controller=appointment&action=updateStatus" method="POST" style="flex: 1;">
                                        <input type="hidden" name="id" value="<?= $app['id'] ?>">
                                        <input type="hidden" name="status" value="declined">
                                        <button type="submit" class="booking-btn" style="background: #EF4444;">Refuser</button>
                                    </form>
                                </div>
                            <?php elseif ($app['status'] === 'accepted' && $app['is_online'] && $app['meeting_link']): ?>
                                <p style="margin-top: 0.5rem;"><strong>Lien:</strong> <a href="<?= htmlspecialchars($app['meeting_link']) ?>" target="_blank">Rejoindre</a></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
