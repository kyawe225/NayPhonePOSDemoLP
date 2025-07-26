<?php

namespace App\Repository\Implementation;

use App\Models\Customer;
use App\Repository\Interface\ICustomerRepository;
use App\ViewModels\ResponseModel;
use Exception;
use Log;
use Str;

class CustomerRepository implements ICustomerRepository
{
    public function create(array $request){
        try{
            $customer = Customer::where("email",$request['email'])->first();
            if($customer == null){
                return ResponseModel::BadRequest("Email is Already Registered!",null);
            }
            $request['id'] = Str::uuid7();
            $customer = Customer::create($request);
            $customer->save();
            return ResponseModel::Ok("Customer Added Successfully!",null);
        }catch(Exception $e){
            Log::error("CustomerRepository.Delete => $e->getMessage()");
            return ResponseModel::BadRequest("Invalid Request.",null);
        }
    }
    public function update(string $id, array $request){
        try{
            $customer = Customer::where("email",$request['email'])->where("id","<>",$id)->first();
            if($customer == null){
                return ResponseModel::BadRequest("Email is Already Registered!",null);
            }
            $customer = Customer::where("id",$id)->first();
            if($customer == null){
                return ResponseModel::BadRequest("Customer Not Found!",null);
            }
            $state = $customer->update($request);
            if($state){
                return ResponseModel::Ok("Customer Updated Successfully!",null);
            }
            return ResponseModel::BadRequest("Invalid Request.",null);
        }catch(Exception $e){
            Log::error("CustomerRepository.Delete => $e->getMessage()");
            return ResponseModel::BadRequest("Invalid Request.",null);
        }
    }
    public function delete(string $id){
        try{
            $customer = Customer::where("id",$id)->first();
            if($customer == null){
                return ResponseModel::BadRequest("Customer Not Found!",null);
            }
            $state = $customer->delete();
            if($state){
                return ResponseModel::Ok("Customer Deleted Successfully!",null);
            }
            return ResponseModel::BadRequest("Invalid Request.",null);
        }catch(Exception $e){
            Log::error("CustomerRepository.Delete => $e->getMessage()");
            return ResponseModel::BadRequest("Invalid Request.",null);
        }
        
    }
    public function get(string $id){
        try{
            $customer = Customer::where("id",$id)->first();
            if ($customer != null) {
                return ResponseModel::NotFound("Phone Not Found!", null);
            }
            return ResponseModel::Ok("Fetch Success", $customer);
        }catch(Exception $e){

        }
    }
    public function all($request){
        try{
            $customerQuery = Customer::query();
            #region sorting session and others
            if(array_key_exists("search:value",$request)){
                $request['search:value'] = trim(strtolower($request["search:value"])); 
                $customerQuery = $customerQuery->whereRaw("LOWER(`name`) LIKE ?",["%".$request['search:value'].'%'])->orWhereRaw("LOWER(`phone`) LIKE ?",["%".$request["search:value"].'%'])->orWhereRaw("LOWER(`email`) LIKE ?",["%".$request["search:value"].'%']);
            }
            #endregion

            $customer = $customerQuery->get();
            if ($customer != null) {
                return ResponseModel::NotFound("Customer Not Found!", null);
            }

            return ResponseModel::Ok("Fetch Success", $customer);
        }catch(Exception $e){

        }
    }
}


?>