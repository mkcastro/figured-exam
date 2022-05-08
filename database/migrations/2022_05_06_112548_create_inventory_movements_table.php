<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('product_id')
                // ! default to first product since imcomming data has no product id
                ->default(1)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->date('transacted_at')->unique();
            $table->char('type', 1);
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('price')->nullable();
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
        Schema::dropIfExists('inventory_movements');
    }
};
