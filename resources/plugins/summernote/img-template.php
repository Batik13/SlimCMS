<?
session_start();
isset($_SESSION['user']) or die("Access denied!");


if (isset($_GET['path'])) {
  
  $allowed = array( 'jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF' );
  $root = $_GET['path'];
  $uploadsPath = $root . 'resources/uploads/';
  $uploadsPathLocal = '../../uploads/';

  $date = new DateTime();
  $prefix = $date->getTimestamp();

  $formatWrap = '
  <div class="container container-scroll">
    <div class="row">
      <table id="initDataTablesImg'.$prefix.'" class="ui celled table">
        <thead>
          <tr>
            <th>Категория</th>
            <th>Картинка</th>
          </tr>
        </thead>
        <tbody>%1$s</tbody>
        <tfoot>
          <tr>
            <th>Category</th>
            <th>Img</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <script>
    var table = $(\'#initDataTablesImg'.$prefix.'\').DataTable({
      initComplete: function () {
        this.api().columns().every( function () {
          var column = this;
          var select = $(\'<select><option value="">Выбрать категорию</option></select>\')
            .appendTo( $(column.footer()).empty() )
            .on( \'change\', function () {
              var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
              );

              column
                .search( val ? \'^\'+val+\'$\' : \'\', true, false )
                .draw();
            });

          column.data().unique().sort().each( function ( d, j ) {
            select.append( \'<option value="\'+d+\'">\'+d+\'</option>\' )
          });
        });
      },
      "language": {
          "lengthMenu": "Выводить по _MENU_ записей",
          "zeroRecords": "Ничего не найдено",
          "info": "Показывается _PAGE_ из _PAGES_",
          "infoEmpty": "Нет доступных записей",
          "infoFiltered": "(отфильтровано из _MAX_ записей)",
          "sSearch": "Поиск",
          "paginate": {
            "next": "Вперед",
            "previous": "Назад"
          },
        },
      "order": [[ 0, "desc" ]],
    });
    vars.set(\'initDataTablesImg'.$prefix.'Counter\', false);

    var moduleName = document.location.href.match(/admin\/[a-z]+\//gm)[0].split(\'/\')[1];
    $(\'#initDataTablesImg'.$prefix.' tfoot tr th:first-child select\').val(moduleName).trigger(\'change\');
  </script>
  <style>#initDataTablesImg'.$prefix.' tfoot tr th:last-child select{display: none; } #initDataTablesImg'.$prefix.'_length {display: none; } #initDataTablesImg'.$prefix.'_filter {display: none; } #initDataTablesImg'.$prefix.'_info {display: none; } #initDataTablesImg'.$prefix.'_paginate {display: none; } #initDataTablesImg'.$prefix.'_wrapper {position: static; } #initDataTablesImg'.$prefix.' tfoot tr th:first-child select {position: absolute; top: -43px; right: 60px; font-size: 14px; } #initDataTablesImg'.$prefix.' thead tr th:first-child {/*display: none;*/ width: 0 !important; padding: 0 !important; font-size: 0 !important; } #initDataTablesImg'.$prefix.' tbody tr td:first-child {/*display: none;*/ width: 0 !important; padding: 0 !important; font-size: 0 !important; } #initDataTablesImg'.$prefix.' tfoot tr th:first-child {width: 0 !important; padding: 0 !important; font-size: 0 !important; } #initDataTablesImg'.$prefix.' tfoot th, table.dataTable tfoot td {border: none; } #initDataTablesImg'.$prefix.' thead tr th:last-child {display: none; } #initDataTablesImg'.$prefix.' tbody th, #initDataTablesImg'.$prefix.' tbody td {border: none; } #initDataTablesImg'.$prefix.' thead th, #initDataTablesImg'.$prefix.' thead td {border: none; }</style>
  ';
  $formatCategory = '
  <tr>
    <td>%1$s</td>
    <td>%2$s</td>
  </tr>';
  $formatItem = '
  <div class="img-item">
    <img class="thumbnail" src="%1$s" alt="thumbnail"/>
    <i>%2$s</i>
  </div>';
  $str;
  
  $category = scandir($uploadsPathLocal);
  for ($i=2; $i<count($category); $i++) { 
    $strItem = '';
    $images = scandir($uploadsPathLocal . $category[$i] . '/');
    foreach ($images as $value) {
      $extension = pathinfo( $value, PATHINFO_EXTENSION );
      if( in_array( $extension, $allowed ) ) {
        $src = $uploadsPath . $category[$i] .'/'. $value;
        $strItem .= sprintf($formatItem, $src, $value);
      }
    }

    $str .= sprintf($formatCategory, $category[$i], $strItem);
  }

  echo sprintf($formatWrap, $str);
}