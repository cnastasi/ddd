<?php

require_once (__DIR__ . '/../vendor/autoload.php');

use CNastasi\DDD\Primitive\Text;
use CNastasi\DDD\Serializer\SerializerBaseFactory;

// Getting the base serializer (you can customize it, if you want)
$serializer = SerializerBaseFactory::make();

class Name extends Text {
    protected string $regex = "/^[A-Za-z]{2,20}$/"; // Lenght min:2, max:20. No spaces
}

$name = Name::create('John'); // it returns a Name

var_dump((string)$name);

$wrongName = Name::create('Wrong name with spaces'); // it returns an InvalidValueObject

var_dump(
    $wrongName->getMessage(),
    $wrongName->getType()
);

class FullName  {
    private function __construct(
        private Name $firstName,
        private Name $lastName
    ) {}

    public function getFirstName(): Name { return $this->firstName;}
    public function getLastName(): Name { return $this->lastName; }

    public static function create(string|Name $firstName, string|Name $lastName): static|\CNastasi\DDD\Error\ValidationError {
        return \CNastasi\DDD\factory (
            __CLASS__,
            Name::create($firstName),
            Name::create($lastName)
        );
    }
}

$fullName = FullName::create('John wrong name', 'Smith wrong name'); // It returns a ValidationError

print_r($fullName->getInvalidFields());

