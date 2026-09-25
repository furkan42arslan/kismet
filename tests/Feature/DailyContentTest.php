<?php

test('daily content endpoint returns the same approved content for the same day', function () {
    /** @var \Tests\TestCase $this */
    $this->artisan('migrate:fresh')->assertOk();

    \App\Models\Content::create([
        'type' => 'ayet',
        'body' => 'Günün ilk içerik metni.',
        'source' => 'Kaynak 1',
        'is_approved' => true,
    ]);

    \App\Models\Content::create([
        'type' => 'hadis',
        'body' => 'Günün ikinci içerik metni.',
        'source' => 'Kaynak 2',
        'is_approved' => true,
    ]);

    $firstResponse = $this->getJson('/get-daily');
    $secondResponse = $this->getJson('/get-daily');

    $firstResponse->assertOk();
    $secondResponse->assertOk();

    expect($firstResponse->json('success'))->toBeTrue()
        ->and($firstResponse->json('data.body'))->not->toBeEmpty()
        ->and($firstResponse->json('data'))->toMatchArray($secondResponse->json('data'));
});
