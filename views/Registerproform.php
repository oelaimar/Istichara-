<!DOCTYPE html>
<html lang="fr">
        <style>
            * {
                margin: 0;
            padding: 0;
            box-sizing: border-box;
                }

                .type-btn {
                    flex: 1;
                    padding: 20px;
                    border: 2px solid #e0e0e0;
                    border-radius: 8px;
                    background: white;
                    cursor: pointer;
                    font-size: 16px;
                    font-weight: 500;
                    transition: all 0.3s;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                }

                .type-btn.active {
                    border-color: #2c5f8d;
                    background: #f0f4f8;
                    color: #2c5f8d;
                    font-weight: 600;
                    transform: scale(1.02);
                    box-shadow: 0 0 0 3px rgba(44, 95, 141, 0.1);
                }

                .type-btn:hover {
                    border-color: #2c5f8d;
                    background: #f8f9fa;
                }

                .type-btn.active {
                    border-color: #2c5f8d;
                    background: #f0f4f8;
                    color: #2c5f8d;
                    font-weight: 600;
                    transform: scale(1.02);
                }

                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    min-height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 20px;
                }

                .container {
                    background: white;
                    border-radius: 20px;
                    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                    max-width: 600px;
                    width: 100%;
                    padding: 40px;
                }

                h1 {
                    text-align: center;
                    color: #2c5f8d;
                    margin-bottom: 10px;
                    font-size: 28px;
                }

                .subtitle {
                    text-align: center;
                    color: #666;
                    margin-bottom: 30px;
                    font-size: 14px;
                }

                /* Progress Bar */
                .progress-container {
                    margin-bottom: 40px;
                }

                .progress-bar {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 10px;
                    position: relative;
                }

                .progress-bar::before {
                    content: '';
                    position: absolute;
                    top: 20px;
                    left: 0;
                    right: 0;
                    height: 4px;
                    background: #e0e0e0;
                    z-index: -1;
                }

                .progress-bar-fill {
                    position: absolute;
                    top: 20px;
                    left: 0;
                    height: 4px;
                    background: #2c5f8d;
                    transition: width 0.3s ease;
                    z-index: -1;
                }

                .step-indicator {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    position: relative;
                }

                .step-number {
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    background: #e0e0e0;
                    color: #999;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: bold;
                    transition: all 0.3s ease;
                    z-index: 1;
                }

                .step-indicator.active .step-number {
                    background: #2c5f8d;
                    color: white;
                    transform: scale(1.1);
                }

                .step-indicator.completed .step-number {
                    background: #4CAF50;
                    color: white;
                }

                .step-label {
                    margin-top: 8px;
                    font-size: 12px;
                    color: #999;
                    text-align: center;
                }

                .step-indicator.active .step-label {
                    color: #2c5f8d;
                    font-weight: 600;
                }

                /* Form Steps */
                .form-step {
                    display: none;
                }

                .form-step.active {
                    display: block;
                    animation: fadeIn 0.5s;
                }

                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: translateY(20px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .form-group {
                    margin-bottom: 20px;
                }

                label {
                    display: block;
                    margin-bottom: 8px;
                    color: #333;
                    font-weight: 500;
                    font-size: 14px;
                }

                .required {
                    color: #e74c3c;
                }

                input[type="text"],
                input[type="email"],
                input[type="password"],
                input[type="tel"],
                input[type="number"],
                select,
                textarea {
                    width: 100%;
                    padding: 12px 15px;
                    border: 2px solid #e0e0e0;
                    border-radius: 8px;
                    font-size: 14px;
                    transition: all 0.3s;
                }

                input:focus,
                select:focus,
                textarea:focus {
                    outline: none;
                    border-color: #2c5f8d;
                    box-shadow: 0 0 0 3px rgba(44, 95, 141, 0.1);
                }

                textarea {
                    resize: vertical;
                    min-height: 100px;
                }

                .file-upload {
                    border: 2px dashed #e0e0e0;
                    border-radius: 8px;
                    padding: 30px;
                    text-align: center;
                    transition: all 0.3s;
                    cursor: pointer;
                }

                .file-upload:hover {
                    border-color: #2c5f8d;
                    background: #f8f9fa;
                }

                .file-upload input[type="file"] {
                    display: none;
                }

                .file-upload-label {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    gap: 10px;
                    cursor: pointer;
                }

                .upload-icon {
                    font-size: 40px;
                    color: #2c5f8d;
                }

                .file-name {
                    margin-top: 10px;
                    font-size: 13px;
                    color: #666;
                }

                /* Radio Buttons */
                .radio-group {
                    display: flex;
                    gap: 20px;
                }

                .radio-option {
                    flex: 1;
                }

                .radio-option input[type="radio"] {
                    display: none;
                }

                .radio-label {
                    display: block;
                    padding: 15px;
                    border: 2px solid #e0e0e0;
                    border-radius: 8px;
                    text-align: center;
                    cursor: pointer;
                    transition: all 0.3s;
                }

                .radio-option input[type="radio"]:checked + .radio-label {
                    border-color: #2c5f8d;
                    background: #f0f4f8;
                    font-weight: 600;
                }

                /* Buttons */
                .button-group {
                    display: flex;
                    gap: 15px;
                    margin-top: 30px;
                }

                .btn {
                    flex: 1;
                    padding: 14px 30px;
                    border: none;
                    border-radius: 8px;
                    font-size: 16px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.3s;
                }

                .btn-prev {
                    background: #e0e0e0;
                    color: #666;
                }

                .btn-prev:hover {
                    background: #d0d0d0;
                }

                .btn-next {
                    background: #2c5f8d;
                    color: white;
                }

                .btn-next:hover {
                    background: #1e4a6d;
                    transform: translateY(-2px);
                    box-shadow: 0 5px 15px rgba(44, 95, 141, 0.3);
                }

                .btn-submit {
                    background: #4CAF50;
                    color: white;
                }

                .btn-submit:hover {
                    background: #45a049;
                    transform: translateY(-2px);
                    box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
                }

                .btn:disabled {
                    opacity: 0.5;
                    cursor: not-allowed;
                }

                /* Review Section */
                .review-section {
                    background: #f8f9fa;
                    border-radius: 8px;
                    padding: 20px;
                    margin-bottom: 20px;
                }

                .review-section h3 {
                    color: #2c5f8d;
                    margin-bottom: 15px;
                    font-size: 18px;
                }

                .review-item {
                    display: flex;
                    justify-content: space-between;
                    padding: 10px 0;
                    border-bottom: 1px solid #e0e0e0;
                }

                .review-item:last-child {
                    border-bottom: none;
                }

                .review-label {
                    font-weight: 500;
                    color: #666;
                }

                .review-value {
                    color: #333;
                }

                /* Alert */
                .alert {
                    padding: 15px;
                    border-radius: 8px;
                    margin-bottom: 20px;
                }

                .alert-error {
                    background: #fee;
                    color: #c33;
                    border: 1px solid #fcc;
                }

                .alert-success {
                    background: #efe;
                    color: #3c3;
                    border: 1px solid #cfc;
                }

                /* Link */
                .login-link {
                    text-align: center;
                    margin-top: 20px;
                    color: #666;
                    font-size: 14px;
                }

                .login-link a {
                    color: #2c5f8d;
                    text-decoration: none;
                    font-weight: 600;
                }

                .login-link a:hover {
                    text-decoration: underline;
                }
    </style>
<?php

use repositories\VilleRepo;

$villeRepo = new VilleRepo();
$villes = $villeRepo->getVilleNames();
?>
<body>
    <div class="container">
        <h1>🏛️ Inscription Professionnel</h1>
        <p class="subtitle">Rejoignez notre plateforme en 3 étapes simples</p>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Progress Bar -->
        <div class="progress-container">
            <div class="progress-bar">
                <div class="progress-bar-fill" id="progressFill" style="width: 33.33%;"></div>
                
                <div class="step-indicator active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-label">Informations</div>
                </div>
                
                <div class="step-indicator" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-label">Documents</div>
                </div>
                
                <div class="step-indicator" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-label">Révision</div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="index.php?controller=demande&action=Registerpro" method="POST" enctype="multipart/form-data" id="multiStepForm">
            
            <!-- STEP 1: Informations Personnelles -->
            <div class="form-step active" data-step="1">
                <h2 style="color: #2c5f8d; margin-bottom: 20px;">📋 Informations Personnelles</h2>
                
                <div class="form-group">
                    <label>Type de professionnel <span class="required">*</span></label>
                    <input type="hidden" name="role" id="professionalType" value="avocat">
                    <div class="radio-group">
                        <button type="button" class="type-btn" data-value="avocat" id="avocatBtn">
                            ⚖️ Avocat
                        </button>
                        <button type="button" class="type-btn" data-value="huissier" id="huissierBtn">
                            📋 Huissier
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name">Nom complet <span class="required">*</span></label>
                    <input type="text" id="name" name="name" >
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" >
                </div>

                <div class="form-group">
                    <label for="phone">Téléphone <span class="required">*</span></label>
                    <input type="tel" id="phone" name="phone" >
                </div>

                <div class="form-group">
                    <label for="city">Ville <span class="required">*</span></label>
                    <select id="city" name="ville" >
                        <option value="">Sélectionnez une ville</option>
                        <?php foreach($villes as $id => $name): ?>
                            <option value="<?= $id ?>"><?= htmlspecialchars($name) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="experience">Années d'expérience <span class="required">*</span></label>
                    <input type="number" id="experience" name="experience" min="0" >
                </div>

                <div class="form-group">
                    <label for="tarif">Tarif horaire (MAD) <span class="required">*</span></label>
                    <input type="number" id="tarif" name="tarif" min="0" step="50" >
                </div>

                <div id="avocatFields" style="display: none;">
                    <div class="form-group">
                        <label for="specialization">Spécialité <span class="required">*</span></label>
                        <select id="specialization" name="specialization">
                            <option value="">Sélectionnez une spécialité</option>
                            <option value="Droit pénal">Droit pénal</option>
                            <option value="Civil">Civil</option>
                            <option value="Famille">Famille</option>
                            <option value="Affaires">Affaires</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Consultation en ligne <span class="required">*</span></label>
                        <div class="radio-group">
                            <div class="radio-option">
                                <input type="radio" name="consultation_online" id="online_yes" value="1">
                                <label for="online_yes" class="radio-label">Oui</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" name="consultation_online" id="online_no" value="0">
                                <label for="online_no" class="radio-label">Non</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="huissierFields" style="display: none;">
                    <div class="form-group">
                        <label for="type_actes">Types d'actes <span class="required">*</span></label>
                        <select id="type_actes" name="type_actes">
                            <option value="">Sélectionnez un type</option>
                            <option value="Signification">Signification</option>
                            <option value="Exécution">Exécution</option>
                            <option value="Constats">Constats</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe <span class="required">*</span></label>
                    <input type="password" id="password" name="password" minlength="6">
                </div>

                <!-- <div class="form-group">
                    <label for="password_confirm">Confirmer le mot de passe <span class="required">*</span></label>
                    <input type="password" id="password_confirm" name="password_confirm" required>
                </div> -->

                <div class="button-group">
                    <button type="button" class="btn btn-next" onclick="nextStep()">Suivant →</button>
                </div>
            </div>

            <!-- STEP 2: Documents -->
            <div class="form-step" data-step="2">
                <h2 style="color: #2c5f8d; margin-bottom: 20px;">📄 Documents Justificatifs</h2>

                <div class="form-group">
                    <div class="file-upload" onclick="document.getElementById('diplomes').click()">
                        <div class="file-upload-label">
                            <div class="upload-icon">📚</div>
                            <div>Cliquez pour uploader vos documents</div>
                            <small style="color: #999;">PDF, JPG, PNG (Max 5MB chacun)</small>
                        </div>
                        <input type="file" id="diplomes" name="diplomes[]" accept=".pdf,.jpg,.jpeg,.png" multiple>
                        <div class="file-name" id="diplomes_name"></div>
                    </div>
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-prev" onclick="prevStep()">← Précédent</button>
                    <button type="button" class="btn btn-next" onclick="nextStep()">Suivant →</button>
                </div>
            </div>

            <!-- STEP 3: Révision -->
            <div class="form-step" data-step="3">
                <h2 style="color: #2c5f8d; margin-bottom: 20px;">✅ Révision</h2>
                
                <div class="review-section">
                    <h3>Informations Personnelles</h3>
                    <div class="review-item">
                        <span class="review-label">Type:</span>
                        <span class="review-value" id="review_type"></span>
                    </div>
                    <div class="review-item">
                        <span class="review-label">Nom:</span>
                        <span class="review-value" id="review_name"></span>
                    </div>
                    <div class="review-item">
                        <span class="review-label">Email:</span>
                        <span class="review-value" id="review_email"></span>
                    </div>
                    <div class="review-item">
                        <span class="review-label">Téléphone:</span>
                        <span class="review-value" id="review_phone"></span>
                    </div>
                    <div class="review-item">
                        <span class="review-label">Ville:</span>
                        <span class="review-value" id="review_city"></span>
                    </div>
                    <div class="review-item">
                        <span class="review-label">Expérience:</span>
                        <span class="review-value" id="review_experience"></span>
                    </div>
                    <div class="review-item">
                        <span class="review-label">Tarif horaire:</span>
                        <span class="review-value" id="review_tarif"></span>
                    </div>
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-prev" onclick="prevStep()">← Précédent</button>
                    <button type="submit" name="submit" class="btn btn-submit">Envoyer ma demande ✓</button>
                </div>
            </div>

        </form>

        <div class="login-link">
            Déjà inscrit ? <a href="/istishara/login">Se connecter</a>
        </div>
    </div>

    <script>
        let avcbtn = document.getElementById("avocatBtn")
        let hsbtn = document.getElementById("huissierBtn")
        let hsfield = document.getElementById("huissierFields")
        let avcfield = document.getElementById("avocatFields")
        let selected = document.getElementById("professionalType")

        avcbtn.addEventListener("click", (e) => {
            selected.value = "Avocat"
            avcbtn.classList.add("active");
            hsbtn.classList.remove("active");
            avcfield.style.display = "block";
            hsfield.style.display = "none";
        })

        hsbtn.addEventListener("click", (e) => {
            selected.value = "Huissier"
            avcbtn.classList.remove("active");
            hsbtn.classList.add("active");
            hsfield.style.display = "block";
            avcfield.style.display = "none";
        })

        let currentstep = 1;
        const totalsteps = 3;

        function populateReview(){
            let reviewtype = document.getElementById("review_type");
            reviewtype.textContent = selected.value
            //name
            let reviewname = document.getElementById("review_name")
            let name = document.getElementById("name")
            reviewname.textContent = name.value
            //email
            let reviewemail = document.getElementById("review_email")
            let email = document.getElementById("email")
            reviewemail.textContent = email.value
            //phone
            let reviewphone = document.getElementById("review_phone")
            let phone = document.getElementById("phone")
            reviewphone.textContent = phone.value
            //city
            let reviewcity = document.getElementById("review_city")
            let ville = document.getElementById("city")
            reviewcity.textContent = ville.options[ville.selectedIndex].text
            //experience
            let reviewexperience = document.getElementById("review_experience")
            let experience = document.getElementById("experience")
            reviewexperience.textContent = experience.value + " ans"
            //tarif
            let reviewtarif = document.getElementById("review_tarif")
            let tarif = document.getElementById("tarif")
            reviewtarif.textContent = tarif.value + " MAD";
        }

        function nextStep(){
            if(currentstep>=totalsteps){
                return;
            }
            let stepactuelle = document.querySelector(`.form-step[data-step="${currentstep}"]`)
            let currentindicator = document.querySelector(`.step-indicator[data-step="${currentstep}"]`)
            currentindicator.classList.remove("active")
            stepactuelle.classList.remove("active")

            currentstep ++;

            let newstep = document.querySelector(`.form-step[data-step="${currentstep}"]`)
            let newindicator = document.querySelector(`.step-indicator[data-step="${currentstep}"]`)

            newstep.classList.add("active")
            newindicator.classList.add("active")
            
            if(currentstep === 3){
                populateReview();
            }
        }

        function prevStep(){
            if(currentstep <= 1){
                return;
            }
            let stepactuelle = document.querySelector(`.form-step[data-step="${currentstep}"]`)
            let currentindicator = document.querySelector(`.step-indicator[data-step="${currentstep}"]`)

            stepactuelle.classList.remove("active")
            currentindicator.classList.remove("active")

            currentstep --;

            let newprevstep = document.querySelector(`.form-step[data-step="${currentstep}"]`)
            let newprevindicator = document.querySelector(`.step-indicator[data-step="${currentstep}"]`)

            newprevindicator.classList.add("active")
            newprevstep.classList.add("active")
        }

        
    </script>

    