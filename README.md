# coachtech　フリマアプリ

## 環境構築
**Dockerビルド**
1. $ git clone git@github.com:o-emi/coachtech-flea-market-app.git
2. cd coachtech-flea-market-app
3. dockerアプリを立ち上げる
4. `docker-compose up -d --build`

## Laravel環境構築

1. `docker-compose exec php bash`
2. `composer install`
3. cp env.example .env または、新しく.envファイルを作成。
.envに以下の環境変数を追加。
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
``` bash
php artisan key:generate
```

6. マイグレーションの実行
``` bash
php artisan migrate
```

7. シーディングの実行
``` bash
php artisan db:seed
```
8. シンボリックリンク作成
``` bash
php artisan storage:link
```

## URL
- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/


## 使用技術（実行環境）
- PHP 8.1.33
- Laravel 8.83.8
- My SQL 11.8.3

## ER図
![ER図]()
