<?php

test('it can list fonts from bunny provider', function () {
    $manager = \Apsonex\Font\Font::make()->bunny();
    $response = $manager->list(limit: 10);

    expect($response)
        ->toBeInstanceOf(\Apsonex\Font\FontResponse::class)
        ->and(count($response->fonts))->toBeLessThanOrEqual(10);
});

test('it can search fonts by keyword', function () {
    $manager = \Apsonex\Font\Font::make()->bunny();
    $response = $manager->search('abo');

    expect($response)
        ->toBeInstanceOf(\Apsonex\Font\FontResponse::class);
});

test('it can find font by key', function () {
    $manager = \Apsonex\Font\Font::make()->bunny();
    $font = $manager->findByKey('abel');

    expect($font)
        ->toBeInstanceOf(\Apsonex\Font\FontDTO::class)
        ->and($font->key)->toBe('abel');
});

test('it can find fonts by family', function () {
    $manager = \Apsonex\Font\Font::make()->bunny();
    $response = $manager->findByFamily('Abel');

    expect($response->fonts)
        ->not()
        ->toBeEmpty();
});

test('it can find fonts by type', function () {
    $manager = \Apsonex\Font\Font::make()->bunny();
    $response = $manager->findByType('sans-serif');

    expect($response->fonts)
        ->not()
        ->toBeEmpty();
});
