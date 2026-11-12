# Models and Database Tables

## Category

**Table:** `categories`

**Primary key:** `id`

**Records in table:** 5

### Columns

| Field | Type | Null | Default |
|-------|------|------|---------|
| `id` | bigint(20) unsigned | NO | NULL |
| `name` | varchar(255) | NO | NULL |
| `created_at` | timestamp | YES | NULL |
| `updated_at` | timestamp | YES | NULL |

### Foreign keys

None

### Fillable

- `name`

---

## Feedback

**Table:** `feedback`

**Primary key:** `id`

**Records in table:** 0

### Columns

| Field | Type | Null | Default |
|-------|------|------|---------|
| `id` | bigint(20) unsigned | NO | NULL |
| `user_id` | bigint(20) unsigned | NO | NULL |
| `subject` | varchar(255) | NO | NULL |
| `message` | text | NO | NULL |
| `rating` | tinyint(3) unsigned | NO | NULL |
| `created_at` | timestamp | YES | NULL |
| `updated_at` | timestamp | YES | NULL |

### Foreign keys

- `user_id` references `users.id`

### Fillable

- `user_id`
- `subject`
- `message`
- `rating`

---

## ServiceRequest

**Table:** `service_requests`

**Primary key:** `id`

**Records in table:** 2

### Columns

| Field | Type | Null | Default |
|-------|------|------|---------|
| `id` | bigint(20) unsigned | NO | NULL |
| `user_id` | bigint(20) unsigned | NO | NULL |
| `category_id` | bigint(20) unsigned | NO | NULL |
| `title` | varchar(255) | NO | NULL |
| `description` | text | NO | NULL |
| `location` | varchar(255) | NO | NULL |
| `priority` | varchar(255) | NO | medium |
| `status` | varchar(255) | NO | pending |
| `created_at` | timestamp | YES | NULL |
| `updated_at` | timestamp | YES | NULL |

### Foreign keys

- `category_id` references `categories.id`
- `user_id` references `users.id`

### Fillable

- `user_id`
- `category_id`
- `title`
- `description`
- `location`
- `priority`
- `status`

---

## User

**Table:** `users`

**Primary key:** `id`

**Records in table:** 2

### Columns

| Field | Type | Null | Default |
|-------|------|------|---------|
| `id` | bigint(20) unsigned | NO | NULL |
| `name` | varchar(255) | NO | NULL |
| `email` | varchar(255) | NO | NULL |
| `email_verified_at` | timestamp | YES | NULL |
| `password` | varchar(255) | NO | NULL |
| `remember_token` | varchar(100) | YES | NULL |
| `created_at` | timestamp | YES | NULL |
| `updated_at` | timestamp | YES | NULL |
| `role` | varchar(255) | NO | user |

### Foreign keys

None

### Fillable

- `name`
- `email`
- `password`

---

