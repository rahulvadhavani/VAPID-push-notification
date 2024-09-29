# Laravel Web Push Notifications with VAPID and Authentication

This project demonstrates how to implement web push notifications in a Laravel application using VAPID for push subscription, with user authentication.

## Features

- User authentication using Laravel UI
- Push notification subscription for authenticated users
- Sending web push notifications using VAPID keys
- Service worker for handling push notifications

## Requirements

- PHP 8.x
- Composer
- Laravel 10.x
- MySQL or any compatible database
- openssl

## Installation

### Step 1: Clone the Repository

```bash
git clone https://github.com/yourusername/laravel-push-notifications.git
cd laravel-push-notifications
```

### Step 2: Install Dependencies

Run the following command to install PHP dependencies:

```bash
composer install
```

### Step 3: Set Up Environment Variables

Copy `.env.example` to `.env`:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Set your database configuration in the `.env` file:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### Step 4: Run Migrations

To set up the database tables, run:

```bash
php artisan migrate
```


### Step 7: Generate VAPID Keys

Generate VAPID keys for sending push notifications:

```bash
php artisan webpush:vapid
```

Update your `.env` file with the generated keys:

```dotenv
VAPID_PUBLIC_KEY=your_public_key
VAPID_PRIVATE_KEY=your_private_key
```


### Step 9: Serve the Application

To start the Laravel development server, run:

```bash
php artisan serve
```

You can now access the application at `http://127.0.0.1:8000`.

## Using the Application

### Subscribing to Push Notifications

1. Log in to the application using your credentials.
2. On the home page, click the **"Subscribe to Push Notifications"** button to subscribe to notifications.

### Sending Notifications

1. After subscribing, click the **"Trigger Notification"** button to trigger a push notification.
2. You should see a notification pop up in your browser.






---

## Troubleshooting: VAPID Key Generation Issues (Windows)

If you encounter issues during VAPID key generation on Windows, such as errors related to OpenSSL, follow these steps to resolve them:

### 1. **OpenSSL Not Installed**

#### Issue
Running `php artisan webpush:vapid` results in an error indicating that OpenSSL is not found.
When running `php artisan webpush:vapid`, you see an error indicating that VAPID keys cannot be generated.

#### Solution
You need to install OpenSSL on your Windows machine.

1. Download the OpenSSL installer from the [official site](https://slproweb.com/products/Win32OpenSSL.html).
2. Choose the version that matches your system architecture (Win32/Win64).
3. Run the installer and follow the instructions.
4. During installation, when prompted to configure the OpenSSL binary directory, choose to copy OpenSSL DLL files to the system folder (this helps PHP find OpenSSL).

After installation, add the OpenSSL `bin` directory to your system's environment variables:
   
1. Open **Control Panel** -> **System and Security** -> **System** -> **Advanced system settings**.
2. Click **Environment Variables**.
3. Under **System variables**, select the **Path** variable, and click **Edit**.
4. Add the path to your OpenSSL `bin` folder (e.g., `C:\Program Files\OpenSSL-Win64\bin`).
5. Click **OK** to save the changes and restart your system.

### 2. **OpenSSL PHP Extension Not Enabled**

#### Issue
You encounter an error because the OpenSSL PHP extension is not enabled in your `php.ini` file.

#### Solution
To enable the OpenSSL extension in PHP:

1. Locate your `php.ini` file (in XAMPP, it's typically found in `C:\xampp\php\php.ini`).
2. Open `php.ini` in a text editor and find the following line:

   ```ini
   ;extension=openssl
   ;extension=php_openssl.dll

   ```

3. Remove the semicolon (`;`) at the beginning of the line to uncomment it:

   ```ini
   ;extension=openssl
   extension=php_openssl.dll  ;this is for window xammp
   ```

4. Save the file and restart your local server (Apache or Nginx).

   - If using **XAMPP**, open the **XAMPP Control Panel**, and click **Stop** and **Start** next to **Apache**.

### 3. **VAPID Key Generation Error: Unable to Generate Keys**

Ref. Doc :  https://medium.com/@sagarmaheshwary31/push-notifications-with-laravel-and-webpush-446884265aaa