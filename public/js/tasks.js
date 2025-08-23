const API_URL = '/tasks'; // endpoint de tu backend

function fetchTasks() {
  const xhr = new XMLHttpRequest();
  xhr.open('GET', '/tasks', true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      const tasks = JSON.parse(xhr.responseText);
      const taskList = document.getElementById('taskList');
      taskList.innerHTML = '';
      tasks.forEach(task => {
        const div = document.createElement('div');
        div.innerHTML = `
          <div class="task">
            <div class="task-title">
              <textarea class="task-input">${task.title}</textarea>
            </div>
            <div class="task-actions">
              <button type="button" class="delete-button" onclick="deleteTask(${task.id}, this)">Eliminar</button>
              <button type="button" class="update-button" onclick="updateTask(${task.id}, this)">Actualizar</button>
            </div>
          </div>
        `;
        taskList.appendChild(div);
      });
    }
  };
  xhr.send();
}

// Crear tarea
function createTask() {
  let title = document.getElementById('newTask').value;
  if (!title) return;

  const xhr = new XMLHttpRequest();
  xhr.open('POST', '/tasks', true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onload = function () {
    if (xhr.status === 201) {
      fetchTasks();
      document.getElementById('newTask').value = '';
    }
  };
  xhr.send(JSON.stringify({ title }));

}

function deleteTask(id, button) {
  button.disabled = true;
  button.textContent = "Eliminando...";
  const xhr = new XMLHttpRequest();
  xhr.open('DELETE', `/tasks/${id}`, true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      fetchTasks();
    }
  };
  xhr.send();
}

function updateTask(id, button) {
  button.disabled = true;
  button.textContent = "Actualizando...";
  const textarea = button.parentElement.parentElement.querySelector('.task-input');
  const title = textarea.value;
  if (!title) return;
  const xhr = new XMLHttpRequest();
  xhr.open('PUT', `/tasks/${id}`, true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onload = function () {
    if (xhr.status === 200) {
      fetchTasks();
    }
  };
  xhr.send(JSON.stringify({ title }));
}

fetchTasks()
