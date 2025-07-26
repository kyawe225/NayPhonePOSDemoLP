<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Phone\RepairAllFilterRequest;
use App\Http\Requests\Repair\RepairCreateRequest;
use App\Http\Requests\Repair\RepairUpdateRequest;
use App\Repository\Interface\IRepairRepository;

class RepairController extends Controller
{
    public function __construct(private readonly IRepairRepository $repository){

    }
    public function getDetail(string $id){
        return response()->json($this->repository->get($id));
    }
    public function getAll(){
        return response()->json($this->repository->all([]));
    }
    public function getAllFilter(RepairAllFilterRequest $request){
        $validated = $request->validated();
        return response()->json($this->repository->all($validated));
    }
    public function insert(RepairCreateRequest $request){
        $validated = $request->validated();
        return response()->json($this->repository->create($validated));
    }
    public function edit(string $id, RepairUpdateRequest $request){
        $validated = $request->validated();
        return response()->json($this->repository->update($id,$validated));
    }
    public function delete(string $id){
        return response()->json($this->repository->delete($id));
    }
}
