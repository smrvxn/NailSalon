document.addEventListener('DOMContentLoaded', () => {
  const masterSelect = document.getElementById('master-select');
  const monthSelect = document.getElementById('month-select');
  const nextBtn = document.getElementById('next-btn');
  const calendarContainer = document.getElementById('calendar-container');
  const saveBtn = document.getElementById('save-btn');
  const calendar = document.getElementById('calendar');

  // Fetch masters from the server
  fetchMasters().then(masters => {
    masters.forEach(master => {
      const option = document.createElement('option');
      option.value = master.id;
      option.textContent = master.name;
      masterSelect.appendChild(option);
    });
  });

  nextBtn.addEventListener('click', () => {
    const masterId = masterSelect.value;
    const month = monthSelect.value;
    fetchWorkingDays(masterId, month).then(workingDays => {
      renderCalendar(month, workingDays);
      calendarContainer.classList.remove('hidden');
    });
  });

  saveBtn.addEventListener('click', () => {
    const masterId = masterSelect.value;
    const month = monthSelect.value;
    const selectedDays = Array.from(document.querySelectorAll('.calendar-day.selected'))
      .map(day => day.dataset.day);
    saveWorkingDays(masterId, month, selectedDays);
  });

  function fetchMasters() {
    return fetch('get-masters.php')
      .then(response => response.json())
      .then(data => data);
  }

  function fetchWorkingDays(masterId, month) {
    return fetch(`get-working-days.php?masterId=${masterId}&month=${month}`)
      .then(response => response.json())
      .then(data => data);
  }

  function saveWorkingDays(masterId, month, workingDays) {
    return fetch('save-working-days.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ masterId, month, workingDays })
    })
    .then(response => response.json())
    .then(data => {
      // Handle the response from the server
      console.log(data);
    });
  }

  function renderCalendar(month, workingDays) {
    calendar.innerHTML = '';
    const daysInMonth = new Date(new Date().getFullYear(), month, 0).getDate();
    for (let i= 1; i <= daysInMonth; i++) {
      const dayElement = document.createElement('div');
      dayElement.classList.add('calendar-day');
      dayElement.dataset.day = i;
      dayElement.textContent = i;
      if (workingDays.includes(i)) {
        dayElement.classList.add('selected');
      }
      dayElement.addEventListener('click', () => {
        dayElement.classList.toggle('selected');
      });
      calendar.appendChild(dayElement);
    }
  }
});