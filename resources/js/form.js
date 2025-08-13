
const formImagePath = document.querySelector('#js-form-imagePath');
if(formImagePath){
    const image = document.querySelector('#js-image');
    formImagePath.addEventListener("change", function() {
        const path = formImagePath.files[0];
        console.log(path)
        if(!path){
            image.classList.add('hidden');
            return;
        }
        const reader = new FileReader();
        reader.onload = e => {
            image.src = e.target.result;
            image.classList.remove('hidden');
        }
        reader.readAsDataURL(path);
    });
}
