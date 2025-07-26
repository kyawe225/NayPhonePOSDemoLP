<?php

namespace App\Repository\Implementation;

use App\Models\Repair;
use App\Repository\Interface\IRepairRepository;
use App\ViewModels\ResponseModel;
use Carbon\Carbon;
use DB;
use Exception;
use Log;
use Str;

class RepairRepository implements IRepairRepository
{
    public function create(array $request){
        try{
            $request["id"] = Str::uuid7();
            $request["date"]= Carbon::now("utc");
            $repair = Repair::create($request); 
            $inserted= $repair->save();
            if(!$inserted){
                return ResponseModel::BadRequest("Invalid Request", null); 
            }
            return ResponseModel::Ok("Repair Registered Successfully!", null);

        }catch(Exception $e){
            Log::error("RepairHistoryRepository.Create => {$e->getMessage()}");
            return ResponseModel::InternalServerError("Invalid Request.",null);
        }
    }
    public function update(string $id, array $request){
        try{
            DB::beginTransaction();
            $repair =Repair::lockForUpdate()->where("id",$id)->first();
            if($repair == null){
                return ResponseModel::NotFound("Repair Request Not Found!", null); 
            }
            $inserted = $repair->update($request); 
            DB::commit();
            if(!$inserted){
                return ResponseModel::BadRequest("Invalid Request", null); 
            }
            return ResponseModel::Ok("Repair Updated Successfully!", null);
        }catch(Exception $e){
            DB::rollBack();
            Log::error("RepairHistoryRepository.Update => {$e->getMessage()}");
            return ResponseModel::InternalServerError("Invalid Request.",null);
        }
    }
    public function delete(string $id){
        try{
            $repair = Repair::where("id",$id)->first();
            if($repair == null){
                return ResponseModel::NotFound("Repair History Not Found!",null);
            }
            $deleted = $repair->delete();
            if($deleted == false){
                return ResponseModel::BadRequest("Repair History Cannot Be Deleted!",null);
            }
            return ResponseModel::Ok("Repir History Deleted Successfully!",null);
        }catch(Exception $e){
            Log::error("RepairHistoryRepository.Delete => {$e->getMessage()}");
            return ResponseModel::InternalServerError("Invalid Request.",null);
        }
    }
    public function get(string $id){
        try{
            $phone = Repair::where("id",$id)->with("customer","service_history")->first();
            if($phone == null){
                return ResponseModel::NotFound("Phone Not Found!",null);
            }
            return ResponseModel::Ok("Fetch Success",$phone);
        }catch(Exception $e){
            Log::error("RepairRepository.Get => {$e->getMessage()}");
            return ResponseModel::BadRequest("Invalid Request.",null);
        }
    }
    public function all($request){
        try{
            $repairQuery = Repair::query();
            
            #region sorting session and others
            if(array_key_exists("search:value",$request)){
                $request['search:value'] = trim(strtolower($request["search:value"])); 
                $repairQuery = $repairQuery->whereRaw("LOWER(`phone_model`) LIKE ?",["%".$request['search:value'].'%'])->orWhereRaw("LOWER(`issue`) LIKE ?",["%".$request["search:value"].'%'])->orWhereHas("customer",function ($query) use ($request){
                    $query->whereRaw("LOWER(`name`) LIKE ?",["%".$request["search:value"]."%"]);
                });
            }
            if(array_key_exists("sort:Status:P",$request)){
                $repairQuery = $repairQuery->where("status","pending");
            }
            if(array_key_exists("sort:Status:C",$request)){
                $repairQuery = $repairQuery->where("status","completed");
            }
            if(array_key_exists("sort:newest",$request)){
                $repairQuery = $repairQuery->orderByDesc("created_at");
            }
            if(array_key_exists("sort:oldest",$request)){
                $repairQuery = $repairQuery->orderBy("created_at");
            }
            #endregion
            $repairs = $repairQuery->with(["customer","service_history"])->get();
            if($repairs == null){
                return ResponseModel::NotFound("Repair History Not Found!",null);
            }
            return ResponseModel::Ok("Fetch Success",$repairs);
        }catch(Exception $e){
            Log::error("PhoneRepository.All => {$e->getMessage()}");
            return ResponseModel::BadRequest("Invalid Request.",null);
        }
    }
}


?>