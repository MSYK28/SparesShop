import {
    data
} from 'jquery';
import './bootstrap';
import Swal from 'sweetalert2';

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


// CREATE NEW PRODUCT
// $(document).ready(function () {
//     $('#product-form').on('submit', function (e) {
//         e.preventDefault();
//         $.ajax({
//             url: "/products",
//             method: "POST",
//             data: $(this).serialize(),
//             success: function (response) {
//                 console.log(response);
//                 window.location.href = '/products';
//                 alert('product added successfully');
//             },
//             error: function (xhr, status, error) {
//                 console.log(xhr.responseJSON.errors);
//             }
//         });
//     });
// });

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
        $.ajax({
            url: "/products/" + $('#productId').val(),
            method: "PUT",
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);
                window.location.href = '/products';
                alert('product updated successfully');
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseJSON.errors);
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
                console.log(response);
                window.location.href = '/home';
                alert('Added to cart');
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
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            success: function (response) {
                window.location.href = '/home';
                alert('Cart emptied');
                // Reload the cart page or update the cart count
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseJSON.errors);
            }
        });
    });
});

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
                console.log(data);
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
    $('#addCustomerSubmitButton').click(function () {
        $('#addCustomerForm').submit();
    });
});

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
                console.log(response);
                window.location.href = '/orders/create-order/' + supplier_id;
                alert('Added to Basket');
                // Show a success message or update the cart count
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseJSON.errors);
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
