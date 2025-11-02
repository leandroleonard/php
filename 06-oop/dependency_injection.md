
# Dependency Injection in PHP

Dependency Injection (DI) is a **design pattern** that allows you to remove hard-coded dependencies between classes, making your code **more flexible, testable, and maintainable**.

---

## 🧭 Table of Contents

1. [Overview](#overview)
2. [Why Dependency Injection Matters](#why-dependency-injection-matters)
3. [Basic Example](#basic-example)
4. [Constructor Injection](#constructor-injection)
5. [Setter Injection](#setter-injection)
6. [Interface Injection](#interface-injection)
7. [Using Dependency Injection Containers](#using-dependency-injection-containers)
8. [Example with Laravel’s Service Container](#example-with-laravels-service-container)
9. [Benefits of Dependency Injection](#benefits-of-dependency-injection)
10. [Common Pitfalls](#common-pitfalls)
11. [Summary](#summary)
12. [Related Topics](#related-topics)

---

## Overview

Dependency Injection (DI) is a technique in which an **object receives its dependencies from the outside**, rather than creating them itself.

In simple terms:
> Instead of a class *creating* what it needs, it is *given* what it needs.

This helps you **decouple** your classes and **improve testability**.

---

## Why Dependency Injection Matters

Without DI, your code becomes rigid and hard to test.

### Tight Coupling Example

```php
class EmailService {
    public function send($message) {
        echo "Sending: $message";
    }
}

class UserController {
    private $emailService;

    public function __construct() {
        $this->emailService = new EmailService(); // Hard dependency
    }

    public function notify($message) {
        $this->emailService->send($message);
    }
}

$controller = new UserController();
$controller->notify("Hello!");
```

Here, `UserController` is **tightly coupled** to `EmailService`.
You cannot easily swap or mock the service for testing.

---

## Basic Example with Dependency Injection

```php
class EmailService {
    public function send($message) {
        echo "Sending: $message";
    }
}

class UserController {
    private $mailer;

    // Dependency is injected through the constructor
    public function __construct(EmailService $mailer) {
        $this->mailer = $mailer;
    }

    public function notify($message) {
        $this->mailer->send($message);
    }
}

$mailer = new EmailService();
$controller = new UserController($mailer);
$controller->notify("Welcome!");
```

**Now:**

* `UserController` doesn’t care how `EmailService` works.
* You can easily replace it with another implementation.

---

## Constructor Injection

Constructor Injection is the **most common** form of dependency injection.

```php
class Logger {
    public function log($message) {
        echo "[LOG] $message";
    }
}

class OrderService {
    private $logger;

    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    public function placeOrder() {
        $this->logger->log("Order placed successfully!");
    }
}

$logger = new Logger();
$orderService = new OrderService($logger);
$orderService->placeOrder();
```

---

## Setter Injection

Injecting a dependency through a **setter method** instead of the constructor.

```php
class PaymentService {
    private $gateway;

    public function setGateway($gateway) {
        $this->gateway = $gateway;
    }

    public function process() {
        $this->gateway->charge();
    }
}
```

This allows **optional dependencies** to be set later.

---

## Interface Injection

Uses an interface to ensure the injected dependency provides specific methods.

```php
interface PaymentGateway {
    public function charge();
}

class PayPalGateway implements PaymentGateway {
    public function charge() {
        echo "Charging via PayPal";
    }
}

class PaymentService {
    private $gateway;

    public function __construct(PaymentGateway $gateway) {
        $this->gateway = $gateway;
    }

    public function process() {
        $this->gateway->charge();
    }
}

$service = new PaymentService(new PayPalGateway());
$service->process();
```

---

## Using Dependency Injection Containers

A **Dependency Injection Container (DIC)** is a tool that automatically provides dependencies when needed.

Instead of manually creating dependencies, you *register* and *resolve* them.

Example of a simple PHP DIC:

```php
class Container {
    private $bindings = [];

    public function set($name, $resolver) {
        $this->bindings[$name] = $resolver;
    }

    public function get($name) {
        return $this->bindings[$name]($this);
    }
}

$container = new Container();

$container->set('logger', function() {
    return new Logger();
});

$container->set('orderService', function($c) {
    return new OrderService($c->get('logger'));
});

$orderService = $container->get('orderService');
$orderService->placeOrder();
```

---

## Example with Laravel’s Service Container

Laravel provides a powerful built-in DI container that **automatically resolves dependencies**.

```php
class ReportService {
    protected $logger;

    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }
}
```

Laravel automatically resolves it:

```php
$reportService = app(ReportService::class);
```

You can also bind custom implementations:

```php
app()->bind(Logger::class, FileLogger::class);
```

---

## Benefits of Dependency Injection

Promotes **loose coupling**
Makes **unit testing** easier (you can inject mocks)
Improves **code reusability** and **readability**
Encourages **clean architecture** and separation of concerns
Enables **inversion of control (IoC)**

---

## Common Pitfalls

| Issue               | Description                                                         |
| :------------------ | :------------------------------------------------------------------ |
| Over-injection      | Too many constructor parameters may indicate a class doing too much |
| Hidden dependencies | Avoid creating objects inside methods that bypass DI                |
| Misusing containers | The container is a tool, not a replacement for clear architecture   |

---

## Summary

**Dependency Injection (DI)** is a way to give objects what they need, rather than having them build it themselves.
It’s fundamental for writing modular, testable, and maintainable PHP applications.

* Use **constructor injection** for required dependencies.
* Use **setter injection** for optional ones.
* Use a **container** to manage dependencies automatically.

---

## 🔗 Related Topics

* [Inversion of Control (IoC)](https://en.wikipedia.org/wiki/Inversion_of_control)
* [Service Containers in Laravel](https://laravel.com/docs/container)
* [SOLID Principles in PHP](https://phptherightway.com/#solid)
* [PHP Interfaces](https://www.php.net/manual/en/language.oop5.interfaces.php)
* [PHP Interfaces - Git](https://github.com/leandroleonard/php/blob/main/06-poo/interfaces.md)

