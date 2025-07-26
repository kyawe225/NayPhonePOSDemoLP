<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerCreateRequest;
use App\Http\Requests\Customer\CustomerUpdateRequest;
use App\Repository\Interface\ICustomerRepository;

class CustomerController extends Controller
{
    public function __construct(private readonly ICustomerRepository $repository){

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
