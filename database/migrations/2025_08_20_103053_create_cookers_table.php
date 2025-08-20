<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cookers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id'); // link to client

            $table->string('cooker_name'); // restaurant name
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('phone'); // required

            $table->decimal('admin_commission', 5, 2)->default(0.00);
            $table->boolean('active')->default(true);
            $table->boolean('available_for_delivery')->default(true);
            $table->decimal('rating', 3, 2)->default(0.00);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cookers');
    }
};
