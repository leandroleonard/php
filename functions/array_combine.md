# 🐘 Understanding `array_combine()` in PHP

The `array_combine()` function in PHP creates a **new associative array** by using one array for keys and another for values.  
It’s a simple and powerful way to pair related data sets, such as IDs and names, or fields and values.

---

## 📖 Table of Contents

1. [Overview](#overview)
2. [Basic Usage](basic-usage)
3. [How It Works](how-it-works)
4. [Requirements and Errors](requirements-and-errors)
5. [Practical Examples](practical-examples)
6. [Handling Invalid Input Safely](handling-invalid-input-safely)
7. [Common Use Cases](common-use-cases)
8. [Summary](summary)
9. [Related Functions](related)

---

## Overview

**Definition:**

```php
array array_combine(array $keys, array $values)
```

**Purpose:** Creates an associative array by combining the elements of one array as **keys** and the elements of another as **values**.

**Returns:**

* A new array on success
* `false` on failure (if the number of elements in each array does not match)

---

## Basic Usage

```php
$keys = ["name", "age", "country"];
$values = ["Alice", 25, "Brazil"];

$result = array_combine($keys, $values);

print_r($result);
/*
[
    "name" => "Alice",
    "age" => 25,
    "country" => "Brazil"
]
*/
```

---

## How It Works

* The **first array** provides the **keys**.
* The **second array** provides the **values**.
* Both arrays must have the **same number of elements**, otherwise PHP throws a warning and returns `false`.

Example:

```php
$keys = ["a", "b", "c"];
$values = [10, 20, 30];

$result = array_combine($keys, $values);
// ["a" => 10, "b" => 20, "c" => 30]
```

---

## Requirements and Errors

If the arrays have **different lengths**, `array_combine()` fails:

```php
$keys = ["x", "y"];
$values = [1, 2, 3];

$result = array_combine($keys, $values);
// Warning: array_combine(): Both parameters should have an equal number of elements
// Returns: false
```

> Both arrays must be **non-empty** and of **equal size**.

---

## Practical Examples

### Example 1 — Combine database column names with values

```php
$columns = ["id", "name", "email"];
$data = [1, "Leandro", "leandro@example.com"];

$user = array_combine($columns, $data);
/*
[
    "id" => 1,
    "name" => "Leandro",
    "email" => "leandro@example.com"
]
*/
```

### Example 2 — Combine IDs with labels

```php
$ids = [101, 102, 103];
$labels = ["Pending", "Approved", "Rejected"];

$statusList = array_combine($ids, $labels);
/*
[
    101 => "Pending",
    102 => "Approved",
    103 => "Rejected"
]
*/
```

---

## Handling Invalid Input Safely

You can check lengths before combining arrays:

```php
$keys = ["a", "b"];
$values = [10, 20, 30];

if (count($keys) === count($values)) {
    $result = array_combine($keys, $values);
} else {
    echo "Arrays must have the same number of elements.";
}
```

---

## Common Use Cases

| Use Case                        | Description                          |
| ------------------------------- | ------------------------------------ |
| **Mapping keys and values**     | Build associative arrays dynamically |
| **Combining headers and data**  | Useful for CSV imports               |
| **Creating configuration maps** | Merge field names with user input    |
| **API data pairing**            | Combine JSON keys with decoded data  |

---

## Summary

| Concept            | Description                                       |
| ------------------ | ------------------------------------------------- |
| **Function Type**  | Built-in array function                           |
| **Purpose**        | Combines one array’s keys with another’s values   |
| **Requirement**    | Both arrays must have the same number of elements |
| **Return Value**   | New associative array or `false` on error         |
| **Error Handling** | Emits a warning if array sizes differ             |

---

## Related

* [`array_merge()`](https://github.com/leandroleonard/php/blob/main/functions/array_merge.md) — Merge arrays together
* [`array_combine()` (PHP Manual)](https://www.php.net/manual/en/function.array-combine.php) — Official documentation
