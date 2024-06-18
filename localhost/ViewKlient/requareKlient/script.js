document.addEventListener('DOMContentLoaded', function() {

    fetch('get_masters.php')
        .then(response => response.json())
        .then(masters => {
            const masterSelect = document.getElementById('master');
            masters.forEach(master => {
                const option = document.createElement('option');
                option.value = master.id;
                option.text = master.name;
                masterSelect.appendChild(option);
            });
        });

    const dateInput = document.getElementById('date');
    const masterSelect = document.getElementById('master');
    dateInput.addEventListener('change', function() {
        fetch('get_times.php?date=' + dateInput.value + '&masterId=' + masterSelect.value)
            .then(response => response.json())
            .then(times => {
                const timeSelect = document.getElementById('time');
                timeSelect.innerHTML = '';

                times.forEach(time => {
                    const option = document.createElement('option');
                    option.value = time;
                    option.text = time;
                    timeSelect.appendChild(option);
                });
            });
    });

    masterSelect.addEventListener('change', function() {
        fetch('get_workdays.php?masterId=' + masterSelect.value)
            .then(response => response.json())
            .then(workdays => {
                const dateInput = document.getElementById('date');
                const currentDate = new Date();

                dateInput.innerHTML = '';

                workdays.forEach(day => {
                    const date = new Date(day.year, day.month - 1, day.day);

                    if (date >= currentDate && date <= new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate())) {
                        const option = document.createElement('option');
                        option.value = date.toISOString().slice(0, 10);
                        option.text = date.toLocaleDateString();
                        dateInput.appendChild(option);
                    }
                });
            });
    });

    const recordButton = document.getElementById('record-button');
    recordButton.addEventListener('click', function() {
        const masterId = document.getElementById('master').value;
        const date = document.getElementById('date').value;
        const time = document.getElementById('time').value;

        console.log('Отправка запроса на: ', 'record_client.php?masterId=' + masterId + '&date=' + date + '&time=' + time);

       fetch('record_client.php?masterId=' + masterId + '&date=' + date + '&time=' + time)
           .then(response => {
               console.log('Ответ от сервера:', response);
               return response.json();
           })
            .then(data => {
                console.log(data);
                if (data.success) {
                    alert('Вы успешно записались!');
                    window.location.href = '../main_page.php';
                } else {
                    alert(data.error);
                }
            });
        });
    });
