<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocapprovalguidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docapprovalguides', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('doctype_id')->nullable();
            $table->integer('approver_sequence')->nullable();
            $table->foreignId('approver_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docapprovalguides');
    }
}
