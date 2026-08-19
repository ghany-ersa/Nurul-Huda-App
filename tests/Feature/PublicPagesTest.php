<?php

use App\Models\DocumentationPhoto;
use App\Models\DonationProgram;
use App\Models\Event;
use App\Models\FinancialReport;
use App\Models\VenueInquiry;
use App\Models\VenuePage;

use function Pest\Laravel\assertDatabaseHas;

test('homepage renders successfully', function () {
    $this->get(route('home'))->assertOk();
});

test('committee members page renders successfully', function () {
    $this->get(route('committee-members.index'))->assertOk();
});

test('donation programs index page renders successfully', function () {
    $this->get(route('donation-programs.index'))->assertOk();
});

test('donation program detail page renders successfully', function () {
    $donationProgram = DonationProgram::factory()->create();

    $this->get(route('donation-programs.show', $donationProgram))->assertOk();
});

test('donation program detail page shows photo carousel when photos exist', function () {
    $donationProgram = DonationProgram::factory()->create();
    DocumentationPhoto::factory()->create([
        'photoable_type' => DonationProgram::class,
        'photoable_id' => $donationProgram->id,
    ]);

    $this->get(route('donation-programs.show', $donationProgram))
        ->assertOk()
        ->assertSee('Dokumentasi Kegiatan');
});

test('donation program detail page hides photo carousel when no photos', function () {
    $donationProgram = DonationProgram::factory()->create();

    $this->get(route('donation-programs.show', $donationProgram))
        ->assertOk()
        ->assertDontSee('Dokumentasi Kegiatan');
});

test('financial reports page renders successfully', function () {
    $this->get(route('financial-reports.index'))->assertOk();
});

test('financial reports page renders successfully with data', function () {
    FinancialReport::factory()->create([
        'period_year' => 2026,
        'period_month' => 8,
        'type' => 'income',
    ]);

    $this->get(route('financial-reports.index', ['year' => 2026]))->assertOk();
});

test('events page renders successfully', function () {
    $this->get(route('events.index'))->assertOk();
});

test('event detail page renders successfully', function () {
    $event = Event::factory()->create();

    $this->get(route('events.show', $event))->assertOk();
});

test('event detail page shows photo carousel when photos exist', function () {
    $event = Event::factory()->create();
    DocumentationPhoto::factory()->create([
        'photoable_type' => Event::class,
        'photoable_id' => $event->id,
    ]);

    $this->get(route('events.show', $event))
        ->assertOk()
        ->assertSee('Dokumentasi Kegiatan');
});

test('event detail page hides photo carousel when no photos', function () {
    $event = Event::factory()->create();

    $this->get(route('events.show', $event))
        ->assertOk()
        ->assertDontSee('Dokumentasi Kegiatan');
});

test('venue page renders successfully', function () {
    VenuePage::factory()->create();

    $this->get(route('venue.index'))->assertOk();
});

test('venue inquiry submission is stored and redirects to whatsapp', function () {
    VenuePage::factory()->create(['wa_number' => '6285335104803']);

    $response = $this->post(route('venue.store'), [
        'name' => 'Budi Santoso',
        'phone' => '081234567890',
        'planned_date' => now()->addMonth()->format('Y-m-d'),
        'note' => 'Perkiraan 100 tamu.',
    ]);

    $response->assertRedirect();
    expect($response->headers->get('Location'))->toContain('wa.me/6285335104803');

    assertDatabaseHas(VenueInquiry::class, [
        'name' => 'Budi Santoso',
        'phone' => '081234567890',
        'note' => 'Perkiraan 100 tamu.',
        'status' => 'pending',
    ]);
});

test('venue inquiry submission requires name, phone, and planned date', function () {
    $response = $this->post(route('venue.store'), []);

    $response->assertSessionHasErrors(['name', 'phone', 'planned_date']);
    $this->assertDatabaseCount(VenueInquiry::class, 0);
});
