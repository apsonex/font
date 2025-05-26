<?php

namespace Apsonex\Font;

/**
 * Class FontDTO
 *
 * A Data Transfer Object representing a single font in normalized format.
 *
 * @property string $key        Unique lowercase key (e.g., 'abeezee')
 * @property string $provider   Font provider name (e.g., 'bunny')
 * @property string $category   Font category (e.g., 'sans-serif')
 * @property string $family     Font family name (e.g., 'ABeeZee')
 * @property string $urlString  Font identifier for CSS usage (e.g., 'abeezee:400,400i')
 *
 * Example:
 * ```
 * $font = new FontDTO([
 *     'key' => 'abeezee',
 *     'provider' => 'bunny',
 *     'category' => 'sans-serif',
 *     'family' => 'ABeeZee',
 *     'urlString' => 'abeezee:400,400i',
 * ]);
 *
 * echo $font->family; // ABeeZee
 * ```
 */
class FontDTO
{
    public string $key;
    public string $provider;
    public string $category;
    public string $family;
    public string $urlString;

    public function __construct(array $data)
    {
        $this->key = $data['key'];
        $this->provider = $data['provider'];
        $this->category = $data['category'];
        $this->family = $data['family'];
        $this->urlString = $data['urlString'];
    }
}
