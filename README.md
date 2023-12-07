# DTO Tool

DTO Tool is a PHP library that provides tools for managing Data Transfer Object (DTO) classes. It simplifies the process
of working with DTOs by offering convenient methods for data manipulation and conversion.

## Installation

You can install the DTO Tool library via Composer. Run the following command in your project directory:

```bash
composer require sajadsdi/dto-tool
```

## Features

- auto Add Dynamic Getter and Setter for Public and Private Properties (You can change Visibility)
- Initial DTO with array
- Export DTO to array

## Requirements

- PHP version 8.1 or higher
- sajadsdi/php-reflection package version 1.0 or higher

## Usage

1. Create your DTO classes and define the private properties.
2. use the DTOTrait in DTO

```php
<?php

use Sajadsdi\DtoTool\Concerns\DTOTrait;

class MyDTOClass
{
    use DTOTrait;
    
    private string $name;
    private int $price;
    private int $total;
}
```

3. You can get or set properties like below:

```php
$dto = new MyDTOClass();
$dto->setName('pen');
$dto->setPrice(12);
$dto->setTotal(5);

//getting data
$name = $dto->getName();
$price = $dto->getPrice();
$total = $dto->getTotal();

echo "name: " . $name; // name: pen
echo "price: " . $price;// price: 12
echo "total: " . $total;// total: 5

$array = $dto->toArray();
print_r($array);// ['name' => "pen", 'price' => 12, 'total' => 5]

// you can initial data very easy
$dto->init(['name' => "ball" ,'price' => 50 ,'total' => 20]);
print_r($dto->toArray());// ['name' => "ball", 'price' => 50, 'total' => 20]
```
4. you can overwrite get and set methods
```php
<?php

use Sajadsdi\DtoTool\Concerns\DTOTrait;

class MyDTOClass
{
    use DTOTrait;
    
    private string $name;
    private int $price;
    private int $total;
    
    public function getName()
    {
        return "prefix_".$this->name;
    }
}
```
## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a
pull request on the GitHub repository.

## License

This library is open-source and released under the MIT License. See
the [LICENSE](LICENSE) file for more information.

## Credits

DTO Tool is developed and maintained by SajaD SaeeDi.

Enjoy using DTO Tool for easy management of your DTO classes!
