<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\TaskModel;

class TaskController extends ResourceController
{
  protected $modelName = TaskModel::class;
  protected $format    = 'json';

  public function index()
  {
    $tasks = $this->model->findAll();
    return $this->respond($tasks);
  }

  public function show($id = null)
  {
    $taskModel = new TaskModel();
    $task = $taskModel->find($id);

    if (!$task) {
      return $this->failNotFound("Task with ID $id not found.");
    }

    return $this->respond($task);
  }

  public function create()
  {
    $taskModel = new TaskModel();
    $data = $this->request->getJSON(true);

    if (!$data || !isset($data['title']) || empty(trim($data['title']))) {
      return $this->response->setJSON([
        'status' => 'error',
        'message' => 'El título es requerido'
      ])->setStatusCode(400);
    }

    $taskModel->insert([
      'title'     => $data['title'],
      'completed' => $data['completed'] ?? false
    ]);

    return $this->response->setJSON([
      'status' => 'success',
      'message' => 'Tarea creada correctamente',
      'task_id' => $taskModel->getInsertID()
    ])->setStatusCode(201);
  }


  public function update($id = null)
  {
    $data = $this->request->getJSON(true);

    if (!$this->model->find($id)) {
      return $this->failNotFound('Tarea no encontrada');
    }

    $this->model->update($id, $data);

    return $this->respond([
      'status' => 200,
      'message' => 'Tarea actualizada correctamente',
      'data' => $data
    ]);
  }

  public function delete($id = null)
  {
    $task = $this->model->find($id);

    if (!$task) {
        return $this->failNotFound("Task with ID $id not found");
    }

    $this->model->delete($id);
    
    return $this->respondDeleted([
        'message' => "Task with ID $id deleted successfully"
    ]);
  }
}
