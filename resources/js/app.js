import {
    data
} from 'jquery';
import './bootstrap';
import Swal from 'sweetalert2';

// NAVBAR ACTIVE LINK
$(document).ready(function () {
    $('.active-link').each(function () {
        if ($(this).attr('href') === window.location.pathname) {
            $(this).parent().addClass('active');
        }
    });
});

// DATA TABLES
$(document).ready(function () {
    $('#transactions-table').DataTable({
        "paging": true, // Enable/Disable pagination
        "lengthChange": true, // Enable/Disable changing the number of rows per page
        "searching": true, // Enable/Disable search box
        "ordering": true, // Enable/Disable column ordering
        "info": true, // Enable/Disable the display of table information (top-left corner)
        "autoWidth": true,
    });
});

$(document).ready(function () {
    $('#products-table').DataTable({
        "paging": true, // Enable/Disable pagination
        "lengthChange": true, // Enable/Disable changing the number of rows per page
        "searching": true, // Enable/Disable search box
        "ordering": true, // Enable/Disable column ordering
        "info": true, // Enable/Disable the display of table information (top-left corner)
        "autoWidth": true,
    });
});

// SELECT 2
$(document).ready(function () {
    $('.mySelect').select2({
        placeholder: 'Select an option',
        allowClear: true,
        width: '100%',
    });
});

// SUPPLIERS
// ADDING SUPPLIERS
$(document).ready(function () {
    $('#addSupplierForm').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will add a new supplier to the database.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, add supplier!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let name = document.getElementById('name').value;
                let email = document.getElementById('email').value;
                let status = document.getElementById('status').value;
                let taxID = document.getElementById('taxID').value;
                let phone_number = document.getElementById('phone_number').value;
                let bank_name = document.getElementById('bank_name').value;
                let bank = document.getElementById('bank').value;
                let bank_account = document.getElementById('bank_account').value;

                $.ajax({
                    url: "/suppliers",
                    type: "POST",
                    data: {
                        _token: $('#token').val(),
                        name: name,
                        email: email,
                        status: status,
                        taxID: taxID,
                        phone_number: phone_number,
                        bank_name: bank_name,
                        bank: bank,
                        bank_account: bank_account,
                    },
                    success: function (response) {
                        Swal.fire({
                            title: 'Success!',
                            text: name + ' has been added.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        window.location.href ='/suppliers';
                    },
                    error: function (xhr, status, error) {
                        // Display an error message
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred: ' + xhr.responseText,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
            else
            {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'The supplier was not added.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        })
    })
});

// ADDING PRODUCT TO PRODUCTS LIST
$(document).ready(function () {
    $('#product-form').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will add a new product to the database.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, add it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            // If the user confirms, send the AJAX request
            if (result.isConfirmed) {
                let supplier = document.getElementById('supplier').value;
                let productTitle = document.getElementById('productTitle').value;
                let productBarcode = document.getElementById('productBarcode').value;
                let quantity = document.getElementById('quantity').value;
                let reorderQty = document.getElementById('reorderQty').value;
                let productBuyingPrice = document.getElementById('productBuyingPrice').value;
                let productPrice = document.getElementById('productPrice').value;
                let productDiscountedPrice = document.getElementById('productDiscountedPrice').value;

                // Send an AJAX request to add the product
                $.ajax({
                    url: '/products',
                    type: 'POST',
                    data: {
                        _token: $('#token').val(),
                        supplier: supplier,
                        productTitle: productTitle,
                        productBarcode: productBarcode,
                        quantity: quantity,
                        reorderQty: reorderQty,
                        productBuyingPrice: productBuyingPrice,
                        productPrice: productPrice,
                        productDiscountedPrice: productDiscountedPrice,
                    },
                    success: function (response) {
                        // Reload the page to show the updated product list
                        Swal.fire({
                            title: 'Success!',
                            text: productTitle + ' has been added.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        window.location.href = '/products';
                    },
                    error: function (xhr, status, error) {
                        // Display an error message
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred: ' + xhr.responseText,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'The product was not added.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        });

    });
});

// EDIT CREATED PRODUCTS
$(document).ready(function () {
    $('#product-edit-form').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will edit the product in the database.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, edit it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            // If the user confirms, send the AJAX request
            if (result.isConfirmed) {
                let productTitle = document.getElementById('productTitle').value;

                $.ajax({
                    url: "/products/" + $('#productId').val(),
                    method: "PUT",
                    data: $(this).serialize(),
                    success: function (response) {
                        window.location.href = '/products';
                        Swal.fire({
                            title: 'Success!',
                            text: productTitle + ' has been updated.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseJSON.errors);
                    }
                });
            }
            else {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'The product was not edited.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});

// ADD PRODUCTS TO CART
$(document).ready(function () {
    $('#add-to-cart-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            success: function (response) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Added to cart.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                window.location.href = '/home';
                // alert('Added to cart');
                // Show a success message or update the cart count
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseJSON.errors);
            }
        });
    });
});

// REMOVE ITEM FROM CART
$(document).ready(function () {
    $('#remove-from-cart-button').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/products/remove-from-cart/' + product_id,
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                window.location.href = '/home';
                alert('Removed from cart');
                // Reload the cart page or update the cart count
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseJSON.errors);
            }
        });
    });
});


// EMPTY ENTIRE CART
$(document).ready(function () {
    $('#empty-cart-form').on('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: 'This will empty the cart.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, empty cart!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function (response) {
                        window.location.href = '/home';
                        Swal.fire({
                            title: 'Success!',
                            text: 'Cart has been emptied.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseJSON.errors);
                    }
                });
            }
        })
    });
});

