const userCheckbox = document.querySelector('#user');
    const passeggeroDiv = document.getElementById('passeggero');
    const autistaDiv = document.getElementById('autista');

    userCheckbox.addEventListener('click', function() {
        if (this.checked) {
            passeggeroDiv.style.display = 'none';
            autistaDiv.style.display = 'block';
        } else {
            passeggeroDiv.style.display = 'block';
            autistaDiv.style.display = 'none';
        }
    });