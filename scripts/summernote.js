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
  });
};

export default summernote;
