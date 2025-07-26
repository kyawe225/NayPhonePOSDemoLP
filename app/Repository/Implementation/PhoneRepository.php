<?php

namespace App\Repository\Implementation;

use App\Models\Phone;
use App\Repository\Interface\IPhoneRepository;
use App\ViewModels\ResponseModel;
use Exception;
use Log;
use Str;

class PhoneRepository implements IPhoneRepository
{
    public function create(array $request)
    {
        try {
            if (array_key_exists("discount_type", $request) && array_key_exists("discount_amount", $request)) {
                if ($request["discount_type"] == "percentage" && ($request["discount_amount"] < 0 || $request["discount_amount"] > 100)) {
                    return ResponseModel::BadRequest("Please add valid percentage.", null);
                }
            }
            $phone = Phone::where("imei", $request["imei"])->first();
            if ($phone != null) {
                return ResponseModel::BadRequest("Please Choose the new imei code.", null);
            }
            $request["id"] = Str::uuid7();
            $request["status"] = "avaliable";
            $phone = Phone::create($request);
            $inserted = $phone->save();
            if (!$inserted) {
                return ResponseModel::BadRequest("Invalid Request", null);
            }
            return ResponseModel::Ok("Phone Registered Successfully!", null);

        } catch (Exception $e) {
            Log::error("PhoneRepository.Create => {$e->getMessage()}");
            return ResponseModel::InternalServerError("Invalid Request.", null);
        }
    }
    public function update(string $id, array $request)
    {
        try {
            if (array_key_exists("discount_type", $request) && array_key_exists("discount_amount", $request)) {
                if ($request["discount_type"] == "percentage" && ($request["discount_amount"] < 0 || $request["discount_amount"] > 100)) {
                    return ResponseModel::BadRequest("Please add valid percentage.", null);
                }
            }
            $phone = Phone::where("imei", $request["imei"])->where("id", $id)->first();
            if ($phone != null) {
                return ResponseModel::BadRequest("Please Choose the new imei code.", null);
            }
            $phone = Phone::where("id", $id)->first();
            if($phone == null){
                return ResponseModel::NotFound("Phone Not Found!",null);
            }
            $inserted = $phone->update($request);

            if (!$inserted) {
                return ResponseModel::BadRequest("Invalid Request", null);
            }
            return ResponseModel::Ok("Phone Updated Successfully!", null);
        } catch (Exception $e) {
            Log::error("PhoneRepository.Update => {$e->getMessage()}");
            return ResponseModel::InternalServerError("Invalid Request.", null);
        }
    }
    public function delete(string $id)
    {
        try {
            $phone = Phone::where("id", $id)->first();
            if ($phone == null) {
                return ResponseModel::NotFound("Phone Not Found!", null);
            }
            $deleted = $phone->delete();
            if ($deleted == false) {
                return ResponseModel::BadRequest("Phone Cannot Be Deleted!", null);
            }
            return ResponseModel::Ok("Phone Deleted Successfully!", null);
        } catch (Exception $e) {
            Log::error("PhoneRepository.Delete => {$e->getMessage()}");
            return ResponseModel::InternalServerError("Invalid Request.", null);
        }
    }
    public function get(string $id)
    {
        try {
            $phone = Phone::where("id", $id)->first();
            if ($phone == null) {
                return ResponseModel::NotFound("Phone Not Found!", null);
            }
            return ResponseModel::Ok("Fetch Success", $phone);
        } catch (Exception $e) {
            Log::error("PhoneRepository.Get => {$e->getMessage()}");
            return ResponseModel::BadRequest("Invalid Request.", null);
        }
    }
    public function all($request)
    {
        try {
            $phoneQuery = Phone::query();
            #region sorting session and others
            if(array_key_exists("search:value",$request)){
                $request['search:value'] = trim(strtolower($request["search:value"])); 
                $phoneQuery = $phoneQuery->whereRaw("LOWER(`model`) LIKE ?",["%".$request['search:value'].'%'])->orWhereRaw("LOWER(`brand`) LIKE ?",["%".$request["search:value"].'%'])->orWhereRaw("LOWER(`imei`) LIKE ?",["%".$request["search:value"].'%'])->orWhereRaw("LOWER(`category`) LIKE ?",["%".$request["search:value"].'%']);
            }
            if(array_key_exists("sort:Status:A",$request)){
                $phoneQuery = $phoneQuery->where("status","avaliable");
            }
            if(array_key_exists("sort:Status:S",$request)){
                $phoneQuery = $phoneQuery->where("status","sold");
            }
            if(array_key_exists("sort:newest",$request)){
                $phoneQuery = $phoneQuery->orderByDesc("created_at");
            }
            if(array_key_exists("sort:oldest",$request)){
                $phoneQuery = $phoneQuery->orderBy("created_at");
            }
            if(array_key_exists("sort:Price:HTL",$request)){
                $phoneQuery = $phoneQuery->orderByDesc("cost");
            }
            if(array_key_exists("sort:Price:LTH",$request)){
                $phoneQuery = $phoneQuery->orderBy("cost");
            }
            #endregion

            $phone = $phoneQuery->get();
            if ($phone == null) {
                return ResponseModel::NotFound("Phone Not Found!", null);
            }

            return ResponseModel::Ok("Fetch Success", $phone);
        } catch (Exception $e) {
            Log::error("PhoneRepository.All => {$e->getMessage()}");
            return ResponseModel::BadRequest("Invalid Request.", null);
        }
    }
}


?>