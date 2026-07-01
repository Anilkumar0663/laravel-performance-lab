# Benchmark Database

## Overview

The Laravel Performance Lab uses a large benchmark database to simulate production-like scenarios and measure the real performance of Eloquent features.

Unlike traditional examples that use only a few hundred records, this project generates a large dataset to expose performance bottlenecks, query inefficiencies, and memory usage patterns.

---

## Dataset

| Table       |                          Records |
| ----------- | -------------------------------: |
| Users       |                          100,000 |
| Categories  |                               20 |
| Products    |                          500,000 |
| Orders      |                        1,000,000 |
| Order Items | Millions (generated dynamically) |
| Payments    |                        1,000,000 |

---

## Why a Large Dataset?

Small datasets often hide performance issues.

A query that performs well with 100 records may become significantly slower when executed against hundreds of thousands or millions of records.

Using a realistic dataset allows us to benchmark Laravel features under conditions that are much closer to a production environment.

---

## What Can Be Benchmarked?

This benchmark database is used to compare:

* N+1 Query Problem
* Eager Loading (`with()` vs `load()`)
* `chunk()` vs `chunkById()`
* `lazy()` vs `cursor()`
* Database Indexing
* EXPLAIN Query Analysis
* Query Builder vs Eloquent
* Raw SQL vs Eloquent
* Pagination Strategies
* Transactions
* Locking Strategies

---

## Benchmark Goals

Each benchmark focuses on one or more of the following metrics:

* Query Count
* Execution Time
* Memory Usage
* Database Execution Plan
* Scalability
* Real-world Performance

---

## Project Objective

The goal of this project is not to determine a universal "best" approach.

Instead, it demonstrates how different Laravel features behave under realistic workloads so developers can make informed decisions based on performance, scalability, and maintainability.

---

## Future Improvements

The benchmark database will continue to evolve with additional datasets, benchmark scenarios, and performance reports as new Laravel features are explored.
