<?php

use Illuminate\Foundation\Testing\TestCase;

test('the application returns a successful response', function () {
    /** @var TestCase $this */
    $response = $this->get('/');

    $response->assertStatus(200);
});
