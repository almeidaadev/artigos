const summernote = () => {
    $("#content").summernote({
        height: 300, // altura do negocio
        tabsize: 2, // aamanho do tab
        toolbar: [
            // Ferramentas disponíveis
            ["style", ["style"]],
            ["font", ["bold", "italic", "underline", "clear"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["insert", ["link", "picture", "video"]],
            ["view", ["fullscreen", "codeview", "help"]],
        ],
        // onImageUpload: function (files, editor, welEditable) {
        //     sendFile(files[0], editor, welEditable);
        // },
    });
};

// function sendFile(file, editor, welEditable) {
//     data = new FormData();
//     data.append("files", file);

//     $.ajax({
//         type: "POST",
//         url: "../posts.php",
//         data: data,
//         success: function (data) {
//             alert(data);
//             $(".editor").summernote("editor.insertImage", data);
//         },
//     });
// }

export default summernote;
