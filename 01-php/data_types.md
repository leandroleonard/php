# 🐘 PHP Data Types and Type System

PHP supports a wide variety of data types, ranging from simple scalars to complex object structures and modern advanced types like `never`, `mixed`, and `enum`.  
Understanding these types is essential for writing **type-safe**, **robust**, and **predictable** code.

---

## 📖 Table of Contents

1. [Type System Overview](#type-system)
2. [NULL](#null)
3. [Booleans](#booleans)
4. [Integers](#integers)
5. [Floating Point Numbers](#floating-point-numbers)
6. [Strings](#strings)
7. [Numeric Strings](#numeric-strings)
8. [Arrays](#arrays)
9. [Objects](#objects)
10. [Enumerations](#enumerations)
11. [Resources](#resources)
12. [Callbacks / Callables](#callbacks--callables)
13. [Mixed](#mixed)
14. [Void](#void)
15. [Never](#never)
16. [Relative Class Types](#relative-class-types)
17. [Singleton Types](#singleton-types)
18. [Iterables](#iterables)
19. [Type Declarations](#type-declarations)
20. [Type Juggling](#type-juggling)
21. [Summary](#summary)
22. [Related Links](#related)

---

## Type System

PHP is a **dynamically typed** language, meaning variables can hold values of any type, and their type can change at runtime.

However, since PHP 7 and later, it also supports **strict typing**, **type declarations**, and **union/intersection types**, providing strong typing when desired.

| Type Category | Examples |
|----------------|-----------|
| **Scalar types** | `int`, `float`, `string`, `bool` |
| **Compound types** | `array`, `object`, `callable`, `iterable` |
| **Special types** | `resource`, `null`, `mixed`, `void`, `never` |

---

## NULL

Represents a variable with **no value**.

```php
$value = null;

if (is_null($value)) {
    echo "Value is null";
}
```

Only one possible value: `NULL`.

---

## Booleans

Represent **true** or **false**.

```php
$isActive = true;
$hasAccess = false;

if ($isActive) echo "User active";
```

Common conversions:

* `0`, `""`, `null`, and `[]` → `false`
* All others → `true`

---

## Integers

Whole numbers, positive or negative.

```php
$a = 42;
$b = -10;
```

**Range (platform-dependent):**

* Typically `-2,147,483,648` to `2,147,483,647` (on 32-bit)

---

## Floating Point Numbers

Decimal or exponential numbers.

```php
$pi = 3.14159;
$e = 2.5e3; // 2500
```

Floating point precision is **limited** — avoid for financial calculations.

---

## Strings

Sequence of characters, enclosed in quotes.

```php
$name = "Leandro";
echo "Hello, $name";
```

Can use:

* `"Double quotes"` → interpolate variables
* `'Single quotes'` → literal text

---

## Numeric Strings

Strings that contain numeric values.

```php
$val = "123"; // Numeric string
echo $val + 2; // 125 — auto-converted to int
```

Used in **type juggling** when PHP automatically converts between string and number.

---

## Arrays

Ordered maps that can contain mixed keys and values.

```php
$user = [
    "id" => 1,
    "name" => "Alice",
    "roles" => ["admin", "editor"]
];
```

Arrays can act as:

* Lists
* Maps (associative arrays)
* Matrices (multidimensional arrays)

---

## Objects

Instances of classes created using `new`.

```php
class User {
    public $name;
}

$u = new User();
$u->name = "Leandro";
```

Objects support **methods**, **properties**, and **inheritance**.

---

## Enumerations

Introduced in **PHP 8.1**, enums define a fixed set of values.

```php
enum Status {
    case Active;
    case Inactive;
}

$status = Status::Active;
```

Safer than string constants.

---

## Resources

Special type representing **external system references** (like file handles or DB connections).

```php
$file = fopen("data.txt", "r");
var_dump($file); // resource
```

They cannot be duplicated or serialized meaningfully.

---

## Callbacks / Callables

Represent **functions** or **methods** that can be executed dynamically.

```php
function greet($name) { echo "Hello, $name"; }

$callback = "greet";
call_user_func($callback, "Leandro");
```

Used heavily in event-driven and functional-style PHP code.

---

## Mixed

Represents **any type**.
Useful when a function can accept or return multiple types.

```php
function getValue(mixed $input): mixed {
    return $input;
}
```

---

## Void

Means the function **returns nothing**.

```php
function logMessage(string $msg): void {
    echo $msg;
}
```

You cannot return any value, not even `null`.

---

## Never

Indicates a function that **never returns** — it always exits or throws an exception.

```php
function fail(string $msg): never {
    throw new Exception($msg);
}
```

Introduced in PHP 8.1.

---

## Relative Class Types

Used to refer to **class contexts** dynamically:

| Keyword  | Refers To                                    |
| -------- | -------------------------------------------- |
| `self`   | Current class (compile-time)                 |
| `static` | Called class (runtime — Late Static Binding) |
| `parent` | Immediate parent class                       |

---

## Singleton Types

Although PHP doesn’t have native singleton types, the **Singleton pattern** ensures **only one instance** of a class exists.

```php
class Config {
    private static ?Config $instance = null;
    private function __construct() {}

    public static function getInstance(): Config {
        return self::$instance ??= new self();
    }
}
```

---

## Iterables

Represent any **traversable data structure** — arrays or objects implementing `Traversable`.

```php
function printItems(iterable $items): void {
    foreach ($items as $item) {
        echo $item . PHP_EOL;
    }
}
```

---

## Type Declarations

You can declare parameter, return, and property types.

```php
function add(int $a, int $b): int {
    return $a + $b;
}
```

Supports:

* Scalar types (`int`, `float`, `string`, `bool`)
* Compound types (`array`, `object`, `callable`, `iterable`)
* Union types (`int|string`)
* Nullable (`?int`)
* Intersection types (`A&B`)

---

## Type Juggling

PHP automatically converts types during operations — known as **type juggling**.

```php
$val = "10" + 5; // "10" becomes int(10)
echo gettype($val); // integer
```

Can lead to unexpected behavior:

```php
var_dump("123abc" == 123); // true (string converted to int)
```

Use `===` for strict comparisons to avoid issues.

---

## Summary

| Category | Type                               | Description          |
| -------- | ---------------------------------- | -------------------- |
| Scalar   | int, float, string, bool           | Basic data types     |
| Compound | array, object, callable, iterable  | Complex structures   |
| Special  | null, resource, mixed, void, never | Edge or meta types   |
| Modern   | enum, relative types               | Added in PHP 8+      |
| Behavior | type juggling                      | Implicit conversions |

---

## 📚 Related

* [PHP Manual – Types](https://www.php.net/manual/en/language.types.php)
* [PHP Type Declarations](https://www.php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration)
* [PHP Enumerations](https://www.php.net/manual/en/language.enumerations.php)
* [Type Juggling Explained](https://www.php.net/manual/en/language.types.type-juggling.php)

---
