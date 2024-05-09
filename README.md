** 開発環境 **
- Docker
** Dockerイメージ **
- laravel
- php
- mysql

** 開発環境構築手順 **
- Dockerをインストール
- gitcloneでリモートリポジトリをcloneする
- dockerにdbフォルダを作成
- docker compose up -dでコンテナを作成・起動
- docker-compose exec app bashでコンテナに入る
- composer installでlaravelをインストール
- cd laravel-projectに移動
- apt-get install npmでnpmをインストール
- npm update -g npmでnpmアップデート
- npm installを行う
