<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studios', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->foreignIdFor(\App\Models\Branch::class);
            $table->decimal("basic_price", 13, 2)->min("1")->max("10000000");
            $table->decimal("additional_friday_price", 13, 2)->min("0")->max("10000000");
            $table->decimal("additional_saturday_price", 13, 2)->min("0")->max("10000000");
            $table->decimal("additional_sunday_price", 13, 2)->min("0")->max("10000000");
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
        Schema::dropIfExists('studios');
    }
}
