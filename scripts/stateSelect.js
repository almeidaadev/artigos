function stateSelect() {
  $("#categoria").change(function () {
    if (!$(this).val) {
      $("#subcategorias").prop("disabled", true);
    }

    $("#subcategorias").prop("disabled", false);
  });
}

export default stateSelect;
