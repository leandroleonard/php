# Understanding Anonymous Classes in PHP

**Anonymous classes** in PHP are classes **without a name**, defined directly where they are needed.
They were introduced in **PHP 7.0** to provide a lightweight, flexible way to create simple class instances on the fly — especially useful for temporary objects or quick implementations.

---

## 📖 Table of Contents

1. [Overview](#overview)
2. [Basic Syntax](#basic-syntax)
3. [Using Anonymous Classes as Objects](#using-anonymous-classes-as-objects)
4. [Anonymous Classes with Inheritance](#anonymous-classes-with-inheritance)
5. [Implementing Interfaces and Using Traits](#implementing-interfaces-and-using-traits)
6. [Passing Anonymous Classes as Dependencies](#passing-anonymous-classes-as-dependencies)
7. [When to Use Anonymous Classes](#when-to-use-anonymous-classes)
8. [Limitations](#limitations)
9. [Summary](#summary)
10. [Related Topics](#related-topics)

---

## Overview

Anonymous classes are defined using the `new class` syntax and **do not have a name**.
They are created and instantiated immediately, often in one line.

They are useful when:

* You need a **one-time-use class** (e.g., quick testing or small logic).
* You want to **avoid polluting the global namespace**.
* You are defining **temporary dependencies** or **callback handlers**.

---

## Basic Syntax

```php
$object = new class {
    public function sayHello() {
        return "Hello from an anonymous class!";
    }
};

echo $object->sayHello();
// Output: Hello from an anonymous class!
```

Here, PHP creates a **new class instance** on the fly without a class name.

---

## Using Anonymous Classes as Objects

They behave just like normal objects — you can define properties, methods, and even constructors.

```php
$person = new class("Leandro") {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function greet() {
        return "Hello, " . $this->name . "!";
    }
};

echo $person->greet();
// Output: Hello, Leandro!
```

---

## Anonymous Classes with Inheritance

Anonymous classes can extend other classes.

```php
class Animal {
    public function speak() {
        return "Some sound...";
    }
}

$dog = new class extends Animal {
    public function speak() {
        return "Woof!";
    }
};

echo $dog->speak(); // Output: Woof!
```

This works just like normal class inheritance.

---

## Implementing Interfaces and Using Traits

You can implement interfaces and use traits inside anonymous classes as well:

```php
interface Logger {
    public function log($message);
}

trait Timestamp {
    public function timestamp() {
        return date('Y-m-d H:i:s');
    }
}

$logger = new class implements Logger {
    use Timestamp;

    public function log($message) {
        echo "[{$this->timestamp()}] $message\n";
    }
};

$logger->log("Anonymous class logging works!");
```

---

## Passing Anonymous Classes as Dependencies

They are great for **dependency injection** when you need a simple, one-off implementation:

```php
function process(Logger $logger) {
    $logger->log("Processing started...");
}

process(new class implements Logger {
    public function log($message) {
        echo $message . "\n";
    }
});

// Output: Processing started...
```

No need to create a named class for a single use case!

---

## When to Use Anonymous Classes

✅ Temporary or throwaway implementations.
✅ Quick interface or trait tests.
✅ Lightweight dependency injection.
✅ To encapsulate small pieces of logic locally.

---

## Limitations

* Cannot be autoloaded (no name to reference).
* Harder to debug or reuse later.
* Overuse can make code harder to read.
* Not ideal for large or shared components.

---

## Summary

| Concept                   | Description                      |
| ------------------------- | -------------------------------- |
| **Introduced in**         | PHP 7.0                          |
| **Syntax**                | `new class { ... }`              |
| **Supports inheritance**  | Yes                            |
| **Implements interfaces** | Yes                            |
| **Uses traits**           | Yes                            |
| **Autoloadable**          | No                             |
| **Main purpose**          | Quick, local, disposable classes |

---

## 🔗 Related Topics

* [Traits in PHP](#https://github.com/leandroleonard/php/blob/main/06-oop/traits.md)
* [Interfaces in PHP](#https://github.com/leandroleonard/php/blob/main/06-oop/interfaces.md)
* [Dependency Injection](#https://github.com/leandroleonard/php/blob/main/06-oop/dependency_injection.md)