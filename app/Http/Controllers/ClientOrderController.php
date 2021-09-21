<?php

namespace App\Http\Controllers;

use App\DataTables\OrdersDataTable;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClientOrderController extends Controller
{
    public function index(OrdersDataTable $ordersDataTable)
    {
        return $ordersDataTable->render('shop.datatable');
    }

    public function exportPDF($orderID)
    {
        $pdf = $this->generatePDF('id', $orderID);

        return $pdf->download('order_details.pdf');
    }

    public static function generatePDF($column, $value)
    {
        $order = Order::all()->where($column, '=', $value)->last();
        $order_items = (OrderItem::all()->where('order_id', '=', $order['id']))->values();
        $products = [];
        foreach ($order_items as $item) {
            $productName = Product::select("name")->where("id", $item['product_id'])->first();
            array_push($products, $productName);
        }

        $pdf = PDF::loadView('shop/client/pdf_invoice', ['order' => $order, 'order_items' => $order_items, 'products' => $products]);
        return $pdf;
    }
}
