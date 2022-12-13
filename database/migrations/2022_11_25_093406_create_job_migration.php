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
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('company_title', 160)->nullable();
            $table->string('company_description', 200)->nullable();
            $table->string('company_logo', 100)->nullable();
            $table->string('company_address', 160)->nullable();
            $table->string('company_city', 100)->nullable();
            $table->boolean('is_smartwork')->default(false);
            $table->timestamps();
        });

        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jobcat_id')->constrained('categories');
            $table->foreignId('company_id')->constrained('company');
            $table->string('job_title', 160)->nullable();
            $table->mediumText('job_description')->nullable();
            $table->mediumText('job_requirement')->nullable();
            $table->string('job_language', 100)->nullable();
            $table->text('job_img_post')->nullable();
            $table->enum('job_lokasi', ['onsite', 'remote', 'hybrid'])->nullable();
            $table->enum('job_kontrak', ['Freelance', 'Part-time', 'Full-time'])->nullable();
            $table->double('job_salary', 15, 0)->nullable();
            $table->double('job_experience', 3, 0)->nullable();
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
        Schema::drop('jobs');
        Schema::drop('company');
    }
};
