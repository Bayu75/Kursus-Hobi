<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = [
            ['name' => 'Rina Wijaya', 'expertise' => 'Piano & Vokal', 'bio' => 'Musisi profesional dengan pengalaman 10 tahun di bidang pendidikan musik.'],
            ['name' => 'Bambang Setiawan', 'expertise' => 'Fotografi Digital', 'bio' => 'Fotografer komersial yang telah menangani berbagai brand nasional.'],
            ['name' => 'Siska Dewi', 'expertise' => 'Pastry & Baking', 'bio' => 'Chef pastry lulusan Perancis dengan spesialisasi kue tradisional modern.'],
            ['name' => 'Dimas Pratama', 'expertise' => 'Lukis Akrilik', 'bio' => 'Seniman lukis yang karyanya telah dipamerkan di berbagai galeri nasional.'],
            ['name' => 'Aulia Rahman', 'expertise' => 'Web Development', 'bio' => 'Full-stack developer dengan pengalaman 8 tahun di industri teknologi.'],
            ['name' => 'Maya Sari', 'expertise' => 'Kriya Tekstil', 'bio' => 'Pengrajin tekstil yang memadukan teknik tradisional dengan desain kontemporer.'],
        ];

        foreach ($instructors as $instructor) {
            Instructor::create($instructor);
        }
    }
}
