$(document).ready(function () {
    console.log("ready!");
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());

    if (params.column && params.operation) {
        toggleArrow(params.column, params.operation);
    }

    let categories = []
    $.ajax({
        url: '/categories',
        success: function (data) {
            categories = data.data;
            console.log(data)
        }
    })

    setTimeout(() => {
        const options = categories.map(c => ({label: c.name, value: c.id}))
        initializeProductDTE(options)
    }, 100)

});

function initializeProductDTE(categories) {

    $('#shop').DataTable({
        "dom": 'Bfrtip',
        "serverSide": false,
        "ajax": '/shop-editor',
        "select": true,
        "columns": [
            {"data": "id"},
            {"data": "name"},
            {"data": "price"},
            {"data": "description"},
            {"data": "units"},
            {
                "data": "category_id",
                "render": function (val, type, row) {
                    const cat = categories.find(c => c.value == val)
                    return cat.label
                }
            },
        ],
    });
}

function initializeOrderDTE() {
    let editor = new $.fn.dataTable.Editor({
        ajax: {
            url: '/orders/remove',
            success: function (data) {
                console.log('SUCCESS')
            },
            error: function (data) {
                window.location.reload()
            }
        },
        table: "#orders",
        idSrc: "id",
    });

    const table = $('#orders').DataTable({
        "dom": 'Bfrtip',
        "serverSide": false,
        "ajax": '/orders/index',
        "select": true,
        "columns": [
            // {
            //     "className":      'items',
            //     "orderable":      false,
            //     "data":           "items",
            //     "defaultContent": ''
            // },
            {
                "data": "id",
                "className": "order-id"
            },
            {"data": "date"},
            {"data": "total_price"},
        ],
        buttons: [
            'pdfHtml5',
            {
                extend: "remove",
                editor: editor,
                formMessage: function (e, dt) {
                    var rows = dt.rows(e.modifier()).data().pluck('id');
                    return 'Are you sure you want to delete the entries for the ' +
                        'following record(s)? <ul><li>' + rows.join('</li><li>') + '</li></ul>';
                }
            },
        ]
    });

    itemsTable = initializeOrderItemDTE([]);
    table.on( 'select', function () {
        itemsTable.destroy()
        var rowData = table.rows( { selected: true } ).data()[0];
        console.log(rowData.items)
        itemsTable = initializeOrderItemDTE(rowData.items)
    } );
}

function initializeOrderItemDTE(data) {
    const table = $('#order_items').DataTable({
        "dom": 'Bfrtip',
        "serverSide": false,
        "data": data,
        "select": true,
        "columns": [
            {"data": "id"},
            {"data": "product_id"},
            {"data": "units_num"},
            {"data": "price"},
            {"data": "order_id"},
        ],
    })
    return table;
}

function exportProducts() {
    $.ajax('/shop-editor/export');
}

function importData(event) {
    console.log(event)
    console.log($('#formFile'))
}

function addToCart(product) {
    console.log('ADD IN CART')
    product.quantity = 1
    $.ajax({
        url: '/add-product',
        type: "POST",
        data: {product},
        datatype: "json",
        success: function (data) {
            console.log(data)
            let totalCost = 0
            let totalQuantity = 0
            const cartProducts = JSON.parse(data)

            cartProducts.forEach(prod => {
                totalCost += prod.price * prod.quantity
                totalQuantity += prod.quantity * 1
            })
            $('#prodNum').html(totalQuantity)
            $('#totalCost').html(totalCost)
            $('#successCart').show()
        }
    })
}

function updateQuantity(product, sign) {
    if (sign > 0) product.quantity++
    else product.quantity--

    if (product.quantity > 0) {
        $.ajax({
            url: '/update-quantity',
            type: "POST",
            data: {product},
            datatype: "json",
            success: function (data) {
                console.log('SUCCESS +')
                window.location.reload()
            }
        })
    } else {
        removeProductFromCart(product.id)
    }
}

function removeProductFromCart(id) {
    $.ajax({
        url: '/remove-cart-product?id=' + id,
        type: "GET",
        data: {},
        datatype: "json",
        success: function (data) {
            console.log('SUCCESS -')
            window.location.reload()
        }
    })
}
