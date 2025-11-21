<?php

namespace App\Repository\Implementation;

use App\ViewModels\ResponseModel;
use Carbon\Carbon;
use Exception;
use Hash;
use Str;
use App\Repository\Interface\IAuthRepository;
use \App\Models\User;

class AuthRepository implements IAuthRepository
{
    public function register(array $register)
    {
        try {
            if (User::where("email", $register["email"])->exists()) {
                return ResponseModel::BadRequest(
                    "This email is already registered. Please use different email.",
                    "",
                );
            }
            $register['id'] = "usr_".Str::uuid7();
            $register["password"] = Hash::make($register["password"]);
            $user = User::create($register);
            $success = $user->save();
            if ($success) {
                return ResponseModel::Ok(
                    "User Registered Successfully",
                    null,
                );
            }
            return ResponseModel::InternalServerError(
                "Invalid Request",
                "",
            );
        } catch (Exception $e) {
            Log::error("UserRepository->register => " . $e->getMessage());
            return ResponseModel::InternalServerError(
                "Invalid Request. Please contact developer.",
                "",
            );
        }
    }

    public function login(array $register)
    {
        try {
            $user = User::where("email", $register["email"])->first();
            if($user == null){
                return ResponseModel::BadRequest(
                    "Double check your email or password!",
                    null,
                );
            }
            
            if (Hash::check($register['password'],$user->password)) {
                $token = $user->createToken(Str::uuid7().$user->name, expiresAt: Carbon::now("utc")->addDays((int) env("TokenExpiry",1)));
                return ResponseModel::Ok(
                        "Welcome $user->name!",
                    $token->plainTextToken,
                );
            }
            return ResponseModel::BadRequest(
                "Double check your email or password!",
                null,
            );
        } catch (Exception $e) {
            Log::error("UserRepository->register => " . $e->getMessage());
            return ResponseModel::Ok(
                "Invalid Request. Please contact developer.",
                "",
            );
        }
    }
}


?>