<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('doclink'); //link of the filed form
            $table->foreignId('filer_user_id')->nullable();
            $table->foreignId('archiver_user_id')->nullable();
            $table->foreignId('doctype_id')->nullable();
            $table->integer('approval_status')->nullable(); //0 - on process, 1 - approved, 2 - disapproved, 3 - cancelled by filer, 4 - cancelled by approver
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
