const div=document.getElementById("extraFields");
const avocat=document.getElementById("avocat");
const hussier=document.getElementById("hussier");

avocat.addEventListener("click",()=>{

    const avocatDiv=document.createElement('div');
    div.innerHTML = "";
    avocatDiv.innerHTML=`
    
        <div class="extra-grid">
            <div class="extra-group">
                <label>Années d'expérience</label>
                <input type="number" name="expYears" required>
            </div>

            <div class="extra-group">
                <label>Tarif horaire (MAD)</label>
                <input type="number" name="hourlyRate" required>
            </div>

            <div class="extra-group">
                <label>Spécialisation</label>
                <select name="specialisation" required>
                    <option value="">-- Choisir --</option>
                    <option value="Droit pénal">Droit pénal</option>
                    <option value="Civil">Droit civil</option>
                    <option value="Famille">Droit de la famille</option>
                    <option value="Affaires">Droit des affaires</option>
                </select>
            </div>

            <div class="extra-group">
            <label>Consultation Online </label>
            <input type="radio" name="consultationOnline" value="Oui" required>Oui
            <input type="radio" name="consultationOnline" value="Nom" required>Non
            </div>
        </div>
    `
    div.appendChild(avocatDiv);
});


hussier.addEventListener("click",()=>{

    const hussierDiv=document.createElement('div');
    div.innerHTML = "";
    hussierDiv.innerHTML=`
    
        <div class="extra-grid">
            <div class="extra-group">
                <label>Années d'expérience</label>
                <input type="number" name="expYears" required>
            </div>

            <div class="extra-group">
                <label>Tarif horaire (MAD)</label>
                <input type="number" name="hourlyRate" required>
            </div>

            <div class="extra-group">
                <label>Type</label>
                <select name="type" required>
                    <option value="">-- Choisir --</option>
                    <option value="Signification">Signification</option>
                    <option value="Exécution">Execution</option>
                    <option value="Constats">Constats</option>
                </select>
            </div>
        </div>
    `;

    div.appendChild(hussierDiv);
})