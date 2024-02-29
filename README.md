# NewsLetter Management System
## Description
This is a simple newsletter management system that allows users to subscribe to a newsletter and receive updates on the latest news and events. The system is built using PHP and Laravel framework. It also uses MySQL database to store user information and newsletter subscriptions. The system also has an admin panel that allows the admin to manage the newsletter subscribers and send out newsletters to the subscribers. The admin can also view the statistics of the newsletters sent out and the number of subscribers who have read the newsletters.

## Installation
1. Clone the repository
```bash
git clone https://github.com/HMZElidrissi/NewsLetter-Manager.git
```
2. Change directory
```bash
cd NewsLetter-Manager
```
3. Install dependencies
```bash
composer install
npm install
```
4. Create a copy of the .env file
```bash
cp .env.example .env
```
5. Generate an application key
```bash
php artisan key:generate
```
6. Create a new database and update the .env file with the database details
7. Run the migrations
```bash
php artisan migrate --seed
```
8. Install Laravel Sail
```bash
./vendor/bin/sail install
```
9. Build the assets
```bash
npm run dev
```
10. Link the storage folder
```bash
php artisan storage:link
```
11. Run Docker
```bash
sudo service docker start
```
11. Start the application
```bash
./vendor/bin/sail up
```
