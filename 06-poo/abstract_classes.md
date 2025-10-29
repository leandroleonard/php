````markdown
# Abstract Classes in PHP

## 🧭 Table of Contents
1. [Summary](#summary)  
2. [What is an Abstract Class?](#what-is-an-abstract-class)  
3. [Syntax](#syntax)  
4. [How Abstract Classes Work](#how-abstract-classes-work)  
5. [Abstract Methods](#abstract-methods)  
6. [Example: Abstract Class in Action](#example-abstract-class-in-action)  
7. [Key Points](#key-points)  
8. [Abstract Classes vs Interfaces](#abstract-classes-vs-interfaces)  
9. [Practical Use Cases](#practical-use-cases)  
10. [Conclusion](#conclusion)

---

## 🧩 Summary
In PHP, an **abstract class** is a special type of class that cannot be instantiated directly.  
It serves as a **blueprint** for other classes and is used to define **common behaviors and structure** that child classes must implement.

Abstract classes help enforce a consistent API and promote code reusability and organization.

---

## 📘 What is an Abstract Class?

An **abstract class**:
- Cannot be instantiated directly.
- May contain **abstract methods** (without implementation).
- May also contain **regular methods** with implementation.
- Is used as a **base class** for other classes.

Think of it as a **template** that defines how child classes should behave.

---

## 🧱 Syntax

```php
<?php

abstract class Animal {
    // Abstract method (must be implemented by subclasses)
    abstract public function makeSound();

    // Regular method
    public function sleep() {
        echo "Sleeping...\n";
    }
}
````

> Any class with at least one `abstract` method must itself be declared as `abstract`.

---

## ⚙️ How Abstract Classes Work

1. You **cannot** create an instance of an abstract class directly.
2. You **must** create a subclass that extends the abstract class.
3. The subclass **must implement** all abstract methods.

---

## 🧠 Abstract Methods

An **abstract method** is declared without a body.
It defines a method signature that subclasses are forced to implement.

```php
abstract public function makeSound();
```

Each subclass must define its own version of `makeSound()`.

---

## 🧩 Example: Abstract Class in Action

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
$dog->makeSound(); // Output: Woof!
$dog->sleep();     // Output: Sleeping...

$cat = new Cat();
$cat->makeSound(); // Output: Meow!
```

---

## 📋 Key Points

* Abstract classes **cannot be instantiated**.
* They may contain both **abstract and concrete** methods.
* Child classes must **implement all abstract methods**.
* Useful for defining **base functionality** that other classes extend.

---

## ⚖️ Abstract Classes vs Interfaces

| Feature                      | Abstract Class               | Interface                   |
| ---------------------------- | ---------------------------- | --------------------------- |
| Instantiation                | ❌ Not possible               | ❌ Not possible              |
| Contains implemented methods | ✅ Yes                        | ❌ No                        |
| Can have properties          | ✅ Yes                        | ❌ No                        |
| Multiple inheritance         | ❌ No                         | ✅ Yes (multiple interfaces) |
| Purpose                      | Share behavior and structure | Define a contract only      |

---

## 💡 Practical Use Cases

* Defining a **common base** for similar objects (e.g., `Vehicle`, `Shape`, `PaymentGateway`).
* Enforcing consistent method signatures across subclasses.
* Providing **default implementations** shared among derived classes.

---

## 🏁 Conclusion

Abstract classes in PHP are a core **object-oriented programming** feature that promote clean architecture and consistent design.

They let developers:

* Define shared logic,
* Enforce structure across subclasses,
* And maintain code reusability with clear hierarchies.

> ✅ Use abstract classes when multiple classes share common functionality but need to implement specific behaviors differently.

---

```
```
