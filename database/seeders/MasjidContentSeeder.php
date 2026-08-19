<?php

namespace Database\Seeders;

use App\Models\CommitteeMember;
use App\Models\DocumentationPhoto;
use App\Models\DonationProgram;
use App\Models\DonationTransaction;
use App\Models\Event;
use App\Models\Facility;
use App\Models\FinancialReport;
use App\Models\GalleryPhoto;
use App\Models\VenueInquiry;
use App\Models\VenuePage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasjidContentSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedFacilities();
        $this->seedCommitteeMembers();
        // $this->seedDonationPrograms();
        // $this->seedFinancialReports();
        $this->seedEvents();
        // $this->seedVenueInquiries();
        $this->seedGalleryPhotos();
        $this->seedVenuePage();
    }

    private function seedFacilities(): void
    {
        $facilities = [
            ['name' => 'Halaman dan Teras Depan', 'photo' => 'facilities/01M0CQ2ENVEQ1WQYZE5AQM257E.jpg', 'description' => ''],
            ['name' => 'Parkiran Utama', 'photo' => 'facilities/01M0CQYYDATZX1SYKX2APKBRJK.jpg', 'description' => ''],
            ['name' => 'Taman dan Kolam Masjid', 'photo' => 'facilities/01M0CQ3E3PVMX3QJS7XZSQH757.jpg', 'description' => ''],
            ['name' => 'Tempat Jamaah Laki-laki', 'photo' => 'facilities/01M0CQBN9Z92DPB8KC69WCRGA7.jpg', 'description' => ''],
            ['name' => 'Tempat Jamaah Perempuan', 'photo' => 'facilities/01M0CQCASWABEETW67AYWWZT7W.jpg', 'description' => ''],
            ['name' => 'Tempat Wudhu Laki-laki (Luar)', 'photo' => 'facilities/01M0CQD8CBYZ8W04MTY14KZ4WS.jpg', 'description' => ''],
            ['name' => 'Tempat Wudhu Perempuan (depan)', 'photo' => 'facilities/01M0CQET8624HXDET63JPCTWPM.jpg', 'description' => ''],
            ['name' => 'Tempat Wudhu Laki-laki (Belakang)', 'photo' => 'facilities/01M0CQG09YTAADQE878R8HS78W.jpg', 'description' => ''],
            ['name' => 'Tempat Wudhu Perempuan (Belakang)', 'photo' => 'facilities/01M0CQGWCMTSMZJS4SD5D7M1X3.jpg', 'description' => ''],
            ['name' => 'Parkiran Belakang', 'photo' => 'facilities/01M0CQNYNXE3NP5K5NHG5JP3CR.jpg', 'description' => ''],
            ['name' => 'Ruang Masjid Lantai 2', 'photo' => 'facilities/01M0CQRCJTJA6SK8KBFXWE43GQ.jpg', 'description' => ''],
            ['name' => 'Perpustakaan Masjid', 'photo' => 'facilities/01M0CQX64RWA3WECA9CM5AMP90.jpg', 'description' => ''],
            ['name' => 'Alat Sholat', 'photo' => 'facilities/01M0CQYDFZDKQV8J67PK0MKW92.jpg', 'description' => ''],
        ];

        foreach ($facilities as $index => $facility) {
            Facility::factory()->create([
                'name' => $facility['name'],
                'description' => $facility['description'],
                'photo' =>  $facility['photo'],
                'order' => $index,
            ]);
        }
    }

    private function seedCommitteeMembers(): void
    {
        $members = [
            ['name' => 'Suhartono, S.Pd', 'position' => 'Ketua Takmir'],
            ['name' => 'Tyas Hidayatulloh, S.Pd, M.Pd', 'position' => 'Sekretaris'],
        ];

        foreach ($members as $index => $member) {
            CommitteeMember::factory()->create([
                'name' => $member['name'],
                'position' => $member['position'],
                'photo' => "https://picsum.photos/seed/committee-{$index}/400/400",
                'order' => $index,
            ]);
        }
    }

    private function seedDonationPrograms(): void
    {
        $programs = [
            [
                'name' => 'Wakaf Pembangunan Masjid',
                'description' => 'Program wakaf untuk pembangunan dan renovasi fasilitas Masjid Nurul Huda Ambulu, mencakup pemavingan halaman parkir, taman, tempat wudhu, teras masjid, dan payung Nabawi.',
                'target_amount' => 1_175_600_000,
                'starts_at' => now()->subMonths(6),
                'ends_at' => now()->addYear(),
                'transactions' => 20,
            ],
            [
                'name' => 'Renovasi Atap Masjid',
                'target_amount' => 50_000_000,
                'starts_at' => now()->subWeeks(3),
                'ends_at' => now()->addMonths(2),
                'transactions' => 8,
            ],
            [
                'name' => 'Santunan Anak Yatim',
                'target_amount' => 20_000_000,
                'starts_at' => now()->subMonths(2),
                'ends_at' => now()->addMonth(),
                'transactions' => 12,
            ],
            [
                'name' => 'Pembangunan Perpustakaan',
                'target_amount' => 15_000_000,
                'starts_at' => now()->subMonth(),
                'ends_at' => now()->subDays(3),
                'transactions' => 3,
            ],
            [
                'name' => 'Wakaf Al-Quran',
                'target_amount' => 10_000_000,
                'starts_at' => now()->addWeek(),
                'ends_at' => now()->addMonths(3),
                'transactions' => 0,
            ],
        ];

        foreach ($programs as $index => $program) {
            $attributes = [
                'name' => $program['name'],
                'slug' => str($program['name'])->slug(),
                'target_amount' => $program['target_amount'],
                'cover_photo' => "https://picsum.photos/seed/donation-{$index}/800/450",
                'starts_at' => $program['starts_at'],
                'ends_at' => $program['ends_at'],
            ];

            if (isset($program['description'])) {
                $attributes['description'] = $program['description'];
            }

            $donationProgram = DonationProgram::factory()->create($attributes);

            DonationTransaction::factory($program['transactions'])->create([
                'donation_program_id' => $donationProgram->id,
            ]);

            // Hanya program pertama diberi galeri dokumentasi, sisanya sengaja kosong
            // untuk menguji carousel tersembunyi otomatis saat tidak ada foto.
            if ($index === 0) {
                $this->attachDocumentationPhotos($donationProgram, 'wakaf-progres', 6);
            }
        }
    }

    private function seedFinancialReports(): void
    {
        $categories = [
            'income' => ['Infaq Jumat', 'Donasi Umum', 'Zakat'],
            'expense' => ['Listrik', 'Kebersihan', 'Gaji Marbot', 'Perawatan Gedung'],
        ];

        foreach (range(0, 5) as $monthsAgo) {
            $period = now()->subMonths($monthsAgo);

            foreach ($categories as $type => $categoryList) {
                foreach ($categoryList as $category) {
                    FinancialReport::factory()->create([
                        'period_month' => $period->month,
                        'period_year' => $period->year,
                        'type' => $type,
                        'category' => $category,
                    ]);
                }
            }
        }
    }

    private function seedEvents(): void
    {
        $kajianRutin = [
            ['title' => 'KAJIAN MALAM ILMU & IMAN', 'speaker' => 'Ust. Hadi Santoso', 'day_of_week' => 5, 'poster' => 'https://s3.nurul-huda.ambulu.or.id/events/kajian-malam-ilmu-iman/01M08259H61EQF563WADR8V0C2.jpg', 'description' => '<p>Materi Aqidah Tauhid Kitab Ummul Barahin, Karya Imam Sanusi<br>Diawali salat Maghrib berjamaah</p>'],
            ['title' => 'KAJIAN MALAM ILMU & IMAN', 'speaker' => 'Ust. Tyas Hidayatulloh, M.Pd', 'day_of_week' => 5, 'poster' => 'https://s3.nurul-huda.ambulu.or.id/events/kajian-malam-ilmu-iman/01M0825TZHZX7YQGYFBRB9TQHF.jpg', 'description' => '<p>Materi Tafsir Kitab Al Azhar, Karya Buya Hamka<br>Diawali salat Maghrib berjamaah</p>'],
            ['title' => 'KAJIAN MALAM ILMU & IMAN', 'speaker' => 'Ust. Affan Kamal Mubarok, B.S., M.A.', 'day_of_week' => 5, 'poster' => 'https://s3.nurul-huda.ambulu.or.id/events/kajian-malam-ilmu-iman/01M0828PZCVCYVYD68218XEYJX.jpg', 'description' => '<p>Materi Shirah Kitab Asy-Syamail Al-Muhammadiyah, Karya Imam Tirmidzi<br>Diawali salat Maghrib berjamaah</p>'],
            ['title' => 'KAJIAN MALAM ILMU & IMAN', 'speaker' => 'Ust. Nurhadi Amin, S.Ag', 'day_of_week' => 5, 'poster' => 'https://s3.nurul-huda.ambulu.or.id/events/kajian-malam-ilmu-iman/01M08295CAE327Y0C2JDVN41EY.jpg', 'description' => '<p>Materi Fiqh Kitab Bidayatul Mujtahid, Karya Ibnu Rusyd<br>Diawali salat Maghrib berjamaah</p>'],
        ];

        foreach ($kajianRutin as $index => $kajian) {
            $event = Event::factory()->create([
                'title' => $kajian['title'],
                'type' => 'kajian',
                'speaker' => $kajian['speaker'],
                'day_of_week' => $kajian['day_of_week'],
                'time' => null,
                'poster' => $kajian['poster'],
                'event_date' => null,
                'description' => $kajian['description'],
            ]);
        }
    }

    private function attachDocumentationPhotos(DonationProgram|Event|Facility|VenuePage $model, string $seedPrefix, int $count): void
    {
        foreach (range(0, $count - 1) as $index) {
            DocumentationPhoto::factory()->create([
                'photoable_type' => $model::class,
                'photoable_id' => $model->id,
                'photo' => "https://picsum.photos/seed/{$seedPrefix}-{$index}/900/600",
                'order' => $index,
            ]);
        }
    }

    private function seedVenueInquiries(): void
    {
        VenueInquiry::factory()->create([
            'name' => 'Budi & Siti',
            'planned_date' => now()->addMonths(2),
            'note' => 'Rencana akad nikah, perkiraan 100 tamu.',
            'status' => 'pending',
        ]);

        VenueInquiry::factory()->create([
            'name' => 'Andi & Rina',
            'planned_date' => now()->addWeeks(6),
            'note' => 'Akad nikah keluarga besar.',
            'status' => 'confirmed',
        ]);

        VenueInquiry::factory()->create([
            'name' => 'Eko & Dewi',
            'planned_date' => now()->subWeek(),
            'note' => null,
            'status' => 'completed',
        ]);
    }

    private function seedVenuePage(): void
    {
        $venuePage = VenuePage::factory()->create([
            'hero_title' => 'Akad Nikah di Aula Serbaguna',
            'hero_subtitle' => 'Rayakan momen sakral Anda di tempat yang teduh, penuh berkah, dan siap menampung hingga 150 tamu undangan.',
            'availability_badge' => 'Terbuka untuk Pemesanan',
            'description_title' => 'Aula Serbaguna',
            'description' => 'Aula dengan kapasitas hingga 150 tamu, dilengkapi pendingin ruangan, sound system, area parkir luas, dan tempat wudhu terpisah untuk pria dan wanita. Cocok untuk resepsi akad nikah dalam suasana khidmat, dikelilingi kesejukan lingkungan masjid.',
            'testimonial' => 'Menikah di rumah Allah adalah awal yang penuh berkah — semoga setiap akad yang berlangsung di sini menjadi fondasi rumah tangga sakinah, mawaddah, wa rahmah.',
            'wa_number' => '6285335104803',
            'facilities' => [
                ['icon' => 'user-group', 'label' => 'Hingga 150 Tamu'],
                ['icon' => 'sun', 'label' => 'Pendingin Ruangan'],
                ['icon' => 'musical-note', 'label' => 'Sound System'],
                ['icon' => 'truck', 'label' => 'Area Parkir Luas'],
                ['icon' => 'sparkles', 'label' => 'Wudhu Terpisah'],
                ['icon' => 'check-circle', 'label' => 'Suasana Khidmat'],
            ],
        ]);

        $this->attachDocumentationPhotos($venuePage, 'aula-serbaguna', 6);
    }

    private function seedGalleryPhotos(): void
    {
        $photos = [
            'Sholat Jumat berjamaah',
            'Kajian rutin malam Senin',
            'Kegiatan TPA anak-anak',
            'Renovasi tempat wudhu',
            'Buka puasa bersama jamaah',
            'Peringatan Maulid Nabi',
            'Gotong royong kebersihan masjid',
            'Santunan anak yatim',
        ];

        foreach ($photos as $index => $caption) {
            GalleryPhoto::factory()->create([
                'photo' => "https://picsum.photos/seed/masjid-gallery-{$index}/800/600",
                'caption' => $caption,
                'order' => $index,
            ]);
        }
    }
}
