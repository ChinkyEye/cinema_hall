<?php

namespace Tests\Unit;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;


class TaskStatusTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_returns_true_if_task_is_completed()
    {
        $task = Task::factory()->create([
            'status' => 'Completed',
        ]);
        $this->assertTrue($task->isCompleted());
    }

    public function test_it_returns_false_if_task_is_pending()
    {
        $task = Task::factory()->create([
            'status' => 'Pending',
        ]);
        $this->assertFalse($task->isCompleted());
    }

    // public function testBasicTest()
    // {

    //     $this->assertDatabaseHas('tasks',[
    //         'status'=>'Completed'
    //     ]);
    //     $this->assertTrue(true);
    // }
   

}
