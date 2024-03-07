

//Вариант с использование селектора JQery - наиболее короткий и читаемый
$(document).ready(function () {
  $('select[name="type_val"]').change(function () {
      var selectedType = $(this).val();
      $('input[type="text"]').hide();
      $('input[name^="input_' + selectedType + '"]').show();
  });
});


