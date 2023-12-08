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
        if(!Schema::hasTable('tenanttable')){
            Schema::create('tenanttable',function(Blueprint $table){
                $table->id();
                $table->string('firstname');
                $table->string('lastname');
                $table->string('address');
                $table->string('state');
                $table->string('lga');
                $table->string('mobileno',50)->unique();
                $table->string('altmobileno');
                $table->string('email',200)->unique();
                $table->string('passcode',1000);
                $table->string('occupation');
                $table->string('status');
                $table->string('nextofkindetails',1000);
                $table->timestamps();
                
            });
        }
        }
    
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            //
            Schema::dropIfExists('tenanttable');
            
        }
};
