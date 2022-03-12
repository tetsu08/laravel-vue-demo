# laravel 8 + vue 3 DEMO
## LaravelとVueを用いたWebアプリ開発デモ
**概要**  
Googleアカウントと連携してサインアップ処理を行います。  
また、サインアップ完了後にプロフィール画像にメッセージを加工して画面に表示します。
<img width="850" alt="screen_shots" src="https://user-images.githubusercontent.com/95295260/154947438-aba1b448-f78f-4fe2-bf66-2a0c5774ee3b.png">

**構成**
- 仮想環境
  - Docker Compose
- バックエンド
  - フレームワーク
    - Laravel
  - 画像処理
    - ImageMagick
  - テストコード
    - PHPUnit
- フロントエンド
  - フレームワーク
    - Vue.js
    - Vue Router
    - Vuex
  - UIフレームワーク
    - PrimeVue
- WEBサーバー
  - Nginx
- DB
  - PostgreSQL
- Google連携
  - Firebase

## How to use
### 事前準備
* Dockerをインストールする  
https://docs.docker.jp/compose/install.html

* Firebase環境構築を構築する
1. Firebaseプロジェクトを作成する  
https://firebase.google.com/docs/web/setup?hl=ja
1. FirebaseプロジェクトのSDK情報を環境ファイルに転記する  
`app\laravel\.env.demo` の以下の項目にそれぞれの内容を設定する
```
FIREBASE_PROJECT_ID=【projectId】

VITE_FIREBASE_AUTH_DOMAIN=【authDomain】
VITE_FIREBASE_APP_ID=【appId】
VITE_FIREBASE_API_KEY=【apiKey】
```

### システム起動
* Dockerコンテナを構築・起動する
```
docker compose up --build -d
```
* 環境初期化スクリプトを実行する
```
docker exec api bash /tmp/init.sh
```
* 下記URLを開く
```
http://localhost
```

### テストコード実行
```
docker exec api php artisan test
```

### システム停止
* Dockerコンテナを終了・除去する
```
docker compose down --rmi all --volumes
```
