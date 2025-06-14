<!-- GETTING STARTED -->
## Getting Started

Proyek ini dirancang untuk memenuhi tugas besar mata kuliah Pengembangan Aplikasi Website. Proyek ini merupakan Sistem Manajemen Kantin T-Mart Gedung TULT, yang dibuat menggunakan Laravel + Breeze. Proyek ini memiliki fitur CRUD utama, yaitu

1. Fitur Manajemen User (Admin, Seller, Customer)
2. Fitur Manajemen Menu
3. Fitur Pemesanan Menu
4. Fitur Pengiriman Menu
5. Fitur Feedback Pemesanan

### Installation

Berikut merupakan tahap instalasi yang harus dilakukan untuk menjalankan proyek ini, jalankan sintaks berikut menggunakan Terminal di perangkat anda.

1. Clone the repository
   ```sh
   git clone https://github.com/zamzamyst/PAW-KELOMPOK7-SI4710.git
   ```
2. Move to directory
   ```sh
   cd PAW-KELOMPOK7-SI4710/
   ```
3. Install Composer packages
   ```sh
   composer install
   ```
4. Install NPM packages
   ```sh
   npm install
   ```
5. Run NPM packages
   ```sh
   npm run build
   ```
5. Copy the `.env.example` file to `.env`
   ```sh
    cp .env.example .env
    ```
6. Setup your database configuration in `.env`
7. Run database migrations
    ```sh
    php artisan migrate
    ```
8. Generate application encryption key
    ```sh
    php artisan key:generate
    ```
9. Seed all user
    ```sh
    php artisan db:seed --class=UserSeeder
    ```
10. Seed roles and permission
    ```sh
    php artisan db:seed --class=RolePermissionSeeder
    ```
11. Seed template menu
    ```sh
    php artisan db:seed --class=MenuSeeder
    ```
12. Start laravel project
    ```sh
    php artisan serve

<p align="right">(<a href="#readme-top">back to top</a>)</p>
