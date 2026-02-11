<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    function dashboardPage()
    {
        return view('backpage.dashboard-page');
    }

    function Summary(Request $request): array
    {
        $user_id = $request->header('id');
        $Product = Product::where('user_id', $user_id)->count();
        $Category = Category::where('user_id', $user_id)->count();
        $Customer = Customer::where('user_id', $user_id)->count();
        $Invoice = Invoice::where('user_id', $user_id)->count();
        $Total = Invoice::where('user_id', $user_id)->sum('total');
        $Vat = Invoice::where('user_id', $user_id)->sum('vat');
        $Payable = Invoice::where('user_id', $user_id)->sum('payable');


        return [
            'product' => $Product,
            'category' => $Category,
            'customer' => $Customer,
            'invoice' => $Invoice,
            'total' => round($Total, 2),
            'vat' => round($Vat, 2),
            'payable' => round($Payable, 2)
        ];
    }
}
