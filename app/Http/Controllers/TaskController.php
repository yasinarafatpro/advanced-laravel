<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $taskService;
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function store(Request $request){
        $data = $request->only([
            'title',
            'description',
        ]);
        $result=['status'=>200];

        try{
            $result['data']= $this->taskService->saveTaskData($data);
        }catch(Exception $e){
            $result=[
                'status'=>500,
                'error' => $e ->getMessage()
            ];
        }
        return response()->json($result,$result['status']);
    }
    public function index(){
        $result=['status'=>200];
        try{
            $result['data']=$this->taskService->getAll();
        }catch(Exception $e){
            $result=[
                'status'=>500,
                'error'=>$e->getMessage()
            ];
        }
        return response()->json($result,$result['status']);
    }
    /**
     * @param $id
     */
    public function show($id){
        $result=['status'=>200];
        try{
            $result['data']= $this->taskService->getbyId($id);
        }catch(Exception $ex){
            $result=[
                'status'=>500,
                'error' =>$ex->getMessage()
            ];
        }
        return response()->json($result,$result['status']);
    }
    public function update(Request $request ,$id){
        $data = $request->only([
            'title',
            'description'
        ]);
        $result =['status'=>200];
        try{
            $result['data']=$this->taskService->updateTask($data,$id);
        }catch(Exception $ex){
            $result=[
                'status'=>500,
                'error'=>$ex->getMessage()
            ];
        };
        return response()->json($result,$result['status']);
    }
    public function destroy($id){
        $result =['status'=>200];
        try{
            $result['data']=$this->taskService->deleteById($id);
        }catch(Exception $ex){
            $result=[
                'status'=>500,
                'error' =>$ex->getMessage()
            ];
        }
        return response()->json($result,$result['status']);
    }
}
