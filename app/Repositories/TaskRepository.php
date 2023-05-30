<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function save($data)
    {

        $task = new $this->task;

        $task->title = $data['title'];
        $task->description = $data['description'];

        $task->save();

        return $task->fresh();
    }
    public function getAllTask()
    {
        return $this->task->get();
    }
    public function getById($id)
    {
        return $this->task
            ->where('id', $id)
            ->get();
    }
    public function update($data, $id)
    {
        $task = $this->task->find($id);

        $task->title = $data['title'];
        $task->description = $data['description'];

        $task->update();

        return $task;
    }
    public function delete($id){
        $task=$this->task->find($id);
        $task->delete();
        return $task;
    }
}
