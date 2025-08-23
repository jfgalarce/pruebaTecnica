<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="/css/style.css">

</head>

<body>
  <h1 class="title">Gestor de Tareas</h1>

  <div id="taskForm" class="form-container">
    <div>
      <textarea type="text" id="newTask" placeholder="Nueva tarea..." class="add-task"></textarea>
    </div>
    <div>
      <button type="button" onclick="createTask()" class="add-button">Agregar</button>
    </div>

  </div>

  <h2 class="sub-title">Listado de tareas</h2>

  <div class="list-tasks" id="taskList">
  </div>

</body>
<script src="/js/tasks.js"></script>

</html>