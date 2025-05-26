# Font Manager PHP Package

A simple PHP package to manage and search fonts from multiple providers.
Currently supports the **Bunny Fonts** provider with an easy way to list, search, and filter fonts.

## Features
- List fonts with pagination
- Search fonts by keyword
- Find fonts by key(s), family(ies), and type
- Extensible with multiple font providers

## Installation

```bash
composer require apsonex/font-manager
```

## Usage

```php
use Apsonex\Font\Font;

// Instantiate the font manager
$fontManager = Font::make();

// Select Bunny provider
$fontManager->bunny();

// List fonts (paginated)
$response = $fontManager->list(limit: 20, page: 1);
foreach ($response->fonts as $font) {
    echo $font->family . PHP_EOL;
}

// Search fonts by keyword
$searchResponse = $fontManager->search('abo', limit: 20, page: 1);

// Find font by a single key
$font = $fontManager->findByKey('abel');

// Find fonts by multiple keys
$response = $fontManager->findByKeys(['abel', 'abeezee'], limit: 10);

// Find fonts by family
$response = $fontManager->findByFamily('Abel', limit: 10);

// Find fonts by multiple families
$response = $fontManager->findByFamilies(['Abel', 'Aboreto'], limit: 10);

// Find fonts by type (e.g., 'sans-serif')
// Use limit -1 to fetch all matches
$response = $fontManager->findByType('sans-serif', limit: -1);
```

## API Reference

### Font Manager `(Apsonex\Font\Font)`
- make(): static — Create a new instance
- bunny(): static — Use Bunny font provider
- useProvider(FontProviderInterface $provider): static — Use a custom font provider
- list(int $limit = 20, int $page = 1): FontResponse — List fonts paginated
- search(string $keyword, int $limit = 20, int $page = 1): FontResponse — Search fonts by keyword
- findByKey(string $key): ?FontDTO — Find a single font by key
- findByKeys(array $keys, int $limit = 20): FontResponse — Find fonts by keys
- findByFamily(string $family, int $limit = 20): FontResponse — Find fonts by family
- findByFamilies(array $families, int $limit = 20): FontResponse — Find fonts by families
- findByType(string $type, int $limit = -1): FontResponse — Find fonts by category/type

### FontDTO `(Apsonex\Font\FontDTO)`
- Represents a single font object with these properties:
- key (string): Unique font key
- provider (string): Provider name
- category (string): Font category (e.g., sans-serif)
- family (string): Font family name
- urlString (string): CSS font string identifier

## FontResponse `(Apsonex\Font\FontResponse)`
- Paginated font response containing:
- fonts (array of FontDTO)
- total (int) — total matched fonts
- limit (int) — items per page
- page (int) — current page number

## Testing
This package uses Pest PHP for testing.

```bash
./vendor/bin/pest
```

## Extending with other Providers

You can implement your own provider by creating a class that implements:

```php
use Apsonex\Font\Contracts\FontProviderInterface;

class YourProvider implements FontProviderInterface
{
    public function list(int $limit, int $page): FontResponse { /*...*/ }
    public function search(string $keyword, int $limit, int $page): FontResponse { /*...*/ }
    public function findByKey(string $key): ?FontDTO { /*...*/ }
    // Implement other methods from interface...
}
```

Then register it:

```php
    $fontManager->useProvider(new YourProvider());
```

## License
MIT License © Apsonex Inc

## Contributing
Feel free to open issues and pull requests!
