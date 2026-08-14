<?php

use App\Models\DocumentationPhoto;
use App\Models\DonationProgram;
use Illuminate\Support\Facades\Storage;

test('deleting a donation program removes its cover photo from storage', function () {
    Storage::fake();

    $path = 'donation-programs/test-program/cover.jpg';
    Storage::put($path, 'fake-content');

    $donationProgram = DonationProgram::factory()->create(['cover_photo' => $path]);

    $donationProgram->delete();

    Storage::assertMissing($path);
});

test('deleting a donation program without a cover photo does not error', function () {
    Storage::fake();

    $donationProgram = DonationProgram::factory()->create(['cover_photo' => null]);

    $donationProgram->delete();

    expect(DonationProgram::find($donationProgram->id))->toBeNull();
});

test('deleting a documentation photo removes the file from storage', function () {
    Storage::fake();

    $path = 'documentation-photos/test-program/foto.jpg';
    Storage::put($path, 'fake-content');

    $donationProgram = DonationProgram::factory()->create();
    $documentationPhoto = DocumentationPhoto::factory()->for($donationProgram, 'photoable')->create(['photo' => $path]);

    $documentationPhoto->delete();

    Storage::assertMissing($path);
});
