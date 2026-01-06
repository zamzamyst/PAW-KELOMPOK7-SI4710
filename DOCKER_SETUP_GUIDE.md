# Docker Setup Guide for Tmart Project

## What is Docker?

Docker is a containerization platform that packages your entire application with all its dependencies into a standardized unit called a "container". This ensures your app runs the same way everywhere.

**Benefits:**
- ✅ Same environment on your machine, GitHub, and production servers
- ✅ No more "works on my machine" problems
- ✅ Easy for team members to set up - just one command
- ✅ Includes databases, PHP, Apache - everything pre-configured

## Files Created

1. **Dockerfile** - Instructions to build the Laravel app container
2. **docker-compose.yml** - Configuration to run all services (app + MySQL + PhpMyAdmin)
3. **docker/init-databases.sql** - Script to create all 6 databases automatically
4. **.dockerignore** - Files to exclude from the container
5. **.env.docker** - Docker-specific environment configuration

## Prerequisites

1. **Install Docker Desktop** from https://www.docker.com/products/docker-desktop
   - Available for Windows, Mac, and Linux

2. **Verify installation:**
   ```bash
   docker --version
   docker-compose --version
   ```

## How to Use - Step by Step

### Step 1: Generate Laravel App Key
```bash
php artisan key:generate
```
Copy the `APP_KEY` value from your `.env` file (it looks like `base64:...`)

### Step 2: Prepare Docker Environment
Copy `.env.docker` to use it as environment variables:
```bash
cp .env.docker .env.docker.local
# Edit .env.docker.local and update APP_KEY if needed
```

### Step 3: Build and Start Containers
```bash
docker-compose up -d
```

This command:
- Downloads required images (PHP, MySQL)
- Builds your application container
- Starts all services in the background
- Automatically creates all 6 databases

**Output should show:**
```
Creating tmart-mysql ... done
Creating tmart-app ... done
Creating tmart-phpmyadmin ... done
```

### Step 4: Run Migrations (if needed)
```bash
docker-compose exec app php artisan migrate
```

### Step 5: Seed Database (if needed)
```bash
docker-compose exec app php artisan db:seed
```

### Step 6: Access Your Application

- **Laravel App:** http://localhost:8000
- **PhpMyAdmin:** http://localhost:8081
  - Username: `tmart_user`
  - Password: `tmart_password`
  - Server: `mysql`

## Common Docker Commands

### Start containers
```bash
docker-compose up -d
```

### Stop containers
```bash
docker-compose down
```

### View logs
```bash
docker-compose logs -f app
```

### Execute commands in container
```bash
docker-compose exec app php artisan tinker
docker-compose exec app composer install
docker-compose exec app npm run build
```

### Access MySQL directly
```bash
docker-compose exec mysql mysql -u tmart_user -p tmart-users
# Enter password: tmart_password
```

### Rebuild containers (after code changes)
```bash
docker-compose up -d --build
```

## Database Connections

Inside Docker, your database host is automatically set to `mysql` (hostname of the MySQL container):

```
Host: mysql
Port: 3306
Username: tmart_user
Password: tmart_password
```

This is already configured in `.env.docker`.

## Pushing to GitHub

✅ All Docker files are safe to commit:
```bash
git add Dockerfile docker-compose.yml docker/ .dockerignore .env.docker
git commit -m "Add Docker containerization"
```

## Cleanup

To remove containers and volumes:
```bash
docker-compose down -v
```

To stop without removing:
```bash
docker-compose down
```

## Troubleshooting

### Port already in use
If port 8000 or 3306 is already in use, edit `docker-compose.yml`:
```yaml
ports:
  - "8001:80"  # Use 8001 instead of 8000
```

### Permission denied errors
Run with appropriate permissions or add your user to docker group:
```bash
sudo usermod -aG docker $USER
```

### Database connection fails
Wait a few seconds for MySQL to start, then:
```bash
docker-compose down
docker-compose up -d
```

## Next Steps

1. Install Docker Desktop
2. Run `docker-compose up -d`
3. Access your app at http://localhost:8000
4. Commit the Docker files to GitHub

Your project is now containerized and ready for deployment! 🐳
