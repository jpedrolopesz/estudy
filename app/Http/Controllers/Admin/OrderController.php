<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function show()
    {

        return Inertia('Admin/Order/Show', [
            'filters' => \Illuminate\Support\Facades\Request::all('search', 'role', 'trashed'),
            'users' => User::get(['id']),
            'plans' => Plan::all(['id', 'name']),
            'orders' => Order::with('user', 'plan.planFeatures')
                ->filter(\Illuminate\Support\Facades\Request::only('search', 'role', 'trashed'))
                ->latest()
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($order) => [
                    'id' => $order->id,
                    'order_id' => $order->order_id,
                    'transaction_id' => $order->transaction_id,
                    'user_id' => $order->user->id,
                    'user_name' => $order->user->name,
                    'currency_symbol' => $order->currency_symbol,
                    'amount' => $order->amount,
                    'payment_provider' => $order->payment_provider,
                    'plan' => $order->plan,
                ])

        ]);
    }

    public function orderDetails(Order $order, Plan $plan, User $user)
    {

        return Inertia('Admin/Order/OrderDetails', [
           'order' => $order->user->load('orders'),
            'subscribed_plan' => $plan->with('planFeatures')
                ->get()


        ]);
    }

}
