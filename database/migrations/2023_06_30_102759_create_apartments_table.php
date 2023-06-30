<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('image')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('rooms')->index();
            $table->tinyInteger('bathrooms')->index();
            $table->tinyInteger('beds')->index();
            $table->smallInteger('square_meters')->index()->nullable();
            $table->string('address')->index();
            $table->decimal('latitude', 15, 12, true);
            $table->decimal('longitude', 15, 12, true);
            $table->boolean('visibility')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
};
