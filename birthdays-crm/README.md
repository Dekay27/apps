# Birthdays CRM

Birthdays CRM is a Laravel app for tracking contacts and automating birthday outreach. It lets you import contacts from CSV, browse birthdays by month, queue custom messages, and send scheduled SMS greetings using Arkesel.

## Features

- Contact management with search and birthday filters
- CSV import with a fixed header format
- Monthly birthday views grouped by week
- Manual message queueing for a contact
- Scheduled birthday SMS sending via queued jobs
- Settings page for SMS provider credentials

## Requirements

- PHP 8.2+
- Composer
- Node.js + npm
- A database supported by Laravel (SQLite/MySQL/Postgres)
- Queue worker (database queue supported out of the box)

## Setup

1. Install dependencies:

   ```bash
   composer install
   npm install
   npm run build
   ```

2. Configure environment:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. Update `.env` with your database connection and Arkesel credentials:

   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=/absolute/path/to/database.sqlite

   ARKESEL_API_KEY=your_api_key
   ARKESEL_SENDER_ID=YOURBRAND
   ARKESEL_API_URL=https://sms.arkesel.com/api/v2/sms/send
   ```

4. Run migrations:

   ```bash
   php artisan migrate
   ```

5. Start the app:

   ```bash
   php artisan serve
   ```

## Queues and scheduling

Birthday messages are queued and processed by the Laravel queue worker. Start a worker in a separate terminal:

```bash
php artisan queue:work
```

The scheduled command runs `app:send-birthday-messages` daily at 12:05 GMT. Add this to your server cron:

```bash
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

## CSV import format

The importer expects these exact headers (case-sensitive):

```
Name,Date,Notes,Telephone1,Telephone2,Telephone3,Email
```

Dates should be in `DD/MM/YYYY` format.

## License

This project is open-sourced software licensed under the MIT license.
