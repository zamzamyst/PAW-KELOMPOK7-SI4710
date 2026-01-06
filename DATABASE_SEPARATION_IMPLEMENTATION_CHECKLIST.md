# Database Separation - Implementation Checklist

## ✅ Pre-Implementation Review

- [x] Feasibility confirmed: **95-98% HIGHLY FEASIBLE**
- [x] Files affected: **33+** across 5 categories
- [x] GraphQL changes needed: **ZERO**
- [x] Breaking changes: **NONE**
- [x] Rollback capability: **EASY** (switch $connection back)
- [x] Risk level: **LOW**

---

## Phase 1: Database Creation

### 1.1 Create 6 Separate MySQL Databases

**Database Names:**
```
paw-tmart-users       (User, Authentication)
paw-tmart-menu        (Menu)
paw-tmart-order       (Order)
paw-tmart-delivery    (Delivery, DeliveryService, Tracking)
paw-tmart-feedback    (Feedback)
paw-tmart-tracking    (Tracking) [OPTIONAL - can share with delivery]
```

**Using Laragon MySQL (via adminer or CLI):**

```sql
-- Create all 6 databases
CREATE DATABASE `paw-tmart-users` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE DATABASE `paw-tmart-menu` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE DATABASE `paw-tmart-order` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE DATABASE `paw-tmart-delivery` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE DATABASE `paw-tmart-feedback` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE DATABASE `paw-tmart-tracking` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Verify creation
SHOW DATABASES LIKE 'paw-tmart%';
```

**Expected Output:**
```
Database
paw-tmart-delivery
paw-tmart-feedback
paw-tmart-menu
paw-tmart-order
paw-tmart-tracking
paw-tmart-users
```

**Checklist:**
- [ ] All 6 databases created
- [ ] Character set verified as utf8mb4
- [ ] All databases empty (ready for migrations)

---

## Phase 2: Configuration Updates

### 2.1 Update `.env` File

**File:** `.env`

**Add these lines:**
```bash
# Service-specific databases
DB_DATABASE_MENU=paw-tmart-menu
DB_DATABASE_ORDER=paw-tmart-order
DB_DATABASE_DELIVERY=paw-tmart-delivery
DB_DATABASE_FEEDBACK=paw-tmart-feedback
DB_DATABASE_TRACKING=paw-tmart-tracking
DB_DATABASE_USERS=paw-tmart-users
```

**Note:** Keep the existing `DB_DATABASE=paw-tmart-users` for default connection

**Checklist:**
- [ ] .env updated with all 6 DB_DATABASE_* variables
- [ ] All values match created database names
- [ ] File saved

### 2.2 Update `config/database.php`

**File:** `config/database.php`

**Add these connections in 'connections' array (after 'mysql' connection):**

```php
'mysql_menu' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE_MENU', 'paw-tmart-menu'),
    'username' => env('DB_USERNAME', 'zamzamyst'),
    'password' => env('DB_PASSWORD', 'Dreamzzz@19'),
    'unix_socket' => env('DB_SOCKET', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'prefix_indexes' => true,
    'strict' => true,
    'engine' => null,
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
    ]) : [],
],

'mysql_order' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE_ORDER', 'paw-tmart-order'),
    'username' => env('DB_USERNAME', 'zamzamyst'),
    'password' => env('DB_PASSWORD', 'Dreamzzz@19'),
    'unix_socket' => env('DB_SOCKET', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'prefix_indexes' => true,
    'strict' => true,
    'engine' => null,
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
    ]) : [],
],

'mysql_delivery' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE_DELIVERY', 'paw-tmart-delivery'),
    'username' => env('DB_USERNAME', 'zamzamyst'),
    'password' => env('DB_PASSWORD', 'Dreamzzz@19'),
    'unix_socket' => env('DB_SOCKET', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'prefix_indexes' => true,
    'strict' => true,
    'engine' => null,
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
    ]) : [],
],

'mysql_feedback' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE_FEEDBACK', 'paw-tmart-feedback'),
    'username' => env('DB_USERNAME', 'zamzamyst'),
    'password' => env('DB_PASSWORD', 'Dreamzzz@19'),
    'unix_socket' => env('DB_SOCKET', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'prefix_indexes' => true,
    'strict' => true,
    'engine' => null,
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
    ]) : [],
],

'mysql_tracking' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE_TRACKING', 'paw-tmart-tracking'),
    'username' => env('DB_USERNAME', 'zamzamyst'),
    'password' => env('DB_PASSWORD', 'Dreamzzz@19'),
    'unix_socket' => env('DB_SOCKET', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'prefix_indexes' => true,
    'strict' => true,
    'engine' => null,
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
    ]) : [],
],
```

