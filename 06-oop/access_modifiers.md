# Access Modifiers in PHP

## 📚 Table of Contents

1. [Summary](#summary)
2. [Introduction](#introduction)
3. [Types of Access Modifiers](#types-of-access-modifiers)

   * [Public](#1-public)
   * [Protected](#2-protected)
   * [Private](#3-private)
4. [Access Modifiers in Inheritance](#access-modifiers-in-inheritance)
5. [Access Modifiers for Properties vs Methods](#access-modifiers-for-properties-vs-methods)
6. [Access Modifiers in Interfaces and Abstract Classes](#access-modifiers-in-interfaces-and-abstract-classes)
7. [Best Practices](#best-practices)
8. [Summary Table](#summary-table)
9. [References](#references)

---

## Summary

Access modifiers in PHP control the **visibility** of class properties and methods.
They define **how and where** these members can be accessed — within the same class, by inherited classes, or from outside.

PHP supports **three** visibility levels:

* `public` — accessible everywhere.
* `protected` — accessible only within the class and its subclasses.
* `private` — accessible only within the class that defines it.

---

## Introduction

Encapsulation is one of the key principles of **Object-Oriented Programming (OOP)**.
Access modifiers help enforce encapsulation by restricting direct access to a class’s internal data and behavior.

This allows developers to:

* Hide implementation details.
* Expose only what’s necessary.
* Maintain code consistency and prevent unintended modification.

---

## Types of Access Modifiers

### 1. `public`

Members declared as `public` are **accessible from anywhere** — inside or outside the class.

```php
class User {
    public $name;

    public function sayHello() {
        return "Hello, {$this->name}!";
    }
}

$user = new User();
$user->name = "Leandro";
echo $user->sayHello(); // Hello, Leandro!
```

**Use case:** When the property or method needs to be globally accessible.

---

### 2. `protected`

Members declared as `protected` can be accessed:

* Within the same class.
* Within subclasses (child classes).
* Not accessible outside the class hierarchy.

```php
class Animal {
    protected $species = "Unknown";

    protected function getSpecies() {
        return $this->species;
    }
}

class Dog extends Animal {
    public function showSpecies() {
        return $this->getSpecies();
    }
}

$dog = new Dog();
echo $dog->showSpecies(); // Unknown
// echo $dog->getSpecies(); // Error: protected method
```

**Use case:** When a property or method is shared within a class family but shouldn’t be exposed to the outside world.

---

### 3. `private`

Members declared as `private` can be accessed **only within the same class**.
They are **not inherited**.

```php
class BankAccount {
    private $balance = 0;

    public function deposit($amount) {
        $this->balance += $amount;
    }

    public function getBalance() {
        return $this->balance;
    }
}

class SavingsAccount extends BankAccount {
    public function showBalance() {
        // return $this->balance; // Error: Cannot access private property
    }
}

$account = new BankAccount();
$account->deposit(100);
echo $account->getBalance(); // 100
```

**Use case:** When you need full encapsulation and data protection.

---

## Access Modifiers in Inheritance

| Visibility    | Same Class | Subclass | Outside Class |
| ------------- | ---------- | -------- | ------------- |
| **public**    | X          | X        | X             |
| **protected** | X          | X        |              |
| **private**   | X          |         |             |

---

## Access Modifiers for Properties vs Methods

Both properties and methods can use visibility modifiers.

Example:

```php
class Example {
    public publicProperty = "I am public";
    protected protectedProperty = "I am protected";
    private privateProperty = "I am private";

    public function show() {
        echo $this->protectedProperty;
    }
}
```

Visibility behaves **the same** for both.

---

## Access Modifiers in Interfaces and Abstract Classes

* All methods in **interfaces** are **implicitly public** — you can’t make them protected or private.
* In **abstract classes**, you can use any visibility modifier.

```php
interface Loggable {
    public function log($message);
}

abstract class Logger {
    protected abstract function formatMessage($message);
}
```

---

## Best Practices

Use **private** by default, and only relax to `protected` or `public` when necessary.
Provide **public getters and setters** instead of exposing properties directly.
Keep **internal logic hidden** — expose only meaningful public APIs.
Avoid using `public` variables directly unless you have a good reason.

---

## Summary Table

| Modifier    | Visibility         | Inheritance | Typical Use                      |
| ----------- | ------------------ | ----------- | -------------------------------- |
| `public`    | Everywhere         | Yes         | Public APIs, utilities           |
| `protected` | Class + Subclasses | Yes         | Shared logic within class family |
| `private`   | Only same class    | No          | Internal state and logic         |

---

## References

* [PHP Manual: Visibility](https://www.php.net/manual/en/language.oop5.visibility.php)
* [PHP RFC: Access Modifiers Overview](https://wiki.php.net/rfc)
* [PSR-12: Coding Style Guide](https://www.php-fig.org/psr/psr-12/)

