FizzBuzz
========

This is the codebase for FizzBuzz, a small php application with some issues
that need resolving. This app is built for the purpose of screening PHP
developer candidates.

## Requirements

 - PHP 5.4+
 - Composer
 - MySQL
 - Apache

# Running Locally
After running composer install you just need to follow these steps:

1. set up vhost
2. add entry to hosts file
3. set up datatabse
4. build database

## 1. set up vhost
```
<VirtualHost *:80>
    ServerName fizzbuzz.local
    DocumentRoot "<PATH_TO_PROJECT>/public"
    RewriteEngine on
    SetEnv APP_ENV "development"
    <Directory "<PATH_TO_PROJECT>/public">
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Satisfy Any
        Allow from all
        Require all granted
    </Directory>
</VirtualHost>
```
Where `<PATH_TO_PROJECT>` is the actual path to the project.

Restart apache.

## 2. add entry to hosts file
In `/etc/hosts` (Linux/Mac) or `C:\Windows\System32\drivers\etc\hosts` (Windows):
```
127.0.0.1       fizzbuzz.local
```

## 3. set up database
Set up a MySQL database called `fizzbuzz` on localhost under user `fizz` with
password `buzz`.

```
mysql> create database fizzbuzz;
```

```
mysql> grant all privileges on fizzbuzz.* to fizz@localhost identified by 'buzz';
```

## 4. build database
From the project root:
```
vendor/bin/up development
```
If `mysql` is not in your `$PATH` then try:
```
vendor/bin/up development /path/to/mysql/bin/mysql
```

Open `http://fizzbuzz.local` in your browser.
