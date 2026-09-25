<?php

use Tests\TestCase;

test('random content falls back when the database is empty', function () {
    /** @var TestCase $this */
    $this->artisan('migrate:fresh')->assertOk();

    $response = $this->getJson('/get-random');

    $response->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure([
            'data' => ['id', 'type', 'body', 'source', 'is_approved'],
        ]);
});

test('daily content falls back when the database is empty', function () {
    /** @var TestCase $this */
    $this->artisan('migrate:fresh')->assertOk();

    $response = $this->getJson('/get-daily');

    $response->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure([
            'data' => ['id', 'type', 'body', 'source', 'is_approved'],
        ]);
});
