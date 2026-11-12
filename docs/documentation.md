# CampusFix - System Documentation

Generated on: 2026-11-11 22:42:48

# Blade Views

| View | Location |
|------|----------|
| auth/confirm-password | resources/views/auth/confirm-password.blade.php |
| auth/forgot-password | resources/views/auth/forgot-password.blade.php |
| auth/login | resources/views/auth/login.blade.php |
| auth/register | resources/views/auth/register.blade.php |
| auth/reset-password | resources/views/auth/reset-password.blade.php |
| auth/verify-email | resources/views/auth/verify-email.blade.php |
| components/application-logo | resources/views/components/application-logo.blade.php |
| components/auth-session-status | resources/views/components/auth-session-status.blade.php |
| components/danger-button | resources/views/components/danger-button.blade.php |
| components/dropdown-link | resources/views/components/dropdown-link.blade.php |
| components/dropdown | resources/views/components/dropdown.blade.php |
| components/input-error | resources/views/components/input-error.blade.php |
| components/input-label | resources/views/components/input-label.blade.php |
| components/modal | resources/views/components/modal.blade.php |
| components/nav-link | resources/views/components/nav-link.blade.php |
| components/primary-button | resources/views/components/primary-button.blade.php |
| components/responsive-nav-link | resources/views/components/responsive-nav-link.blade.php |
| components/secondary-button | resources/views/components/secondary-button.blade.php |
| components/text-input | resources/views/components/text-input.blade.php |
| dashboard | resources/views/dashboard.blade.php |
| feedback/create | resources/views/feedback/create.blade.php |
| feedback/index | resources/views/feedback/index.blade.php |
| layouts/app | resources/views/layouts/app.blade.php |
| layouts/footer | resources/views/layouts/footer.blade.php |
| layouts/guest | resources/views/layouts/guest.blade.php |
| layouts/navigation | resources/views/layouts/navigation.blade.php |
| profile/edit | resources/views/profile/edit.blade.php |
| profile/partials/delete-user-form | resources/views/profile/partials/delete-user-form.blade.php |
| profile/partials/update-password-form | resources/views/profile/partials/update-password-form.blade.php |
| profile/partials/update-profile-information-form | resources/views/profile/partials/update-profile-information-form.blade.php |
| requests/_form | resources/views/requests/_form.blade.php |
| requests/create | resources/views/requests/create.blade.php |
| requests/edit | resources/views/requests/edit.blade.php |
| requests/index | resources/views/requests/index.blade.php |
| welcome | resources/views/welcome.blade.php |

# Controllers

## AuthenticatedSessionController

**Location:** app/Http/Controllers/Auth/AuthenticatedSessionController.php

**Methods:**
- `create()`
- `store()`
- `destroy()`

## ConfirmablePasswordController

**Location:** app/Http/Controllers/Auth/ConfirmablePasswordController.php

**Methods:**
- `show()`
- `store()`

## EmailVerificationNotificationController

**Location:** app/Http/Controllers/Auth/EmailVerificationNotificationController.php

**Methods:**
- `store()`

## EmailVerificationPromptController

**Location:** app/Http/Controllers/Auth/EmailVerificationPromptController.php

**Methods:**

## NewPasswordController

**Location:** app/Http/Controllers/Auth/NewPasswordController.php

**Methods:**
- `create()`
- `store()`

## PasswordController

**Location:** app/Http/Controllers/Auth/PasswordController.php

**Methods:**
- `update()`

## PasswordResetLinkController

**Location:** app/Http/Controllers/Auth/PasswordResetLinkController.php

**Methods:**
- `create()`
- `store()`

## RegisteredUserController

**Location:** app/Http/Controllers/Auth/RegisteredUserController.php

**Methods:**
- `create()`
- `store()`

## VerifyEmailController

**Location:** app/Http/Controllers/Auth/VerifyEmailController.php

**Methods:**

## Controller

**Location:** app/Http/Controllers/Controller.php

**Methods:**
- `authorize()`
- `authorizeForUser()`
- `authorizeResource()`
- `validateWith()`
- `validate()`
- `validateWithBag()`

## FeedbackController

**Location:** app/Http/Controllers/FeedbackController.php

