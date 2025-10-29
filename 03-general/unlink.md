---
title: "Understanding unlink() in PHP"
author: "Leandro Ventura"
date: "2025-10-10"
description: "A concise guide explaining how the unlink() function works in PHP, including usage, permissions, and error handling."
---

# 🐘 Understanding `unlink()` in PHP

`unlink()` is a **built-in PHP function** used to delete files from the filesystem.  
It is part of PHP’s file system functions and provides a simple way to remove files permanently.

---

## 📖 Table of Contents

1. [Overview](#overview)
2. [Basic Usage](#basic-usage)
3. [File Permissions](#file-permissions)
4. [Checking Before Deleting](#checking-before-deleting)
5. [Error Handling](#error-handling)
6. [Unlinking Multiple Files](#unlinking-multiple-files)
7. [Deleting Temporary or Uploaded Files](#deleting-temporary-or-uploaded-files)
8. [Summary](#summary)
9. [Related Functions](#related)

---

## Overview

`unlink()` deletes a file from the filesystem.  
It works similarly to the **Unix `rm` command** — once the file is deleted, it cannot be recovered.

**Syntax:**

```php
bool unlink(string $filename, ?resource $context = null)
```
Returns: true on success, false on failure.

## Basic Usage
```php
$file = "example.txt";

if (unlink($file)) {
    echo "File deleted successfully!";
} else {
    echo "Error deleting file.";
}
```
If *example.txt* exists and PHP has permission to remove it, the file is deleted.

## File Permissions

To use unlink(), PHP must have write permissions on the directory where the file is located.

Example:

```php
chmod("example.txt", 0777); // give full permissions (for testing only)
unlink("example.txt");
```

**Security Tip:** Never set 0777 in production.
Use the minimum necessary permissions instead.

## Checking Before Deleting

It’s good practice to check whether a file exists before attempting to delete it:

```php
$file = "data.log";

if (file_exists($file)) {
    unlink($file);
    echo "Deleted $file.";
} else {
    echo "File not found.";
}
```
This prevents unnecessary warnings and improves reliability.

## Error Handling

unlink() emits a PHP warning if it fails to delete a file.
You can handle errors safely using the **error suppression operator @** (used carefully):

```php
if (!@unlink("config.tmp")) {
    error_log("Failed to delete file: config.tmp");
}

```
Tip: Always log errors instead of ignoring them.

## Unlinking Multiple Files

You can delete several files in a loop:

```php
$files = ["a.txt", "b.txt", "c.txt"];

foreach ($files as $file) {
    if (file_exists($file)) {
        unlink($file);
        echo "Deleted $file\n";
    }
}

```

## Deleting Temporary or Uploaded Files

unlink() is often used to remove uploaded or temporary files after processing:

```php
if (isset($_FILES['photo'])) {
    $tempPath = $_FILES['photo']['tmp_name'];
    // Move or process file...
    unlink($tempPath); // cleanup
}
```

## Summary

| Concept                       | Description                           |
| ----------------------------- | ------------------------------------- |
| **Type**                      | Built-in PHP function                 |
| **Purpose**                   | Deletes a file from the filesystem    |
| **Return Value**              | `true` on success, `false` on failure |
| **Requires write permission** | Yes                                 |
| **Can delete directories**    |No (`rmdir()` is used for that)     |

## Related

<a href="#">rmdir()</a> — Remove empty directories

<a href="#">file_exists()</a> — Check if a file exists

<a href="#">is_writable()</a> — Check file permissions