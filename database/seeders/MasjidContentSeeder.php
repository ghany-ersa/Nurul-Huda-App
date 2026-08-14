<?php

namespace Database\Seeders;

use App\Models\CommitteeMember;
use App\Models\DonationProgram;
use App\Models\DonationTransaction;
use App\Models\Event;
use App\Models\Facility;
use App\Models\FinancialReport;
use App\Models\VenueInquiry;
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
        $this->seedDonationPrograms();
        $this->seedFinancialReports();
        $this->seedEvents();
        $this->seedVenueInquiries();
    }

    private function seedFacilities(): void
    {
        $facilities = [
            ['name' => 'Ruang Sholat Utama', 'description' => 'Ruang sholat utama berkapasitas 500 jamaah dengan pendingin ruangan.'],
            ['name' => 'Tempat Wudhu', 'description' => 'Tempat wudhu terpisah untuk jamaah pria dan wanita.'],
            ['name' => 'Perpustakaan', 'description' => 'Koleksi buku-buku islami dan referensi kajian.'],
            ['name' => 'Ruang TPA', 'description' => 'Ruang belajar mengaji untuk anak-anak.'],
            ['name' => 'Aula Serbaguna', 'description' => 'Aula untuk kegiatan akad nikah, kajian besar, dan acara masjid.'],
            ['name' => 'Area Parkir', 'description' => 'Area parkir luas untuk mobil dan motor jamaah.'],
        ];

        foreach ($facilities as $index => $facility) {
            Facility::factory()->create([
                'name' => $facility['name'],
                'description' => $facility['description'],
                'photo' => "https://picsum.photos/seed/facility-{$index}/800/600",
                'order' => $index,
            ]);
        }
    }

    private function seedCommitteeMembers(): void
    {
        $members = [
            ['name' => 'H. Ahmad Fauzi', 'position' => 'Ketua Takmir'],
            ['name' => 'Muhammad Ridwan', 'position' => 'Sekretaris'],
            ['name' => 'Abdullah Hakim', 'position' => 'Bendahara'],
            ['name' => 'Umar Syarif', 'position' => 'Anggota'],
            ['name' => 'Yusuf Hidayat', 'position' => 'Anggota'],
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
                'name' => 'Renovasi Atap Masjid',
                'target_amount' => 50_000_000,
                'collected_amount' => 32_500_000,
                'starts_at' => now()->subWeeks(3),
                'ends_at' => now()->addMonths(2),
                'transactions' => 8,
            ],
            [
                'name' => 'Santunan Anak Yatim',
                'target_amount' => 20_000_000,
                'collected_amount' => 20_000_000,
                'starts_at' => now()->subMonths(2),
                'ends_at' => now()->addMonth(),
                'transactions' => 12,
            ],
            [
                'name' => 'Pembangunan Perpustakaan',
                'target_amount' => 15_000_000,
                'collected_amount' => 4_000_000,
                'starts_at' => now()->subMonth(),
                'ends_at' => now()->subDays(3),
                'transactions' => 3,
            ],
            [
                'name' => 'Wakaf Al-Quran',
                'target_amount' => 10_000_000,
                'collected_amount' => 0,
                'starts_at' => now()->addWeek(),
                'ends_at' => now()->addMonths(3),
                'transactions' => 0,
            ],
        ];

        foreach ($programs as $index => $program) {
            $donationProgram = DonationProgram::factory()->create([
                'name' => $program['name'],
                'slug' => str($program['name'])->slug(),
                'target_amount' => $program['target_amount'],
                'collected_amount' => $program['collected_amount'],
                'cover_photo' => "https://picsum.photos/seed/donation-{$index}/800/450",
                'starts_at' => $program['starts_at'],
                'ends_at' => $program['ends_at'],
            ]);

            DonationTransaction::factory($program['transactions'])->create([
                'donation_program_id' => $donationProgram->id,
            ]);
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
            ['title' => 'Kajian Tafsir Al-Quran', 'speaker' => 'Ust. Abdullah Hakim', 'day_of_week' => 1, 'time' => '19:30'],
            ['title' => 'Kajian Fiqih Sehari-hari', 'speaker' => 'Ust. Muhammad Ridwan', 'day_of_week' => 3, 'time' => '19:30'],
            ['title' => 'Kajian Subuh', 'speaker' => 'Ust. Umar Syarif', 'day_of_week' => 6, 'time' => '05:00'],
        ];

        foreach ($kajianRutin as $index => $kajian) {
            Event::factory()->create([
                'title' => $kajian['title'],
                'type' => 'kajian',
                'speaker' => $kajian['speaker'],
                'day_of_week' => $kajian['day_of_week'],
                'time' => $kajian['time'],
                'event_date' => null,
                'poster' => "https://picsum.photos/seed/kajian-{$index}/600/800",
            ]);
        }

        $eventKhusus = [
            ['title' => 'Peringatan Maulid Nabi', 'event_date' => now()->addWeeks(2)],
            ['title' => 'Buka Puasa Bersama', 'event_date' => now()->addMonth()],
        ];

        foreach ($eventKhusus as $index => $event) {
            Event::factory()->create([
                'title' => $event['title'],
                'type' => 'event',
                'day_of_week' => null,
                'time' => null,
                'event_date' => $event['event_date'],
                'poster' => "https://picsum.photos/seed/event-{$index}/600/800",
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
}
