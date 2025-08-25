const API_URL = '/tasks'; // endpoint de tu backend

function fetchTasks() {
  const xhr = new XMLHttpRequest();
  xhr.open('GET', '/tasks', true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      const tasks = JSON.parse(xhr.responseText).data;
      const taskList = document.getElementById('taskList');
      taskList.innerHTML = '';
      tasks.forEach(task => {
        const div = document.createElement('div');
        div.innerHTML = `
          <div class="task">
            <div class="task-title">
              <textarea class="task-input" maxlength="255">${task.title}</textarea>
            </div>
            <div class="task-actions">
              <button type="button" class="delete-button" onclick="deleteTask(${task.id}, this)">Eliminar</button>
              <button type="button" class="update-button" onclick="updateTask(${task.id}, this)">Actualizar</button>
            </div>
          </div>
        `;
        taskList.appendChild(div);
      });
    }else{
      alert('Error al cargar las tareas')
    }
  };
  xhr.send();
}

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
    }else {
      alert("Errores de validación")
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
    if (xhr.status === 204) {
      fetchTasks();
    }else{
      alert("Error al eliminar la tarea");
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
    }else if(xhr.status === 404){
      alert("Recurso no existe");
    }else if (xhr.status === 422){
      alert("Validación fallida");
    }
  };
  xhr.send(JSON.stringify({ title }));
}

fetchTasks()
