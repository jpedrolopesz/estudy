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
            ['name' => 'Gold', 'url' => 'gold', 'slug' => 'monthly', 'price' => 990, 'stripe_id' => 'price_1LSRHkGQW0U1PfqxJO7EGsHx', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção gráfica'],
            ['name' => 'Gold', 'url' => 'gold', 'slug' => 'yearly', 'price' => 9990, 'stripe_id' => 'price_1LTBIAGQW0U1Pfqxdr82APbW', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção gráficas'],
            ['name' => 'Diamond', 'url' => 'diamond', 'slug' => 'monthly', 'price' => 3990, 'stripe_id' => 'price_1LSmsIGQW0U1PfqxxsV7db73', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção'],
            ['name' => 'Diamond', 'url' => 'diamond', 'slug' => 'yearly', 'price' => 33990, 'stripe_id' => 'price_1Lb6p6GQW0U1PfqxjKs6uVX2', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção'],
            ['name' => 'Premium', 'url' => 'premium', 'slug' => 'monthly', 'price' => 6990, 'stripe_id' => 'price_1LSRIVGQW0U1PfqxnFnKpQmh', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção'],
            ['name' => 'Premium', 'url' => 'premium', 'slug' => 'yearly', 'price' => 66990, 'stripe_id' => 'price_1Lb6kvGQW0U1PfqxQFJJcEBN', 'description' => 'A expressão Lorem ipsum em design gráfico e editoração é um texto padrão em latim utilizado na produção']
        ];

        foreach ($plans as $item) {
            Plan::create($item)->planFeatures()->create(['max_users' => 2]);
        }



        Course::factory()->create([
            'title' => "Space Exploration and Planetary Colonization: Towards a Multiplanetary Species",
            'thumbnail' => '/thumbnails/imageFakeElon.jpg'
            ])->each(function ($course) {
            // Module 1
            Module::factory()->create([
                'title' => 'Introduction to Space Exploration',
                'course_id' => $course->id
            ])->each(function ($module) {
                Lesson::factory()->create([
                    'module_id' => $module->id,
                    'title' => 'Overview of Space Exploration',
                ]);
                Lesson::factory()->create([
                    'module_id' => $module->id,
                    'title' => 'Historical Milestones in Space Exploration',
                ]);
                Lesson::factory()->create([
                    'module_id' => $module->id,
                    'title' => 'Challenges of Space Exploration'
                ]);
            });
            // Module 2
            Module::factory()->create([
                'title' => 'The Mission of SpaceX',
                'course_id' => $course->id
            ])->each(function ($module) {
                Lesson::factory()->create([
                    'module_id' => $module->id,
                    'title' => "Elon Musk's Vision for a Multiplanetary Species"
                ]);
                Lesson::factory()->create([
                    'module_id' => $module->id,
                    'title' => 'The History and Achievements of SpaceX'
                ]);
                Lesson::factory()->create([
                    'module_id' => $module->id,
                    'title' => 'The Future Plans of SpaceX'
                ]);
            });
            // Module 3
            Module::factory()->create([
                'title' => 'Advanced Space Technologies',
                'course_id' => $course->id
            ])->each(function ($module) {
                Lesson::factory()->create([
                    'module_id' => $module->id,
                    'title' => "Reusable Rockets: The Future of Space Transportation"
                ]);
                Lesson::factory()->create([
                    'module_id' => $module->id,
                    'title' => 'The Falcon Heavy Revolution'
                ]);
                Lesson::factory()->create([
                    'module_id' => $module->id,
                    'title' => 'Starship: The Next Generation of Spacecraft'
                ]);
            });
            // Module 4
            Module::factory()->create([
                'title' => 'Mars Colonization',
                'course_id' => $course->id
            ])->each(function ($module) {
                Lesson::factory()->create([
                    'module_id' => $module->id,
                    'title' => "Why Mars is a Candidate for Colonization"
                ]);
                Lesson::factory()->create([
                    'module_id' => $module->id,
                    'title' => 'Challenges of Mars Colonization'
                ]);
                Lesson::factory()->create([
                    'module_id' => $module->id,
                    'title' => 'Preparing to Live on Mars'
                ]);
            });

            // Module 5
            Module::factory()->create([
                'title' => 'Life Beyond Earth',
                'course_id' => $course->id
            ])->each(function ($module) {
                Lesson::factory()->create([
                    'module_id' => $module->id,
                    'title' => "The Search for Extraterrestrial Life"
                ]);
                Lesson::factory()->create([
                    'module_id' => $module->id,
                    'title' => 'Exoplanets: Other Potentially Habitable Worlds'
                ]);
                Lesson::factory()->create([
                    'module_id' => $module->id,
                    'title' => 'The Significance of Discovering Life Beyond Earth'
                ]);
            });



        });


        Course::factory()->count(4)->create()->each(function ($curso) {
            $modulos = Module::factory()->count(5)->create(['course_id' => $curso->id]);

            $modulos->each(function ($modulo) {
                $aulas = Lesson::factory()->count(3)->create(['module_id' => $modulo->id]);

                $aulas->each(function ($aula) {
                    $comments = Comment::factory()->count(3)->create([
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
