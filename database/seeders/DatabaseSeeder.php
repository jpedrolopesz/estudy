<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Account;
use App\Models\Order;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Laravel\Cashier\Subscription;
use Laravel\Cashier\SubscriptionItem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $account = Account::create(['name' => 'PuroSaaS']);

        User::factory()->create([
            'account_id' => $account->id,
            'first_name' => 'Joao Pedro',
            'last_name' => 'Lopes Zamonelo',
            'email' => 'jplopeszamonelo@hotmail.com',
            'password' => bcrypt('joao1998'),
            'owner' => true,
            'trial_ends_at' => now()->addDays(config('cashier.trial_days')),
        ]);

        User::factory(10)->create(['account_id' => $account->id]);


        $plans = [
            [
                'name' => 'Gold', 'url' => 'gold', 'slug' => 'monthly', 'price' => 990, 'stripe_id' => 'price_1LSRHkGQW0U1PfqxJO7EGsHx'
            ],
            [
                'name' => 'Gold', 'url' => 'gold', 'slug' => 'yearly', 'price' => 9990, 'stripe_id' => 'price_1LTBIAGQW0U1Pfqxdr82APbW'
            ],
            [
                'name' => 'Diamond', 'url' => 'diamond', 'slug' => 'monthly', 'price' => 3990, 'stripe_id' => 'price_1LSmsIGQW0U1PfqxxsV7db73'
            ],
            [
                'name' => 'Diamond', 'url' => 'diamond', 'slug' => 'yearly', 'price' => 33990, 'stripe_id' => 'price_1Lb6p6GQW0U1PfqxjKs6uVX2'
            ],
            [
                'name' => 'Premium', 'url' => 'premium', 'slug' => 'monthly', 'price' => 6990, 'stripe_id' => 'price_1LSRIVGQW0U1PfqxnFnKpQmh'
            ],
            [
                'name' => 'Premium', 'url' => 'premium', 'slug' => 'yearly', 'price' => 66990, 'stripe_id' => 'price_1Lb6kvGQW0U1PfqxQFJJcEBN'
            ]


        ];

        foreach ($plans as $item) {
            $plan = Plan::create($item);

            $plan->planFeatures()->create([
                'max_users' => 2,
            ]);
        }
        Order::factory(10)->create();









    }


}
