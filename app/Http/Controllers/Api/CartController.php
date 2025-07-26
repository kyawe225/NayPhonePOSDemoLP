<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Interface\ICartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private readonly ICartRepository $repository){

    }
    public function getDetail(string $id){
        return response()->json($this->repository->get($id));
    }
    public function getAll($request){
        $validated = $request->validated();
        return response()->json($this->repository->all($validated));
    }
    public function insert(CustomerCreateRequest $request){
        $validated = $request->validated();
        return response()->json($this->repository->create($validated));
    }
    public function edit(string $id, CustomerUpdateRequest $request){
        $validated = $request->validated();
        return response()->json($this->repository->create($validated));
    }
    public function delete(string $id){
        return response()->json($this->repository->delete($id));
    }
}
