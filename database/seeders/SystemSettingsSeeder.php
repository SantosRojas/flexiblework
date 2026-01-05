<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SystemSetting::set('max_home_office_days', 2,1);
        SystemSetting::set('max_people_per_day', 7,1);
        SystemSetting::set('daily_work_minutes', 576,1);

    }
}
