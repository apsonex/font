<?php

use Apsonex\Font\Providers\BunnyProvider;

test('search returns empty array for unknown keyword', function () {
    $provider = new BunnyProvider;
    $response = $provider->search('no-font-should-match-this', 10, 1);

    expect($response->fonts)->toBeEmpty();
});
