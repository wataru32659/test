 **開発環境**
- Docker

**Dockerイメージ**
- laravel
- php
- mysql

**開発環境構築手順**
- Dockerをインストール
- git cloneでリモートリポジトリをcloneする
- dockerにdbフォルダを作成
- wsl環境(ubuntu)を開く
- docker compose up -dでコンテナを作成・起動
- cd docker-laravelに移動
- docker-compose exec app bashでコンテナに入る
- composer installでlaravelをインストール
- cd laravel-projectに移動
- apt-get install npmでnpmをインストール
- npm update -g npmでnpmアップデート
- npm installを行う
- exitでコンテナから出る
**DB環境での操作手順**
- docker-compose exec db bashでmysqlのコンテナに入る
- export LANG=ja_JP.UTF-8を実施※日本語入出力できるようにするためのものです。
- mysql -u root -pでmysqlに入る
- passwordはrootを入力※入力時に画面上に表示されないが、見えないだけで入力されています。
- SHOW DATABASES※すべてのデータベース一覧を表示してくれます。
- use 〇〇※データベース一覧を表示してくれます。
**Dockerコマンド一覧**
- docker ps ※現在のコンテナ稼働状況確認
- docker ps -a　※現在のコンテナ稼働状況確認(停止しているコンテナも含む)
- docker stop <CONTAINER IDまたはNAME>※コンテナ停止
- docker start $(docker ps -aq)※すべてのコンテナ開始
- docker stop $(docker ps -q)※すべてのコンテナ停止