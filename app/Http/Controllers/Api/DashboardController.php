<?php

namespace App\Http\Controllers\Api;

use App\Models\Repair;
use App\Models\Sale;
use DB;

class DashboardController
{
    // this only works for no discount sale and others ......
    public function index()
    {
        $dailyRepairs = Repair::groupBy("created_at")->where("status", "<>", "cancelled")->select([DB::raw("cast(created_at as date) as date"), DB::raw("sum(cost) as total_cost")])->get();
        $totalRepairRevenue = Repair::where("status", "<>", "cancelled")->sum("cost");
        $repairs = Repair::with([
            "customer" => function ($query) {
                $query->select("name");
            }
        ])->where("status", "<>", "cancelled")->get(["phone_model", "date", "cost"]);

        $dailySales = Sale::join("phones", "phones.id", "=", "phone_id")->where("status", "<>", "cancelled")->groupByRaw("sales.created_at")->select([
            DB::raw("sales.created_at as date"),
            DB::raw(" SUM(CASE 
        WHEN discount_type = 'fixed_amount' THEN (price - discount_amount)
        WHEN discount_type = 'percentage' THEN ROUND((price - (price * discount_amount / 100)), 2)
        ELSE price 
    END) as total_earned")
        ])->get();
        $totalSaleRevenue = Sale::join("phones", "phones.id", "=", "phone_id")->where("status", "<>", "cancelled")->sum(DB::raw(" CASE 
        WHEN discount_type = 'fixed_amount' THEN (price - discount_amount)
        WHEN discount_type = 'percentage' THEN ROUND((price - (price * discount_amount / 100)), 2)
        ELSE price 
    END"));
        $sales = Sale::with("phone", "customer")->get();
        return [
            "dailyRepairs" => $dailyRepairs,
            "totalRepairRevenue" => $totalRepairRevenue,
            "repairs" => $repairs,
            "dailySales" => $dailySales,
            "saleRevenue" => $totalSaleRevenue,
            "sales" => $sales
        ];
    }
}