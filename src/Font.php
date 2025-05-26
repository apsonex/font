<?php

namespace Apsonex\Font;

use Apsonex\Font\Contracts\FontProviderInterface;
use Apsonex\Font\Providers\BunnyProvider;

class Font
{
    protected FontProviderInterface $provider;

    public static function make(): static
    {
        return new static;
    }

    public function bunny(): static
    {
        $this->provider = new BunnyProvider;

        return $this;
    }

    public function useProvider(FontProviderInterface $provider): static
    {
        $this->provider = $provider;

        return $this;
    }

    public function list(int $limit = 20, int $page = 1): FontResponse
    {
        return $this->provider->list($limit, $page);
    }

    public function search(string $keyword, int $limit = 20, int $page = 1): FontResponse
    {
        return $this->provider->search($keyword, $limit, $page);
    }

    public function findByKey(string $key): ?FontDTO
    {
        return $this->provider->findByKey($key);
    }

    public function findByKeys(array $keys, int $limit = 20): FontResponse
    {
        return $this->provider->findByKeys($keys, $limit);
    }

    public function findByFamily(string $family, int $limit = 20): FontResponse
    {
        return $this->provider->findByFamily($family, $limit);
    }

    public function findByFamilies(array $families, int $limit = 20): FontResponse
    {
        return $this->provider->findByFamilies($families, $limit);
    }

    public function findByType(string $type, int $limit = -1): FontResponse
    {
        return $this->provider->findByType($type, $limit);
    }
}
