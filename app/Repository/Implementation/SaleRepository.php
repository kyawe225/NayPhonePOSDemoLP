<?php

namespace App\Repository\Implementation;

use App\Models\Sale;
use App\Repository\Interface\IRepairRepository;
use App\Repository\Interface\ISaleRepository;
use App\ViewModels\ResponseModel;
use Exception;
use Log;
use Str;
use Carbon\Carbon;

class SaleRepository implements ISaleRepository
{
    public function create(array $request){
        try{
            $request["id"] = Str::uuid7();
            $request["date"]=Carbon::now("utc");
            $sale = Sale::create($request); 
            $inserted= $sale->save();
            if(!$inserted){
                return ResponseModel::BadRequest("Invalid Request", null); 
            }
            return ResponseModel::Ok("Sale Registered Successfully!", null);

        }catch(Exception $e){
            Log::error("SaleRepository.Create => {$e->getMessage()}");
            return ResponseModel::InternalServerError("Invalid Request.",null);
        }
    }
    public function update(string $id, array $request){
        try{
            $sale =Sale::where("id",$id)->first();
            if($sale == null){
                return ResponseModel::NotFound("Sale Not Found.", null); 
            }
            $inserted = $sale->update($request); 
            if(!$inserted){
                return ResponseModel::BadRequest("Invalid Request", null); 
            }
            return ResponseModel::Ok("Sale Updated Successfully!", null);
        }catch(Exception $e){
            Log::error("SaleRepository.Update => {$e->getMessage()}");
            return ResponseModel::InternalServerError("Invalid Request.",null);
        }
    }
    public function delete(string $id){
        try{
            $sale = Sale::where("id",$id)->first();
            if($sale == null){
                return ResponseModel::NotFound("Sale Not Found!",null);
            }
            $deleted = $sale->delete();
            if($deleted == false){
                return ResponseModel::BadRequest("Sale Cannot Be Deleted!",null);
            }
            return ResponseModel::Ok("Sale Deleted Successfully!",null);
        }catch(Exception $e){
            Log::error("SaleRepository.Delete => {$e->getMessage()}");
            return ResponseModel::InternalServerError("Invalid Request.",null);
        }
    }
    public function get(string $id){
        try{
            $sale = Sale::where("id",$id)->with("phone")->first();
            if($sale == null){
                return ResponseModel::NotFound("Sale Not Found!",null);
            }
            return ResponseModel::Ok("Fetch Success",$sale);
        }catch(Exception $e){
            Log::error("SaleRepository.Get => {$e->getMessage()}");
            return ResponseModel::BadRequest("Invalid Request.",null);
        }
    }
    public function all($request){
        try{
            $sale = Sale::with("phone")->all();
            if($sale == null){
                return ResponseModel::NotFound("Sale Not Found!",null);
            }
            return ResponseModel::Ok("Fetch Success",$sale);
        }catch(Exception $e){
            Log::error("SaleRepository.All => {$e->getMessage()}");
            return ResponseModel::BadRequest("Invalid Request.",null);
        }
    }
}


?>