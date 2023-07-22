var table;
var initTransactionsTable = function(route,data=null) {
    table = $('#transactionsTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: route,
            type: "POST",
            data: {
                data,
                "_token": `${$('meta[name="csrf-token"]').attr('content')}`,

            }
        },
        columns: [
            {
                data: 'actions',
                name: 'actions',
            },
            {
                data: 'reference_no',
                name: 'reference_no',
            },
            {
                data: 'date',
                name: 'date',
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'transaction_type',
                name: 'transaction_type'
            },
            {
                data: 'category',
                name: 'category'
            },
            {
                data: 'amt_type',
                name: 'amt_type'
            },
            {
                data: 'amount',
                name: 'amount',
            },
            {
                data: 'balance',
                name: 'balance'
            },
        ],
        columnDefs: [
            {
                targets: [0, 8],
                orderable: false,
                searchable: false,
            },
        ],
        order:[
            [1, 'desc']
        ],
    });
}
