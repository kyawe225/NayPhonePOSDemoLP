<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Phone\PhoneAllFilterRequest;
use App\Http\Requests\Phone\PhoneCreateRequest;
use App\Http\Requests\Phone\PhoneUpdateRequest;
use App\Repository\Interface\IPhoneRepository;

class PhoneController extends Controller
{
    public function __construct(private readonly IPhoneRepository $repository){

    }
    public function getDetail(string $id){
        return response()->json($this->repository->get($id));
    }
    public function getAll(){
        return response()->json($this->repository->all([]));
    }
    /**
     * @OA\Post(
     *     path="/api/phone/filter",
     *     summary="Search with filters",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PhoneAllFilterRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function getAllFilter(PhoneAllFilterRequest $request){
        $validated = $request->validated();
        return response()->json($this->repository->all($validated));
    }
    public function insert(PhoneCreateRequest $request){
        $validated = $request->validated();
        return response()->json($this->repository->create($validated));
    }
    public function edit(string $id, PhoneUpdateRequest $request){
        $validated = $request->validated();
        return response()->json($this->repository->update($id,$validated));
    }
    public function delete(string $id){
        return response()->json($this->repository->delete($id));
    }
}
