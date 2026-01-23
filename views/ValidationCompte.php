<?php require_once __DIR__ . '/header.php'; ?>

<div class="dashboard-wrapper">
    <header class="dashboard-header">
        <h1>Validation des Comptes</h1>
        <p class="subtitle">Valider les demandes d'inscription des professionnels</p>
    </header>

    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Spécialité/Type</th>
                    <th>Document</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pendingPros)): ?>
                    <tr><td colspan="6">Aucune demande en attente.</td></tr>
                <?php else: ?>
                    <?php foreach ($pendingPros as $pro): ?>
                    <tr>
                        <td><?= htmlspecialchars($pro['name']) ?></td>
                        <td><?= htmlspecialchars($pro['email']) ?></td>
                        <td>
                            <?php 
                                echo !empty($pro['specialization']) ? 
                                    '<span class="badge-avocat">Avocat: '.htmlspecialchars($pro['specialization']).'</span>' : 
                                    '<span class="badge-hussier">Huissier: '.htmlspecialchars($pro['type']).'</span>';
                            ?>
                        </td>
                        <td>
                            <?php if(!empty($pro['document'])): ?>
                                <a href="<?= htmlspecialchars($pro['document']) ?>" target="_blank" class="btn-doc">Voir Document</a>
                            <?php else: ?>
                                <span class="text-muted">Non fourni</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d/m/Y', strtotime($pro['created_at'])) ?></td>
                        <td>
                            <div class="actions">
                                <form action="index.php?controller=admin&action=accept" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $pro['id'] ?>">
                                    <button type="submit" class="btn-approve">Approuver</button>
                                </form>
                                <form action="index.php?controller=admin&action=reject" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $pro['id'] ?>">
                                    <button type="submit" class="btn-reject">Rejeter</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
