<?php

use App\Models\Content;
use App\Models\User;

test('database seeder can run more than once without duplicate data', function () {
    /** @var \Tests\TestCase $this */
    $this->artisan('migrate:fresh', ['--seed' => true])->assertOk();

    $initialUserCount = User::query()->count();
    $initialContentCount = Content::query()->count();

    $this->artisan('db:seed', ['--force' => true])->assertOk();

    expect(User::query()->count())->toBe($initialUserCount)
        ->and(Content::query()->count())->toBe($initialContentCount);
});
