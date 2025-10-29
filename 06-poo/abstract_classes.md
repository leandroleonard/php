# **Abstract Classes** in PHP

An **abstract class** in PHP is a blueprint for other classes.  
It defines **common behavior and structure** but cannot be instantiated directly.  
Abstract classes are key to building consistent, reusable, and organized object-oriented code.

---

## 📖 Table of Contents

1. [Overview](#overview)  
2. [Basic Syntax](#basic-syntax)  
3. [Abstract Methods](#abstract-methods)  
4. [Instantiation Rules](#instantiation-rules)  
5. [Example — Real Implementation](#example--real-implementation)  
6. [Key Points](#key-points)  
7. [Abstract Classes vs Interfaces](#abstract-classes-vs-interfaces)  
8. [Practical Use Cases](#practical-use-cases)  
9. [Summary](#summary)  
10. [Related](#related)

---

## Overview

An abstract class acts as a **template** that defines what all its subclasses must implement.  
It can contain:
- **Abstract methods** (no implementation)
- **Concrete methods** (implemented normally)
- **Properties and constants**

You **cannot create an object** directly from an abstract class — you must extend it.

---

## Basic Syntax

```php
<?php

abstract class Animal {
    abstract public function makeSound();

    public function sleep() {
        echo "Sleeping...\n";
    }
}
```

> Any class with at least one abstract method must also be declared as `abstract`.

---

## Abstract Methods

Abstract methods have **no body** — they define a contract that child classes must fulfill.

```php
abstract class Animal {
    abstract public function makeSound();
}
```

Subclasses are **required** to implement these methods:

```php
class Dog extends Animal {
    public function makeSound() {
        echo "Woof!";
    }
}
```

---

## Instantiation Rules

You **cannot instantiate** an abstract class directly:

```php
$animal = new Animal(); 
// Fatal error: Cannot instantiate abstract class Animal
```

You must extend it and create an instance of a **concrete subclass**.

---

## Example — Real Implementation

```php
<?php

abstract class Animal {
    abstract public function makeSound();

    public function sleep() {
        echo "Sleeping...\n";
    }
}

class Dog extends Animal {
    public function makeSound() {
        echo "Woof!\n";
    }
}

class Cat extends Animal {
    public function makeSound() {
        echo "Meow!\n";
    }
}

$dog = new Dog();
$dog->makeSound(); // Woof!
$dog->sleep();     // Sleeping...

$cat = new Cat();
$cat->makeSound(); // Meow!
```

---

## Key Points

| Concept              | Description                               |
| -------------------- | ----------------------------------------- |
| **Purpose**          | Define a template or base class           |
| **Instantiation**    | Cannot be instantiated directly           |
| **Abstract Methods** | Must be implemented by subclasses         |
| **Concrete Methods** | Optional — can include default logic      |
| **Properties**       | Allowed                                   |
| **Access Modifiers** | Must be compatible with parent definition |

---

## Abstract Classes vs Interfaces

| Feature                | Abstract Class            | Interface              |
| ---------------------- | ------------------------- | ---------------------- |
| Can have properties    | Yes                     | No                   |
| Can have method bodies | Yes                     | No                   |
| Multiple inheritance   | No                      | Yes                  |
| Purpose                | Share structure and logic | Define a contract only |
| Instantiation          | No                      | No                   |

---

## Practical Use Cases

* Defining **common base behavior** (e.g. `Vehicle`, `Shape`, `PaymentGateway`)
* Enforcing **method contracts** across child classes
* Providing **default logic** while allowing customization
* Creating **consistent APIs** across subclasses

---

## Summary

| Feature                       | Description                         |
| ----------------------------- | ----------------------------------- |
| **Type**                      | Class modifier                      |
| **Purpose**                   | Enforces structure and shared logic |
| **Can be instantiated**       | No                                |
| **Supports abstract methods** | Yes                               |
| **Supports concrete methods** | Yes                               |
| **Encourages code reuse**     | Strongly                          |

---

## Related
* [Interfaces](https://github.com/leandroleonard/php/blob/main/06-poo/interfaces.md)
* [Traits](https://github.com/leandroleonard/php/blob/main/06-poo/traits.md)
* [Polymorphism](#)