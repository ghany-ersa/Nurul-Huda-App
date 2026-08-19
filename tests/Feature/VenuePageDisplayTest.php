<?php

use App\Models\DocumentationPhoto;
use App\Models\VenuePage;

test('akad venue page renders content managed by the CMS', function () {
    $venuePage = VenuePage::factory()->create([
        'hero_title' => 'Akad Nikah di Aula Serbaguna',
        'availability_badge' => 'Terbuka untuk Pemesanan',
        'description_title' => 'Aula Serbaguna',
        'testimonial' => 'Semoga setiap akad menjadi berkah.',
    ]);

    $response = $this->get(route('venue.index'));

    $response->assertOk()
        ->assertSee($venuePage->hero_title)
        ->assertSee($venuePage->availability_badge)
        ->assertSee($venuePage->description_title)
        ->assertSee($venuePage->testimonial);
});

test('akad venue page shows the photo gallery when documentation photos exist', function () {
    $venuePage = VenuePage::factory()->create();
    DocumentationPhoto::factory()->create([
        'photoable_type' => VenuePage::class,
        'photoable_id' => $venuePage->id,
    ]);

    $this->get(route('venue.index'))
        ->assertOk()
        ->assertSee('Dokumentasi');
});

test('akad venue page hides the photo gallery when no documentation photos exist', function () {
    VenuePage::factory()->create();

    $this->get(route('venue.index'))
        ->assertOk()
        ->assertDontSee('Dokumentasi');
});

test('submitting the venue inquiry form redirects to the CMS configured whatsapp number', function () {
    VenuePage::factory()->create(['wa_number' => '6281111111111']);

    $response = $this->post(route('venue.store'), [
        'name' => 'Budi & Siti',
        'phone' => '08123456789',
        'planned_date' => now()->addMonth()->format('Y-m-d'),
        'note' => null,
    ]);

    $response->assertRedirect();
    expect($response->headers->get('Location'))->toContain('wa.me/6281111111111');
});
