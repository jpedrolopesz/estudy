<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Plan;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->create([
            'id' => 1,
            'first_name' => 'Joao Pedro',
            'last_name' => 'Lopes Zamonelo',
            'email' => 'jplopeszamonelo@hotmail.com',
            'password' => bcrypt('joao1998'),
            'owner' => true,
            'role' => Roles::SUPER_ADMIN,
            'trial_ends_at' => now()->addDays(config('cashier.trial_days')),
        ]);

        User::factory()->count(10)->create();



        $plans = [
            [
                'name' => 'Gold', 'url' => 'gold', 'slug' => 'monthly', 'price' => 990, 'stripe_id' => 'price_1LSRHkGQW0U1PfqxJO7EGsHx', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção gráfica'
            ],
            [
                'name' => 'Gold', 'url' => 'gold', 'slug' => 'yearly', 'price' => 9990, 'stripe_id' => 'price_1LTBIAGQW0U1Pfqxdr82APbW', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção gráficas'
            ],
            [
                'name' => 'Diamond', 'url' => 'diamond', 'slug' => 'monthly', 'price' => 3990, 'stripe_id' => 'price_1LSmsIGQW0U1PfqxxsV7db73', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção '
            ],
            [
                'name' => 'Diamond', 'url' => 'diamond', 'slug' => 'yearly', 'price' => 33990, 'stripe_id' => 'price_1Lb6p6GQW0U1PfqxjKs6uVX2', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção'
            ],
            [
                'name' => 'Premium', 'url' => 'premium', 'slug' => 'monthly', 'price' => 6990, 'stripe_id' => 'price_1LSRIVGQW0U1PfqxnFnKpQmh', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção'
            ],
            [
                'name' => 'Premium', 'url' => 'premium', 'slug' => 'yearly', 'price' => 66990, 'stripe_id' => 'price_1Lb6kvGQW0U1PfqxQFJJcEBN', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção'
            ]


        ];

        foreach ($plans as $item) {
            $plan = Plan::create($item);

            $plan->planFeatures()->create([
                'max_users' => 2,
            ]);
        }


        Course::factory()->count(4)->create()->each(function ($curso) {
            // Criar 5 módulos para cada curso
            $modulos = Module::factory()->count(5)->create(['course_id' => $curso->id]);

            // Para cada módulo, criar 5 aulas
            $modulos->each(function ($modulo) {
                $aulas = Lesson::factory()->count(3)->create(['module_id' => $modulo->id]);

                // Para cada aula, criar 3 comentários
                $aulas->each(function ($aula) {
                    Comment::factory()->count(3)->create([
                        'lesson_id' => $aula->id,
                    ]);
                    Reply::factory()->count(3)->create();

                });
            });
        });
    }


}
