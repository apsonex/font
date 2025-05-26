<?php

namespace Apsonex\Font;

class FontResponse
{
    /** @var FontDTO[] */
    public array $fonts;

    public int $total;

    public int $limit;

    public int $page;

    public function __construct(array $fonts, int $total, int $limit, int $page)
    {
        $this->fonts = $fonts;
        $this->total = $total;
        $this->limit = $limit;
        $this->page = $page;
    }
}
