<?php

use App\Filament\Resources\DonationPrograms\Pages\CreateDonationProgram;
use App\Models\DonationProgram;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

test('uploading a cover photo compresses it to a small jpeg', function () {
    Storage::fake();

    $admin = User::factory()->create(['is_admin' => true]);

    $largePng = UploadedFile::fake()->image('cover.png', 2000, 1200)->size(3000);

    Livewire::actingAs($admin)
        ->test(CreateDonationProgram::class)
        ->fillForm([
            'name' => 'Wakaf Pembangunan Masjid',
            'slug' => 'wakaf-pembangunan-masjid',
            'target_amount' => '1.000.000',
            'cover_photo' => $largePng,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $donationProgram = DonationProgram::where('slug', 'wakaf-pembangunan-masjid')->firstOrFail();

    expect($donationProgram->cover_photo)->toEndWith('.jpg');

    Storage::assertExists($donationProgram->cover_photo);

    $stored = Storage::get($donationProgram->cover_photo);

    expect(strlen($stored))->toBeLessThan(300 * 1024)
        ->and(getimagesizefromstring($stored)['mime'])->toBe('image/jpeg');
});
