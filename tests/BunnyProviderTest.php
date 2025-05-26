<?php

use Apsonex\Font\Providers\BunnyProvider;
use Apsonex\Font\FontDTO;
use Apsonex\Font\FontResponse;

beforeEach(function () {
    $this->provider = new BunnyProvider();
});

test('bunny provider lists fonts', function () {
    $response = $this->provider->list(5, 1);

    expect($response)->toBeInstanceOf(FontResponse::class)
        ->and(count($response->fonts))->toBeLessThanOrEqual(5);
});

test('bunny provider can search fonts by keyword', function () {
    $response = $this->provider->search('abo', 10, 1);

    expect($response)->toBeInstanceOf(FontResponse::class);
});

test('bunny provider can find font by key', function () {
    $font = $this->provider->findByKey('abel');

    expect($font)->toBeInstanceOf(FontDTO::class)
        ->and($font->key)->toBe('abel');
});

test('bunny provider can find fonts by keys', function () {
    $response = $this->provider->findByKeys(['abel']);

    expect($response)->toBeInstanceOf(FontResponse::class)
        ->and(count($response->fonts))->toBeGreaterThan(0);
});

test('bunny provider can find fonts by family', function () {
    $response = $this->provider->findByFamily('Abel');

    expect($response->fonts)->not()->toBeEmpty();
});

test('bunny provider can find fonts by families', function () {
    $response = $this->provider->findByFamilies(['Abel', 'Aboreto']);

    expect($response->fonts)->toHaveCount(2);
});

test('bunny provider can find fonts by type', function () {
    $response = $this->provider->findByType('sans-serif');

    expect($response->fonts)->not()->toBeEmpty();
});
