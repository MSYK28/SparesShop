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

$(document).ready(function () {
    $('#consolidated-table').DataTable({
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
                let code = document.getElementById('code').value;
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
                        code: code,
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
                        window.location.href = '/suppliers';
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
                    text: 'The supplier was not added.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        })
    })
});

// IMPORTING THROUGH CSV

$(document).ready(function () {
    $('#import-csv').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will add new products to the database.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, add it!',
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
                        // Reload the page to show the updated product list
                        Swal.fire({
                            title: 'Success!',
                            text: 'Products have been added.',
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
                    text: 'The products were not added.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        });
    })
});

// IMPORTING THROUGH CSV !!!


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
            } else {
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

// SHOW PRODUCTS
$(document).ready(function () {
    $('#showProductInfo').on('click', function (e) {
        e.preventDefault();

        $('#showCustomerDetails').modal('show');
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            success: function (response) {
                $('#showCustomerDetails .modal-body').html(response.html);
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
// Get the remove-from-cart-button element
$(document).ready(function () {
    $('#remove-from-cart-button').on('click', function (e) {
        const product_id = document.getElementById('productId').value;
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will remove the item from cart.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove item!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/products/remove-from-cart/' + product_id,
                    type: 'DELETE',
                    data: {
                        _token: $('#token').val(),
                        product_id: product_id,
                    },
                    success: function (response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Item has been removed.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseJSON.errors);
                    }
                });
                location.reload();
            } else {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'The item was not removed.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        })
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
            } else {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'The cart was not emptied.',
                    icon: 'info',
                    confirmButtonText: 'OK'
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
                        window.location.href = '/home';
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
            } else {
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
    $('#completeSale').on('submit', function (e) {
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
            } else {
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
                        window.location.href = '/customers';
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
        const customer_id = document.getElementById('customer_id').value;
        const amount = document.getElementById('amount').value;
        const mpesa_code = document.getElementById('mpesa_code').value;
        e.preventDefault();
        $.ajax({
            url: '/customers/' + customer_id + '/balance',
            type: 'GET',
            success: function (response) {
                if (response.success) {
                    if (response.balance >= amount) {
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
                                $.ajax({
                                    url: '/customers/transactions',
                                    method: 'POST',
                                    data: {
                                        _token: $('#token').val(),
                                        customer_id: customer_id,
                                        amount: amount,
                                        mpesa_code: mpesa_code,
                                    },
                                    success: function (response) {
                                        Swal.fire({
                                            title: 'Success!',
                                            text: 'Transaction has been added.',
                                            icon: 'success',
                                            confirmButtonText: 'OK'
                                        });
                                        window.location.href = '/customers/show-customer-details/' + customer_id;
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
                                    text: 'The transaction was not added.',
                                    icon: 'info',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Cancelled',
                            text: 'The amount entered is greater than balance.',
                            icon: 'info',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

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



// PRODUCTS ORDERING
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

// REMOVE ITEM FROM BASKET
// Get the remove-from-basket-button element
$(document).ready(function () {
    $('#remove-from-basket-button').on('click', function (e) {
        const product_id = document.getElementById('product_id').value;
        const supplier_id = document.getElementById('supplier_id').value;
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will remove the item from basket.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove item!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/orders/remove-from-basket/' + product_id,
                    type: 'DELETE',
                    data: {
                        _token: $('#token').val(),
                        id: product_id,
                        supplier_id: supplier_id,
                    },
                    success: function (response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Item has been removed.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseJSON.errors);
                    }
                });
                location.reload();
            } else {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'The item was not removed.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        })
    });
});

// EMPTY ENTIRE BASKET
$(document).ready(function () {
    $('#empty-basket-form').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will empty the basket.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, empty basket!',
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
                            text: 'Basket has been emptied.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseJSON.errors);
                    }
                });
            } else {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'The basket was not emptied.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        })
    });
});


//  CREATE ORDER 
$(document).ready(function () {
    $('#order-form').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will create a new order.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, create order!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // var supplier_id = document.getElementById('supplier_id').value;
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),

                    success: function (response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Order has been created',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        window.location.href = '/orders';
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
                    text: 'The sale was not created.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        })
    })
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

//  GET ORDER TOTAL
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
    document.getElementById('subtotal').value = total;

}

// RECEIVE ORDERED GOODS
$(document).ready(function () {
    $('#receiveOrderForm').on('submit', function (e) {
        var order_id = document.getElementById('order_id').value;
        var subtotal = document.getElementById('subtotal').value;
        var product_id = document.getElementById('product_id').value;

        e.preventDefault();
        console.log(order_id, subtotal, product_id);

        Swal.fire({
            title: 'Are you sure?',
            text: 'This will add a received products to the database.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Confirm Received Goods!',
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
                            text: 'Order has been received.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        location.reload();
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
                    text: 'The Customer was not added.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});

// PAY SUPPLIER/MAKE SUPPLIER TRANSACTION
$(document).ready(function () {
    $('#paySupplierForm').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will make a new transaction to the supplier.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, make transaction!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                var supplier_id = document.getElementById('supplier_id').value;
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),

                    success: function (response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Transaction has been done.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        window.location.href = '/suppliers/' + supplier_id;
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
                    text: 'The transaction failed. Please try again later.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        })
    })
});

// FILTER SALES BY DATE
$(document).ready(function () {
    $('#filterForm').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will filter the sales by date.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, filter!',
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
                            text: 'Filter Successful.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        window.location.href = '/analytics/create';
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
                    text: 'The request failed. Please try again later.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        })
    })
});


// CONSOLIDATE SALES!!!
$(document).ready(function () {
    $('#salesConsolidation').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will add a consolidate sales for the chosen date.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Consolidate!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let cash_sales = document.getElementById('cash_sales').value;
                let credit_sales = document.getElementById('credit_sales').value;
                let revenue = document.getElementById('revenue').value;
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function (response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Sales on have been consolidated',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        window.location.href = '/analytics/create';
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
                    text: 'The transaction was cancelled.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        })
    })
});
// CONSOLIDATE SALES!!!