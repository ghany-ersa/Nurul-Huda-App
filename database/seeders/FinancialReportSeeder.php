<?php

namespace Database\Seeders;

use App\Models\FinancialReport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class FinancialReportSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Jumlah bulan ke belakang yang akan diisi datanya.
     */
    private const MONTHS_BACK = 4;

    private const SUBUH_MIN = 150_000;

    private const SUBUH_MAX = 190_000;

    private const JUMAT_MIN = 1_000_000;

    private const JUMAT_MAX = 1_500_000;

    private const OPERATIONAL_EXPENSE_MIN = 7_000_000;

    private const OPERATIONAL_EXPENSE_MAX = 8_000_000;

    private const LISTRIK_MIN = 2_900_000;

    private const LISTRIK_MAX = 3_500_000;

    /**
     * Proporsi tiap kategori pengeluaran operasional selain Listrik,
     * dihitung dari sisa total setelah dikurangi biaya Listrik.
     *
     * @var array<string, float>
     */
    private const OPERATIONAL_EXPENSE_SHARES = [
        'Gaji Marbot' => 0.55,
        'Kebersihan' => 0.20,
        'Air (PDAM)' => 0.13,
        'Perlengkapan & ATK' => 0.12,
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        collect(range(self::MONTHS_BACK, 1))
            ->map(fn (int $monthsAgo): Carbon => now()->subMonths($monthsAgo)->startOfMonth())
            ->each(function (Carbon $period) use ($now): void {
                $daysInMonth = $period->daysInMonth;
                $fridayCount = $this->countFridays($period);

                $infakSubuh = 0;
                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $infakSubuh += fake()->numberBetween(self::SUBUH_MIN, self::SUBUH_MAX);
                }

                $infakJumat = 0;
                for ($i = 0; $i < $fridayCount; $i++) {
                    $infakJumat += fake()->numberBetween(self::JUMAT_MIN, self::JUMAT_MAX);
                }

                FinancialReport::create([
                    'period_month' => $period->month,
                    'period_year' => $period->year,
                    'type' => 'income',
                    'category' => 'Infak Subuh',
                    'amount' => $infakSubuh,
                    'description' => "Rekap infak subuh harian ({$daysInMonth} hari).",
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                FinancialReport::create([
                    'period_month' => $period->month,
                    'period_year' => $period->year,
                    'type' => 'income',
                    'category' => "Infak Jum'at",
                    'amount' => $infakJumat,
                    'description' => "Rekap infak Jum'at ({$fridayCount} kali).",
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                $totalExpense = fake()->numberBetween(self::OPERATIONAL_EXPENSE_MIN, self::OPERATIONAL_EXPENSE_MAX);

                foreach ($this->splitExpenseByCategory($totalExpense) as $category => $amount) {
                    FinancialReport::create([
                        'period_month' => $period->month,
                        'period_year' => $period->year,
                        'type' => 'expense',
                        'category' => $category,
                        'amount' => $amount,
                        'description' => "Pengeluaran operasional bulanan: {$category}.",
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            });
    }

    /**
     * Pecah total pengeluaran operasional ke beberapa kategori.
     * Listrik diacak independen pada rentangnya sendiri, sisanya dibagi
     * proporsional dari sisa total. Sisa pembulatan dibebankan ke kategori
     * terakhir agar totalnya tetap presisi.
     *
     * @return array<string, int>
     */
    private function splitExpenseByCategory(int $totalExpense): array
    {
        $listrik = fake()->numberBetween(self::LISTRIK_MIN, self::LISTRIK_MAX);
        $remaining = $totalExpense - $listrik;

        $categories = array_keys(self::OPERATIONAL_EXPENSE_SHARES);
        $lastCategory = end($categories);

        $amounts = ['Listrik' => $listrik];
        $allocated = 0;

        foreach (self::OPERATIONAL_EXPENSE_SHARES as $category => $share) {
            if ($category === $lastCategory) {
                continue;
            }

            $amount = (int) round($remaining * $share, -3);
            $amounts[$category] = $amount;
            $allocated += $amount;
        }

        $amounts[$lastCategory] = $remaining - $allocated;

        return $amounts;
    }

    /**
     * Hitung jumlah hari Jum'at dalam bulan dari tanggal yang diberikan.
     */
    private function countFridays(Carbon $period): int
    {
        $count = 0;
        $cursor = $period->copy()->startOfMonth();
        $end = $period->copy()->endOfMonth();

        while ($cursor->lte($end)) {
            if ($cursor->isFriday()) {
                $count++;
            }

            $cursor->addDay();
        }

        return $count;
    }
}
