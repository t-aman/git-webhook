# 概要

#### GitHubからの自動デプロイ

GitHubのWebHookを使用して、自動的にリモートサーバに更新資産を反映させるスクリプトです。

#### 動作環境

リモートサーバのPHP環境にて動作します。
レンタルサーバ（さくらインターネットなど）に配置し実行することも可能です。

# 利用方法

#### 1. リモートサーバでローカルリポジトリを作成

    $ git clone https://github.com/xxxx/xxxx.git ./

#### 2. GitHubでWebHookを設定

    ・https://xxxx/webhook.php
    ・application/json
    ・SECRETの設定
    ・Just the push event.

#### 3. スクリプトを配置しSECRETを定義

    ・webhook.php をリモートサーバに配置（公開フォルダ）
    ・GitHubで設定したSECRETに記載

#### 4. GitHubにPUSHすると自動的にサーバに反映される

