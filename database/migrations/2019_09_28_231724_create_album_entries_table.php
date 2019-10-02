<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumEntriesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('album_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('album_id');
            $table->unsignedBigInteger('entry_id');
            $table->string('entry_type');
            $table->integer('order')->unsigned();
            $table->timestamps();
            
            $table->foreign('album_id')->references('id')
                ->on('albums')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('album_entries');
    }
}
