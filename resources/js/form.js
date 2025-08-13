// 画像フォーム
const formImagePath = document.querySelector('#js-form-imagePath');

// 画像フォームがあるか確認
if(formImagePath){
    // プレビュー画像の取得
    const image = document.querySelector('#js-image');
    
    // 画像フォームにchangeイベント
    formImagePath.addEventListener("change", function() {

        // フォーム内の画像ファイルを取得
        const path = formImagePath.files[0];
        
        // 画像が選択されていない場合は、画像を非表示にする
        if(!path){
            image.classList.add('hidden');
            return;
        }
        
        // 画像が選択された場合は、画像を表示する
        const reader = new FileReader();
        reader.onload = e => {
            image.src = e.target.result;
            image.classList.remove('hidden');
        }

        // 画像の読み込み
        reader.readAsDataURL(path);
    });
}
