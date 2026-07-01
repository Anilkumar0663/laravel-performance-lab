# N+1 Query Problem

## Overview

The N+1 Query Problem occurs when an application executes one query to retrieve parent records and then executes an additional query for each parent record to fetch related data.

This is one of the most common performance issues in Laravel applications.

---

## Benchmark Setup

Dataset Used:

* 100,000 Users
* 1,000,000 Orders

Relationship:

```php
User::hasMany(Order::class)
```

---

## Without Eager Loading

```php
$users = User::take(1000)->get();

foreach ($users as $user) {
    $user->orders;
}
```

---

## With Eager Loading

```php
$users = User::with('orders')
    ->take(1000)
    ->get();
```

---

## Benchmark Result

| Method        | Queries |   Time |
| ------------- | ------: | -----: |
| Lazy Loading  |    1001 | 812 ms |
| Eager Loading |       2 | 158 ms |

---

## Conclusion

Eager loading significantly reduces the number of database queries and improves response time.

Use `with()` whenever related data is known in advance.
