# chunk() vs chunkById()

## Overview

Both methods process large datasets without loading everything into memory.

## chunk()

```php
Order::chunk(1000, function ($orders) {

});

Uses OFFSET/LIMIT internally.

Suitable for static datasets.

chunkById()
Order::chunkById(1000, function ($orders) {

});

Uses the primary key instead of OFFSET.

Safer when records are inserted or deleted during processing.

Benchmark Result
Method	Records
chunk()	50,000
chunkById()	1,000,000
When to Use
chunk()
Reports
Static datasets
chunkById()
Queue jobs
Background processing
Huge tables
Continuously changing data
Conclusion

Prefer chunkById() for long-running operations on large production tables.


---

## 📄 `docs/lazy-vs-cursor.md`

```md
# lazy() vs cursor()

## Overview

Both methods help process large datasets using minimal memory.

The difference lies in how records are retrieved.

---

## cursor()

```php
User::cursor();
Retrieves one record at a time.
Uses PHP Generators.
Extremely memory efficient.