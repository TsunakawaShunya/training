# アプリケーション名
とれログ

# 概要
とれログは筋トレに関する便利な機能を揃えたwebアプリケーションです

## サービスのURL
テスト用アカウント【ユーザー名：test01，メールアドレス：test01@mail.com，パスワード：test01test01】でログインしてご利用いただけます．  
https://traininglog-b44a4487c027.herokuapp.com/

## 開発した背景
私は1年ほど前から友人と一緒にジムで筋トレをしています．
アメリカの研究によると，「フィットネスジムの利用継続率は1年後にはわずか4%未満になる」とも言われているように，筋トレはなかなか継続が難しいものです．
私も，辛いことに対して忍耐強いとは決して言えない性格ですが，友人とトレーニングの状況などを話したりしていたからこそ，今でもトレーニングを続けられているのではないかと感じました．
そこで，友人とトレーニング状況を共有でき，記録など必要な機能を備えたアプリケーションが欲しいと思い，開発を始めました．

# 使用している主な技術
- バックエンドフレームワーク
  <img src="https://img.shields.io/badge/-Laravel-E74430.svg?logo=laravel&style=plastic">
- フロンドエンド言語
  <img src="https://img.shields.io/badge/-Javascript-F7DF1E.svg?logo=javascript&style=plastic">
- バックエンド言語
  <img src="https://img.shields.io/badge/-Php-777BB4.svg?logo=php&style=plastic">
- データベース
  <img src="https://img.shields.io/badge/-Mysql-4479A1.svg?logo=mysql&style=plastic">
- インフラ
  <img src="https://img.shields.io/badge/-Amazon%20aws-232F3E.svg?logo=amazon-aws&style=plastic">

# ER図
下記のリンクがER図になります．  
https://drive.google.com/file/d/1mMStdOYaFrB1XO4iorAO1pGybRAU3zgM/view?usp=sharing

# ディレクトリ構成
laravelによる構成が基本となっている．
- マイグレーションファイル /training/database/migrations
- モデル /training/app/Models
- コントローラー /training/app/Http/Controllers
- ビュー /training/resources/views
- ルーティング /training/routes/web.php

# 今後の展望
- フレンド申請した，されたユーザーを確認するページでフレンドだったら表示しない
- スマートフォン用にCSSを書く
- ショッピング機能を充実させる
