 # 🚀 Laravel Performance Lab

![Laravel](https://img.shields.io/badge/Laravel-13-red?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

A practical **Laravel 13** project built to benchmark Eloquent features, database queries, and performance optimization techniques using a **real-world dataset**.

Instead of comparing Laravel features with a few hundred factory records, this project benchmarks them against a large dataset to simulate production-like scenarios.

---

## ✨ Features

* ⚡ Large benchmark dataset
* 📊 Real performance metrics
* 🧠 Query count analysis
* 💾 Memory usage comparison
* ⏱️ Execution time benchmarking
* 🔍 EXPLAIN query analysis
* 📚 Well-documented benchmark examples

---

# 📦 Benchmark Dataset

| Table       |   Records |
| ----------- | --------: |
| Users       |   100,000 |
| Categories  |        20 |
| Products    |   500,000 |
| Orders      | 1,000,000 |
| Order Items |  Millions |
| Payments    | 1,000,000 |

---

# 📈 Completed Benchmarks

| Benchmark              | Status |
| ---------------------- | :----: |
| N+1 Query Problem      |    ✅   |
| with() vs load()       |    ✅   |
| chunk() vs chunkById() |    ✅   |
| lazy() vs cursor()     |    ✅   |

---

# 🚧 Upcoming Benchmarks

* Database Indexing
* EXPLAIN Query Analysis
* exists() vs count()
* whereHas() vs join()
* select() vs *
* Query Builder vs Eloquent
* Raw SQL vs Eloquent
* paginate() vs simplePaginate()
* cursorPaginate()
* Database Transactions
* Optimistic vs Pessimistic Locking
* Cache Performance
* Queue Performance

---

# 📊 Benchmark Metrics

Each benchmark measures one or more of the following:

* Query Count
* Execution Time
* Memory Usage
* Database Execution Plan
* Performance Comparison
* Real-world Use Cases

---

# 📁 Project Structure

```text
app/
 ├── Http/
 │    └── Controllers/
 │         └── BenchmarkController.php
 │
 └── Services/
      └── BenchmarkDataGenerator.php

config/
 └── benchmark.php

database/
 ├── migrations/
 └── seeders/
      └── BenchmarkSeeder.php

docs/

screenshots/

routes/
```

---

# ⚙️ Installation

Clone the repository

```bash
git clone https://github.com/Anilkumar0663/laravel-performance-lab.git
```

Move into the project

```bash
cd laravel-performance-lab
```

Install dependencies

```bash
composer install
```

Copy the environment file

```bash
cp .env.example .env
```

Generate the application key

```bash
php artisan key:generate
```

Configure your database in the `.env` file.

Run migrations

```bash
php artisan migrate
```

Generate the benchmark dataset

```bash
php artisan db:seed --class=BenchmarkSeeder
```

---

# 📚 Documentation

Detailed benchmark documentation will be available inside the `docs/` directory.

Each benchmark includes:

* Problem Statement
* Benchmark Setup
* Source Code
* Results
* Performance Analysis
* Best Practices

---

# 🤝 Contributing

Contributions are always welcome.

If you have ideas for additional Laravel performance benchmarks or improvements, feel free to open an issue or submit a pull request.

---

# 📜 License

This project is open-sourced under the MIT License.

---

## ⭐ Support

If you find this project useful, consider giving it a ⭐ on GitHub.

It helps others discover the project and motivates future benchmark releases.