**Methods:**
- `create()`
- `store()`
- `index()`

## PageController

**Location:** app/Http/Controllers/PageController.php

**Methods:**
- `home()`
- `dashboard()`

## ProfileController

**Location:** app/Http/Controllers/ProfileController.php

**Methods:**
- `edit()`
- `update()`
- `destroy()`

## ServiceRequestController

**Location:** app/Http/Controllers/ServiceRequestController.php

**Methods:**
- `index()`
- `create()`
- `store()`
- `edit()`
- `update()`
- `destroy()`


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


# Routes

| Method | URI | Name | Action |
|--------|-----|------|--------|
| GET,HEAD | sanctum/csrf-cookie | sanctum.csrf-cookie | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show |
| GET,HEAD | _ignition/health-check | ignition.healthCheck | Spatie\LaravelIgnition\Http\Controllers\HealthCheckController |
| POST | _ignition/execute-solution | ignition.executeSolution | Spatie\LaravelIgnition\Http\Controllers\ExecuteSolutionController |
| POST | _ignition/update-config | ignition.updateConfig | Spatie\LaravelIgnition\Http\Controllers\UpdateConfigController |
| GET,HEAD | api/user | - | Closure |
| GET,HEAD | / | home | App\Http\Controllers\PageController@home |
| GET,HEAD | dashboard | dashboard | App\Http\Controllers\PageController@dashboard |
| GET,HEAD | profile | profile.edit | App\Http\Controllers\ProfileController@edit |
| PATCH | profile | profile.update | App\Http\Controllers\ProfileController@update |
| DELETE | profile | profile.destroy | App\Http\Controllers\ProfileController@destroy |
| GET,HEAD | requests | requests.index | App\Http\Controllers\ServiceRequestController@index |
| GET,HEAD | requests/create | requests.create | App\Http\Controllers\ServiceRequestController@create |
| POST | requests | requests.store | App\Http\Controllers\ServiceRequestController@store |
| GET,HEAD | requests/{serviceRequest}/edit | requests.edit | App\Http\Controllers\ServiceRequestController@edit |
| PUT,PATCH | requests/{serviceRequest} | requests.update | App\Http\Controllers\ServiceRequestController@update |
| DELETE | requests/{serviceRequest} | requests.destroy | App\Http\Controllers\ServiceRequestController@destroy |
| GET,HEAD | feedback | feedback.index | App\Http\Controllers\FeedbackController@index |
| GET,HEAD | feedback/create | feedback.create | App\Http\Controllers\FeedbackController@create |
| POST | feedback | feedback.store | App\Http\Controllers\FeedbackController@store |
| GET,HEAD | register | register | App\Http\Controllers\Auth\RegisteredUserController@create |
| POST | register | - | App\Http\Controllers\Auth\RegisteredUserController@store |
| GET,HEAD | login | login | App\Http\Controllers\Auth\AuthenticatedSessionController@create |
| POST | login | - | App\Http\Controllers\Auth\AuthenticatedSessionController@store |
| GET,HEAD | forgot-password | password.request | App\Http\Controllers\Auth\PasswordResetLinkController@create |
| POST | forgot-password | password.email | App\Http\Controllers\Auth\PasswordResetLinkController@store |
| GET,HEAD | reset-password/{token} | password.reset | App\Http\Controllers\Auth\NewPasswordController@create |
| POST | reset-password | password.store | App\Http\Controllers\Auth\NewPasswordController@store |
| GET,HEAD | verify-email | verification.notice | App\Http\Controllers\Auth\EmailVerificationPromptController |
| GET,HEAD | verify-email/{id}/{hash} | verification.verify | App\Http\Controllers\Auth\VerifyEmailController |
| POST | email/verification-notification | verification.send | App\Http\Controllers\Auth\EmailVerificationNotificationController@store |
| GET,HEAD | confirm-password | password.confirm | App\Http\Controllers\Auth\ConfirmablePasswordController@show |
| POST | confirm-password | - | App\Http\Controllers\Auth\ConfirmablePasswordController@store |
| PUT | password | password.update | App\Http\Controllers\Auth\PasswordController@update |
| POST | logout | logout | App\Http\Controllers\Auth\AuthenticatedSessionController@destroy |
