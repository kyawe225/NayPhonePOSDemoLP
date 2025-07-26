<?php

namespace App\Repository\Implementation;

use App\Models\Cart;
use App\Repository\Interface\ICartRepository;
use Str;

class CartRepository implements ICartRepository
{
    public function create(array $request){
        try{
            $request["id"] = Str::uuid7();
            $phone = Phone::where("id",$request['phone_id'])->first();
            $request["price"]=$phone->price;
            $request["brand"]=$phone->brand;
            $request["model"]=$phone->model;
            $request["date"]=Carbon::now("utc");
            $sale = Sale::create($request); 
            $inserted= $sale->save();
            if(!$inserted){
                return ResponseModel::BadRequest("Invalid Request", null); 
            }
            return ResponseModel::Ok("Sale Registered Successfully!", null);

        }catch(Exception $e){
            Log::error("SaleRepository.Create => $e->getMessage()");
            return ResponseModel::InternalServerError("Invalid Request.",null);
        }
    }
    public function update(string $id, array $request){
        try{
            $cart =Cart::where("id",$id)->first();
            if($cart == null){
                return ResponseModel::NotFound("Sale Not Found.", null); 
            }
            $inserted = $cart->update($request); 
            if(!$inserted){
                return ResponseModel::BadRequest("Invalid Request", null); 
            }
            return ResponseModel::Ok("Sale Updated Successfully!", null);
        }catch(Exception $e){
            Log::error("SaleRepository.Update => $e->getMessage()");
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
            Log::error("SaleRepository.Delete => $e->getMessage()");
            return ResponseModel::InternalServerError("Invalid Request.",null);
        }
    }
    public function get(string $id){
        try{
            $cart = Cart::where("id",$id)->with("phone")->first();
            if($cart != null){
                return ResponseModel::NotFound("Cart Not Found!",null);
            }
            return ResponseModel::Ok("Fetch Success",$cart);
        }catch(Exception $e){
            Log::error("CartRepository.Get => $e->getMessage()");
            return ResponseModel::BadRequest("Invalid Request.",null);
        }
    }
    public function all($request){
        try{
            $sale = Cart::with("phone");
            if(array_has("customer_id",$request)){
                $sale = $sale->where("customer_id",$request["customer_id"]);
            }
            if(array_has("phone_id",$request)){
                $sale = $sale->where("phone_id",$request["phone_id"]);
            }
            $data = $sale->all();
            if($data != null){
                return ResponseModel::NotFound("Cart Not Found!",null);
            }
            return ResponseModel::Ok("Fetch Success",$data);
        }catch(Exception $e){
            Log::error("CartRepository.All => $e->getMessage()");
            return ResponseModel::BadRequest("Invalid Request.",null);
        }
    }
}


?>