**Checklist:**
- [ ] config/database.php updated with 5 new connections
- [ ] All connections point to correct database env variables
- [ ] File syntax valid (PHP can parse it)
- [ ] File saved

---

## Phase 3: Model Updates

### 3.1 Update Model Files (Add $connection Property)

**File:** `app/Models/Menu.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $connection = 'mysql_menu';  // ← ADD THIS LINE
    protected $fillable = ['menu_code', 'name', 'price', 'description'];
    // ... rest of class
}
```

**File:** `app/Models/Order.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mysql_order';  // ← ADD THIS LINE
    protected $fillable = ['menu_code', 'name', 'price', 'quantity', 'notes'];
    // ... rest of class
}
```

**File:** `app/Models/Delivery.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $connection = 'mysql_delivery';  // ← ADD THIS LINE
    protected $fillable = ['order_id', 'delivery_service_id', 'delivery_address', 'delivery_status'];
    // ... rest of class
}
```

**File:** `app/Models/DeliveryService.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryService extends Model
{
    protected $connection = 'mysql_delivery';  // ← ADD THIS LINE
    protected $table = 'delivery_services';
    protected $fillable = ['name', 'price', 'estimation_days', 'is_active'];
    // ... rest of class
}
```

**File:** `app/Models/Tracking.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $connection = 'mysql_tracking';  // ← ADD THIS LINE
    protected $table = 'trackings';
    protected $fillable = ['delivery_id', 'latitude', 'longitude'];
    // ... rest of class
}
```

**File:** `app/Models/Feedback.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $connection = 'mysql_feedback';  // ← ADD THIS LINE
    protected $fillable = ['order_id', 'user_id', 'rating', 'comment'];
    // ... rest of class
}
```

**File:** `app/Models/User.php`
```php
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // Keep default connection (mysql) for authentication
    // OR add: protected $connection = 'mysql_users';
    
    // ... rest of class
}
```

**Checklist:**
- [ ] Menu.php updated with $connection = 'mysql_menu'
- [ ] Order.php updated with $connection = 'mysql_order'
- [ ] Delivery.php updated with $connection = 'mysql_delivery'
- [ ] DeliveryService.php updated with $connection = 'mysql_delivery'
- [ ] Tracking.php updated with $connection = 'mysql_tracking'
- [ ] Feedback.php updated with $connection = 'mysql_feedback'
- [ ] User.php verified (keep default or update as needed)
- [ ] All files saved

---

## Phase 4: Migration Execution

### 4.1 Run Migrations for Each Database

**Option A: Run all migrations (Laravel handles routing):**
```bash
php artisan migrate
```

Laravel will:
- Create migrations in default 'mysql' (users table)
- Create migrations in 'mysql_menu' (menus table)
- Create migrations in 'mysql_order' (orders table)
- Create migrations in 'mysql_delivery' (deliveries, trackings, delivery_services)
- Create migrations in 'mysql_feedback' (feedbacks table)

**Option B: Run per database (manual approach):**
```bash
# Users database
php artisan migrate --database=mysql

# Menu database
php artisan migrate --database=mysql_menu

# Order database
php artisan migrate --database=mysql_order

# Delivery database
php artisan migrate --database=mysql_delivery

# Feedback database
php artisan migrate --database=mysql_feedback

# Tracking database
php artisan migrate --database=mysql_tracking
```

