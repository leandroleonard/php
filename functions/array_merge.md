# 🐘 Understanding `array_merge()` in PHP

The `array_merge()` function in PHP is used to **combine two or more arrays** into a single array.  
It intelligently merges numeric and associative keys, depending on the array type.

---

## 📖 Table of Contents

1. [Overview](#overview)
2. [Basic Usage](#basic-usage)
3. [Merging Numeric Arrays](#merging-numeric-arrays)
4. [Merging Associative Arrays](#merging-associative-arrays)
5. [Overwriting Behavior](#overwriting-behavior)
6. [Using Spread Operator Alternative](#using-spread-operator-alternative)
7. [Practical Examples](#practical-examples)
8. [Differences from array_merge_recursive](#differences-from-array_merge_recursive)
9. [Summary](#summary)
10. [Related Functions](#related)

---

## Overview

**Definition:**

```php
array array_merge(array ...$arrays)
```

**Purpose:** Merges multiple arrays into one, appending or overwriting elements based on key types.

**Returns:** A new combined array.

---

## Basic Usage

```php
$a = [1, 2, 3];
$b = [4, 5, 6];

$result = array_merge($a, $b);

print_r($result);
// Output: [1, 2, 3, 4, 5, 6]
```

If all keys are numeric, the arrays are **reindexed sequentially**.

---

## Merging Numeric Arrays

When merging arrays with numeric indexes, the function **reindexes** all values:

```php
$a = [10, 20];
$b = [30, 40];

print_r(array_merge($a, $b));
// [0 => 10, 1 => 20, 2 => 30, 3 => 40]
```

> Note: Even if numeric keys exist, `array_merge()` ignores them and creates new sequential keys.

---

## Merging Associative Arrays

When merging associative arrays, string keys are **preserved**, and later arrays **overwrite earlier ones** if the same key exists.

```php
$a = ["name" => "Alice", "age" => 25];
$b = ["age" => 30, "city" => "London"];

print_r(array_merge($a, $b));
/*
[
    "name" => "Alice",
    "age" => 30,     // overwritten
    "city" => "London"
]
*/
```

---

## Overwriting Behavior

If duplicate **string keys** exist, the **last one wins**.

```php
$a = ["x" => 1, "y" => 2];
$b = ["y" => 99, "z" => 3];

print_r(array_merge($a, $b));
// ["x" => 1, "y" => 99, "z" => 3]
```

---

## 🚀 Using Spread Operator Alternative

Since PHP 7.4+, you can merge arrays using the **spread operator (`...`)** — a cleaner syntax.

```php
$a = [1, 2];
$b = [3, 4];
$c = [5, 6];

$merged = [...$a, ...$b, ...$c];
print_r($merged);
// [1, 2, 3, 4, 5, 6]
```

> Works similarly to `array_merge()` for **numeric arrays**,
> but behaves differently for **associative arrays** (later keys override earlier ones).

---

##  Practical Examples

### Merge form data

```php
$defaults = ["lang" => "en", "timezone" => "UTC"];
$userPrefs = ["timezone" => "America/Sao_Paulo"];

$settings = array_merge($defaults, $userPrefs);
// ["lang" => "en", "timezone" => "America/Sao_Paulo"]
```

### Merge API responses

```php
$response = array_merge($headerData, $bodyData, $metaData);
```

---

## Differences from `array_merge_recursive`

`array_merge_recursive()` combines values with the same key into **arrays**, instead of overwriting.

```php
$a = ["color" => "blue"];
$b = ["color" => "red"];

print_r(array_merge_recursive($a, $b));
// ["color" => ["blue", "red"]]
```

So:

* `array_merge()` → overwrites duplicate keys
* `array_merge_recursive()` → merges duplicate keys into subarrays

---

## Summary

| Concept           | Description                       |
| ----------------- | --------------------------------- |
| **Function Type** | Built-in array function           |
| **Purpose**       | Combines multiple arrays into one |
| **Numeric Keys**  | Reindexed sequentially            |
| **String Keys**   | Overwritten by later arrays       |
| **Return Type**   | New array                         |
| **Alternative**   | Spread operator (`...`)           |

---

## Related

* [`array_merge_recursive()`](https://www.php.net/manual/en/function.array-merge-recursive.php)
* [`array_combine()`]()
* [`array_push()`]()

