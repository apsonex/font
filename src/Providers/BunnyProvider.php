<?php

namespace Apsonex\Font\Providers;

use Apsonex\Font\Contracts\FontProviderInterface;
use Apsonex\Font\FontDTO;
use Apsonex\Font\FontResponse;

class BunnyProvider implements FontProviderInterface
{
    protected array $fonts;

    public function __construct()
    {
        $this->fonts = json_decode(
            file_get_contents(__DIR__.'/../data/bunny.json'),
            true
        );
    }

    public function list(int $limit = 20, int $page = 1): FontResponse
    {
        $fonts = array_values($this->fonts);

        return $this->paginate($fonts, $limit, $page);
    }

    public function search(string $keyword, int $limit = 20, int $page = 1): FontResponse
    {
        $filtered = array_filter($this->fonts, fn ($font) => str_contains(strtolower($font['family']), strtolower($keyword)));

        return $this->paginate(array_values($filtered), $limit, $page);
    }

    public function findByKey(string $key): ?FontDTO
    {
        return isset($this->fonts[$key]) ? new FontDTO($this->fonts[$key]) : null;
    }

    public function findByKeys(array $keys, int $limit = 20): FontResponse
    {
        $results = array_filter($this->fonts, fn ($font) => in_array($font['key'], $keys));

        return $this->paginate(array_values($results), $limit, 1);
    }

    public function findByFamily(string $family, int $limit = 20): FontResponse
    {
        $results = array_filter($this->fonts, fn ($font) => strtolower($font['family']) === strtolower($family));

        return $this->paginate(array_values($results), $limit, 1);
    }

    public function findByFamilies(array $families, int $limit = 20): FontResponse
    {
        $families = array_map('strtolower', $families);
        $results = array_filter($this->fonts, fn ($font) => in_array(strtolower($font['family']), $families));

        return $this->paginate(array_values($results), $limit, 1);
    }

    public function findByType(string $type, int $limit = -1): FontResponse
    {
        $results = array_filter($this->fonts, fn ($font) => strtolower($font['category']) === strtolower($type));

        return $this->paginate(array_values($results), $limit, 1);
    }

    protected function paginate(array $items, int $limit, int $page): FontResponse
    {
        $total = count($items);
        if ($limit <= 0) {
            $limit = $total;
        }
        $offset = ($page - 1) * $limit;
        $pageItems = array_slice($items, $offset, $limit);
        $dtos = array_map(fn ($data) => new FontDTO($data), $pageItems);

        return new FontResponse($dtos, $total, $limit, $page);
    }
}
