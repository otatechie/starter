# OboDash - Laravel Vue Admin Starter Kit

A modern admin dashboard starter kit built with Laravel, Vue.js, Inertia, and Tailwind CSS.

![Dashboard Preview](https://via.placeholder.com/800x450?text=OboDash+Preview)

[🔗 Live Demo](https://demo-url.com) | [📘 Official Documentation](https://obodash.com)

## Features

- 🔐 **Authentication**
  - Secure login with Laravel's authentication
  - Passwordless login option
  - Role-based permissions
  - Password security policies
  - Authentication logs

- 🎨 **Interface**
  - Responsive mobile-friendly design
  - Dark/Light mode
  - Modern dashboard layout

- 📊 **Data Management**
  - Interactive data tables
  - Advanced filtering
  - FilePond file uploads
  - Automated backups

## Quick Start

### Prerequisites

- PHP >= 8.2
- Node.js & NPM (Latest LTS)
- Composer

### Installation

1. Clone the repository
```bash
git clone https://github.com/otatechie/obodash-tailwind.git
cd obodash-tailwind
```

2. Install dependencies
```bash
composer install
npm install
```

3. Set up environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure your database in `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Run migrations and seed
```bash
php artisan migrate
php artisan db:seed
```

6. Start development servers
```bash
npm run dev
php artisan serve
```

Visit http://localhost:8000 to see your application.

## Tech Stack

- Laravel v11.x - PHP framework
- Vue.js v3.x - Frontend framework
- Inertia.js v2.x - Modern monolith
- Tailwind CSS v4.x - Utility-first CSS

## Deployment

### Production Server Requirements

- PHP >= 8.2 with required extensions
- MySQL 8.0+ or PostgreSQL 13+
- HTTPS enabled (required for secure cookies)
- Composer installed globally

### Deployment Steps

1. Set up your production environment variables
```bash
# Set environment to production
APP_ENV=production
APP_DEBUG=false

# Configure secure cookie settings
SESSION_SECURE_COOKIE=true
```

2. Build frontend assets
```bash
npm run build
```

3. Optimize Laravel for production
```bash
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Additional Resources

- [👉 Official OboDash Documentation](https://obodash.com) - Complete guides and tutorials
- [Laravel Documentation](https://laravel.com/docs)
- [Vue.js Documentation](https://vuejs.org/guide/introduction.html)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Inertia.js Documentation](https://inertiajs.com/)

## License

[MIT License](LICENSE.md)
