# 🐘 Understanding `unset()` in PHP

`unset()` is a **language construct** in PHP that destroys variables or removes elements from arrays.  
Although it looks like a function, it behaves differently under the hood — similar to `isset()` or `empty()`.

---

## 📖 Table of Contents

1. [Overview](#overview)
2. [Basic Usage](#basic-usage)
3. [Multiple Variables](#multiple-variables)
4. [Working with Arrays](#working-with-arrays)
5. [Not a Function](#not-a-function)
6. [Variable Scope](#variable-scope)
7. [Advanced Tip — Unsetting Object Properties](#advanced-tip--unsetting-object-properties)
8. [Summary](#summary)
9. [Related Functions](#related)

---

## Overview

`unset()` removes a variable from the current scope, freeing its memory slot.  
It can also be used to delete array elements or object properties.

---

## Basic Usage

```php
$var = "Hello World!";
unset($var);

echo $var; // Notice: Undefined variable
```

## Multiple Variables

You can unset multiple variables at once:

```php
$a = 1;
$b = 2;
$c = 3;

unset($a, $b, $c);
```

All three variables are destroyed after this operation.

## Working with Arrays

unset() can remove specific keys or elements from arrays.

```php
$numbers = [10, 20, 30];
unset($numbers[1]);

print_r($numbers);
// Output: [0 => 10, 2 => 30]
```
Note: unset() does not reindex numeric keys automatically.
If you want to reindex:
```php
$numbers = array_values($numbers);
```

## Not a Function

Even though it looks like one, unset() is not a true function.
This means it cannot be called dynamically:

```php
$f = 'unset';
$f($var); //  Fatal error
```

## Variable Scope

unset() affects variables in the current scope only.

```php
function test() {
    $x = 10;
    unset($x);
}
test();

echo isset($x); // false, $x is not accessible here

```

## Advanced Tip — Unsetting Object Properties

When used on object properties, unset() behaves differently depending on visibility and magic methods.

```php
class Demo {
    public $x = 10;
    public function __unset($name) {
        echo "Trying to unset '$name'";
    }
}

$d = new Demo();
unset($d->x); // Calls __unset() if property is inaccessible
```

## Summary

| Concept                            | Description                                  |
| ---------------------------------- | -------------------------------------------- |
| **Type**                           | Language construct                           |
| **Purpose**                        | Destroys variables or removes array elements |
| **Return Value**                   | None                                         |
| **Scope**                          | Current scope only                           |
| **Can unset multiple vars**        | Yes                                        |
| **Reindexes arrays automatically** | No                                         |

## Related
<a href="#">isset()</a>
<a href="#">empty()</a>
<a href="#">array_values()</a>