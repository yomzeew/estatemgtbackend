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
        //
        if (!Schema::hasTable('propertytotenant')) {
            Schema::create('propertytotenant', function (Blueprint $table) {
                $table->id();
                $table->integer('tenant_id');
                $table->integer('property_id'); // Assuming it's an integer referencing the property table
                $table->decimal('rent_fees', 10, 2);
                $table->decimal('agent_fees', 10, 2);
                $table->decimal('agreement',10,2); // Assuming it's a file path or URL
                $table->decimal('total_fees',10,2);
                $table->string('payment_status');
                $table->date('payment_date');
                $table->timestamps();
            });
        }
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propertytotenant');
        
        //
    }
};
