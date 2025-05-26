<?php

use Apsonex\Font\Providers\BunnyProvider;

test('findByFamily is case-insensitive', function () {
    $provider = new BunnyProvider();
    $response1 = $provider->findByFamily('Abel');
    $response2 = $provider->findByFamily('abel');

    expect($response1->fonts)->toEqualCanonicalizing($response2->fonts);
});

test('findByType is case-insensitive', function () {
    $provider = new BunnyProvider();
    $response1 = $provider->findByType('Sans-Serif');
    $response2 = $provider->findByType('sans-serif');

    expect($response1->fonts)->toEqualCanonicalizing($response2->fonts);
});
