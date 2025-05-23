<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
        {
            Schema::table('reports', function (Blueprint $table) {
                $table->foreignId('trash_type_id')->nullable()->constrained('trash_types')->onDelete('set null');
            });
        }


    /**
     * Reverse the migrations.
     */
        public function down(): void
        {
            Schema::table('reports', function (Blueprint $table) {
                //
            });
        }
};
