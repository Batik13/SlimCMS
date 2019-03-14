$(function(){

  var $type = $('#type'), $values = $('.js-values-row');

  $type.on('change', function(){

    $values.addClass('d-none');
    $values.find('input').attr('placeholder', '');
    
    if (this.value === 'textarea') {
      $values.removeClass('d-none');
      $values.find('input').attr('placeholder', 'summernote || codemirror');
    }
    if (this.value === 'select') {
      $values.removeClass('d-none');
      $values.find('input').attr('placeholder', 'green:Зеленый;red:Красный;black:Черный');
    }
  });


  $('.select').each(function(){
    var $this = $(this), val = $this.attr('value');
    $this.val(val).trigger('change');
  })

});