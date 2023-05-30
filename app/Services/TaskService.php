<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    public function saveTaskData($data)
    {
        $validatior = Validator($data, [
            'title' => 'required',
            'description' => 'required',
        ]);
        if ($validatior->fails()) {
            throw new InvalidArgumentException($validatior->error()->first());
        }

        $result = $this->taskRepository->save($data);
        return $result;
    }
    public function getAll()
    {
        return $this->taskRepository->getAllTask();
    }
    public function getById($id)
    {
        return $this->taskRepository->getById($id);
    }
    public function updateTask($data, $id)
    {
        $validatior = Validator::make($data, [
            'title' => 'bail|min:2',
            'description' => 'bail|max:255'
        ]);
        if ($validatior->fails()) {
            throw new InvalidArgumentException($validatior->errors()->first());
        }
        DB::beginTransaction();
        try {
            $task = $this->taskRepository->update($data, $id);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::info($ex->getMessage());
            throw new InvalidArgumentException('Unable to update task data');
        }
        DB::commit();
        return $task;
    }
    public function deleteById($id){
        DB::beginTransaction();
        try{
            $task=$this->taskRepository->delete($id);

        }catch(Exception $ex){
            DB::rollBack();
            Log::info($ex->getMessage());

            throw new InvalidArgumentException('Unable to delete task data');
        }
        DB::commit();
        return $task;
    }
}
