<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseMaterial;
use App\Models\CourseSchedule;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'category_id' => 1,
                'instructor_id' => 1,
                'title' => 'Piano untuk Pemula',
                'slug' => 'piano-untuk-pemula',
                'description' => 'Belajar piano dari dasar: notasi, teknik tangan, dan lagu sederhana.',
                'type' => 'online',
                'price' => 250000,
                'thumbnail' => 'courses/piano.jpg',
            ],
            [
                'category_id' => 1, 'instructor_id' => 1,
                'title' => 'Teknik Vokal Modern', 'slug' => 'teknik-vokal-modern',
                'description' => 'Latihan vokal untuk meningkatkan jangkauan suara dan kontrol nada.',
                'type' => 'offline', 'price' => 350000,
                'thumbnail' => 'courses/vocal.jpg',
            ],
            [
                'category_id' => 2, 'instructor_id' => 2,
                'title' => 'Fotografi Smartphone', 'slug' => 'fotografi-smartphone',
                'description' => 'Hasilkan foto profesional hanya dengan smartphone Anda.',
                'type' => 'online', 'price' => 150000,
                'thumbnail' => 'courses/photography.jpg',
            ],
            [
                'category_id' => 3, 'instructor_id' => 3,
                'title' => 'Pastry & Baking Dasar', 'slug' => 'pastry-baking-dasar',
                'description' => 'Dasar-dasar membuat kue, roti, dan pastry untuk pemula.',
                'type' => 'offline', 'price' => 450000,
                'thumbnail' => 'courses/pastry.jpg',
            ],
            [
                'category_id' => 4, 'instructor_id' => 4,
                'title' => 'Lukis Akrilik untuk Pemula', 'slug' => 'lukis-akrilik-pemula',
                'description' => 'Eksplorasi teknik lukis akrilik dari dasar hingga mahir.',
                'type' => 'online', 'price' => 200000,
                'thumbnail' => 'courses/painting.jpg',
            ],
            [
                'category_id' => 5, 'instructor_id' => 5,
                'title' => 'Web Development Fundamental', 'slug' => 'web-development-fundamental',
                'description' => 'Belajar HTML, CSS, dan JavaScript untuk menjadi web developer.',
                'type' => 'online', 'price' => 300000,
                'thumbnail' => 'courses/web-dev.jpg',
            ],
            [
                'category_id' => 6, 'instructor_id' => 6,
                'title' => 'Kriya Tekstil Tradisional', 'slug' => 'kriya-tekstil-tradisional',
                'description' => 'Membuat karya tekstil dengan teknik tradisional Nusantara.',
                'type' => 'offline', 'price' => 275000,
                'thumbnail' => 'courses/textile.jpg',
            ],
        ];

        foreach ($courses as $data) {
            $course = Course::create($data);

            if ($course->type === 'online') {
                CourseMaterial::create([
                    'course_id' => $course->id,
                    'title' => 'Pengenalan',
                    'file_path' => 'materials/intro.mp4',
                    'sequence_order' => 1,
                ]);
                CourseMaterial::create([
                    'course_id' => $course->id,
                    'title' => 'Materi Inti',
                    'file_path' => 'materials/core.mp4',
                    'sequence_order' => 2,
                ]);
                CourseMaterial::create([
                    'course_id' => $course->id,
                    'title' => 'Latihan & Evaluasi',
                    'file_path' => 'materials/practice.mp4',
                    'sequence_order' => 3,
                ]);
            }

            if ($course->type === 'offline') {
                CourseSchedule::create([
                    'course_id' => $course->id,
                    'date' => now()->addDays(7)->format('Y-m-d'),
                    'start_time' => '09:00:00',
                    'end_time' => '12:00:00',
                    'location_name' => 'Studio Kursus Hobi - Jakarta',
                    'google_maps_link' => 'https://maps.google.com/?q=Jakarta',
                    'quota' => 20,
                ]);
            }
        }
    }
}