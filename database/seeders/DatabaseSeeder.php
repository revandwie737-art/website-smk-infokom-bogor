<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SchoolSettingSeeder::class,
            UserSeeder::class,
            ProgramSeeder::class,
            CategorySeeder::class,
            ClassSeeder::class,
            ClassMemberSeeder::class,
            ScheduleSeeder::class,
            XiiRpl2ScheduleTeacherSeeder::class,
            TeacherSeeder::class,
            NewsSeeder::class,
            AchievementSeeder::class,
            GallerySeeder::class,
            FacilitySeeder::class,
            PklPartnerSeeder::class,
            PartnerSeeder::class,
            ExtracurricularSeeder::class,
            AnnouncementSeeder::class,
            EventSeeder::class,
        ]);
    }
}
