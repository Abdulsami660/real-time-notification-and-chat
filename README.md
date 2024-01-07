In Order To Run The Project Follow the Steps Below

## 1. Setup The Env and Migration

-  Copy .env.example to .env and enter your database name and run the following command
- change Broadcaster Driver From log To pusher
- BROADCAST_DRIVER=pusher

```bash
php artisan migrate
```

## 2. Install the dependencies

```bash
composer install
npm install
```

## 3. Start The Websocket Server

```bash
php artisan websockets:serve
```

## 4. Serve The Project

```bash
php artisan serve
```

## Thats It . Enjoy Chatting
