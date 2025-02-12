function value() {
  $(document).ready(function () {
    $("#categoria").change(function () {
      var categoriaId = $(this).val();

      if (categoriaId) {
        $.ajax({
          method: "GET",
          url: "/crudArtigoss/get_subcategorias.php",
          data: { id_categoria: categoriaId },

          success: function (response) {
            console.log(response);
            $("#subcategorias").html(response);
          },
        });
      } else {
        $("#subcategorias").html('<option value="">Deu bo</option>');
      }
    });
  });

  $(document).ready(function () {
    $("#categoria").change(function () {
      var categoriaId = $(this).val();

      if (categoriaId) {
        $.ajax({
          url: "/crudArtigoss/editarposts.php",
          method: "GET",
          data: { id_categoria: categoriaId },

          success: function (response) {
            console.log(response);
            $("#subcategorias").html(response);
          },
        });
      } else {
        $("#subcategorias").html('<option value="">Deu bo</option>');
      }
    });
  });
}
export default value;

// $.ajax({
//     type: "POST",
//     url: "/crudArtigoss/criar.php",
//     data: { value: 222 }, // Enviando como formulário normal
//     dataType: "json", // Espera receber JSON
//     success(response) {
//         console.log("Resposta do servidor:", response);
//     },
//     error(jqXHR, textStatus, errorThrown) {
//         console.error("Erro na requisição:", textStatus, errorThrown);
//         console.log("Resposta do servidor:", jqXHR.responseText);
//     },
// });

// function value() {
//     const categoriaSelect = $("#categoria");

//     categoriaSelect.on("change", () => {
//         const categoriaSelectValue = categoriaSelect.val;
//         const url = "/crudArtigoss/criar.php";
//         $.ajax({
//             type: "POST",
//             url: url,
//             data: JSON.stringify({oi: 1}),
//             contentType: "application/json; charset=utf-8",
//             dataType: "json",
//             success() {
//                 console.log("deu certo");
//             }
//         });
//     });
// }
// export default value;
