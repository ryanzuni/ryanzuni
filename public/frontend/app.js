function login() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    fetch('/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email, password }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.token) {
            localStorage.setItem('token', data.token);
            loadTasks();
        } else {
            alert('Login failed');
        }
    });
}

function loadTasks() {
    fetch('/api/tasks', {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })
    .then(response => response.json())
    .then(data => {
        const taskList = document.getElementById('task-list');
        taskList.innerHTML = '';
        data.forEach(task => {
            const taskItem = document.createElement('div');
            taskItem.innerHTML = `<h3>${task.title}</h3><p>${task.description}</p>`;
            taskList.appendChild(taskItem);
        });
    });
}
