<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Inertia\Inertia;
use Stripe\Balance;


class DashboardAdminController extends Controller
{
    public $balance;


    protected function getBalance() {
        return Balance::retrieve(['api_key' => config('cashier.secret')]);
    }


    public function index(): \Inertia\Response
    {


        $balance = $this->balance = ($this->getBalance())->toArray();
        $formattedBalance = number_format($balance['pending'][0]['amount'], 2, ',' , '.');

        return Inertia::render('Admin/Dashboard',[
            'totalUsers' => User::count(),
            'totalComments' => Comment::count(),
            'balance' =>  $formattedBalance,
        ]);


    }
}
