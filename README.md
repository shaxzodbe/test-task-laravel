# Mini CRM

Simple Mini CRM built with Laravel 11 for managing Leads and Tasks.

## Requirements

- PHP 8.1+
- MySQL or PostgreSQL
- Composer
- Node.js & NPM

## Installation & Setup

1. **Clone the repository** (if not already done).
2. **Install PHP dependencies**:
   ```bash
   composer install
   ```
3. **Install JS dependencies and build**:
   ```bash
   npm install && npm run build
   ```
4. **Environment Setup**:
   - Copy `.env.example` to `.env`.
   - Configure database credentials in `.env` (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
5. **Generate Key**:
   ```bash
   php artisan key:generate
   ```
6. **Migrate and Seed**:
   ```bash
   php artisan migrate --seed
   ```

## Test Users & Credentials

The seeder creates 2 users for testing purposes:

| Email | Password |
|-------|----------|
| `user1@example.com` | `password` |
| `user2@example.com` | `password` |

## Running the Application

Start the local development server:
```bash
php artisan serve
```
Access the application at `http://localhost:8000`.

## Testing

Run the test suite:
```bash
php artisan test
```

## Features

- **Leads**: Create, Read, Update, Delete (Scoped to current user).
- **Tasks**: Add tasks to leads, toggle status.
- **Search & Filter**: Search leads by name/phone, filter by status.
- **Validation**: Strict validation on inputs.
- **Authorization**: Users can only manage their own leads.
