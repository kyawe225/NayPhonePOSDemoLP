<?php

namespace App\Repository\Implementation;

use App\Models\ServiceHistory;
use App\Repository\Interface\IServiceHistoryRepository;
use App\ViewModels\ResponseModel;
use Carbon\Carbon;
use Exception;
use Log;
use Str;

class ServiceHistoryRepository implements IServiceHistoryRepository
{
    public function create(array $request)
    {
        try {
            $request["id"] = Str::uuid7();
            $request["date"] = Carbon::now("utc");
            $serviceHistory = ServiceHistory::create($request);
            $inserted = $serviceHistory->save();
            if ($inserted == false) {
                return ResponseModel::BadRequest("Please double check!", null);
            }
            return ResponseModel::Ok("Save Successfully!", null);
        } catch (Exception $e) {
            Log::error("Service History Repository.Create => {$e->getMessage()}");
            return ResponseModel::InternalServerError("Invalid request.", null);
        }
    }
    public function update(string $id, array $request)
    {
        try {
            $serviceHistory=ServiceHistory::where('id',$id)->first();
            if($serviceHistory == null)
                return ResponseModel::NotFound("Service history not found",null);
            $request["date"] = Carbon::parse($request["date"],"utc");
            $updateStatus = $serviceHistory->update($request);
            if ($updateStatus == false) {
                return ResponseModel::BadRequest("Please double check!", null);
            }
            return ResponseModel::Ok("Update Successfully!", null);
        } catch (Exception $e) {
            Log::error("Service History Repository.Update => {$e->getMessage()}");
            return ResponseModel::InternalServerError("Invalid request.", null);
        }
    }
    public function delete(string $id)
    {
        try {
            $serviceHistory = ServiceHistory::where("id", $id)->first();
            if ($serviceHistory == null) {
                return ResponseModel::NotFound("Service Not Found!", null);
            }
            $serviceHistory->delete();
            return ResponseModel::Ok("Delete Success!", null);
        } catch (Exception $e) {
            Log::error("Service History Repository.Get => {$e->getMessage()}");
            return ResponseModel::InternalServerError("Invalid request.", null);
        }
    }
    public function get(string $id)
    {
        try {
            $serviceHistory = ServiceHistory::where("id", $id)->first();
            if ($serviceHistory == null) {
                return ResponseModel::NotFound("Service Not Found!", null);
            }
            return ResponseModel::Ok("Fetch Success!", $serviceHistory);
        } catch (Exception $e) {
            Log::error("Service History Repository.Get => {$e->getMessage()}");
            return ResponseModel::InternalServerError("Invalid request.", null);
        }
    }
    public function all($request)
    {
        try {
            return ResponseModel::Ok("Successfully Fetch!",ServiceHistory::all());
        } catch (Exception $e) {
            Log::error("Service History Repository.All => {$e->getMessage()}");
            return ResponseModel::InternalServerError("Invalid request.", null);
        }
    }
}


?>