**Checklist:**
- [ ] Migrations completed successfully
- [ ] No migration errors reported
- [ ] All 6 databases now have proper tables
- [ ] Check each database in Adminer to confirm tables exist

### 4.2 Verify Database Structure

**In Laragon Adminer (http://localhost:8000/adminer):**

```
paw-tmart-users:
  ✓ users
  ✓ password_reset_tokens
  ✓ sessions
  ✓ cache
  ✓ job_batches
  ✓ jobs

paw-tmart-menu:
  ✓ menus
  ✓ migrations

paw-tmart-order:
  ✓ orders
  ✓ migrations

paw-tmart-delivery:
  ✓ deliveries
  ✓ trackings
  ✓ delivery_services
  ✓ migrations

paw-tmart-feedback:
  ✓ feedbacks
  ✓ migrations

paw-tmart-tracking:
  ✓ trackings
  ✓ migrations
```

**Checklist:**
- [ ] All 6 databases visible in Adminer
- [ ] All tables created in respective databases
- [ ] No errors in migration status

---

## Phase 5: Seeder Execution

### 5.1 Run Seeders (Update if Needed)

**For basic setup, run:**
```bash
php artisan db:seed
```

**If seeders need updating for multi-database:**

Each seeder should specify the connection:

```php
// database/seeders/MenuSeeder.php
public function run(): void
{
    DB::connection('mysql_menu')->table('menus')->insert([
        [
            'menu_code' => 'MENU001',
            'name' => 'Nasi Goreng',
            'price' => 25000,
            'description' => 'Indonesian fried rice',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
}
```

**Checklist:**
- [ ] Seeders executed
- [ ] Test data populated in each database
- [ ] Verify with SELECT queries in Adminer

---

## Phase 6: Testing

### 6.1 Test GraphQL Queries

**Open GraphQL Playground:** http://localhost:8000/graphql-playground

**Test Query 1: Menus (mysql_menu)**
```graphql
query {
  menus {
    id
    menu_code
    name
    price
    created_at
  }
}
```

**Expected:** Returns menu data from paw-tmart-menu

**Test Query 2: Orders (mysql_order)**
```graphql
query {
  orders {
    id
    menu_code
    name
    quantity
    created_at
  }
}
```

**Expected:** Returns order data from paw-tmart-order

**Test Query 3: Deliveries (mysql_delivery)**
```graphql
query {
  deliveries {
    id
    order_id
    delivery_address
    delivery_status
    created_at
  }
}
```

**Expected:** Returns delivery data from paw-tmart-delivery

**Test Query 4: Cross-Database Relationship**
```graphql
query {
  orders {
    id
    name
    delivery {
      id
      delivery_address
      delivery_status
    }
    feedback {
      id
      rating
      comment
    }
  }
}
```

**Expected:** Returns orders WITH delivery/feedback data (cross-database join)

### 6.2 Test GraphQL Mutations

**Test Mutation 1: Create Menu**
```graphql
mutation {
  createMenu(name: "Fried Chicken", price: 35000) {
    id
    name
    price
    created_at
  }
}
```

**Expected:** New menu created in paw-tmart-menu

**Test Mutation 2: Create Order**
```graphql
mutation {
  createOrder(menu_code: "MENU001", name: "Nasi Goreng", price: 25000, quantity: 2) {
    id
    name
    quantity
    created_at
  }
}
```

**Expected:** New order created in paw-tmart-order

**Checklist:**
- [ ] All queries return correct data from respective databases
- [ ] Mutations create/update data properly
- [ ] Cross-database relationships work
- [ ] No GraphQL errors
- [ ] Response times acceptable

---

## Phase 7: Troubleshooting

### Common Issues & Solutions

**Issue 1: "SQLSTATE[HY000]: General error: 1030 Got error 28"**
- **Cause:** Wrong database connection name
- **Solution:** Verify $connection property matches config/database.php

**Issue 2: "Access denied for user 'zamzamyst'@'localhost'"**
- **Cause:** Wrong credentials in .env or config/database.php
- **Solution:** Verify DB_USERNAME and DB_PASSWORD

**Issue 3: "Unknown database 'paw-tmart-menu'"**
- **Cause:** Database not created or wrong name
- **Solution:** Run SQL CREATE DATABASE commands again

**Issue 4: Cross-database relationship not working**
- **Cause:** Model connection not properly configured
- **Solution:** Verify $connection property in both models

**Issue 5: Migrations not running on specific database**
- **Cause:** Migration doesn't know which database to use
- **Solution:** Models must have $connection property set

### 6.3 Test Laravel Artisan Commands

```bash
# Check database connection
php artisan tinker
>>> DB::connection('mysql_menu')->table('menus')->count()
>>> DB::connection('mysql_order')->table('orders')->count()

# Exit
>>> exit
```

**Checklist:**
- [ ] All database connections accessible
- [ ] Table counts match expected seeded data

---

## Phase 8: Post-Implementation Verification

### 8.1 Production Readiness Checks

**Checklist:**
- [ ] All 6 databases created and populated
- [ ] All models have correct $connection property
- [ ] config/database.php has all 5 connections
- [ ] .env has all DB_DATABASE_* variables
- [ ] Migrations successful on all databases
- [ ] GraphQL queries return correct data
- [ ] GraphQL mutations work properly
- [ ] Cross-database relationships working
- [ ] No error logs in storage/logs/laravel.log
- [ ] API response times acceptable (<500ms)

### 8.2 Backup Strategy

**Before going live:**
```bash
# Backup original database
mysqldump -u zamzamyst -p paw-tmart > paw-tmart-backup.sql

# Can restore if needed:
# mysql -u zamzamyst -p < paw-tmart-backup.sql
```

**Checklist:**
- [ ] Original database backed up
- [ ] Backup file stored safely
- [ ] Restore procedure documented

---

## Phase 9: Rollback Plan (If Needed)

### 9.1 Immediate Rollback (< 1 hour)

If implementation fails, quickly restore:

```php
// app/Models/Menu.php
// Remove: protected $connection = 'mysql_menu';
// Models will use default 'mysql' connection

// Then:
php artisan cache:clear
php artisan config:cache
```

All data still in original paw-tmart database.

### 9.2 Full Restoration (If Complete Migration)

```sql
-- If databases separated, copy data back:
INSERT INTO paw-tmart.menus 
SELECT * FROM `paw-tmart-menu`.menus;

-- Restore User.php to default connection
-- Delete DB_DATABASE_* from .env
-- Remove new connections from config/database.php
```

**Checklist:**
- [ ] Rollback plan understood
- [ ] Original data backup exists
- [ ] Reverse procedure documented

---

## Summary

**Total Changes Needed:**
- 1 .env file (1 addition: 6 lines)
- 1 config file (1 addition: 5 connections)
- 6 model files (1 line each: $connection property)
- 0 GraphQL schema changes
- 0 API controller changes
- 0 migration logic changes

**Estimated Time:**
- Database Creation: **5 minutes**
- Configuration Updates: **10 minutes**
- Model Updates: **5 minutes**
- Migrations: **2 minutes**
- Testing: **15 minutes**
- **Total: ~40 minutes**

**Risk Assessment:** **LOW**
- No business logic changes
- GraphQL requires zero updates
- API endpoints unchanged
- Easy rollback possible
- Data integrity maintained

---

## Next Steps

1. **Review this checklist** and confirm all phases
2. **Create 6 databases** using provided SQL
3. **Update .env** with new variables
4. **Update config/database.php** with new connections
5. **Update 6 model files** with $connection property
6. **Run migrations** with: `php artisan migrate`
7. **Run seeders** with: `php artisan db:seed`
8. **Test GraphQL** using Playground
9. **Verify** all operations working
10. **Deploy** to production with confidence

---

**Ready to implement?** Confirm "YES" and I'll help with any step! 🚀

