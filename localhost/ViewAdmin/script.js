function showNotification(message) {
    alert(message);
}

function checkBirthdays() {
    fetch('kupon/addKupon.php')
        .then(response => response.text())
        .then(data => showNotification(data))
        .catch(error => console.error('Ошибка:', error));
}

const button = document.getElementById('check-birthday');
button.addEventListener('click', checkBirthdays);