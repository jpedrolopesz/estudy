<?php

use App\Models\Plan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->unsignedInteger('max_users')->nullable();
            $table->timestamps();
        });

        Schema::table('plan_features', function (Blueprint $table) {
            $table->dropForeign('plan_features_plan_id_foreign');
        });

        Schema::table('plan_features', function (Blueprint $table) {
            $table->foreign('plan_id')->references('id')->on('plans')->cascadeOnDelete();
        });
    }

}
