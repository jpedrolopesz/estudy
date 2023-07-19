<?php

namespace Database\Seeders;

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
            'owner' => false,
            'trial_ends_at' => now()->addDays(config('cashier.trial_days')),
        ]);

        User::factory()->count(10)->create();



        $plans = [
            ['name' => 'Gold', 'url' => 'gold', 'slug' => 'monthly', 'price' => number_format(9.90, 2), 'price_currency'=> 'USD', 'stripe_id' => 'price_1LSRHkGQW0U1PfqxJO7EGsHx', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção gráfica'],
            ['name' => 'Gold', 'url' => 'gold', 'slug' => 'yearly', 'price' => number_format(99.90, 2), 'price_currency'=> 'USD', 'stripe_id' => 'price_1LTBIAGQW0U1Pfqxdr82APbW', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção gráficas'],
            ['name' => 'Diamond', 'url' => 'diamond', 'slug' => 'monthly', 'price' => number_format(39.90, 2), 'price_currency'=> 'USD', 'stripe_id' => 'price_1LSmsIGQW0U1PfqxxsV7db73', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção'],
            ['name' => 'Diamond', 'url' => 'diamond', 'slug' => 'yearly', 'price' => number_format(339.90, 2), 'price_currency'=> 'USD', 'stripe_id' => 'price_1Lb6p6GQW0U1PfqxjKs6uVX2', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção'],
            ['name' => 'Premium', 'url' => 'premium', 'slug' => 'monthly', 'price' => number_format(69.90, 2), 'price_currency'=> 'USD', 'stripe_id' => 'price_1LSRIVGQW0U1PfqxnFnKpQmh', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção'],
            ['name' => 'Premium', 'url' => 'premium', 'slug' => 'yearly', 'price' => number_format(669.90, 2), 'price_currency'=> 'USD', 'stripe_id' => 'price_1Lb6kvGQW0U1PfqxQFJJcEBN', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção']
        ];


        foreach ($plans as $item) {
            Plan::create($item)->planFeatures()->create(['max_users' => 1]);
        }



        Course::factory()->create([
            'title' => "Space Exploration and Planetary Colonization: Towards a Multiplanetary Species",
            'thumbnail' => '/thumbnails/imageFakeElon.jpg'
        ])->each(function ($course) {
            // Module 1
            $module1 = Module::factory()->create([
                'title' => 'Introduction to Space Exploration',
                'course_id' => $course->id
            ]);

            $lessons = Lesson::factory()->create([
                'module_id' => $module1->id,
                'title' => 'Overview of Space Exploration',
                'video_url' => '/videos/curso_introducao.mp4',

            ]);
            // Module 2
            $module2 = Module::factory()->create([
                'title' => 'The Mission of SpaceX',
                'course_id' => $course->id
            ]);
            $lessons = Lesson::factory()->create([
                'module_id' => $module2->id,
                'title' => "Elon Musk's Vision for a Multiplanetary Species",
                'video_url' => '/videos/palestra_elon.mp4',
            ]);

            // Module 3
            $module3 = Module::factory()->create([
                'title' => 'Advanced Space Technologies',
                'course_id' => $course->id
            ]);
             $lessons = Lesson::factory()->create([
                'module_id' => $module3->id,
                'title' => "Reusable Rockets: The Future of Space Transportation",
                'video_url' => '/videos/palestra_elon1.mp4',

            ]);
            $lessons->each(function ($lesson) {
                $comments = Comment::factory()->count(2)->create([
                    'lesson_id' => $lesson->id,
                ]);

                $comments->each(function ($comment) {
                    Reply::factory()->count(2)->create([
                        'comment_id' => $comment->id,
                    ]);
                });
            });


        });




        Course::factory()->count(3)->create()->each(function ($curso) {
            $modulos = Module::factory()->count(5)->create(['course_id' => $curso->id]);

            $modulos->each(function ($modulo) {
                $aulas = Lesson::factory()->count(2)->create(['module_id' => $modulo->id]);

                $aulas->each(function ($aula) {
                    $comments = Comment::factory()->count(2)->create([
                        'lesson_id' => $aula->id,
                    ]);

                    $comments->each(function ($comment) {
                        Reply::factory()->count(3)->create([
                            'comment_id' => $comment->id,
                        ]);
                    });
                });

            });
        });


    }


}