// 
// SAVE PURCHASE AS DRAFT
$(document).ready(function () {
    $('#sale-form').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will create a new sale.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, create sale!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),

                    success: function (response) { 
                        Swal.fire({
                            title: 'Success!',
                            text: 'Sale has been created',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        window.location.href ='/home';
                    },
                    error: function (xhr, status, error) {
                        // Display an error message
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred: ' + xhr.responseText,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
            else
            {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'The sale was not created.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        })
    })
});
// END SAVE PRODUCT AS DRAFT!!!

// START DELETE DRAFTED SALE
$(document).ready(function () {
    $('#delete-draft').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will delete the order.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete order!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let sale_id = document.getElementById('sale_id');

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),

                    success: function (response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Order has been deleted.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        window.location.href = "/sales/";
                    },
                    error: function (xhr, status, error) {
                        // Display an error message
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred: ' + xhr.responseText,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
            else
            {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'The order was not deleted.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        });
    })
});
// END DELETE DRAFTED SALE!!!


// CART TOTAL
$(document).ready(function () {
    $.ajax({
        url: '/products/cart/total',
        method: 'GET',
        success: function (response) {
            // console.log(response);
            // alert('Cart total: ' + response.total);
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseJSON.errors);
        }
    });
});


// GET CUSTOMER DETAILS
$('#customer_id').on('change', function () {
    var customer_id = $(this).val();
    if (customer_id) {
        $.ajax({
            url: '/customers/' + customer_id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#customer_name').val(data.phone_number);
                $('#customer_email').val(data.email);
                $('#customer_sale_id').val(customer_id);
                // Add more fields as needed
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    } else {
        $('#customer_name').val('');
        $('#customer_email').val('');
        // Clear other fields as needed
    }
});

// COMPLETE SALE
$(document).ready(function () {
    $('#completeSale').on('submit', function (e){
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: 'This will complete the sale.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, complete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            // If the user confirms, send the AJAX request
            if (result.isConfirmed) {
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),

                    success: function (response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Sale has been completed.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        window.location.href = "/sales/";
                    },
                    error: function (xhr, status, error) {
                        // Display an error message
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred: ' + xhr.responseText,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
            else {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'The sale was not completed.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
// END COMPLETE SALE


// ADD NEW CUSTOMER!!!
$(document).ready(function () {
    $('#addCustomerForm').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will add a new Customer to the database.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, add Customer!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let customerName = document.getElementById('name').value;

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),

                    success: function (response) {
                        Swal.fire({
                            title: 'Success!',
                            text: customerName + ' has been added.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        window.location.href ='/customers';
                    },
                    error: function (xhr, status, error) {
                        // Display an error message
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred: ' + xhr.responseText,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
            else
            {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'The Customer was not added.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        })
    })
});
// ADD NEW CUSTOMER!!!


// ADD DEBT PAYMENT
$(document).ready(function () {
    $('#PaymentForm').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will create a new transaction to the database.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, add transaction!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let customer_id =document.getElementById('customer_id').value;

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),

                    success: function (response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Transaction has been added.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        window.location.href ='/customers/show-customer-details/'  + customer_id;
                    },
                    error: function (xhr, status, error) {
                        // Display an error message
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred: ' + xhr.responseText,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
            else
            {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'The Customer was not added.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        })
    })
});
// ADD DEBT PAYMENT !!!!

// GET SUPPLIER PRODUCTS WHEN ABOUT TO ORDER
$('#supplier_id').on('change', function () {
    var supplier_id = $(this).val();
    if (supplier_id) {
        $.ajax({
            url: '/orders/products/supplier/' + supplier_id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#all-supplier-stock-order-table').empty();
                $.each(data, function (index, item) {
                    $('#all-supplier-stock-order-table').append('<tr><td>' + item.productTitle + '</td><td>' + item.productBarcode + '</td><td>' + item.quantity + '</td><td><button type="submit" class="btn btn-primary add-to-cart-btn" data-id="' + item.id + '">Add to Cart</button></td></tr>');
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    } else {
        $('#all-supplier-stock-order-table').empty();
    }
});

// ADD PRODUCTS TO BASKET
$(document).ready(function () {
    $('#add-to-basket-form').on('submit', function (e) {
        var supplier_id = $('#supplier_id').val();
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            success: function (response) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Product has been added.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                window.location.href = '/orders/create-order/' + supplier_id;
            },
            error: function (xhr, status, error) {
                // Display an error message
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred: ' + xhr.responseText,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});

// GET ORDER PRICE AND QUANTITY
const priceInputs = document.querySelectorAll('.order_quantity_received');
const quantityInputs = document.querySelectorAll('.order_price');
const totals = document.querySelectorAll('.total');

priceInputs.forEach((priceInput, i) => {
    priceInput.addEventListener('input', () => {
        calculateTotal(priceInputs, quantityInputs, totals);
    });
});

quantityInputs.forEach((quantityInput, i) => {
    quantityInput.addEventListener('input', () => {
        calculateTotal(priceInputs, quantityInputs, totals);
    });
});

function calculateTotal(priceElements, quantityElements) {

    let total = 0;
    let item_total = 0;

    for (let i = 0; i < priceElements.length; i++) {
        let price = parseFloat(priceElements[i].value);
        let quantity = parseInt(quantityElements[i].value);

        if (isNaN(price) || isNaN(quantity)) {
            continue;
        }
        item_total = price * quantity;
        totals[i].innerText = item_total.toFixed(2);
        total += price * quantity;
    }

    document.getElementById('total').innerText = total.toFixed(2);
    document.getElementById('subtotal').innerText = total.toFixed(2);
}
