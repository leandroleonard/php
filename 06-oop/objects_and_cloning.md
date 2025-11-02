# **Objects and Cloning** in PHP

Objects in PHP represent **instances of classes** — structures that bundle data (**properties**) and behavior (**methods**).
When working with objects, it’s important to understand how **assignment**, **references**, and **cloning** work, since PHP handles them differently than primitive data types.

---

## 📖 Table of Contents

1. [Overview](#overview)
2. [Creating Objects](#creating-objects)
3. [Assigning Objects](#assigning-objects)
4. [Cloning Objects](#cloning-objects)
5. [The `__clone()` Magic Method](#the-__clone-magic-method)
6. [Shallow vs Deep Cloning](#shallow-vs-deep-cloning)
7. [References and Object Identity](#references-and-object-identity)
8. [Summary](#summary)
9. [Related Topics](#related-topics)

---

## Overview

In PHP, objects are **created from classes** using the `new` keyword.
Each object instance is a separate entity, but when you assign one object to another variable, PHP assigns a **reference**, not a copy.

This behavior is key to understanding why changes in one variable may affect another that references the same object.

---

## Creating Objects

```php
class Car {
    public $brand;
}

$car1 = new Car();
$car1->brand = "Toyota";
```

Here, `$car1` is an **object instance** of class `Car` with its own data in memory.

---

## Assigning Objects

When you assign an object to another variable, PHP creates a **reference** to the same object — not a copy.

```php
$car2 = $car1; // Both point to the same object
$car2->brand = "Honda";

echo $car1->brand; // Honda
```

Both `$car1` and `$car2` refer to the **same instance** of the object.

---

## Cloning Objects

To make an actual **copy** of an object, you must use the `clone` keyword.

```php
$car3 = clone $car1;
$car3->brand = "Ford";

echo $car1->brand; // Honda
echo $car3->brand; // Ford
```

Now `$car1` and `$car3` are **independent objects** — changes to one do not affect the other.

---

## The `__clone()` Magic Method

When an object is cloned, PHP calls its special `__clone()` method **if defined**.
This allows custom behavior during cloning, such as resetting values or deep copying internal objects.

```php
class User {
    public $name;
    public $session;

    public function __clone() {
        $this->session = null; // Reset session data on clone
    }
}

$user1 = new User();
$user1->name = "Alice";
$user1->session = "xyz123";

$user2 = clone $user1;

var_dump($user2->session); // null
```

---

## Shallow vs Deep Cloning

Cloning in PHP is **shallow by default**, meaning nested objects inside the cloned object still point to the **same references** unless you explicitly clone them in `__clone()`.

```php
class Engine {
    public $type = "V8";
}

class Car {
    public $engine;

    public function __construct() {
        $this->engine = new Engine();
    }

    public function __clone() {
        $this->engine = clone $this->engine; // Deep clone
    }
}

$car1 = new Car();
$car2 = clone $car1;

$car2->engine->type = "Electric";

echo $car1->engine->type; // V8 (unchanged)
```

Without the explicit `clone`, `$car1->engine` and `$car2->engine` would reference the same object.

---

## References and Object Identity

Objects in PHP are compared **by identity** using the `===` operator.

```php
$a = new stdClass();
$b = $a;
$c = clone $a;

var_dump($a === $b); // true  (same object)
var_dump($a === $c); // false (different object)
```

Even if `$a` and `$c` contain identical data, they are **distinct instances**.

---

## Summary

| Concept                         | Description                                     |
| ------------------------------- | ----------------------------------------------- |
| **Assignment behavior**         | Objects are assigned by reference               |
| **Cloning**                     | Creates a new, independent copy                 |
| **`__clone()` method**          | Customizes cloning behavior                     |
| **Shallow cloning**             | Default behavior; nested objects not cloned     |
| **Deep cloning**                | Must be implemented manually                    |
| **Identity comparison (`===`)** | Checks if variables reference the same instance |

---

## Related Topics

* [References and Copies](https://github.com/leandroleonard/php/blob/main/02-basics/references_and_copy.md)
* [Magic Methods](https://github.com/leandroleonard/php/blob/main/06-poo/magic_methods.md)
* [Classes and Objects in PHP](#)
* [Memory Management](#)