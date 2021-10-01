<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumenttrailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documenttrails', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('document_id')->nullable();
            $table->integer('approver_sequence')->nullable();
            $table->foreignId('approver_user_id')->nullable();
            $table->integer('approval_status')->nullable(); //0 - on process, 1 - approved, 2 - disapproved, 3 - cancelled by filer, 4 - cancelled by approver
            $table->integer('is_viewing')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documenttrails');
    }
}
