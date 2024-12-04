function validateDestinationForm() {
    const nom = document.getElementById('nom').value.trim();
    const description = document.getElementById('description').value.trim();
    const image = document.getElementById('image').value.trim();

    if (nom === '' || description === '') {
        alert('Le nom et la description sont obligatoires.');
        return false;
    }

    if (image !== '' && !/^https?:\/\/[^\s]+$/.test(image)) {
        alert('L’URL de l’image est invalide.');
        return false;
    }

    return true;
}
