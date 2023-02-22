<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Account;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
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


        Course::factory()->count(5)->create()->each(function ($curso) {
            // Criar 5 módulos para cada curso
            $modulos = Module::factory()->count(5)->create(['course_id' => $curso->id]);

            // Para cada módulo, criar 5 aulas
            $modulos->each(function ($modulo) {
                $aulas = Lesson::factory()->count(5)->create(['module_id' => $modulo->id]);

                // Para cada aula, criar 3 comentários
                $aulas->each(function ($aula) {
                    Comment::factory()->count(3)->create([
                        'lesson_id' => $aula->id,
                        'user_id' => User::inRandomOrder()->first()->id
                    ]);
                });
            });
        });




        // Cria um curso com 2 módulos e 4 aulas em cada módulo
        $course1 = Course::create([
            'user_id' => 1,
            'thumbnail' => 'https://images.pexels.com/photos/1279813/pexels-photo-1279813.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            'price' => 199,
            'title' => 'Curso de Laravel',
            'description' => 'Aprenda a criar aplicações web com Laravel'
        ]);

        for ($i = 1; $i <= 2; $i++) {
            $module = Module::create([
                'course_id' => $course1->id,
                'title' => 'Módulo ' . $i,
                'order' => 1,
                'description' => 'Descrição do Módulo ' . $i
            ]);

            for ($j = 1; $j <= 4; $j++) {
                $lesson = Lesson::create([
                    'module_id' => $module->id,
                    'title' => 'Aula ' . $j,
                    'description' => 'Descrição da Aula ' . $j,
                    'order' => 1,
                    'video_url' => 'https://www.youtube.com/embed/MlgbDr-9SJE'
                ]);
                $lesson = Lesson::create([
                    'module_id' => $module->id,
                    'title' => 'Aula Motiva ' . $j,
                    'description' => 'Descrição da Aula ' . $j,
                    'order' => 1,
                    'video_url' => 'https://www.youtube.com/embed/SIsCy663mz4'
                ]);
            }
        }

        // Cria outro curso com 1 módulo e 3 aulas
        $course2 = Course::create([
            'user_id' => 1,
            'thumbnail' => 'https://images.pexels.com/photos/1279813/pexels-photo-1279813.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            'price' => 199,
            'title' => 'Curso de Vue.js',
            'description' => 'Aprenda a criar aplicações front-end com Vue.js'
        ]);

        $module = Module::create([
            'course_id' => $course2->id,
            'title' => 'Módulo 1',
            'order' => 1,
            'description' => 'Descrição do Módulo 1'
        ]);

        for ($j = 1; $j <= 3; $j++) {
            $lesson = Lesson::create([
                'module_id' => $module->id,
                'title' => 'Aula ' . $j,
                'description' => 'Descrição da Aula ' . $j,
                'order' => 1,
                'video_url' => 'https://www.youtube.com/embed/MlgbDr-9SJE'
            ]);
            $lesson->comments()->create([
                'comment' => 'Comentário ' . $j,
                'user_id' => 1, // ID do usuário que criou o comentário
            ]);
            $file = $lesson->files()->create([
                'file_name' => 'arquivo.pdf',
                'file_path' => '/caminho/para/o/arquivo.pdf',
                'user_id' => 1, // ID do usuário que criou o comentário

            ]);
        }


        $course3 = Course::create([
            'user_id' => 2,
            'thumbnail' => 'https://images.pexels.com/photos/1279813/pexels-photo-1279813.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            'price' => 199,
            'title' => 'Curso de Laravel',
            'description' => 'Aprenda a criar aplicações web com Laravel'
        ]);

        for ($i = 1; $i <= 2; $i++) {
            $module = Module::create([
                'course_id' => $course1->id,
                'title' => 'Módulo ' . $i,
                'order' => 1,
                'description' => 'Descrição do Módulo ' . $i
            ]);

            for ($j = 1; $j <= 4; $j++) {
                $lesson = Lesson::create([
                    'module_id' => $module->id,
                    'title' => 'Aula ' . $j,
                    'description' => 'Descrição da Aula ' . $j,
                    'order' => 1,
                    'video_url' => 'https://www.youtube.com/embed/MlgbDr-9SJE'
                ]);
            }
        }



    }


}
