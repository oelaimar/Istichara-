<?php require_once "./views/header.php" ?>
<div class="register-container">
    <h2>Créer un compte</h2>

    <form action="index.php?controller=personne&action=create" method="POST">

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
                <label>Téléphone</label>
                <input type="text" name="phone" placeholder="+212 ..." required>
            </div>
        </div>

        <label class="section-label">Type d'utilisateur</label>

        <div class="role-row">
            <label id="avocatLabel" class="role-card">
                <input id="avocat" type="radio" name="role" value="avocat" required>
                ⚖️ Avocat
            </label>

            <label id="hussierLabel" class="role-card">
                <input id="hussier" type="radio" name="role" value="hussier" required>
                📄 Huissier
            </label>
        </div>

        <!-- Zone dynamique -->
        <div id="extraFields" class="extra-fields"></div>

        <button type="submit" name="submit" class="submit-btn">
            Enregistrer
        </button>

    </form>
</div>


<?php require_once "./views/footer.php" ?>
