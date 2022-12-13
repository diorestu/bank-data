<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'company_title'       => 'PT Asta Nadi Karya Utama',
            'company_description' => 'Company',
            'company_logo'        => '',
            'company_address'     => 'Denpasar',
            'company_city'        => 'Denpasar',
            'is_smartwork'        => 1,
        ]);
        Company::create([
            'company_title'       => 'CV Fenny',
            'company_description' => 'Company',
            'company_logo'        => '',
            'company_address'     => 'Denpasar',
            'company_city'        => 'Denpasar',
            'is_smartwork'        => 1,
        ]);
        Company::create([
            'company_title'       => 'PT Bonofactum Jewelry',
            'company_description' => 'Company',
            'company_logo'        => '',
            'company_address'     => 'Denpasar',
            'company_city'        => 'Denpasar',
            'is_smartwork'        => 1,
        ]);
        Company::create([
            'company_title'       => 'PT Mitra Tangguh Persada',
            'company_description' => 'Company',
            'company_logo'        => '',
            'company_address'     => 'Denpasar',
            'company_city'        => 'Denpasar',
            'is_smartwork'        => 1,
        ]);
    }
}
