# PHP Garbage Collection (GC)

Garbage Collection (GC) in PHP is the process by which the engine **automatically frees memory** by cleaning up variables and objects that are **no longer in use**.

Understanding how it works is crucial for writing **efficient, memory-safe applications**, especially those that handle large datasets or long-running processes.

---

## 🧭 Table of Contents

1. [Overview](#overview)
2. [What Is Garbage Collection?](#what-is-garbage-collection)
3. [How Memory Management Works in PHP](#how-memory-management-works-in-php)
4. [Reference Counting](#reference-counting)
5. [Circular References Problem](#circular-references-problem)
6. [How Garbage Collection Solves It](#how-garbage-collection-solves-it)
7. [Controlling the Garbage Collector](#controlling-the-garbage-collector)
8. [GC Configuration and Performance](#gc-configuration-and-performance)
9. [Practical Examples](#practical-examples)
10. [Monitoring Memory Usage](#monitoring-memory-usage)
11. [Best Practices](#best-practices)
12. [Summary](#summary)
13. [Related Topics](#related-topics)

---

## Overview

PHP uses a **reference counting system** to manage memory.  
When a variable or object is **no longer referenced anywhere**, it is **eligible for destruction** and its memory is reclaimed.

However, some structures — like **circular references** — can cause memory to remain allocated even after all visible references are gone.  
That’s where **Garbage Collection (GC)** steps in.

---

## What Is Garbage Collection?

> Garbage Collection is the automatic process of **detecting and cleaning up memory that is no longer reachable** by the running program.

PHP’s garbage collector:
- Detects **reference cycles** between objects.
- Frees them safely.
- Runs periodically or when manually triggered.

---

## How Memory Management Works in PHP

Each variable or object in PHP has an **internal reference counter**:

- When you assign a variable, the counter increases.
- When it goes out of scope or is unset, the counter decreases.
- When the counter reaches **zero**, PHP frees that memory.

Example:

```php
$a = "Hello";
$b = $a; // Two references to the same string
unset($a); // One reference remains
unset($b); // No references -> memory released
```

---

## Reference Counting

Each variable in PHP has a "refcount" — a number that tells how many variables point to it.

You can inspect this using the `debug_zval_dump()` function:

```php
$var = "Hello";
$alias = $var;

debug_zval_dump($var);
```

Output (simplified):

```
string(5) "Hello" refcount(2)
```

When `refcount` drops to 0, PHP automatically deallocates it.

---

## Circular References Problem

Circular references occur when **two or more objects reference each other**, preventing their reference count from ever reaching zero.

```php
class Node {
    public $ref;
}

$a = new Node();
$b = new Node();

$a->ref = $b;
$b->ref = $a;

unset($a, $b); // ❌ Memory leak without GC
```

Here, `$a` references `$b` and `$b` references `$a`.
Their reference count never drops to 0 — creating a **memory leak**.

---

## How Garbage Collection Solves It

PHP’s garbage collector scans memory periodically to detect **circular reference cycles** and clean them up.

It identifies:

1. Objects no longer reachable from the main scope.
2. Cycles of references between such objects.
3. Frees them safely.

You can control the GC behavior using built-in functions.

---

## Controlling the Garbage Collector

| Function              | Description                                      |
| :-------------------- | :----------------------------------------------- |
| `gc_enable()`         | Enables the garbage collector (default: enabled) |
| `gc_disable()`        | Disables it                                      |
| `gc_collect_cycles()` | Forces an immediate garbage collection cycle     |
| `gc_status()`         | Returns information about the GC state           |

### Example

```php
gc_disable();
echo "GC Disabled: ";
var_dump(gc_enabled());

gc_enable();
echo "GC Enabled: ";
var_dump(gc_enabled());

gc_collect_cycles(); // Run GC manually
```

---

## GC Configuration and Performance

You can control garbage collection behavior via `php.ini`:

```ini
; Enable or disable garbage collection
zend.enable_gc = On

; Adjust collection thresholds
gc_divisor = 1000
gc_probability = 1
```

Together, these form a ratio:

```
gc_probability / gc_divisor
```

For example, with `1/1000`, the GC runs **roughly once every 1000 requests**.

---

## Practical Examples

### 1. Manual Collection Example

```php
class Test {
    public $selfRef;
}

$obj = new Test();
$obj->selfRef = $obj;

unset($obj);
echo "Collected cycles: " . gc_collect_cycles();
```

Output:

```
Collected cycles: 1
```

### 2. Tracking Memory Usage

```php
echo "Before: " . memory_get_usage() . "\n";

for ($i = 0; $i < 10000; $i++) {
    $a[] = new stdClass();
}

unset($a);
gc_collect_cycles();

echo "After: " . memory_get_usage() . "\n";
```

---

## Monitoring Memory Usage

PHP provides several functions to inspect memory behavior:

| Function                  | Description                               |
| :------------------------ | :---------------------------------------- |
| `memory_get_usage()`      | Current memory usage                      |
| `memory_get_peak_usage()` | Peak memory usage during script execution |
| `gc_status()`             | Returns array with GC statistics          |

Example:

```php
print_r(gc_status());
```

Output (example):

```php
Array
(
    [runs] => 3
    [collected] => 42
    [threshold] => 10000
    [roots] => 5
)
```

---

## Best Practices

Avoid unnecessary object references.
Unset large variables when no longer needed.
Use `gc_collect_cycles()` in long-running scripts (e.g., daemons, queue workers).
Keep garbage collection enabled unless you have a performance-critical script where it causes measurable slowdown.
Be cautious with circular references in large data structures.

---

## Summary

* PHP uses **reference counting** to manage memory.
* **Garbage Collection (GC)** cleans up circular references automatically.
* You can **manually trigger** GC or **disable it** when needed.
* Always **monitor memory usage** in long-running or resource-heavy scripts.

In short:

> PHP’s garbage collector is your safety net — but writing clean, reference-free code is your best defense.

---

## 🔗 Related Topics

* [PHP Memory Management Internals](https://www.php.net/manual/en/features.gc.php)
* [gc_collect_cycles() Documentation](https://www.php.net/manual/en/function.gc-collect-cycles.php)
* [memory_get_usage()](https://www.php.net/manual/en/function.memory-get-usage.php)
* [Writing Memory-Efficient PHP Code](https://www.php.net/manual/en/features.gc.performance-considerations.php)

---