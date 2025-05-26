<?php

use Apsonex\Font\Font;
use Apsonex\Font\Providers\BunnyProvider;

test('useProvider overrides previous provider', function () {
    $manager = Font::make()
        ->useProvider(new BunnyProvider);

    $response1 = $manager->list(limit: 1);

    $manager->useProvider(new BunnyProvider); // override with another

    $response2 = $manager->list(limit: 1);

    expect($response2)->toBeInstanceOf(\Apsonex\Font\FontResponse::class);
});
