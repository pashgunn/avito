# Avito тестовое задание

Инструкция по запуску локальной среды разработки

## Требования
- [Docker and Docker Compose](https://www.docker.com/get-started/)

## Развертывание среды разработки

[Laravel Sail](https://laravel.com/docs/11.x/sail#main-content) используется для запуска локальной среды разработки.

Используйте последнюю актуальную версию Docker и Docker compose.

1. Создайте `.env` файл в корне проекта на основе `.env.example`:
    ```
    cp .env.example .env
    ```

2. Если необходимо, измените `.env` файл под себя.

3. Настройка псевдонима bash. Добавьте это в файл конфигурации оболочки в вашем домашнем каталоге, например ~/.zshrc или ~/.bashrc, а затем перезапустите оболочку:
    ```shell
    alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
    ```

4. Запустите docker сервисы:
    ```shell
    sail up
    ```

5. Установите зависимости проекта:
    ```shell
    sail composer install
    ```

6. Сгенерируйте ключ приложения:
    ```shell
    sail artisan key:generate
    ```

7. Выполните миграцию баз данных и посев:
    ```shell
    sail artisan migrate:fresh --seed
    ```

7. Перед запустом `bulk-delete` эндпоинта необходимо запустить воркер очереди командой:
    ```shell
    sail artisan queue:work
    ```

8. Выполните тесты:
    ```shell
    sail test
    ```

9. Для остановки контейнеров docker
    ```
    sail stop
    ```
   
## xDebug

Чтобы включить xDebug, перед запуском Sail необходимо установить соответствующий режим (режимы) в `.env` файле:

```shell
SAIL_XDEBUG_MODE=develop,debug,coverage
```
