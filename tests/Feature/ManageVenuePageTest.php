<?php

use App\Filament\Pages\ManageVenuePage;
use App\Models\User;
use App\Models\VenuePage;
use Livewire\Livewire;

test('admin can update the venue page content', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    VenuePage::factory()->create(['hero_title' => 'Judul Lama']);

    Livewire::actingAs($admin)
        ->test(ManageVenuePage::class)
        ->fillForm(['hero_title' => 'Judul Baru'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect(VenuePage::query()->firstOrFail()->hero_title)->toBe('Judul Baru');
});

test('admin can create the venue page content when none exists', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    Livewire::actingAs($admin)
        ->test(ManageVenuePage::class)
        ->fillForm([
            'hero_title' => 'Akad Nikah di Aula Serbaguna',
            'hero_subtitle' => 'Rayakan momen sakral Anda.',
            'availability_badge' => 'Terbuka untuk Pemesanan',
            'description_title' => 'Aula Serbaguna',
            'description' => 'Deskripsi aula.',
            'testimonial' => 'Semoga berkah.',
            'wa_number' => '6285335104803',
            'facilities' => [
                ['icon' => 'user-group', 'label' => 'Hingga 150 Tamu'],
            ],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect(VenuePage::query()->count())->toBe(1);
});

test('venue page gallery photos are managed through the photos morph relationship', function () {
    $venuePage = VenuePage::factory()->create();

    $venuePage->photos()->create([
        'photo' => 'venue-page/gallery.jpg',
        'caption' => 'Suasana akad nikah',
        'order' => 0,
    ]);

    expect($venuePage->photos()->count())->toBe(1)
        ->and($venuePage->photos()->first()->caption)->toBe('Suasana akad nikah');
});

test('admin sees the gallery repeater once the venue page record exists', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    VenuePage::factory()->create();

    Livewire::actingAs($admin)
        ->test(ManageVenuePage::class)
        ->assertOk()
        ->assertFormFieldExists('photos');
});
