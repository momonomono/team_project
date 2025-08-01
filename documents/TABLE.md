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
[サンプル](https://drive.google.com/file/d/1MvQBHGAOKBT0XiLydIKvcryNwQGBGKEd/view?usp=sharing)

チームで設計したテーブル定義書をChatGPTなどにMermaid記法（erDiagram）に変換してもらい、[Mermaid Live Editor](https://mermaid.live/)で出力する。