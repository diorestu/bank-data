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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->unsigned()->nullable();
            $table->string('nik', 20)->nullable();
            $table->string('nama', 200)->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('gender', ['Pria', 'Wanita'])->nullable();
            $table->string('tempat_lahir', 200)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->enum('agama', ['islam', 'hindu', 'buddha', 'kristen', 'katolik', 'konghucu'])->nullable();
            $table->string('alamat', 200)->nullable();
            $table->text('alamat_surat')->nullable();
            $table->string('hobby', 200)->nullable();
            $table->text('pendidikan')->nullable();
            $table->string('email', 200)->nullable();
            $table->string('telp', 50)->nullable();
            $table->double('tinggi', 3, 0)->nullable();
            $table->double('berat', 3, 0)->nullable();
            $table->text('pas_foto')->nullable();
            $table->enum('kawin', ['Kawin', 'Belum Kawin'])->nullable();
            $table->enum('tipe_cv', ['creative', 'ats', 'formal'])->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('resume_files', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->unsigned()->nullable();
            $table->text('url_file')->nullable();
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
        Schema::dropIfExists('resumes');
        Schema::dropIfExists('resume_files');
    }
};
