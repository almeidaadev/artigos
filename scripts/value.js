function value() {
  $(function () {
    $("#categoria").change(function () {
      var categoriaId = $(this).val();

      if (categoriaId) {
        $.ajax({
          method: "GET",
          url: "/crudArtigoss/get_subcategorias.php",
          data: { id_categoria: categoriaId },

          success: function (response) {
            $("#subcategorias").html(response);
          },
        });
      } else {
        $("#subcategorias").html('<option value="">Erro inesperado</option>');
      }
    });
  });

  $(function () {
    $("#categoria").change(function () {
      var categoriaId = $(this).val();

      if (categoriaId) {
        $.ajax({
          url: "/crudArtigoss/editarposts.php",
          method: "GET",
          data: { id_categoria: categoriaId },

          success: function (response) {
            $("#subcategorias").html(response);
          },
        });
      } else {
        $("#subcategorias").html('<option value="">Erro inesperado</option>');
      }
    });
  });
}
export default value;
