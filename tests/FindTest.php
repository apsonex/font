<?php

use Apsonex\Font\Providers\BunnyProvider;

test('findByKey returns null for unknown key', function () {
    $provider = new BunnyProvider();
    $font = $provider->findByKey('this-key-does-not-exist');

    expect($font)->toBeNull();
});

test('findByFamilies returns only valid matches', function () {
    $provider = new BunnyProvider();
    $response = $provider->findByFamilies(['Abel', 'NonexistentFont']);

    $families = collect($response->fonts)->pluck('family');

    expect($families)->toContain('Abel')
        ->and($families)->not()->toContain('NonexistentFont');
});
