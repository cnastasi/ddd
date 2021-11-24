# DDD v1.x


This library provide some helpers and a guideline in order to use some DDD stuff in your projects. 
It helps to adopt using some ready to use "primitives" and a simple serializer. 
It doesn't cover all the possibile use case, then use it if you want, or contribute if you want to cover your specific use case.

---
**NOTE**

Requires PHP 8

---

## Usage
`composer require cnastsi/ddd:^1.0`

## Basic concepts

### Value Objects
The Value object is one of the basic concepts of the DDD.
They provide a safe way to define special types inside your code. 

#### Why I should use them?
Let's think about correctness of the data inside your application. 

```
function doStuff(int $age): void {
   if ($age >= 18) {
       /// Do stuff
   }
   else {
      // Throws an exception?
   }
}
```
In this example, we have `$age`  and we have to validate every time, for every function that use that value.
With a Value Object approach, we have to validate just once, when we instantiate it, and then we are sure that the value is right, always.

```
function doStuff(Age $age): void {
   // Do stuff
}
```
Of course, `Age` is not something generic, but it should follow the rules of our domain. Also, `Age` could/should be immutable, so we can be sure that nobody will never change its value. 
#### Principles
- Value objects should be comparable. A method like `equalsTo` or `sameOf` should be provided.

- Constructor should be private, and a factory method (ex. `create` or `make`) must be provided.

- For an easy debug, a `Stringable` interface should be implemented

- Value objects **MUST BE** always valid. Cannot exists a Value Object with an invalid state.

- Validity should be checked inside the factory method or, in case the constructor is public, inside the constructor.

- Value object must not raise exception. Instead, a ValidationException should be returned.




#### Simple value / Primitives
Describe measurements or values like numbers or strings.

##### Example:
```php
use DDD\ValidationError;

final class Age implements Stringable
{
    private int $age;

    private function __construct(int $age)
    {
        $this->age = $age;
    }

    public function __toString(): string
    {
        return (string)$this->age;
    }

    public function equalsTo(Age $age): bool
    {
        return $this->age === $age;
    }

    public static function create(int $age): Age|ValueObjectError
    {
        $minimumAge = 18;

        if ($age < $minimumAge) {
            return ValidationError::create('age', "Test\Age should be at least $minimumAge");
        }

        return new Age($age);
    }
}
```

#### Composite by primitives
Formed by values that should be described by more than one values, but those values are primitives.

##### Example:
```php
final class Address implements Stringable
{
    final private function __construct(private string $street, private string $postalCode, private string $city, private string $country)
    {
    }

    public function country(): string
    {
        return $this->country;
    }

    public function street(): string
    {
        return $this->street;
    }

    public function postalCode(): string
    {
        return $this->postalCode;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function equalsTo(Address $address): bool
    {
        return $this->street === $address->street
            && $this->city === $address->city
            && $this->postalCode === $address->postalCode
            && $this->country === $address->city;
    }
    
     public function __toString()
    {
        return "{$this->street} {$this->postalCode} {$this->city} {$this->country}";
    }

    public static function create(string $street, string $postalCode, string $city, string $country): Address
    {
        return new Address($street, $postalCode, $city, $country);
    }
}
```

#### Composite by other value objects
Instead of primitives, you can use others value objects

```php
use DDD\ValidationError;
use function DDD\factory;

final class Person
{
    private Name $name;
    private Age $age;

    private function __construct(Name $name, Age $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getAge(): Age
    {
        return $this->age;
    }

    public function equalsTo(Person $person): bool
    {
        return $person->age->equalsTo($this->age)
            && $person->name->equalsTo($this->name);
    }

    final public static function create(string $name, int $age): Person|ValidationError
    {
        /** @var Person|ValidationError $instance */
        $instance = factory(
            Person::class,
            Name::create($name),
            Age::create($age)
        );

        return $instance;
    }
}
```

##### The helper factory
As you can se, inside the `create` factory method it's used a method called factory (seems like a pun).
This method works like a pipe and, in case of ValidationError returned from one of the two create, it returns ValidationError as well, otherwise it returns the instance specified as first argument.