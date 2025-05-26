<?php

namespace Apsonex\Font\Contracts;

use Apsonex\Font\FontDTO;
use Apsonex\Font\FontResponse;

interface FontProviderInterface
{
    public function list(int $limit = 20, int $page = 1): FontResponse;
    public function search(string $keyword, int $limit = 20, int $page = 1): FontResponse;
    public function findByKey(string $key): ?FontDTO;
    public function findByKeys(array $keys, int $limit = 20): FontResponse;
    public function findByFamily(string $family, int $limit = 20): FontResponse;
    public function findByFamilies(array $families, int $limit = 20): FontResponse;
    public function findByType(string $type, int $limit = -1): FontResponse;
}
