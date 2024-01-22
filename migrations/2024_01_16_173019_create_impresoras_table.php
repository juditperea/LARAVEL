<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('impresoras', function (Blueprint $table) {
            $table->id();
            $table->string('papel');
            $table->integer('magenta');
            $table->integer('black');
            $table->integer('cyan');
            $table->integer('yellow');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('impresoras');
    }
    
};
