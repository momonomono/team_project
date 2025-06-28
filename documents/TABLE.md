# テーブル定義書/ER図
- 必要最低限のテーブル項目を記載しています。
    - 論理名や初期値などはチームメンバーで決めてください。
    - 必要なテーブルやカラムがあれば適宜追加してください。
- カテゴリーテーブルは任意です。
    - ユーザーごとにカテゴリーを設定したい場合は作成してください。
    - カテゴリーを共通で利用する場合は作成不要です。
## テーブル定義書
### ユーザーテーブル
| 論理名     | 主キー |
| ------- | --- |
| ユーザーID  | ○   |
| ユーザー名   |     |
| メールアドレス |     |
| パスワード   |     |

### 記事テーブル
| 論理名     | 主キー |
| ------- | --- |
| 記事ID    | ○   |
| ユーザーID  |     |
| カテゴリーID |     |
| タイトル    |     |
| 内容      |     |
| 画像パス    |     |

### コメントテーブル
| 論理名    | 主キー |
| ------ | --- |
| コメントID | ○   |
| 記事ID   |     |
| 投稿者ID  |     |
| コメント内容 |     |

### カテゴリーテーブル
| 論理名     | 主キー |
| ------- | --- |
| カテゴリーID | ○   |
| ユーザーID  |     |
| カテゴリー名  |     |

## ER図
erDiagram
    USERS {
        BIGINT id PK "ユーザーID"
        VARCHAR name "ユーザー名"
        VARCHAR email "メールアドレス"
        VARCHAR password "パスワード"
    }
    CATEGORIES {
        BIGINT id PK "カテゴリーID"
        BIGINT user_id FK "ユーザーID"
        VARCHAR name "カテゴリー名"
    }
    ARTICLES {
        BIGINT id PK "記事ID"
        BIGINT user_id FK "ユーザーID"
        BIGINT category_id FK "カテゴリーID"
        VARCHAR title "タイトル"
        TEXT content "内容"
        VARCHAR image_path "画像パス"
    }
    COMMENTS {
        BIGINT id PK "コメントID"
        BIGINT article_id FK "記事ID"
        BIGINT user_id FK "投稿者ID"
        TEXT content "コメント内容"
    }

    USERS ||--o{ CATEGORIES : "has"
    USERS ||--o{ ARTICLES : "writes"
    CATEGORIES ||--o{ ARTICLES : "includes"
    USERS ||--o{ COMMENTS : "writes"
    ARTICLES ||--o{ COMMENTS : "has"
