#Create your own value object
Let's try to create a simple but composite data structure that describe and validate the domain concept of `Person`.

The Person should have a `Name`.

```php
class Name extends Text {
    protected string $regex = "/^[A-Za-z]{2,20}$/"; // Lenght min:2, max:20. No spaces
}

/* Right name */
$name = Name::create('John'); // it returns a Name

var_dump((string)$name); // string(4) "John"

/* Wrong name */
$wrongName = Name::create('Wrong name with spaces'); // it returns an InvalidValueObject

var_dump($wrongName->getMessage());  // string(81) "Invalid string: 'Wrong name with spaces' does not match with '/^[A-Za-z]{2,20}$/'"

var_dump($wrongName->getType()); // string(14) "invalid string"
```

That's not enough, we want a `FirstName` and a `LastName` and we will reuse `Name` for it

```php
class FullName  {
    public function __construct(
        private Name $firstName, 
        private Name $lastName
    ) {}
    
    public function getFirstName(): Name { return $this->firstName;}
    public function getLastName(): Name { return $this->lastName; }
}

/*  How to create the object */ 
$fullName = new FullName (
    Name::create('John'),
    Name::create('Smith')
);
```

That's seems pretty decent, but if we want to hydrate the object, we had to do it manually, field by field. 

Also, it's difficult to catch the errors and the code will crash while running cause a type error will rise. 

We need a better solution, like a factory method.

```php
class FullName  {
    private function __construct(
        private Name $firstName, 
        private Name $lastName
    ) {}
    
    public function getFirstName(): Name { return $this->firstName;}
    public function getLastName(): Name { return $this->lastName; }
    
    public static function create(string|Name $firstName, string|Name $lastName): static|ValidationError {
        return factory (
            __CLASS__,
            Name::create($firstName),
            Name::create($lastName)
        );
    }
}

/*  How to create the object */
$fullName = FullName::create('John', 'Smith');

/** OR **/

$data = ['firstName' => 'John', 'lastName' => 'Smith'];

$fullName = FullName::create(...$data);   
```
As you can se, the constructor is `private` and the arguments have the union type `string|Name` so we can pass both. 

The create method will return or itself, or a `ValidationError`. 

The `factory` helper will do the magic. It will combine in a `ValidationError` object all the errors generated.

```php
$fullName = FullName::create('John wrong name', 'Smith wrong name'); // It returns a ValidationError

print_r($fullName->getInvalidFields());

// Array
// (
//     [class] => FullName
//     [fields] => Array
//     (
//          [firstName] => Invalid string: 'John wrong name' does not match with '/^[A-Za-z]{2,20}$/'
//          [lastName] => Invalid string: 'Smith wrong name' does not match with '/^[A-Za-z]{2,20}$/'
//     )
// )


// No exception are raised untill now but,
// if you need to, you can throw
// the ValidationError object.
throw $fullName;
```

