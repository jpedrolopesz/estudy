<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignIdColumnDefinition;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('setting', 'App\Support\Setting');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        require app_path('Support/helpers.php');

        Blueprint::macro('primaryKey', function () {
            $this->string('id');
            $this->primary('id');
        });

        Blueprint::macro('foreignKey', function ($name) {
            $this->string("{$name}");

            return new ForeignIdColumnDefinition($this, [
                'type' => 'string',
                'name' => $name,
                'autoIncrement' => false,
                'unsigned' => false,
            ]);
        });

        Blueprint::macro('morphFields', function ($name, $indexName = null) {
            $this->string("{$name}_id");
            $this->string("{$name}_type");
            $this->index(["{$name}_id", "{$name}_type"], $indexName);
        });
        Blueprint::macro('nullableMorphFields', function ($name, $indexName = null) {
            $this->string("{$name}_id")->nullable();
            $this->string("{$name}_type")->nullable();
            $this->index(["{$name}_id", "{$name}_type"], $indexName);
        });
        JsonResource::withoutWrapping();
        Model::preventLazyLoading(! app()->isProduction());
        Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
            $class = get_class($model);
            info("Attempted to lazy load {$relation} on model {$class}");
        });

        Password::default(fn () => Password::min(8)
            ->mixedCase()
            ->uncompromised()
        );
    }
}
