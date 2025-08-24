<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\TaskModel;

class TaskModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $migrate = true;
    protected $refresh = true; 

    protected $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new TaskModel();
    }

    public function test_insert_task()
    {
        $data = [
            'title' => 'Tarea 1',
            'completed' => 0
        ];
        $id = $this->model->insert($data);
        $this->assertIsInt($id);
    }

    public function test_find_task()
    {
        $data = [
            'title' => 'Tarea 2',
            'completed' => 1
        ];
        $id = $this->model->insert($data);
        $task = $this->model->find($id);
        $this->assertEquals('Tarea 2', $task['title']);
        $this->assertEquals(1, $task['completed']);
    }

    public function test_update_task()
    {
        $data = [
            'title' => 'Tarea 3',
            'completed' => 0
        ];
        $id = $this->model->insert($data);
        $this->model->update($id, ['completed' => 1]);
        $task = $this->model->find($id);
        $this->assertEquals(1, $task['completed']);
    }
}