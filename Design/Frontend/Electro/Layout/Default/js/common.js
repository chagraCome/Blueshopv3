$(document).ready(function () {
//add to cart 
    $('.ajax_add_to_cart_button').live("click", function () {
        $(this).children('.product-btn.cart-button > span').hide();
        $(this).children('.product-btn.cart-button .fa-spin').show();
        var idProduct = parseInt($(this).data('id-product'));
        $.ajax({
            type: "GET",
            context: this,
            url: 'index.php?module=cart&page=ajax&event=add&id=' + idProduct + '&qnt=1',
            success: function (d) {
                if (d != "NO") {
                    var json_x = $.parseJSON(d);
                    $(this).html('<i class="fa fa-check"></i>');
                    $('ul.products_list').append(json_x[2]);
                    $(this).removeClass('add_to_cart_from_whishlist');
                    $(".cart_header_count").html(json_x[0]);
                    $("b.sc_price").html(json_x[1]);
                    $(".cart_header_total").html(json_x[1]);
                    $(".div_there_is_no_product").hide();
					
                    $(this).children('.product-btn > i.fa-spin').hide();
                    $(this).children('.product-btn > i.fa-check').show();
                } else {
                    $(this).children('.product-btn.cart-button .fa-spin').hide();
                    $(this).children('.product-btn.cart-button .fa-times').show();
                    $(this).removeClass('ajax_add_to_cart_button');
                }
            }
        });
        return false;
    });
    // add to whishlist
    $('.ajax_add_to_whishlist_button').live("click", function () {
        $(this).children('.product-btn > i.fa-heart-o').hide();
        $(this).children('.product-btn > i.fa-spin').show();
        var idProduct = parseInt($(this).data('id-product'));
        $.ajax({
            type: "GET",
            context: this,
            url: 'index.php?module=product&page=ajax-whishlist&event=add&id=' + idProduct,
            success: function (d) {
                if (d != "NO") {
                    $(this).children('.product-btn > i.fa-spin').hide();
                    $(this).children('.product-btn > i.fa-check').show();
                    $(this).removeClass('ajax_add_to_whishlist_button');
					var currentVal = parseInt($(".whishlist_header_count").text());
                    $(".whishlist_header_count").html(currentVal+ 1);
                }

            }
        });
        return false;
    });
    //add to compare
    $('.ajax_add_to_compare_button').live("click", function () {
        $(this).children('.product-btn > i.fa-copy').hide();
        $(this).children('.product-btn > i.fa-spin').show();
        var idProduct = parseInt($(this).data('id-product'));
        $.ajax({
            type: "GET",
            context: this,
            url: 'index.php?module=product&page=ajax-compare&event=add&id=' + idProduct,
            success: function (d) {
                if (d != "NO") {
                    $(this).children('.product-btn > i.fa-spin').hide();
                    $(this).children('.product-btn > i.fa-check').show();
                    $(this).removeClass('ajax_add_to_compare_button');
					var currentVal = parseInt($(".header_compare_items_count").text());
					alert(currentVal);
                    $(".header_compare_items_count").html(currentVal+ 1);
                } else {
                    $(this).children('.product-btn.cart-button .fa-spin').hide();
                    $(this).children('.product-btn.cart-button .fa-times').show();
                    $(this).removeClass('ajax_add_to_compare_button');
				}
            }
        });
        return false;
    });
    // remove from cart
    $('[role="banner"]').on('click', '.close_product', function () {
        var idProduct = parseInt($(this).data('idproduct'));
        $(this).closest('li').animate({'opacity': '0'}, function () {
            $(this).slideUp(500);
        });
        $.ajax({
            type: "GET",
            context: this,
            url: 'index.php?module=cart&page=ajax&event=delete&id=' + idProduct,
            success: function (d) {
                if (d != "NO") {
                    var json_x = $.parseJSON(d);
                    $(".cart_header_count").html(json_x[0]);
                    $("b.sc_price").html(json_x[1]);
                    $(".cart_header_total").html(json_x[1]);
                    if (json_x[0] == 0) {
                        $(".div_there_is_no_product").show();
                    }
                } else {
                }
            }
        });
        return false;
    });
    //add to cart from whishlist
    $('.add_to_cart_from_whishlist').live("click", function () {
        $(this).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        var idProduct = parseInt($(this).data('productid'));
        var qnt = $('#prod-' + idProduct + ' #qnt-' + idProduct).val();
        $.ajax({
            type: "GET",
            context: this,
            url: 'index.php?module=cart&page=ajax&event=add&id=' + idProduct + '&qnt=' + qnt,
            success: function (d) {
                if (d != 'NO') {
                    var json_x = $.parseJSON(d);
                    $(this).html('<i class="fa fa-check"></i>');
                    $('ul.products_list').append(json_x[2]);
                    $(this).removeClass('add_to_cart_from_whishlist');
                    $(".cart_header_count").html(json_x[0]);
                    $("b.sc_price").html(json_x[1]);
                    $(".cart_header_total").html(json_x[1]);
                    $(".div_there_is_no_product").hide();
                } else {
                    $(this).html('<i class="fa fa-times"></i>');
                    $(this).removeClass('ajax_add_to_cart_button');
                }
            }
        });
        return false;
    });
    //remove from whishlist
    $('.remove_from_whishlist').live("click", function () {
        $(this).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        var idProduct = parseInt($(this).data('productid'));
        $('tr#prod-' + idProduct).animate({'opacity': '0'}, function () {
            $(this).slideUp(500);
        });
        $.ajax({
            type: "GET",
            context: this,
            url: 'index.php?module=product&page=ajax-whishlist&event=delete&id=' + idProduct,
            success: function (d) {
                if (d != 'NO') {
                    $(".whishlist_header_count").html(d);
                } else {

                }
            }
        });
        return false;
    });
    //remove from cart list
    $('.remove_product_from_cart_list').live("click", function () {
        $(this).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        var idProduct = parseInt($(this).data('productid'));
        $('tr#prod-' + idProduct).animate({'opacity': '0'}, function () {
            $(this).slideUp(500);
        });
        $.ajax({
            type: "GET",
            context: this,
            url: 'index.php?module=cart&page=ajax&event=delete&id=' + idProduct,
            success: function (d) {
                if (d != 'NO') {
                    var json_x = $.parseJSON(d);
                    $(".cart_header_count").html(json_x[0]);
                    $("b.sc_price").html(json_x[1]);
                    $(".cart_header_total").html(json_x[1]);
                    $('.grand_total').html(json_x[1]);
                    $('.cart_sub_total').html(json_x[2]);
                    $('#addedProd-' + idProduct).hide();
                    if (json_x[0] == 0) {
                        $('.cart_list_table').hide();
                        $('.cart_empty').show();
                    }
                } else {

                }
            }
        });
        return false;
    });
    $('#cart_quantity_up').live("click", function () {
        var idProduct = parseInt($(this).data('productid'));
        $.ajax({
            type: 'GET',
            url: 'index.php?module=cart&page=ajax',
            headers: {"cache-control": "no-cache"},
            async: true,
            cache: false,
            data: 'id=' + idProduct + '&quantity=1&action=increment',
            success: function (data)
            {
                var json_x = $.parseJSON(data);
                $('#cart_sub_total').text(json_x[0]);
                $('#total_product').text(json_x[1]);
                $('#product_sub_total_' + idProduct).text(json_x[2]);
            }
        });
    });
    $('#cart_quantity_down').live("click", function () {
        var idProduct = parseInt($(this).data('productid'));
        $.ajax({
            type: 'GET',
            url: 'index.php?module=cart&page=ajax',
            headers: {"cache-control": "no-cache"},
            async: true,
            cache: false,
            data: 'id=' + idProduct + '&quantity=1&action=decrement',
            success: function (data)
            {
                var json_x = $.parseJSON(data);
                if (json_x[0] == 0 && json_x[1] == 0) {
                    $('tr#prod-' + idProduct).animate({'opacity': '0'}, function () {
                        $(this).slideUp(500);
                    });
                } else {
                    $('#cart_sub_total').text(json_x[0]);
                    $('#total_product').text(json_x[1]);
                    $('#product_sub_total_' + idProduct).text(json_x[2]);
                }
            }
        });
    });



});


