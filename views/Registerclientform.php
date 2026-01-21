<?php require_once __DIR__ . '/header.php'; ?>
<div class="register-container">
    <h2>Créer un compte</h2>

    <form action="index.php?controller=register&action=Registerclient" method="POST">

        <div class="form-row">
            <div class="form-group">
                <label>Nom complet</label>
                <input type="text" name="name" placeholder="Votre nom" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="exemple@email.com" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Téléphone</label>
                <input type="text" name="phone" placeholder="+212 ..." required>
            </div>

            <div class="form-group">
                <label>Ville</label>
                <select name="ville" required>
                    <option value="">-- Choisir --</option>
                    <?php foreach ($villes as $ville) { ?>
                    <option value=<?= htmlspecialchars($ville['id'])?>> <?= htmlspecialchars($ville['name'])?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <!-- Zone dynamique -->
        <div id="extraFields" class="extra-fields"></div>

        <button type="submit" name="submit" class="submit-btn">
            Enregistrer
        </button>

    </form>
</div>


<?php require_once __DIR__ . '/footer.php'; ?>
