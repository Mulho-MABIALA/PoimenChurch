<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Seed the schedules table with the church's worship times.
     */
    public function run(): void
    {
        $schedules = [
            [
                'title' => 'Culte du Dimanche',
                'description' => 'Service principal de louange et d\'adoration',
                'day_of_week' => 'sunday',
                'start_time' => '09:00',
                'end_time' => null,
                'location' => 'Rue GY-113,132, Dakar',
                'icon' => 'sun',
                'icon_color' => 'primary',
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Étude Biblique',
                'description' => 'Approfondissement de la Parole de Dieu',
                'day_of_week' => 'wednesday',
                'start_time' => '18:00',
                'end_time' => null,
                'location' => 'Rue GY-113,132, Dakar',
                'icon' => 'book',
                'icon_color' => 'gold',
                'is_featured' => true,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Prière Matinale',
                'description' => 'Moment de prière et d\'intercession',
                'day_of_week' => 'friday',
                'start_time' => '05:30',
                'end_time' => null,
                'location' => 'Rue GY-113,132, Dakar',
                'icon' => 'heart',
                'icon_color' => 'blue',
                'is_featured' => true,
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($schedules as $schedule) {
            Schedule::updateOrCreate(
                ['title' => $schedule['title']],
                $schedule
            );
        }
    }
}
