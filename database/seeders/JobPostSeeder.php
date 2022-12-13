<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i++) {
            $cat = Category::inRandomOrder()->first();
            Job::create([
                'jobcat_id' => $cat->id,
                'company_id' => rand(1, 4),
                'job_title' => $cat->title,
                'job_description' => 'Description',
                'job_requirement' => 'Requirement',
                'job_language' => 'Bahasa',
                'job_img_post' => '',
                'job_lokasi' => 'onsite',
                'job_kontrak' => 'Full-time',
                'job_salary' => rand(1800000, 5500000),
                'job_experience' => rand(0, 3),
            ]);
        }
    }
}
