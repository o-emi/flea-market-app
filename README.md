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
- Migration に関する補足
本プロジェクトでは、既存カラム名の変更（renameColumn）を行ったため、
Doctrine DBAL を使用しています。
Laravel の仕様上、renameColumn を使用する場合は
Doctrine DBAL が必要となるため、以下をインストールしてください。

```bash
composer require doctrine/dbal:^3.0
```
※ Laravel と DBAL のバージョン互換性のため、3系を指定しています。

7. シーディングの実行
``` bash
php artisan db:seed
```

8. シンボリックリンク作成
``` bash
php artisan storage:link
```

## メール認証について

本アプリでは、新規登録後にメール認証を行わないとログインできない仕様となっています。

### 開発環境でのメール確認方法

開発環境では MailHog を使用しています。

- 新規登録後、認証メールは MailHog に届きます
- メール内の「認証はこちら」リンクをクリックすると認証が完了します
- 認証完了後はプロフィール設定画面へ遷移します


## 初期データについて

本プロジェクトでは、商品データを Seeder により投入しています。

- ItemSeeder により商品一覧表示用のダミーデータが作成されます
- `is_sold` カラムにより Sold 表示の切り替えを確認できます

### 注意
`php artisan migrate:fresh --seed` を実行すると、
登録済みのユーザー情報・商品データはすべて削除されます。


## 認証が必要な機能

以下の機能はログインおよびメール認証後に利用可能です。

- 商品の出品
- マイページの閲覧・プロフィール編集
- 商品へのいいね
- コメント投稿
- 商品購入


## URL
- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/
- MailHog URL：http://localhost:8025/


## 使用技術（実行環境）
- PHP 8.1.33
- Laravel 8.83.8
- My SQL 11.8.3

## ER図
![ER図]()
