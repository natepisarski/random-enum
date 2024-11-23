# Random Enum
Utilities for selecting random elements from a PHP Enum.

## Installation

```shell
composer install natepisarski/random-enum
```

## Usage

```php
use Natepisarski\RandomEnum\RandomEnum

enum Days: string {
  use RandomEnum;
 
  case Sunday = 'sunday';
  case Monday = 'monday';
  case Tuesday = 'tuesday';
}

Days::randomCase(); // === Days::Sunday

Days::randomValue(); // === 'sunday'

Days::randomCaseArray(count: 3, allowRepeats: false); // === [Days::Tuesday, Days::Monday, Days::Sunday]

Days::randomValueArray(count: 3, allowRepeats: true); // === ['tuesday', 'monday', 'sunday']
```

## Error Handling
The package provides 2 exceptions to handle caveats:
- `RandomEnumSizeException` can be thrown if
  - `::randomCase()` or `randomValue()` is called on an empty Enum
  - A `count` greater than the number of cases is passed to `::randomCaseArray()`
- `RandomEnumValueException`
  - `::randomValue()` / `::randomValueArray` is called on an Enum with no backing values

## LICENSE
MIT license, see [LICENSE](LICENSE) for more information.
```