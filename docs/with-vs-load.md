# with() vs load()

## Overview

Both `with()` and `load()` perform eager loading, but they are used at different stages.

* `with()` loads relationships before executing the query.
* `load()` loads relationships after the models have already been retrieved.

---

## Example

### with()

```php
$users = User::with('orders')->get();
```

### load()

```php
$users = User::all();

$users->load('orders');
```

---

## Benchmark Result

| Method | Queries |      Time |
| ------ | ------: | --------: |
| with() |       2 | 126.81 ms |
| load() |       2 | 125.10 ms |

---

## When to Use

### Use `with()`

* Relationship is already known.
* Better readability.
* Preferred in most situations.

### Use `load()`

* Relationship depends on runtime conditions.
* Existing model collection needs additional data.

---

## Conclusion

Both methods perform similarly.

Choose the one that makes your code easier to understand rather than expecting a major performance difference.
