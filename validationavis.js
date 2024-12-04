function validateAvisForm() {
    const texte = document.getElementById('texte').value.trim();
    const auteur = document.getElementById('auteur').value.trim();

    if (texte === '' || auteur === '') {
        alert('Le texte et l’auteur sont obligatoires.');
        return false;
    }

    if (texte.length < 10) {
        alert('Le texte doit contenir au moins 10 caractères.');
        return false;
    }

    return true;
}
