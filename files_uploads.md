# Handling File Uploads in PHP

How to handle file uploads in PHP, from basic form setup to advanced file validation and security practices.  
First understand how PHP manages uploaded files through the `$_FILES` superglobal and how to store them safely on the server.

---

## 🧭 Table of Contents

1. [Overview](#overview)
2. [How File Uploads Work](#how-file-uploads-work)
3. [Basic Example](#basic-example)
4. [Handling Uploads in PHP](#handling-uploads-in-php)
5. [Validating Uploaded Files](#validating-uploaded-files)
6. [Security Considerations](#security-considerations)
7. [Multiple File Uploads](#multiple-file-uploads)
8. [Common Pitfalls](#common-pitfalls)
9. [Summary](#summary)
10. [Related Topics](#related-topics)

---

## Overview

PHP makes it easy to handle file uploads using:
- An HTML `<form>` element with `enctype="multipart/form-data"`
- The PHP `$_FILES` superglobal to access uploaded files
- Functions like `move_uploaded_file()` to save them to the server

**Use cases:**
- Profile pictures
- Documents
- Image galleries
- CSV/Excel import tools

---

## How File Uploads Work

When a user submits a file through an HTML form:
1. The browser sends the file to the server as part of a `POST` request.
2. PHP temporarily stores the file in the system's temp directory.
3. The `$_FILES` array contains details about each uploaded file.
4. You move the file to a permanent location using `move_uploaded_file()`.

---

## Basic Example

### HTML Form

```html
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <label for="file">Select file:</label>
    <input type="file" name="myFile" id="file">
    <button type="submit">Upload</button>
</form>
```

### PHP Script (`upload.php`)

```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['myFile'];

    echo "File name: " . $file['name'] . "<br>";
    echo "Temp location: " . $file['tmp_name'] . "<br>";
    echo "Size: " . $file['size'] . " bytes<br>";
}
```

**Example Output:**

```
File name: photo.jpg
Temp location: /tmp/php3h4sd2
Size: 24532 bytes
```

---

## 🪄 Handling Uploads in PHP

You can safely move the uploaded file to a desired directory using:

```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['myFile'];
    $uploadDir = 'uploads/';
    $targetPath = $uploadDir . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        echo "File uploaded successfully!";
    } else {
        echo "Upload failed!";
    }
}
```

> **Note:**
> Always ensure the directory `uploads/` exists and has proper write permissions.

---

## Validating Uploaded Files

Before saving any uploaded file, **validate it** to avoid errors and security issues.

### Example: File Type and Size Validation

```php
<?php
$allowedTypes = ['image/jpeg', 'image/png'];
$maxSize = 2 * 1024 * 1024; // 2MB

$file = $_FILES['myFile'];

if (!in_array($file['type'], $allowedTypes)) {
    die("Invalid file type!");
}

if ($file['size'] > $maxSize) {
    die("File too large!");
}

move_uploaded_file($file['tmp_name'], 'uploads/' . basename($file['name']));
echo "Upload successful!";
```

---

## Security Considerations

File uploads can be **a major attack vector** if not handled correctly.
Here are critical precautions:

### Never trust the filename

Attackers can upload files like `shell.php.jpg`.

Use a random name or hash:

```php
$newName = uniqid('upload_', true) . '.jpg';
move_uploaded_file($file['tmp_name'], 'uploads/' . $newName);
```

### Restrict file types

Validate MIME types **and** file extensions.

### Sanitize file names

Remove special characters to avoid path traversal attacks:

```php
$filename = preg_replace("/[^a-zA-Z0-9_\.-]/", "_", $file['name']);
```

### Store outside public root

Keep uploaded files in directories **not directly accessible** from the web.

---

## Multiple File Uploads

You can allow multiple files using:

```html
<input type="file" name="files[]" multiple>
```

Then handle them with a loop:

```php
foreach ($_FILES['files']['tmp_name'] as $index => $tmpPath) {
    $name = $_FILES['files']['name'][$index];
    move_uploaded_file($tmpPath, "uploads/" . $name);
}
```

---

## Common Pitfalls

| Issue             | Description                                                       |
| :---------------- | :---------------------------------------------------------------- |
| Missing `enctype` | The form must include `enctype="multipart/form-data"`             |
| File too large    | Check PHP settings like `upload_max_filesize` and `post_max_size` |
| Wrong permissions | Ensure the upload folder is writable                              |
| Temp file removed | Use `move_uploaded_file()` before the script ends                 |

---

## Summary

File uploads in PHP involve:

1. Creating a form with `enctype="multipart/form-data"`.
2. Accessing uploaded files through `$_FILES`.
3. Validating and sanitizing input.
4. Saving the file with `move_uploaded_file()`.
5. Applying strong security rules.

**Remember:**
Security is more important than convenience when handling user-uploaded files.

---

## 🔗 Related Topics

* [PHP: Working with the Filesystem](https://www.php.net/manual/en/book.filesystem.php)
* [move_uploaded_file() Documentation](https://www.php.net/manual/en/function.move-uploaded-file.php)
* [$_FILES Superglobal](https://www.php.net/manual/en/reserved.variables.files.php)
* [Security Considerations](https://www.php.net/manual/en/features.file-upload.php)

