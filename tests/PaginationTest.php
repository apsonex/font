<?php

use Apsonex\Font\Providers\BunnyProvider;

test('pagination skips records correctly', function () {
    $provider = new BunnyProvider();

    $page1 = $provider->list(limit: 1, page: 1);
    $page2 = $provider->list(limit: 1, page: 2);

    expect($page1->fonts[0]->key)->not()->toBe($page2->fonts[0]->key);
});

test('list handles invalid pagination inputs gracefully', function () {
    $provider = new BunnyProvider();

    $response = $provider->list(limit: -5, page: -2);

    expect($response->fonts)->toBeArray();
});
