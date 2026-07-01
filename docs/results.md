# 🚀 Laravel Performance Lab
| Benchmark   |   Queries |     Time | Memory |
| ----------- | --------: | -------: | -----: |
| N+1         |      1001 |   812 ms |  22 MB |
| with()      |         2 |   158 ms |   4 MB |
| load()      |         2 |   125 ms |   2 MB |
| chunk()     |    50,000 |  1334 ms |    Low |
| chunkById() | 1,000,000 | 16881 ms |    Low |
| lazy()      |    50,000 |  1398 ms |   2 MB |
| cursor()    |    50,000 |  2655 ms |   2 MB |
