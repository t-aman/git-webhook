# 概要

#### GitHubからの自動デプロイ

GitHubのWebHookを使用して、自動的にサーバに更新資産を反映させるスクリプトです。

#### 動作環境

PHP環境にて動作します。レンタルサーバ（さくらインターネットなど）に配置し実行することも可能です。

# 利用方法

#### 1. サーバでローカルリポジトリを作成

    $ git clone https://github.com/xxxx/xxxx.git ./

#### 2. GitHubでWebHookを設定

    ・https://xxxx/webhook.php
    ・application/json
    ・SECRETの設定
    ・Just the push event.

#### 3. スクリプトにSECRETを定義

    GitHubで設定したSECRETに記載

#### 4. GitHubにPULLすると自動的にサーバに反映される

