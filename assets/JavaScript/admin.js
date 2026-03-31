document.addEventListener("DOMContentLoaded", () => {

    // MAJUSCULES
    document.getElementById('nom').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });

    // Sélection des rôles et affichage des champs supplémentaires
    const cards = document.querySelectorAll(".card");
    const roleInput = document.getElementById("roleInput");
    const fields = document.querySelectorAll(".role-fields");

    fields.forEach(f => f.style.display = "none");

    cards.forEach(card => {
        card.addEventListener("click", () => {
            const role = card.dataset.role;
            roleInput.value = role;

            fields.forEach(f => {
                f.style.display = (f.dataset.role === role) ? "block" : "none";
            });

            cards.forEach(c => c.classList.remove("active"));
            card.classList.add("active");
        });
    });

    // Validation du formulaire
    document.getElementById('User').addEventListener('submit', function(e){
        e.preventDefault();
        const errors = [];
        const nom = document.getElementById('nom').value.trim();
        const prenom = document.getElementById('prenom').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const role = roleInput.value;

        // Champs supplémentaires
        const promotion = document.getElementById('promotion').value.trim();
        const company_name = document.getElementById('company_name').value.trim();
        const department = document.getElementById('department').value.trim();

        // Validation générale
        if(!nom) errors.push("Le champ Nom * est obligatoire.");
        if(!prenom) errors.push("Le champ Prénom * est obligatoire.");
        if(!email) errors.push("Le champ Courriel * est obligatoire.");
        if(email && !email.includes('@')) errors.push("Le Courriel * doit être valide.");
        if (!password) errors.push("Le champ Mot de passe * est obligatoire");

        // Validation selon rôle
        if(role === "student" && !promotion) errors.push("Le champ Promotion * est obligatoire.");
        if(role === "company" && !company_name) errors.push("Le champ Nom * de l'entreprise est obligatoire.");
        if(role === "pilote" && !department) errors.push("Le champ Département * est obligatoire.");

        const errorDiv = document.getElementById('errors');
        if(errors.length > 0){
            errorDiv.innerHTML = errors.join('<br>');
        } else {
            errorDiv.innerHTML = "";
            alert("Le compte a été créé avec succès !");
            this.submit();
        }
    });

});
