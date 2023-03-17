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
        Schema::table('program_desa', function (Blueprint $table) {
            $table->decimal('anggaran', 15, 2)->nullable();
            $table->string('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('program_desa', function (Blueprint $table) {
            $table->dropColumn('anggaran');
            $table->dropColumn('foto');
        });
    }
};
