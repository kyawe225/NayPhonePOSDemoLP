<?php

namespace App\Http\Controllers\Api;

use App\Models\Repair;
use App\Models\Sale;
use DB;

class DashboardController{

    public function index(){
        $dailyRepairs = Repair::groupBy("created_at")->where("status","<>","cancelled")->select([DB::raw("cast(created_at as date) as date"),DB::raw("sum(cost) as total_cost")])->get();
        $totalRepairRevenue = Repair::where("status","<>","cancelled")->sum("cost");
        $repairs = Repair::with(["customer" => function($query){
            $query->select("name");
        }])->where("status","<>","cancelled")->get(["phone_model","date","cost"]);
        
        // $dailySales = Sale::groupBy("created_at")->withSum(["phone"=>function($query){ $query->where('status',"<>","cancelled");}],"price")->get();
        $dailySales = Sale::join("phones" , "phones.id","=","phone_id")->where("status","<>","cancelled")->groupByRaw("sales.created_at")->select([DB::raw("sales.created_at as date"),DB::raw("sum(phones.price) as total_earned")])->get();
        $totalSaleRevenue = Sale::join("phones" , "phones.id","=","phone_id")->where("status","<>","cancelled")->sum(DB::raw("phones.price"));
        $sales = Sale::with("phone","customer")->get();
        return [
            "dailyRepairs"=>$dailyRepairs,
            "totalRepairRevenue"=> $totalRepairRevenue,
            "repairs"=> $repairs,
            "dailySales"=>$dailySales,
            "saleRevenue"=> $totalSaleRevenue,
            "sales"=>$sales
        ];
    }
}