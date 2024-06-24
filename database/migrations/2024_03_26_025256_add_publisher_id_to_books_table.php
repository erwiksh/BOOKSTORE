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
        Schema::table('buku', function (Blueprint $table) {
            $table->unsignedBigInteger('penerbit_id');
            $table->foreign('penerbit_id')->references('id')->on('penerbit')->onDelete('cascade')->onUpdate('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buku', function (Blueprint $table) {
            // Disable foreign key constraints to drop the column
            Schema::disableForeignKeyConstraints();
            $table->dropForeign(['penerbit_id']); // Drop foreign key constraint
            $table->dropColumn('penerbit_id');
            Schema::enableForeignKeyConstraints(); // Re-enable foreign key constraints
        });
    }
};

