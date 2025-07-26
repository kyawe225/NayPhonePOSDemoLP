<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Repository\Interface\IAuthRepository;
use OpenApi\Attributes as OA;
class AuthController extends Controller
{
    public function __construct(private readonly IAuthRepository $repository)
    {

    }
    #[OA\Post(
        path: "auth/login",
        description: "This allow user to login for other operations.",
        requestBody: new OA\RequestBody(
            request:"Sample Request Items",
            description: <<<I
            [
                \"email\" => \"kyaw@gmail.com\",
                \"password\" => \"**************\",
            ]
            I
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: <<<I
                [
                    \"status\" => 200,
                    \"message\" => \"string\",
                    \"data\" => \"Some Token\"
                ]
                I,
            )
        ],
    )]
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $response = $this->repository->login($validated);
        return response()->json($response);
    }

    #[OA\Post(
        path: "auth/register",
        description: "This allow user to register for other operations.",
        requestBody: new OA\RequestBody(
            request: <<<I
            [
                \"email\" => \"kyaw@gmail.com\",
                \"password\" => \"**************\",
                \"name\"=>\"string\"
            ]
            I
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: <<<I
                [
                    \"status\" => 200,
                    \"message\" => \"string\",
                    \"data\" => null
                ]
                I,
            )
        ],
    )]
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $response = $this->repository->register($validated);
        return response()->json($response);
    }
}
