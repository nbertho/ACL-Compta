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
            $table->string('phone');
            $table->text('address');
            $table->string('nationality');
            $table->string('languages_spoken_at_home');
            $table->text('follow_up_reasons');
            $table->string('school');
            $table->string('school_year');
            $table->string('mutuality');
            $table->text('family');
            $table->text('medical_background');
            $table->text('educational_background');
            $table->text('hobbies');
            $table->text('contacts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function($table) {
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('nationality');
            $table->dropColumn('languages_spoken_at_home');
            $table->dropColumn('follow_up_reasons');
            $table->dropColumn('school');
            $table->dropColumn('school_year');
            $table->dropColumn('mutuality');
            $table->dropColumn('family');
            $table->dropColumn('medical_background');
            $table->dropColumn('educational_background');
            $table->dropColumn('hobbies');
            $table->dropColumn('contacts');
        });
    }
};
