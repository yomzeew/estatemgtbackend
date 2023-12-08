<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasTable('propertytable')){
            Schema::create('propertytable', function (Blueprint $table) {
                $table->id();
                $table->integer('client_id');
                $table->string('client_name');
                $table->string('property_address');
                $table->string('category');
                $table->text('description');
                $table->decimal('rent_fees', 10, 2);
                $table->decimal('agent_fees', 10, 2);
                $table->string('agreement'); // Assuming it's a file path or URL
                $table->longText('images_base64')->nullable(); // Store base64 images as text (nullable in case there are no images)
    
                $table->timestamps();
            });
        }
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propertytable');
        //
    }
};
