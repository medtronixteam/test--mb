<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\Refund;
class MainController extends Controller
{
    public function products()
    {
        $products = Product::where('isActive', 1)->get();
        return view('warehouse.products', compact('products'));
    }
    public function orders()
    {
        $orders = Order::all();
        $pendingOrder = Order::where('status', 'pending')->count();
        $completedOrder = Order::where('status', 'completed')->count();
        $rejectedOrder = Order::where('status', 'rejected')->count();
        return view('warehouse.orders', compact('orders', 'pendingOrder', 'completedOrder', 'rejectedOrder'));
    }
    public function refunds()
    {
        $refunds = Refund::all();
        $pendingRefund = Refund::where('status', 'pending')->count();
        $approvedRefunds = Refund::where('status', 'completed')->count();
        $cancelledRefunds = Refund::where('status', 'rejected')->count();

        return view('warehouse.refunds', compact('refunds', 'pendingRefund', 'approvedRefunds', 'cancelledRefunds'));
    }

}
