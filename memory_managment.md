# **PHP Memory Management**

PHP manages memory **automatically** through its **reference counting system** and **garbage collector (GC)**.
While most of the time you don’t need to handle memory manually, understanding how PHP allocates and frees memory helps you write **more efficient** and **bug-free** applications.

---

## 📖 Table of Contents

1. [Overview](#overview)
2. [How PHP Allocates Memory](#how-php-allocates-memory)
3. [Reference Counting](#reference-counting)
4. [Garbage Collection](#garbage-collection)
5. [Circular References](#circular-references)
6. [Memory Usage Functions](#memory-usage-functions)
7. [Optimizing Memory Usage](#optimizing-memory-usage)
8. [Summary](#summary)
9. [Related Topics](#related-topics)

---

## Overview

PHP uses a **dynamic memory model**, which means memory is allocated when variables or objects are created and freed when no longer needed.

Internally, PHP uses a **Reference Counting System** combined with a **Garbage Collector** to reclaim memory that is no longer in use.

---

## How PHP Allocates Memory

When you create a variable, PHP requests a chunk of memory from the system and manages it in its **own memory manager**.
This makes PHP fast and efficient but can also hide issues if scripts are poorly optimized.

```php
$a = "Hello PHP!";
$b = range(1, 100000); // Large array allocation
```

Each variable’s size depends on its **data type** and **contents**.

---

## Reference Counting

Every variable in PHP keeps a **reference count** — the number of variable names that point to the same value in memory.

```php
$a = "Hello";
$b = $a; // Reference count = 2

unset($a); // Reference count = 1
```

When the count drops to zero, PHP knows it can safely **free the memory**.

### Key Takeaway:

* Assigning variables increases reference count
* Unsetting or overwriting decreases it
* Memory is released only when count = 0

---

## Garbage Collection

The **Garbage Collector (GC)** handles **circular references** — cases where objects reference each other, preventing their reference counts from reaching zero.

Example of a circular reference:

```php
class Node {
    public $child;
}

$a = new Node();
$b = new Node();

$a->child = $b;
$b->child = $a;
```

Without GC, these two objects would **never be freed**, even after being unset.

PHP’s GC detects these cycles and frees them automatically.

---

## Circular References

Circular references usually occur in **object graphs** where two or more objects refer to each other.

You can manually trigger garbage collection if needed:

```php
gc_collect_cycles();
```

Or disable it (not recommended in production):

```php
gc_disable();
```

Check if GC is enabled:

```php
var_dump(gc_enabled()); // true or false
```

---

## Memory Usage Functions

PHP provides several functions to monitor memory usage:

| Function                  | Description                                      |
| ------------------------- | ------------------------------------------------ |
| `memory_get_usage()`      | Returns current memory usage (bytes)             |
| `memory_get_peak_usage()` | Returns the peak memory usage since script start |
| `gc_collect_cycles()`     | Forces collection of cyclic garbage              |
| `gc_status()`             | Returns detailed garbage collection statistics   |

Example:

```php
echo memory_get_usage(), "\n";
$array = range(1, 1000000);
echo memory_get_peak_usage(), "\n";
```

---

## Optimizing Memory Usage

Tips to reduce memory footprint:

* **Unset large arrays or objects** when no longer needed

  ```php
  unset($largeArray);
  ```
* **Use references** wisely to avoid unnecessary copies
* **Avoid circular references** when possible
* **Use generators** for large datasets instead of arrays

  ```php
  function numbers() {
      for ($i = 0; $i < 1000000; $i++) {
          yield $i;
      }
  }
  ```
* **Monitor memory leaks** in long-running scripts or daemons

---

## Summary

| Concept                | Description                                                |
| ---------------------- | ---------------------------------------------------------- |
| **Memory model**       | Dynamic and managed automatically                          |
| **Reference counting** | Tracks how many variables reference a value                |
| **Garbage collector**  | Cleans up circular references                              |
| **Manual GC control**  | `gc_collect_cycles()`, `gc_enable()`, `gc_disable()`       |
| **Monitoring**         | `memory_get_usage()`, `memory_get_peak_usage()`            |
| **Optimization**       | Unset unused variables, avoid large arrays, use generators |

---

## Related Topics

* [Garbage Collection in PHP](https://github.com/leandroleonard/php/blob/main/02-basics/garbage_collection.md)
* [References and Copies](https://github.com/leandroleonard/php/blob/main/02-basics/references_and_copy.md)
* [unset()](https://github.com/leandroleonard/php/blob/main/03-general/unset.md)
* [Objects and Cloning](https://github.com/leandroleonard/php/blob/main/06-poo/objects_and_cloning.md)