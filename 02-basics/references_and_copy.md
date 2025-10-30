
# Understanding References and Copies in PHP

In PHP, **variables can either hold values directly or act as references** to other variables.
Understanding how **copying** and **referencing** work is essential to avoid unexpected behavior — especially with arrays and objects.

---

## 📖 Table of Contents

1. [Overview](#overview)
2. [Value Assignment (Copy)](#value-assignment-copy)
3. [Reference Assignment](#reference-assignment)
4. [References and Functions](#references-and-functions)
5. [References in Arrays](#references-in-arrays)
6. [Object Assignment (by Reference by Default)](#object-assignment-by-reference-by-default)
7. [Breaking a Reference](#breaking-a-reference)
8. [Summary](#summary)
9. [Related Topics](#related-topics)

---

## Overview

PHP uses a **copy-on-write** mechanism.
That means when you assign a variable to another, PHP **does not immediately duplicate** the data in memory.
A real copy is made **only if one of the variables is modified**.

However, you can also create **references** — two variable names that point to the **same memory location**.

---

## Value Assignment (Copy)

By default, PHP assigns variables **by value** (copy).

```php
$a = 10;
$b = $a; // Copy
$b = 20;

echo $a; // 10
echo $b; // 20
```

In this example, changing `$b` does **not** affect `$a`, because they are **independent**.

---

## Reference Assignment

You can assign variables **by reference** using the `&` operator.

```php
$a = 10;
$b = &$a; // Reference
$b = 20;

echo $a; // 20
echo $b; // 20
```

Now both variables point to the **same memory location**, so changing one affects the other.

---

## References and Functions

You can **pass arguments by reference** to allow functions to modify the original variable.

```php
function increment(&$num) {
    $num++;
}

$value = 5;
increment($value);

echo $value; // 6
```

Without the `&`, the function would receive a **copy** instead of the original variable.

---

## References in Arrays

Array elements can also be stored **by reference**.

```php
$a = 1;
$b = 2;
$arr = [&$a, &$b];

$a = 10;
print_r($arr); // [10, 2]
```

This is particularly useful when you need to maintain synchronization between variables and array elements.

---

## Object Assignment (by Reference by Default)

Since PHP 5, **objects are automatically assigned by reference-like behavior**, even without `&`.

```php
class Example {
    public $x = 1;
}

$a = new Example();
$b = $a; // Points to the same object
$b->x = 99;

echo $a->x; // 99
```

If you want a true copy, you must use the **clone** keyword.

```php
$b = clone $a;
$b->x = 50;

echo $a->x; // 99
echo $b->x; // 50
```

---

## Breaking a Reference

You can break a reference by **unsetting** one of the variables or **reassigning** it.

```php
$a = 5;
$b = &$a;
unset($b);

$a = 10;
echo $a; // 10
```

After `unset($b)`, the link between `$a` and `$b` is broken.

---

## Summary

| Concept                        | Description                                         |
| ------------------------------ | --------------------------------------------------- |
| **Default assignment**         | By value (copy)                                     |
| **Reference assignment**       | Uses `&` operator                                   |
| **Objects**                    | Assigned by reference-like behavior                 |
| **Function reference passing** | Use `function foo(&$x)`                             |
| **Array references**           | Possible using `&` before elements                  |
| **Copy-on-write**              | Real copy occurs only when one variable is modified |
| **Breaking references**        | Via `unset()` or reassignment                       |

---

## Related Topics

* [unset()](https://github.com/leandroleonard/php/blob/main/03-general/unset.md)
* [Objects and Cloning](#)
* [PHP Memory Management](#)
