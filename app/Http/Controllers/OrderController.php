<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderGoods;
use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {
        $shops = Shops::all();
        $count = Order::all()->count();
        if (!empty($request->shop_id)) {
            $count = Order::where('shop_id', $request->shop_id)->get()->count();
            if (!empty($request->month)) {
                $month = substr($request->month, 6, 2);
                $count = Order::where('shop_id', $request->shop_id)->whereMonth('created_at', $month)->get()->count();
            }
            if (!empty($request->date)) {
                $count = Order::where('shop_id', $request->shop_id)->whereDate('created_at', $request->date)->get()->count();
            }
        }

        if (!empty($request->month)) {
            $month = substr($request->month, 6, 2);
            $count = Order::whereMonth('created_at', $month)->get()->count();
        }
        if (!empty($request->date)) {
            $count = Order::whereDate('created_at', $request->date)->get()->count();
        }

        return view('Order/index', compact('count', 'shops'));

    }


    public function menus(Request $request)
    {

        $shops =Shops::all();
        $menus = DB::select("SELECT SUM(amount) as num,goods_name as name from order_goods GROUP BY goods_id ORDER BY num DESC");
        if (!empty($request->month)) {
            $month = substr($request->month, 0, 7);
            $menus = DB::select("SELECT SUM(amount) as num,goods_name as name from order_goods WHERE created_at like '$month%' GROUP BY goods_id ORDER BY num DESC");
        }
        if (!empty($request->date)) {
            $menus = DB::select("SELECT SUM(amount) as num,goods_name as name from order_goods WHERE  created_at like '$request->date%' GROUP BY goods_id ORDER BY num DESC");
        }

            if (!empty($request->shop_id)) {

                $menus = DB::select("SELECT SUM(amount) as num,goods_name as name from order_goods WHERE order_id in (select id FROM orders where shop_id=$request->shop_id) GROUP BY goods_id ORDER BY num DESC");
                if (!empty($request->month)) {
                    $month = substr($request->month, 0, 7);
                    $menus = DB::select("SELECT SUM(amount) as num,goods_name as name from order_goods WHERE order_id in (select id FROM orders where shop_id=$request->shop_id and created_at like '$month%') GROUP BY goods_id ORDER BY num DESC");
                }
                if (!empty($request->date)) {
                    $menus = DB::select("SELECT SUM(amount) as num,goods_name as name from order_goods WHERE order_id in (select id FROM orders where shop_id=$request->shop_id and created_at like '$request->date%') GROUP BY goods_id ORDER BY num DESC");
                }
            }

        return view('Order/menus', compact('menus','shops'));
    }
}