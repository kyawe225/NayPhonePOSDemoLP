<?php

use App\Models\Repair;
use App\Models\Sale;

class DashboardController{

    public function index(){
        $dailyRepairs = Repair::groupBy("created_at")->where("status","<>","cancelled")->select(["cast(created_at as date) as date,sum(cost) as total_cost"])->get();
        $totalRepairRevenue = Repair::where("status","<>","cancelled")->sum("cost");
        $repairs = Repair::with("customer")->where("status","<>","cancelled")->get(["phone_model","customer.name","date","cost"]);
        
        $dailySales = Sale::groupBy("created_at")->with("phone")->select(["cast(created_at as date) as date,sum(phone.price) as total_cost"])->get();
        $totalSaleRevenue = Sale::with("phone")->sum("phone.price");
        $sales = Sale::with("phone","customer")->get();
        return [
            $dailyRepairs,
            $totalRepairRevenue,
            $repairs,
            $dailySales,
            $totalSaleRevenue,
            $sales
        ];
    }
}