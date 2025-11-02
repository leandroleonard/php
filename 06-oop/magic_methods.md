# Magic Methods in PHP

Magic methods are special methods built into PHP that start with double underscores (`__`).  
They allow developers to **customize object behavior**, such as property access, method calls, object serialization, and cloning.

---

## What Are Magic Methods?

Magic methods are **not called explicitly** by your code.  
Instead, PHP **automatically triggers** them in certain situations.

For example:
- Accessing a non-existent property triggers `__get()`.
- Calling an undefined method triggers `__call()`.
- Converting an object to a string triggers `__toString()`.

---

## List of Magic Methods

| Method | Triggered When... | Common Use |
|:-------|:------------------|:------------|
| `__construct()` | An object is created | Initialize properties |
| `__destruct()` | An object is destroyed | Cleanup, closing files or DB connections |
| `__call()` | Calling undefined methods | Dynamic method handling |
| `__callStatic()` | Calling undefined static methods | Static dynamic behavior |
| `__get()` | Accessing undefined properties | Lazy loading or computed properties |
| `__set()` | Assigning to undefined properties | Input validation or dynamic properties |
| `__isset()` | `isset()` or `empty()` on undefined property | Custom property existence logic |
| `__unset()` | `unset()` on undefined property | Handle dynamic deletion |
| `__sleep()` | `serialize()` is called | Prepare object for serialization |
| `__wakeup()` | `unserialize()` is called | Re-establish resources after unserialization |
| `__toString()` | Object used as a string | Define readable string form |
| `__invoke()` | Object called as a function | Make objects callable |
| `__set_state()` | Object exported with `var_export()` | Define export behavior |
| `__clone()` | Object is cloned | Define clone logic |
| `__debugInfo()` | `var_dump()` is called | Control debug output |

---

## Basic Example

```php
<?php
class User {
    private $data = [];

    public function __set($name, $value) {
        echo "Setting '$name' to '$value'\n";
        $this->data[$name] = $value;
    }

    public function __get($name) {
        echo "Getting '$name'\n";
        return $this->data[$name] ?? null;
    }
}

$user = new User();
$user->name = "Leandro";   // __set triggered
echo $user->name;          // __get triggered
```

**Behavior & Output:**

```
Setting 'name' to 'Leandro'
Getting 'name'
Leandro
```

---

## Common Magic Methods in Detail

### 1. `__construct()` and `__destruct()`

Used for **object lifecycle management**.

```php
class Connection {
    public function __construct() {
        echo "Connected to database.\n";
    }

    public function __destruct() {
        echo "Connection closed.\n";
    }
}

$conn = new Connection(); // Connected
unset($conn);             // Connection closed
```

---

### 2. `__call()` and `__callStatic()`

Handle **calls to undefined methods** dynamically.

```php
class Router {
    public function __call($name, $args) {
        echo "Instance method '$name' called with args: ";
        print_r($args);
    }

    public static function __callStatic($name, $args) {
        echo "Static method '$name' called with args: ";
        print_r($args);
    }
}

$router = new Router();
$router->go('home');           // __call()
Router::redirect('about');     // __callStatic()
```

---

### 3. `__toString()`

Triggered when an object is **treated as a string**.

```php
class Person {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function __toString() {
        return "Person: {$this->name}";
    }
}

echo new Person("Alice"); // Person: Alice
```

---

### 4. `__invoke()`

Allows **objects to be called like functions**.

```php
class Adder {
    public function __invoke($a, $b) {
        return $a + $b;
    }
}

$sum = new Adder();
echo $sum(2, 3); // 5
```

---

### 5. `__clone()`

Customizes how an object is **duplicated**.

```php
class User {
    public $id;
    public $name;

    public function __clone() {
        $this->id = null; // Reset ID on clone
    }
}

$u1 = new User();
$u1->id = 10;
$u2 = clone $u1;

echo $u2->id; // null
```

---

### 6. `__debugInfo()`

Customize what `var_dump()` shows.

```php
class Secret {
    private $password = '12345';

    public function __debugInfo() {
        return ['info' => 'hidden'];
    }
}

var_dump(new Secret());
```

**Output:**

```
object(Secret)#1 (1) {
  ["info"]=>
  string(6) "hidden"
}
```

---

## Advanced Example: Dynamic ORM-like Behavior

```php
class Model {
    private $attributes = [];

    public function __get($name) {
        return $this->attributes[$name] ?? null;
    }

    public function __set($name, $value) {
        $this->attributes[$name] = $value;
    }

    public function __call($name, $args) {
        if (strpos($name, 'findBy') === 0) {
            $field = strtolower(substr($name, 6));
            return "SELECT * FROM table WHERE $field = '{$args[0]}'";
        }
        throw new Exception("Undefined method $name");
    }
}

$user = new Model();
$user->name = "Leandro";
echo $user->findByName("Leandro");
```

**Output:**

```
SELECT * FROM table WHERE name = 'Leandro'
```

---

## Best Practices

Use magic methods sparingly — overusing them can make debugging harder.
Always document when using `__call`, `__get`, or `__set`.
Avoid logic that hides real errors (like typos in property names).
Use them mainly for **framework-level abstractions** or **dynamic APIs**.

---

## Summary

Magic methods:

* Start with `__`
* Are automatically triggered by PHP
* Add flexibility to object-oriented code
* Should be used carefully for readability and maintainability

---

## 📎 Related Topics

* [Type Declarations in PHP](#)
* [Object-Oriented Programming Basics](#)
* [Traits and Interfaces in PHP](#)

---
