<?php

use App\Http\Controllers\CommitteeMemberController;
use App\Http\Controllers\DonationProgramController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VenueController;
use App\Livewire\MentariPagiSpinner;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/pengurus', CommitteeMemberController::class)->name('committee-members.index');

Route::get('/donasi', [DonationProgramController::class, 'index'])->name('donation-programs.index');
Route::get('/donasi/{donationProgram:slug}', [DonationProgramController::class, 'show'])->name('donation-programs.show');

Route::get('/laporan-keuangan', FinancialReportController::class)->name('financial-reports.index');

Route::get('/kajian-event', [EventController::class, 'index'])->name('events.index');
Route::get('/kajian-event/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('/akad-venue', VenueController::class)->name('venue.index');

Route::get('/spinner', MentariPagiSpinner::class)->name('mentari-pagi-spinner');
