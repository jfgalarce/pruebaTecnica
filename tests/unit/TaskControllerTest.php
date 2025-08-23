<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use App\Controllers\TaskController;

class TaskControllerTest extends CIUnitTestCase
{
  use ControllerTestTrait;
  /** @test */
  public function it_returns_list_of_tasks()
  {
    $result = $this->withURI('http://localhost/tasks')
      ->controller(TaskController::class)
      ->execute('index');

    $this->assertTrue($result->isOK());
    $this->assertStringContainsString('application/json', $result->getHeaderLine('Content-Type'));
  }


}
