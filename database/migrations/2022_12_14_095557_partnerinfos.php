<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partnerinfos', function (Blueprint $table) {
            $table->id('partner_id');
            $table->integer('portal_id');
            $table->string('partner_name');
            $table->string('engagement_lead');
            $table->enum('partner_status', ['y', 'n']);
            $table->string('password');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partnerinfos');
    }
};
