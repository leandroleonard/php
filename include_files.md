# PHP include files

`require` and `include` are PHP language constructs used to **import external files** into a script.  
They help modularize code, improve reusability, and maintain clean architecture.

The main difference between them lies in **error handling**:  
- `require` produces a **fatal error** if the file cannot be loaded.  
- `include` only produces a **warning**, allowing the script to continue execution.

---

## Table of Contents

1. [Introduction](#introduction)
2. [Why Use `require` and `include`](#why-use-require-and-include)
3. [Basic Syntax](#basic-syntax)
4. [Difference Between `require` and `include`](#difference-between-require-and-include)
5. [Using `_once` Variants](#using-_once-variants)
6. [Example: Modular Code Organization](#example-modular-code-organization)
7. [Error Handling Differences](#error-handling-differences)
8. [Dynamic File Inclusion](#dynamic-file-inclusion)
9. [Best Practices](#best-practices)
10. [Summary](#summary)
11. [References](#references)

---

## Introduction

In PHP, large applications are often split into smaller, reusable files.  
Using **`require`** and **`include`**, developers can import scripts, templates, or configurations from other files.

This approach supports the **DRY principle (Don’t Repeat Yourself)** — writing code once and reusing it wherever needed.

---

## Why Use `require` and `include`

Reuse code across multiple files.  
Simplify maintenance by centralizing logic.  
Organize large applications.  
Improve readability and structure.  
Load configurations, functions, or templates dynamically.

---

## Basic Syntax

```php
<?php
include 'header.php';
require 'config.php';

echo "Main content goes here.";
```

Both statements insert the contents of the specified file into the current script **before execution continues**.

---

## Difference Between `require` and `include`

| Feature                  | `require`                          | `include`                        |
| ------------------------ | ---------------------------------- | -------------------------------- |
| **Error Type**           | Fatal error (`E_ERROR`)            | Warning (`E_WARNING`)            |
| **Execution Continues?** | No                               | Yes                            |
| **Use Case**             | Essential files                    | Optional files                   |
| **Typical Usage**        | Configuration, database connection | Templates, non-critical sections |

### Example:

```php
<?php
require 'config.php';   // Must exist
include 'menu.php';     // Optional

echo "Welcome to the site!";
```

If `config.php` is missing, the script stops immediately.
If `menu.php` is missing, a warning is shown but execution continues.

---

## Using `_once` Variants

PHP provides two special versions to prevent files from being included multiple times:

* `require_once`
* `include_once`

These ensure a file is only imported once during execution, avoiding redeclaration errors.

### Example

```php
<?php
require_once 'database.php';
require_once 'database.php'; // Ignored the second time
```

Prevents function or class redeclaration errors.
Commonly used in frameworks and large applications.

---

## Example: Modular Code Organization

```php
// header.php
<?php
echo "<h1>My Website</h1>";
?>

// footer.php
<?php
echo "<footer>All rights reserved.</footer>";
?>

// index.php
<?php
require 'header.php';
echo "<p>Welcome to the homepage!</p>";
include 'footer.php';
?>
```

**Output:**

```
My Website
Welcome to the homepage!
All rights reserved.
```

This modular structure improves code organization and reusability.

---

## Error Handling Differences

### Case 1: Missing file with `include`

```php
<?php
include 'nonexistent.php';
echo "This line still executes.";
```

Output:

```
Warning: include(nonexistent.php): failed to open stream
This line still executes.
```

### Case 2: Missing file with `require`

```php
<?php
require 'nonexistent.php';
echo "This line will not be executed.";
```

Output:

```
Fatal error: require(): Failed opening required 'nonexistent.php'
```

Execution stops immediately.

---

## Dynamic File Inclusion

You can dynamically include files based on variables or conditions.

```php
<?php
$page = 'about';
include $page . '.php';
```

Useful for template systems or page routing.
Be careful with **user input** — always validate to prevent **LFI (Local File Inclusion) vulnerabilities**.

**Unsafe example (avoid):**

```php
// DANGEROUS — allows arbitrary file inclusion
include $_GET['page'] . '.php';
```

**Safer version:**

```php
<?php
$allowed = ['home', 'about', 'contact'];
$page = $_GET['page'] ?? 'home';

if (in_array($page, $allowed)) {
    include $page . '.php';
} else {
    echo "Page not found.";
}
```

---

## Best Practices

Use `require` for essential files (config, database).
Use `include` for optional or non-critical files.
Always validate filenames before dynamic inclusion.
Prefer `require_once` / `include_once` to avoid duplication.
Keep file paths consistent using constants like `__DIR__` or `$_SERVER['DOCUMENT_ROOT']`.

Example:

```php
<?php
require_once __DIR__ . '/config/database.php';
```

---

## Summary

* **`require`** and **`include`** are used to import external PHP files.
* `require` stops execution on failure, while `include` only warns.
* `_once` versions prevent duplicate imports.
* They help organize code and maintain cleaner architecture.
* Be careful with dynamic inclusion — always sanitize input!

---

## References

* [PHP Manual: include](https://www.php.net/manual/en/function.include.php)
* [PHP Manual: require](https://www.php.net/manual/en/function.require.php)
* [PHP Security Best Practices](https://www.php.net/manual/en/security.filesystem.php)

