# Interfaces in PHP

An **interface** in PHP defines a **contract** that classes must follow.  
It specifies which methods a class must implement, without providing their implementation.

Interfaces are essential for achieving **polymorphism**, **loose coupling**, and **dependency injection** in object-oriented programming.

---

## 📖 Table of Contents

1. [Introduction](#introduction)
2. [Why Use Interfaces](#why-use-interfaces)
3. [Defining an Interface](#defining-an-interface)
4. [Implementing an Interface](#implementing-an-interface)
5. [Multiple Interfaces](#multiple-interfaces)
6. [Interface Inheritance](#interface-inheritance)
7. [Constants in Interfaces](#constants-in-interfaces)
8. [Type Hinting with Interfaces](#type-hinting-with-interfaces)
9. [Interfaces vs Abstract Classes](#interfaces-vs-abstract-classes)
10. [Real-World Example](#real-world-example)
11. [Best Practices](#best-practices)
12. [Summary](#summary)
13. [References](#references)

---

## Introduction

Interfaces are **blueprints for classes**.  
They declare **method signatures** that must be implemented by any class that "implements" the interface.

They help enforce consistent structure and allow for **interchangeable components**, especially in large applications or frameworks.

---

## Why Use Interfaces

Ensure consistency between classes.  
Promote loose coupling and modular design.  
Enable dependency injection and polymorphism.  
Support scalable architecture patterns (like Strategy, Repository, etc.).  
Improve maintainability and testability.

---

## Defining an Interface

An interface is defined using the `interface` keyword.

```php
<?php
interface LoggerInterface {
    public function log(string $message): void;
}
```

This defines a `LoggerInterface` that requires any implementing class to have a `log()` method.

---

## Implementing an Interface

A class must use the `implements` keyword to adopt an interface.

```php
<?php
class FileLogger implements LoggerInterface {
    public function log(string $message): void {
        echo "Writing to file: $message";
    }
}

$logger = new FileLogger();
$logger->log("Hello world!");
```

If a class doesn’t implement **all** methods of the interface, PHP will throw a **fatal error**.

---

## Multiple Interfaces

A class can implement **multiple interfaces**, separated by commas.

```php
<?php
interface Loggable {
    public function log(string $message): void;
}

interface Storable {
    public function save(array $data): void;
}

class DataManager implements Loggable, Storable {
    public function log(string $message): void {
        echo "Log: $message";
    }

    public function save(array $data): void {
        echo "Saving data...";
    }
}
```

This allows for flexible composition of behaviors without inheritance limitations.

---

## Interface Inheritance

Interfaces can **extend other interfaces**, forming a hierarchy.

```php
<?php
interface BaseLogger {
    public function log(string $message): void;
}

interface AdvancedLogger extends BaseLogger {
    public function logError(string $error): void;
}

class AppLogger implements AdvancedLogger {
    public function log(string $message): void {
        echo "Info: $message";
    }

    public function logError(string $error): void {
        echo "Error: $error";
    }
}
```

---

## Constants in Interfaces

Interfaces can contain **constants**, which implementing classes can use but **cannot override**.

```php
<?php
interface Status {
    public const SUCCESS = 1;
    public const FAILURE = 0;
}

class Operation implements Status {
    public function run(): int {
        return self::SUCCESS;
    }
}

echo Operation::SUCCESS; // Output: 1
```

---

## Type Hinting with Interfaces

Interfaces are often used as **type hints** in functions or constructors, allowing flexibility in passing different class implementations.

```php
<?php
interface PaymentGateway {
    public function pay(float $amount): bool;
}

class Paypal implements PaymentGateway {
    public function pay(float $amount): bool {
        echo "Paid $$amount via PayPal.";
        return true;
    }
}

class Stripe implements PaymentGateway {
    public function pay(float $amount): bool {
        echo "Paid $$amount via Stripe.";
        return true;
    }
}

// Function using interface type hint
function processPayment(PaymentGateway $gateway, float $amount) {
    $gateway->pay($amount);
}

processPayment(new Paypal(), 100);
processPayment(new Stripe(), 200);
```

Enables switching between implementations without changing core logic.

---

## Interfaces vs Abstract Classes

| Feature                  | Interface                                                | Abstract Class                  |
| ------------------------ | -------------------------------------------------------- | ------------------------------- |
| **Purpose**              | Define contract                                          | Define base functionality       |
| **Implementation**       | No method implementation                                 | Can contain implemented methods |
| **Multiple inheritance** | Yes (can implement multiple)                             | No (single inheritance)         |
| **Properties**           | Not allowed                                              | Allowed                         |
| **Constants**            | Allowed                                                  | Allowed                         |
| **Use case**             | When behavior varies but method signatures stay the same | When classes share common logic |

Example:

* Use an **interface** for a payment processor API.
* Use an **abstract class** for shared database logic.

---

## Real-World Example

A practical use of interfaces in a **logging system**:

```php
<?php
interface LoggerInterface {
    public function log(string $message): void;
}

class FileLogger implements LoggerInterface {
    public function log(string $message): void {
        echo "Logging to file: $message";
    }
}

class DatabaseLogger implements LoggerInterface {
    public function log(string $message): void {
        echo "Logging to database: $message";
    }
}

function saveData(LoggerInterface $logger) {
    $logger->log("Data saved successfully!");
}

saveData(new FileLogger());
saveData(new DatabaseLogger());
```

Both `FileLogger` and `DatabaseLogger` can be used interchangeably.
This design is common in frameworks like **Laravel** or **Symfony**.

---

## Best Practices

Use interfaces to **decouple** code and define clear contracts.
Keep interfaces **small and focused** — one purpose per interface.
Name interfaces clearly (e.g., `LoggerInterface`, `CacheInterface`).
Combine with **Dependency Injection** for flexible architecture.
Avoid adding constants or logic that break interface purity.

---

## Summary

* **Interfaces define contracts** — not implementations.
* Classes use `implements` to fulfill the interface.
* Multiple interfaces can be combined in one class.
* Ideal for **dependency injection** and **flexible architecture**.
* Help enforce consistent method structures across unrelated classes.

---

## References

* [PHP Manual: Interfaces](https://www.php.net/manual/en/language.oop5.interfaces.php)
* [OOP in PHP Documentation](https://www.php.net/manual/en/language.oop5.php)

