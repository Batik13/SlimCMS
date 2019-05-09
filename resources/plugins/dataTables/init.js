$(document).ready( function () {

  vars.set('initDataTables', function() {
    var table = $('#dataTables').DataTable({

      initComplete: function () {
          this.api().columns().every( function () {
              var column = this;
              var select = $('<select><option value=""></option></select>')
                  .appendTo( $(column.footer()).empty() )
                  .on( 'change', function () {
                      var val = $.fn.dataTable.util.escapeRegex(
                          $(this).val()
                      );

                      column
                          .search( val ? '^'+val+'$' : '', true, false )
                          .draw();
                  } );

              column.data().unique().sort().each( function ( d, j ) {
                  select.append( '<option value="'+d+'">'+d+'</option>' )
              } );
          } );
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
      "order": [[ 0, "desc" ]]
    });  

    $('#dataTables tbody').on('click', 'tr', function () {
      var dataRow = table.row( this ).data();
      vars.set('dataRow', dataRow);
    });
  });
  vars.get('initDataTables')();
	
});