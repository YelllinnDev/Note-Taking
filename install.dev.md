# Docker Local

-   adjust the existing `.env` referencing `.env.example`, especially ports (or just copy the example file)
    ```bash
    yes | cp -f .env.example .env
    ```
-   run make file
    ```bash
    make
    ```

To start/stop containers

```bash
docker compose stop
docker compose start
```

Or just destory and recreate

```bash
docker compose down -v
docker compose up -d
```


## Run Migration and Seeder

```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
```