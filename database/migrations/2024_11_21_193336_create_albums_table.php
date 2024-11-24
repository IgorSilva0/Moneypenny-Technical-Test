<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->integer('artist_id'); // Artist ID
            $table->string('artist_twitter'); // Artist Twitter
            $table->string('artist_name'); // Artist name
            $table->string('name'); // Album name
            $table->timestamps(); // Created at & Updated at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
