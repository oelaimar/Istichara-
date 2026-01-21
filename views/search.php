<?php require_once __DIR__ . '/header.php'; ?>
<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<div class="dashboard-container">
    <h1>Rechercher un professionnel</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

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
                        <button class="booking-btn" onclick="openBookingModal('lawyer', <?= $avocat['id'] ?>, '<?= htmlspecialchars($avocat['name']) ?>', <?= $avocat['consultation_online'] ?>)">Prendre RDV</button>
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
                        <button class="booking-btn" onclick="openBookingModal('hussier', <?= $huissier['id'] ?>, '<?= htmlspecialchars($huissier['name']) ?>', 0)">Prendre RDV</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

    <?php elseif (isset($_GET['nom'])): ?>
        <p style="text-align: center; font-size: 1.2rem; color: #6B7280;">Aucun professionnel trouvé.</p>
    <?php endif; ?>

</div>

<!-- Booking Modal -->
<div id="bookingModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeBookingModal()">&times;</span>
        <h2 id="modalTitle">Prendre Rendez-vous</h2>
        <form action="index.php?controller=search&action=book" method="POST">
            <input type="hidden" name="lawyer_id" id="modalLawyerId">
            <input type="hidden" name="hussier_id" id="modalHussierId">
            
            <div class="form-group" style="margin-bottom: 1rem;">
                <label>Date</label>
                <input type="date" name="day" required min="<?= date('Y-m-d') ?>">
            </div>
            
            <div class="form-group" style="margin-bottom: 1rem;">
                <label>Heure</label>
                <input type="time" name="time" required>
            </div>
            
            <div class="form-group" id="onlineConsultationGroup" style="margin-bottom: 1.5rem; display: flex; flex-direction: row; align-items: center; gap: 0.5rem;">
                <input type="checkbox" name="is_online" id="isOnline" style="width: auto;">
                <label for="isOnline" style="margin-bottom: 0;">Consultation en ligne</label>
            </div>
            
            <button type="submit" class="submit-btn">Confirmer la réservation</button>
        </form>
    </div>
</div>

<script>
function openBookingModal(type, id, name, canOnline) {
    document.getElementById('bookingModal').style.display = 'block';
    document.getElementById('modalTitle').innerText = 'RDV avec ' + name;
    
    if (type === 'lawyer') {
        document.getElementById('modalLawyerId').value = id;
        document.getElementById('modalHussierId').value = '';
    } else {
        document.getElementById('modalHussierId').value = id;
        document.getElementById('modalLawyerId').value = '';
    }
    
    const onlineGroup = document.getElementById('onlineConsultationGroup');
    if (canOnline == 1) {
        onlineGroup.style.display = 'flex';
    } else {
        onlineGroup.style.display = 'none';
        document.getElementById('isOnline').checked = false;
    }
}

function closeBookingModal() {
    document.getElementById('bookingModal').style.display = 'none';
}

window.onclick = function(event) {
    let modal = document.getElementById('bookingModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<?php require_once __DIR__ . '/footer.php'; ?>
