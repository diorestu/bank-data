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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('category_id')->constrained('categories');
            $table->string('nik', 20)->nullable();
            $table->string('nama', 200)->nullable();
            $table->enum('gender', ['Pria', 'Wanita'])->nullable();
            $table->string('tempat_lahir', 200)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->enum('agama', ['islam', 'hindu', 'buddha', 'kristen', 'katolik', 'konghucu'])->nullable();
            $table->string('alamat', 200)->nullable();
            $table->text('alamat_surat')->nullable();
            $table->string('pendidikan', 100)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('telp', 50)->nullable();
            $table->double('tinggi', 3, 0)->nullable();
            $table->double('berat', 3, 0)->nullable();
            $table->string('bpjs', 30)->nullable();
            $table->string('bpjstk', 30)->nullable();
            $table->text('cv')->nullable();
            $table->text('ktp')->nullable();
            $table->text('pas_foto')->nullable();
            $table->enum('kawin', ['Kawin', 'Belum Kawin'])->nullable();
            $table->enum('pekerjaan', ['aktif', 'nonaktif', 'pensiun'])->nullable();
            $table->enum('status', ['appointment', 'interviewed', 'approved', 'reject'])->default('appointment');
            $table->date('approved_at')->nullable();
            $table->string('lokasi_kerja', 160)->nullable();
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
};
