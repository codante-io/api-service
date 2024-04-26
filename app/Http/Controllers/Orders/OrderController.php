<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\StoreOrderRequest;
use App\Http\Requests\Orders\UpdateOrderRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Orders\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $orders = Order::query();

        $request->validate([
            // Busca por status
            'status' => 'in:pending,completed',
            // Busca textual no nome
            'search' => 'string',
        ]);

        // handle status filter
        if (request()->has('status')) {
            $orders->where('status', request('status'));
        }

        // handle search filter
        if (request()->has('search')) {
            $orders->whereRaw('LOWER(`customer_name`) LIKE ?', ['%' . strtolower(request('search')) . '%']);
        }

        $orders = $orders->paginate(10);
        return OrderResource::collection($orders);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        // create order
        $order = Order::create($request->all());
        return new OrderResource($order);

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
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // remove order
        $order->delete();
    }

    public function reset()
    {
        Artisan::call('api:orders-api:reset');
        return response()->json(['message' => 'Database reset']);
    }
}
