# Database Separation - Visual Architecture

## Current Architecture (Single Database)

```
┌─────────────────────────────────────┐
│   GraphQL API                       │
│  (/graphql endpoint)                │
└────────────────┬────────────────────┘
                 │
         ┌───────▼────────┐
         │  Lighthouse    │
         │  (Resolvers)   │
         └───────┬────────┘
                 │
         ┌───────▼────────────────────┐
         │   All Models               │
         │  (User, Menu, Order, etc.) │
         └───────┬────────────────────┘
                 │
         ┌───────▼────────────────────────┐
         │  Single MySQL Connection       │
         │  (config: 'mysql')             │
         └───────┬────────────────────────┘
                 │
         ┌───────▼────────────────────────┐
         │   paw-tmart (Single DB)        │
         │  ├── users                     │
         │  ├── menus                     │
         │  ├── orders                    │
         │  ├── deliveries               │
         │  ├── trackings                │
         │  ├── feedbacks                │
         │  └── delivery_services        │
         └────────────────────────────────┘
```

---

## Proposed Architecture (Separate Databases)

```
┌────────────────────────────────────────┐
│   GraphQL API                          │
│  (/graphql endpoint) - NO CHANGES      │
└─────────────────┬──────────────────────┘
                  │
          ┌───────▼─────────┐
          │ Lighthouse      │
          │ (Resolvers)     │
          └───────┬─────────┘
                  │
      ┌───────────┼───────────┐
      │                       │
┌─────▼─────┐         ┌──────▼──────┐
│   Models  │         │  Models    │
│(with      │         │(with       │
│$connection│         │$connection)│
│)          │         │            │
└─────┬─────┘         └──────┬──────┘
      │                      │
      │        ┌─────────────┼─────────────┐
      │        │             │             │
    ┌─┴──────┐ │      ┌──────▼──────┐     │
    │ MySQL  │ │      │   MySQL     │     │
    │ Conn:  │ │      │   Conn:     │     │
    │ users  │ │      │ mysql_menu  │     │
    └─┬──────┘ │      └──────┬──────┘     │
      │        │             │            │
 ┌────▼──────┐ │      ┌──────▼──────┐    │
 │paw-tmart- │ │      │paw-tmart-   │    │
 │users      │ │      │menu         │    │
 │├─ users   │ │      │├─ menus     │    │
 └───────────┘ │      └─────────────┘    │
               │                          │
      ┌────────▼────────┐      ┌──────────▼────────┐
      │  MySQL Conn:    │      │  MySQL Conn:      │
      │  mysql_order    │      │  mysql_delivery   │
      └────────┬────────┘      └──────────┬────────┘
               │                          │
      ┌────────▼────────┐      ┌──────────▼────────┐
      │paw-tmart-order  │      │paw-tmart-         │
      │├─ orders        │      │delivery           │
      └─────────────────┘      │├─ deliveries      │
                               │├─ trackings       │
                               │└─ delivery_       │
                               │  services         │
                               └───────────────────┘

      ┌──────────────────┐
      │  MySQL Conn:     │
      │  mysql_feedback  │
      └──────────┬───────┘
                 │
      ┌──────────▼───────┐
      │paw-tmart-        │
      │feedback          │
      │├─ feedbacks      │
      └──────────────────┘
```

---

## Database Connection Flow

### **How Lighthouse Resolves Data** (No Changes Needed)

```
User Query: { menus { id name } }
    │
    ▼
GraphQL Parser
    │
    ▼
Lighthouse Router
    │
    ▼
@all(model: "Menu") Directive
    │
    ▼
Menu Model
    │
    ├─ $connection = 'mysql_menu'
    │
    ▼
Config reads 'mysql_menu'
    │
    ├─ DB_HOST: 127.0.0.1
    ├─ DB_PORT: 3306
    ├─ DB_DATABASE: paw-tmart-menu  ◄─ FROM .env
    ├─ DB_USERNAME: zamzamyst
    └─ DB_PASSWORD: Dreamzzz@19
    │
    ▼
MySQL: paw-tmart-menu.menus ✅

Result: Returns menu rows
```

---

## Cross-Database Relationships

### **Example: Feedback ↔ Order (Different Databases)**

