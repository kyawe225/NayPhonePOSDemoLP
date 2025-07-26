<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\SaleCreateRequest;
use App\Http\Requests\Sale\SaleUpdateRequest;
use App\Repository\Interface\ISaleRepository;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct(private readonly ISaleRepository $repository){

    }
    public function getDetail(string $id){
        return response()->json($this->repository->get($id));
    }
    public function getAll($request){
        $validated = $request->validated();
        return response()->json($this->repository->all($validated));
    }
    public function insert(SaleCreateRequest $request){
        $validated = $request->validated();
        return response()->json($this->repository->create($validated));
    }
    public function edit(string $id, SaleUpdateRequest $request){
        $validated = $request->validated();
        return response()->json($this->repository->create($validated));
    }
    public function delete(string $id){
        return response()->json($this->repository->delete($id));
    }
}
