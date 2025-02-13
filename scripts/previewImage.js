// Função para mostrar uma pré visualização de uma imagem

function previewImage() {
    var $imageInput = $(".imageInput");

    $imageInput.on("change", function () {
        var $render = new FileReader();

        $render.onload = function (e) {
            var $image = $("#imagePreview");
            $image.attr("src", e.target.result);
            $image.css("display", "block");
        };

        $render.readAsDataURL(this.files[0]);
        console.log(this);
    });
}

export default previewImage;






























// function previewImage() {
//     const imageInput = document.querySelector(".imageInput");

//     imageInput.addEventListener("change", function () {
//         const input = this;
//         const image = document.querySelector("#imagePreview");

//         if (input.files && input.files[0]) {
//             const render = new FileReader();

//             render.onload = (e) => {
//                 image.src = e.target.result;
//                 image.style.display = "block";
//             };

//             render.readAsDataURL(input.files[0]);
//         }
//     });
// }