```
Feedback Model              Order Model
(mysql_feedback)            (mysql_order)
┌──────────────────┐       ┌──────────────────┐
│ id: 1            │       │ id: 5            │
│ order_id: 5      │───┐   │ menu_code: ...   │
│ rating: 5        │   │   │ quantity: 2      │
│ comment: "Good!" │   │   │ ...              │
└──────────────────┘   │   └──────────────────┘
                       │
              ┌────────┴────────┐
              │                 │
         Feedback::order()  
         belongsTo(Order)
         
         Laravel automatically:
         1. Queries paw-tmart-feedback for feedback row
         2. Gets order_id value
         3. Switches to mysql_order connection
         4. Queries paw-tmart-order for matching order
         5. Combines results

         ✅ WORKS TRANSPARENTLY!
```

---

## File Modification Map

```
Project Root
│
├── .env (🔴 MODIFY)
│   └── Add: DB_DATABASE_MENU, DB_DATABASE_ORDER, etc.
│
├── config/
│   └── database.php (🔴 MODIFY)
│       └── Add: 'mysql_menu', 'mysql_order', etc. connections
│
├── app/Models/ (🟡 LIGHT MODIFY)
│   ├── Menu.php (🔴 Add 1 line: $connection)
│   ├── Order.php (🔴 Add 1 line: $connection)
│   ├── Delivery.php (🔴 Add 1 line: $connection)
│   ├── DeliveryService.php (🔴 Add 1 line: $connection)
│   ├── Tracking.php (🔴 Add 1 line: $connection)
│   ├── Feedback.php (🔴 Add 1 line: $connection)
│   └── User.php (🟢 Optional)
│
├── database/
│   ├── migrations/ (🟢 NO FUNCTIONAL CHANGE)
│   │   └── Can organize by folder (optional)
│   │
│   └── seeders/ (🟡 MINOR MODIFY)
│       └── Specify connection in queries
│
├── graphql/
│   └── schema.graphql (🟢 ZERO CHANGES)
│
└── app/Http/Controllers/ (🟢 ZERO CHANGES)
    └── GraphQL uses models automatically
```

**Legend:**
- 🟢 No changes
- 🟡 Light modification
- 🔴 Needs modification

---

## Environment Variables Needed

### **Current .env**
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=paw-tmart
DB_USERNAME=zamzamyst
DB_PASSWORD=Dreamzzz@19
```

### **With Database Separation**
```bash
# Keep default for backwards compatibility
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=paw-tmart-users
DB_USERNAME=zamzamyst
DB_PASSWORD=Dreamzzz@19

# Add specific databases for each service
DB_DATABASE_MENU=paw-tmart-menu
DB_DATABASE_ORDER=paw-tmart-order
DB_DATABASE_DELIVERY=paw-tmart-delivery
DB_DATABASE_TRACKING=paw-tmart-tracking
DB_DATABASE_FEEDBACK=paw-tmart-feedback
DB_DATABASE_USERS=paw-tmart-users
```

All on same server (127.0.0.1) or can be different servers!

---

## Configuration Example

### **config/database.php Addition**

```php
'connections' => [
    'mysql' => [
        // ... existing default
    ],
    
    'mysql_menu' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE_MENU', 'paw-tmart-menu'),
        'username' => env('DB_USERNAME', 'zamzamyst'),
        'password' => env('DB_PASSWORD', 'Dreamzzz@19'),
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
    
    'mysql_order' => [ /* ... same structure */ ],
    'mysql_delivery' => [ /* ... same structure */ ],
    'mysql_feedback' => [ /* ... same structure */ ],
    'mysql_tracking' => [ /* ... same structure */ ],
]
```

---

## Implementation Timeline

```
Week 1: Planning & Setup
├── Create 6 new MySQL databases
├── Update .env
└── Update config/database.php

Week 2: Model Updates
├── Add $connection to each model
├── Update seeders
└── Test individual model queries

Week 3: Integration Testing
├── Test GraphQL queries
├── Test cross-database relationships
└── Test mutations

Week 4: Deployment
├── Backup current database
├── Run migrations
├── Verify all operations
└── Monitor performance
```

---

## Success Criteria

✅ All 6 services have separate databases
✅ GraphQL queries return correct data
✅ Mutations create/update data properly
✅ Cross-database relationships work (Feedback→Order)
✅ Authentication still works
✅ No API changes needed
✅ Performance same or better

---

**Ready to implement? All systems are Go!** 🚀

