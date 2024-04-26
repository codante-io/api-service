<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Orders\Order;
use Illuminate\Support\Facades\Artisan;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(10);
        return OrderResource::collection($orders);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        // update order
        $order->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // remove order
        $order->delete();
    }

    public function reset() {
        // create DB if not exists
        if (!file_exists(database_path('orders.sqlite'))) {
            touch(database_path('orders.sqlite'));
        }
        
        // reset orders
        Artisan::call('migrate:fresh', [
            '--path' => 'database/migrations/orders',
            '--database' => 'orders',
        ]);
        Artisan::call('db:seed', [
            '--class' => 'Database\Seeders\Order\OrderSeeder',
            '--database' => 'orders',
        ]);

        return response()->json(['message' => 'Database reset']);

    }
}
