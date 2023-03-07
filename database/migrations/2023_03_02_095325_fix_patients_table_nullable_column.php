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
        Schema::table('patients', function($table) {
            $table->date('birth_date')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->string('national_number')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->text('address')->nullable()->change();
            $table->string('nationality')->nullable()->change();
            $table->string('languages_spoken_at_home')->nullable()->change();
            $table->text('follow_up_reasons')->nullable()->change();
            $table->string('school')->nullable()->change();
            $table->string('school_year')->nullable()->change();
            $table->string('mutuality')->nullable()->change();
            $table->text('family')->nullable()->change();
            $table->text('medical_background')->nullable()->change();
            $table->text('educational_background')->nullable()->change();
            $table->text('hobbies')->nullable()->change();
            $table->text('contacts')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
