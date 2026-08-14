<?php

namespace App\Http\Controllers;

use App\Models\DonationProgram;
use Illuminate\Contracts\View\View;

class DonationProgramController extends Controller
{
    public function index(): View
    {
        $donationPrograms = DonationProgram::query()
            ->orderByDesc('created_at')
            ->get();

        return view('donation-programs.index', [
            'donationPrograms' => $donationPrograms,
        ]);
    }

    public function show(DonationProgram $donationProgram): View
    {
        $donationProgram->load([
            'transactions' => function ($query) {
                $query->orderByDesc('donated_at');
            },
            'photos',
        ]);

        return view('donation-programs.show', [
            'donationProgram' => $donationProgram,
        ]);
    }
}
