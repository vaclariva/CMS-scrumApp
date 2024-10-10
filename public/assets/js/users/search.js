$('#search').on('keyup', function() {
    var searchValue = $(this).val();
    let datatable = KTDataTable.getInstance(document.getElementById('datatable_1'));
    datatable.search(searchValue);

    datatable.on('datatable-on-layout-updated', function() {
        var rowCount = $('#datatable_1 tbody tr').filter(function() {
            return !$(this).find('td').text().includes('No records found');
        }).length;

        $('#currentTotalUser').text(rowCount + ' pengguna');

        if (rowCount === 0) {
            $('#datatable_1 tbody').html('<tr><td colspan="5" class="text-center">Tidak ada pengguna yang ditemukan.</td></tr>');
        }
    });
});