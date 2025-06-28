## 環境構築

構築環境
- docker
- PHP 8.2
- laravel 10（sail利用）
  - 参考：https://fadotech.com/laravel10-sail-clone/

**1. git clone**

```
git clone ~~~
```

**2. 環境変数ファイルの作成**

clone したディレクトリへ移動

```
cd ~~~
cp .env.example .env
```

**3. パッケージインストール**

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

**4. Dockerコンテナ起動**

※初回は20分くらい時間がかかります。
```
./vendor/bin/sail up -d
```

**5. APP_KEYの生成**
```
./vendor/bin/sail artisan key:generate
```

**6. フロントパッケージインストール**

```
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

**7. マイグレーション**

```
./vendor/bin/sail artisan migrate
```

**8. おまけ**

以下でエイリアスを変更しておくと、sailコマンドがsail~で実行できるようになる
例：sail artisan migrate
```
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```

## 開発 Tips

### Issue

- Issue にてタスクや問題を書いてください。
- IssueTemplate を使ってください。（該当のテンプレートがない場合は作成してください）
- 重複があると煩雑になるので、関連 Issue を探して#〇〇と参照を入れてください。
- assign、tag をつけてください。
- バグや表示崩れについては、Issue テンプレート`Bug report`で作成してください。
  - 機能実装やテストで見つけ次第、どんどん作成してください。
  - 必要であれば、MTG 内で修正対応について議論してください。
- 作成した Issue を必ず MTG で、いつ対応するのかをチームで決めましょう。

### PullRequest

**1. プルリクエスト前の作業**

プルリクエストを上げる前に必ず、自分が作業を行なっているブランチで `git pull origin main` を行うこと。<br/>
もし、コンフリクトが発生したら、ローカル上で解決する、解決の仕方がわからない場合は、メンバーに相談すること。

**2. `git pull origin main` を行なった後の作業**

remote に変更があった場合は、 `git pull origin main` のコマンドを実行し、remote の変更を取り込む。<br/>
package に更新がないか、確認するため、 `npm install` コマンドを実行する。<br/>
`found 0 vulnerabilities` と表示されれば OK。

**3. プルリクエスト作成時**

- `PullRequestTemplate`を使ってください。
- 作ったブランチから main ブランチへマージするプルリクを作ってください。
- プルリクに issue 番号を紐付けてください。
- レビュアーに assign つけてください。（複数つけても OK）
- レビュー依頼の際は、PR 内にメンションコメント＆念の為 Slack にてレビュアーに声掛けお願いします。

**4. マージ**

- マージはスカッシュコミット（プルリク内のコミットを 1 つににまとめてコミット）でお願いします。
  - マージの際に`Marge Pull Request`ではなく`Squash and merge`を選んでマージしてください。

### Branch

#### ブランチ命名規則（**プレフィックス**をつける）

- feature: 機能追加
- fix: コード修正
- bug: バグ修正

※ 該当項目がない場合は適宜追加

**＜例＞**

```
git checkout -b 'feature/todotop_layout'
git checkout -b 'fix/todotop_layout'
git checkout -b 'bug/todotop_layout'
```

### Commit

#### コミットメッセージ

- 日本語もしくは英語で端的に

**＜例＞**

```
git commit -m 'Top画面 作成'
git commit -m 'create top layout'
```

## 使用技術
### 言語/フレームワーク
- [HTML](https://developer.mozilla.org/ja/docs/Web/HTML)
- [CSS](https://developer.mozilla.org/ja/docs/Web/CSS)
- [PHP 8.2](https://www.php.net/releases/8.2/ja.php)
- [Laravel 10](https://laravel.com/docs/10.x/releases)
- [JavaScript](https://developer.mozilla.org/ja/docs/Web/JavaScript) ※必要に応じて使用

### 技術
- [AWS](https://aws.amazon.com/jp/)
  - RDS：データベース。本番で利用想定。
  - S3：ファイルストレージ。本番で利用（ローカルは任意）。
- Laravel Breeze：認証機能。
- FormRequest：バリデーションに使用。
- configまたはenum：固定値の管理に使用。

### その他
- [GitHub](https://github.co.jp)
- [Laravel Cloud](https://cloud.laravel.com)：Laravelを簡易デプロイできるツール（デプロイ担当者がアカウント作成する）

## 推奨 VScode 拡張機能

- [Git Graph](https://marketplace.visualstudio.com/items?itemName=mhutchie.git-graph&ssr=false#qna) コミットの一覧 → 詳細を閲覧できる
- [Git History](https://marketplace.visualstudio.com/items?itemName=donjayamanne.githistory) ファイルの履歴などを確認できる
- [GitLens](https://marketplace.visualstudio.com/items?itemName=eamodio.gitlens) 視覚的にリポジトリ、ブランチ、ファイル、コミットの状態を確認や操作することができる
