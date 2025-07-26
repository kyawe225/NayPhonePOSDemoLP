<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceHistory\ServiceHistoryCreateRequest;
use App\Http\Requests\ServiceHistory\ServiceHistoryUpdateRequest;
use App\Repository\Interface\IServiceHistoryRepository;
use Illuminate\Http\Request;

class ServiceHisotryController extends Controller
{
    public function __construct(private readonly IServiceHistoryRepository $repository){

    }
    public function getDetail(string $id){
        return response()->json($this->repository->get($id));
    }
    public function getAllFilter($request){
        $validated = $request->validated();
        return response()->json($this->repository->all($validated));
    }
    public function getAll(){
        return response()->json($this->repository->all([]));
    }
    public function insert(ServiceHistoryCreateRequest $request){
        $validated = $request->validated();
        return response()->json($this->repository->create($validated));
    }
    public function edit(string $id, ServiceHistoryUpdateRequest $request){
        $validated = $request->validated();
        return response()->json($this->repository->update($id,$validated));
    }
    public function delete(string $id){
        return response()->json($this->repository->delete($id));
    }
}
