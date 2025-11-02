# Namespaces in PHP

## 📚 Table of Contents

1. [Summary](#summary)
2. [Introduction](#introduction)
3. [Why Namespaces Are Needed](#why-namespaces-are-needed)
4. [Defining a Namespace](#defining-a-namespace)
5. [Accessing Elements in Namespaces](#accessing-elements-in-namespaces)
6. [Using the `use` Keyword (Importing)](#using-the-use-keyword-importing)
7. [Sub-namespaces](#sub-namespaces)
8. [Global Namespace](#global-namespace)
9. [Best Practices](#best-practices)
10. [Summary Table](#summary-table)
11. [References](#references)

---

## Summary

Namespaces in PHP provide a way to **organize code** and **avoid name conflicts** between classes, functions, and constants.
They act like folders or directories for your PHP identifiers, grouping related code together.

A namespace is declared at the **top of a PHP file** using the `namespace` keyword.

---

## Introduction

As PHP projects grow larger — especially when using multiple libraries or frameworks — it’s common for classes or functions to have the same name.
Namespaces solve this by providing **unique “addresses”** for each class or function, similar to how directories prevent file name clashes in an operating system.

---

## 🤔 Why Namespaces Are Needed

Without namespaces:

```php
// file: Models/User.php
class User {}

// file: Admin/User.php
class User {} // Fatal error: Cannot redeclare class User
```

With namespaces:

```php
namespace App\Models;
class User {}

namespace App\Admin;
class User {}
```

Now PHP can distinguish between:

* `App\Models\User`
* `App\Admin\User`

No conflict — both classes can exist.

---

## Defining a Namespace

You declare a namespace **at the top** of the file (before any other code):

```php
<?php
namespace App\Controllers;

class HomeController {
    public function index() {
        echo "Welcome to the homepage!";
    }
}
```

To use this class:

```php
$controller = new \App\Controllers\HomeController();
$controller->index();
```

> The leading backslash `\` means “start from the global namespace”.

---

## Accessing Elements in Namespaces

You can access elements using:

1. **Fully Qualified Name**

   ```php
   $obj = new \App\Models\User();
   ```
2. **Relative Name**
   If you’re in the same namespace:

   ```php
   namespace App\Models;
   $obj = new User(); // Same namespace — no need for full path
   ```
3. **Imported Name (using `use`)**

   ```php
   use App\Models\User;
   $obj = new User();
   ```

---

## Using the `use` Keyword (Importing)

The `use` statement lets you import classes, functions, or constants from another namespace, simplifying your code.

```php
namespace App\Controllers;

use App\Models\User;
use App\Services\AuthService;

class LoginController {
    public function login() {
        $auth = new AuthService();
        $user = new User();
    }
}
```

You can also **alias** names:

```php
use App\Models\User as Customer;
$customer = new Customer();
```

---

## Sub-namespaces

Namespaces can be hierarchical, similar to directories:

```php
namespace App\Services\Mail;

class Mailer {}
```

You can think of this like a folder structure:

```
App/
 └── Services/
      └── Mail/
          └── Mailer.php
```

---

## 🌍 Global Namespace

When you use built-in PHP classes or functions (like `DateTime` or `Exception`), PHP looks in the **global namespace**.

If you redefine these inside a namespace, you must use a **leading backslash** to access the global one:

```php
namespace MyApp;

$date = new \DateTime(); // Refers to global DateTime, not MyApp\DateTime
```

---

## 💡 Best Practices

Follow **PSR-4**: Namespace should match folder structure.
Always declare **one namespace per file**.
Avoid long or inconsistent namespace names — use clear, hierarchical structures (`App\Services\Payment`).
Prefer importing classes with `use` instead of writing full namespace paths repeatedly.
Use **aliases** for clarity when names conflict.

---

## Summary Table

| Concept                   | Description                           | Example                            |
| ------------------------- | ------------------------------------- | ---------------------------------- |
| **Namespace declaration** | Defines a logical group of code       | `namespace App\Models;`            |
| **Fully qualified name**  | Starts with `\`, absolute path        | `new \App\Models\User()`           |
| **Importing with `use`**  | Simplifies access to namespaced items | `use App\Models\User;`             |
| **Alias**                 | Renames imported class                | `use App\Models\User as Customer;` |
| **Global namespace**      | Built-in PHP functions/classes        | `new \DateTime()`                  |

---

## References

* [PHP Manual: Namespaces](https://www.php.net/manual/en/language.namespaces.php)
* [PHP-FIG: PSR-4 Autoloading Standard](https://www.php-fig.org/psr/psr-4/)
* [PHP Manual: Namespace use Declarations](https://www.php.net/manual/en/language.namespaces.importing.php)
