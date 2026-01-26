<!DOCTYPE html>
<html lang="en">
    <style>
        /* Container de la page */
        #login {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Box du formulaire */
        .form-box {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 450px;
            width: 100%;
            padding: 40px;
        }

        /* Titre */
        .form-title {
            text-align: center;
            color: #2c5f8d;
            margin-bottom: 10px;
            font-size: 28px;
        }

        /* Sous-titre */
        .form-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        /* Labels */
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        /* Inputs */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #0F2A44;
            box-shadow: 0 0 0 3px rgba(44, 95, 141, 0.1);
        }

        /* Bouton */
        .btn {
            padding: 14px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn.full {
            width: 100%;
            background: #0F2A44;
            color: white;
        }

        .btn.full:hover {
            background: #1f476d;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44, 95, 141, 0.3);
        }
    </style>

   <?php require_once 'header.php'; ?>


<div id="login" class="page active">
    <div class="form-box">

        <h2 class="form-title">Connexion</h2>
        <p class="form-subtitle">Accédez à votre espace ISTICHARA</p>

        <form action="index.php?controller=login&action=login" method="POST">
            <label>Email</label>
            <input id="email" type="email" name="email" placeholder="exemple@email.com" required>

            <label>Mot de passe</label>
            <input id="pass" type="password" name="password" placeholder="********" required>

            <button type="submit" name="submit" class="btn full">Se connecter</button>
        </form>

    </div>
</div>

    <?php require_once 'footer.php'; ?>
