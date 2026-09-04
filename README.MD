# Birge

Веб-приложение на Laravel 12, Livewire и Filament. В проекте есть публичный портал, авторизация пользователей и административная панель для управления экспертами, статьями и публикациями Telegram.

## Требования

- PHP 8.2 или новее;
- Composer;
- MySQL или другая поддерживаемая Laravel база данных;
- Node.js и npm для сборки frontend-ресурсов;
- PHP-расширения, необходимые Laravel и зависимостям из `composer.json`;
- расширение `pdo_sqlite` для запуска тестов.

## Локальный запуск

1. Установите зависимости:

   ```bash
   composer install
   npm ci
   ```

2. Создайте файл окружения и сгенерируйте ключ приложения:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. В `.env` укажите адрес приложения и доступы к базе данных. Для локального запуска с MySQL достаточно настроить `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` и `DB_PASSWORD`. База данных должна быть создана заранее.

4. Выполните миграции и создайте симлинк для публичных файлов:

   ```bash
   php artisan migrate
   php artisan storage:link
   ```

5. Соберите frontend-ресурсы:

   ```bash
   npm run build
   ```

6. Запустите приложение:

   ```bash
   php artisan serve
   ```

   Приложение будет доступно по адресу `http://localhost:8000`.

   Для разработки с hot reload запустите в отдельном терминале `npm run dev`. Либо используйте команду `composer run dev`: она одновременно запускает Laravel-сервер, обработчик очереди и Vite.

### Начальные данные и администратор

При необходимости начальные эксперты, статьи, категории, Telegram-публикации и пользователь-администратор создаются командой:

```bash
php artisan db:seed
```

Email и пароль администратора берутся из `ADMIN_EMAIL` и `ADMIN_PASSWORD`. Перед запуском сидера в production обязательно задайте эти переменные в `.env`.

Сидер предназначен для первичного заполнения базы: повторный запуск создаст дубликаты записей и очистит `storage/app/public/media`, поэтому не запускайте его на заполненной production-базе.

## Тесты

Запустить весь набор тестов можно любой из команд:

```bash
php artisan test
composer test
vendor/bin/pest
```

В `phpunit.xml` для тестов настроены SQLite в памяти, кэш и сессии в памяти, а очередь работает синхронно. Поэтому для обычного запуска тестов отдельный сервер базы данных и отдельные сервисы не требуются, но расширение PHP `pdo_sqlite` должно быть установлено и включено.

Примеры запуска части тестов:

```bash
php artisan test tests/Feature/Auth/AuthenticationTest.php
php artisan test --filter=authentication
vendor/bin/pest tests/Unit
```

## Деплой на production-сервер

В репозитории нет Docker- или CI-конфигурации, поэтому ниже приведён порядок деплоя на обычный сервер с PHP-FPM и Nginx/Apache.

### Первичная установка

1. Разместите проект на сервере и перейдите в его каталог:

   ```bash
   git clone <URL_РЕПОЗИТОРИЯ> /var/www/birge
   cd /var/www/birge
   ```

2. Установите production-зависимости и соберите frontend:

   ```bash
   composer install --no-dev --optimize-autoloader --no-interaction
   npm ci
   npm run build
   ```

3. Создайте production-конфигурацию:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   В `.env` как минимум укажите:

   ```dotenv
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://example.com

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=birge
   DB_USERNAME=...
   DB_PASSWORD=...

   ADMIN_EMAIL=...
   ADMIN_PASSWORD=...
   ```

   Также настройте почту, если приложение должно отправлять письма. Не добавляйте `.env` в Git и не публикуйте `APP_KEY` или пароли.

   На проде приложение деплоится в подпапку, доступную веб-серверу (например `/www`). Чтобы `.env` был недоступен снаружи, положите его на уровень выше этой папки — `bootstrap/app.php` сначала пытается прочитать `.env` оттуда, и только если его там нет, использует `.env` внутри папки приложения (это нужно для локальной разработки).

4. Выполните миграции и настройте хранилище:

   ```bash
   php artisan migrate --force
   php artisan storage:link
   ```

   `php artisan db:seed --force` выполняйте только при первичном заполнении пустой базы и с учётом предупреждения выше.

5. Очистите старый кэш и создайте production-кэш конфигурации и представлений:

   ```bash
   php artisan optimize:clear
   php artisan config:cache
   php artisan view:cache
   ```

### Веб-сервер и права

- Document root виртуального хоста должен указывать на каталог `<путь-к-проекту>/public`, а не на корень репозитория.
- Все запросы, кроме существующих статических файлов, должны передаваться в `public/index.php`.
- PHP-FPM должен использовать PHP 8.2 или новее.
- Пользователь PHP-FPM должен иметь право записи в `storage` и `bootstrap/cache`.
- После обновления кода повторно выполните сборку `npm run build`, миграции и команды кэширования.

### Очереди

В `.env.example` используется `QUEUE_CONNECTION=database`. Если на production используется это значение, запустите постоянный worker под Supervisor, systemd или другим process manager:

```bash
php artisan queue:work --tries=3 --timeout=90
```

После обновления кода перезапустите worker:

```bash
php artisan queue:restart
```

### Административная панель

После деплоя панель доступна по адресу `https://example.com/admin`. Пользователь для входа создаётся сидером или через штатный механизм регистрации приложения.

### Telegram webhook

Endpoint webhook приложения: `POST https://example.com/api/telegram/webhook`. Он принимает обновления Telegram с `channel_post` или `message` и сохраняет публикацию в базе данных. При настройке webhook в Telegram используйте публичный HTTPS-адрес приложения.

## Полезные команды

```bash
php artisan about              # информация о конфигурации приложения
php artisan migrate:status     # состояние миграций
php artisan route:list         # список маршрутов
```
