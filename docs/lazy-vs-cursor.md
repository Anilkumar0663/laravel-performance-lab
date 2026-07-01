lazy()
User::lazy();
Retrieves records in chunks.
Returns them one by one.
Faster in many scenarios.
Benchmark Result
Method	Records	Time	Memory
lazy()	50,000	1398 ms	2 MB
cursor()	50,000	2655 ms	2 MB
When to Use
lazy()
Recommended for most large datasets.
Better overall performance.
cursor()
Streaming very large datasets.
Extremely memory-sensitive tasks.
Conclusion

Both methods maintain low memory usage, but lazy() often provides better throughput because it fetches records in batches.


---

## 📄 `docs/results.md`

```md
# Benchmark Results

| Benchmark | Queries | Time | Memory |
|-----------|---------:|------:|--------:|
| N+1 | 1001 | 812 ms | 22 MB |
| with() | 2 | 126.81 ms | 2 MB |
| load() | 2 | 125.10 ms | 2 MB |
| chunk() | 50,000 | 1334.73 ms | Low |
| chunkById() | 1,000,000 | 16881.06 ms | Low |
| lazy() | 50,000 | 1398.45 ms | 2 MB |
| cursor() | 50,000 | 2655.32 ms | 2 MB |

---

## Test Environment

- Laravel 13
- PHP 8.3
- MySQL 8
- Windows 10
- Benchmark Dataset:
  - 100,000 Users
  - 20 Categories
  - 500,000 Products
  - 1,000,000 Orders
  - Millions of Order Items
  - 1,000,000 Payments