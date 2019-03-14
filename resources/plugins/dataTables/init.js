$(document).ready( function () {
	var table = $('#dataTables').DataTable({
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