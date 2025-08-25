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

    return $this->response->setJSON([
      'status' => 'success',
      'message' => 'datos encontrados',
      'data' => $tasks
    ])->setStatusCode(200);
  }

  public function show($id = null)
  {
    $taskModel = new TaskModel();
    $task = $taskModel->find($id);

    if (!$task) {
      return $this->response->setJSON([
        'status' => 'Not Found',
        'message' => 'recurso no existe'
      ])->setStatusCode(400);
    }

    return $this->response->setJSON([
      'status' => 'success',
      'message' => 'datos encontrados',
      'data' => $task
    ])->setStatusCode(200);
  }

  public function create()
  {
    $taskModel = new TaskModel();
    $data = $this->request->getJSON(true);

    $data['title'] = isset($data['title']) ? strip_tags(trim($data['title'])) : null;

    $validation =  \Config\Services::validation();
    $rules = [
      'title' => 'required|max_length[255]'
    ];


    if (!$data || !isset($data['title']) || empty(trim($data['title'])) || !$this->validate($rules)) {
      return $this->response->setJSON([
        'status' => 'Unprocessable Entity',
        'message' => 'Errores de validación'
      ])->setStatusCode(422);
    }

    $taskModel->insert([
      'title'     => $data['title'],
      'completed' => false
    ]);

    return $this->response->setJSON([
      'status' => 'Created',
      'message' => 'Tarea creada correctamente',
      'task_id' => $taskModel->getInsertID()
    ])->setStatusCode(201);
  }


  public function update($id = null)
  {
    $data = $this->request->getJSON(true);

    if (!$this->model->find($id)) {
      return $this->respond([
        'status' => 'Not Found',
        'message' => 'Recurso no existe',
        'data' => $data
      ])->setStatusCode(code: 404);
    }


    $data['title'] = isset($data['title']) ? strip_tags(trim($data['title'])) : null;

    $validation =  \Config\Services::validation();
    $rules = [
      'title' => 'required|max_length[255]'
    ];


    if (!$data || !isset($data['title']) || empty(trim($data['title'])) || !$this->validate($rules)) {
      return $this->response->setJSON([
        'status' => 'Unprocessable Entity',
        'message' => 'Errores de validación'
      ])->setStatusCode(422);
    }

    $this->model->update($id, $data);

    return $this->respond([
      'status' => 'OK',
      'message' => 'Tarea actualizada correctamente',
      'data' => $data
    ])->setStatusCode(200);
  }

  public function delete($id = null)
  {
    $task = $this->model->find($id);

    if (!$task) {
      return $this->response->setJSON([
        'status' => 'Not Found',
        'message' => 'Recurso no existe'
      ])->setStatusCode(404);
    }

    $this->model->delete($id);

    return $this->respond([
      'status' => 'No Content',
      'message' => 'Borrado exitoso'
    ])->setStatusCode(204);
  }

  public function view()
  {
    return view('tasks');
  }
}
