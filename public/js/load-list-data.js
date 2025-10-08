function loadData(id_table, url, data_src = 'data', columns = [], leng_menu = [16, 32, 64, -1], drop_down = [16, 32, 64, "All"]) 
{
    if (!id_table || !url) return;

    const table = typeof id_table === 'string' ? $('#' + id_table) : id_table;

    // Khởi tạo DataTable
    table.DataTable({
        ajax: {
            url: url,
            dataSrc: data_src
        },
        autoWidth: true,
        lengthMenu: [
            leng_menu,
            drop_down
        ],
        columns: columns
    });
}
