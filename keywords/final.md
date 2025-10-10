# 🐘 Understanding the `final` Keyword in PHP

The `final` keyword in PHP is used to **restrict inheritance** or **method overriding** in object-oriented programming (OOP).  
It ensures that certain classes or methods **cannot be modified** or **extended** further.

---

## 📖 Table of Contents

1. [Overview](#overview)
2. [Basic Usage](#basic-usage)
3. [Final Classes](#final-classes)
4. [Final Methods](#final-methods)
5. [Inheritance Restrictions](#inheritance-restrictions)
6. [Best Practices](#best-practices)
7. [Common Mistakes](#common-mistakes)
8. [Summary](#summary)
9. [Related Concepts](#related)

---

## Overview

The `final` keyword can be applied to:
- **Classes**, to prevent them from being inherited.
- **Methods**, to prevent them from being overridden in child classes.

It helps maintain **code integrity** by locking down behavior that should not change.

---

## Basic Usage

```php
final class BaseClass {
    public function sayHello() {
        echo "Hello from BaseClass!";
    }
}

// This will cause a fatal error
class ChildClass extends BaseClass {}
```
Result: Fatal error: Class ChildClass may not inherit from final class (BaseClass)

## Final Classes

A final class cannot be extended by any other class.
This is useful for utility or security-sensitive classes that should not be modified.

```php
final class Logger {
    public function log($message) {
        echo "[LOG]: $message";
    }
}

// Error: Cannot extend a final class
class FileLogger extends Logger {}

```

## Final Methods

A final method can exist in a non-final class.
Child classes can extend the parent, but they cannot override that specific method.

```php
class ParentClass {
    final public function greet() {
        echo "Hello from ParentClass!";
    }

    public function normalMethod() {
        echo "This can be overridden.";
    }
}

class ChildClass extends ParentClass {
    // Error: Cannot override final method
    public function greet() {
        echo "Hello from ChildClass!";
    }

    // Allowed
    public function normalMethod() {
        echo "Overridden method!";
    }
}

```

## Inheritance Restrictions

When a method is declared final, it remains inherited, but cannot be redefined.

```php
class Base {
    final public function save() {
        echo "Saving data...";
    }
}

class Derived extends Base {
    // This causes a fatal error if attempted
    // public function save() {}
}
```

You can still call final methods in subclasses — you just can't redefine them.


## Best Practices

Use final when a class or method is core to your system’s logic and must remain stable.

Common use cases:

- Framework base classes (e.g., Laravel’s core helpers)

- Immutable objects or singletons

- Security or logging mechanisms

Example:

```php
final class TokenGenerator {
    public static function generate() {
        return bin2hex(random_bytes(16));
    }
}
```

## Common Mistakes

| Mistake                         | Explanation                                                  |
| ------------------------------- | ------------------------------------------------------------ |
| Declaring `final` on properties | Not allowed — `final` only applies to classes and methods. |
| Trying to extend a final class  | Causes a fatal error.                                      |
| Overriding a final method       | Causes a fatal error.                                      |


# Summary

| Concept          | Description                                 |
| ---------------- | ------------------------------------------- |
| **Keyword Type** | Language keyword                            |
| **Purpose**      | Prevent inheritance or overriding           |
| **Applies To**   | Classes and methods only                    |
| **Affects**      | Inheritance and polymorphism                |
| **Common Use**   | Security, immutability, framework internals |

## Related

<a href="#">abstract</a> — Defines methods that must be implemented by child classes

<a href="#">extends</a> — Defines class inheritance

<a href="https://www.php.net/manual/en/language.oop5.final.php" target="blank">final keyword (PHP Manual)</a>