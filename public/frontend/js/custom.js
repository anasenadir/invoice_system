$(function () {
    // pickdate
    $(".invoice_date").pickadate({
        format: "yyyy-mm-dd",
        today: "",
        clear: "Clear selection",
        close: "Cancel",
    });

    // add another product to your product list  
    $("#add_product").on("click", function (e) {
        e.preventDefault();

        let rowsCount = $(".invoice_details").find(".order_details").length;
        let idValue =
            rowsCount > 0
                ? +$(".invoice_details")
                      .find(".order_details:last")
                      .attr("id") + 1
                : 0;

        console.log(
            +$(".invoice_details").find(".order_details:last").attr("id")
        );

        $("table tbody").append(addAnotherRow(idValue));

        $(".remove-row").on("click", function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    });


    $("#form-details").on("keyup blur", ".product_quantity", function () {
        productnSubtotal($(this));
        sub_total();
        total_due();
    });
    $("#form-details").on("keyup blur", ".product_price", function () {
        productnSubtotal($(this));
        sub_total();
        vat();
        total_due();
    });

    $("#form-details").on("keyup blur", ".descount_value", function () {
        total_due();
    });
    $("#form-details").on("click blur", ".descount_type", function () {
        total_due();
    });
    $("#form-details").on("keyup blur", ".shipping", function () {
        total_due();
    });

    const productnSubtotal = function (elem) {
        let tr = elem.closest("tr");

        // console.log(tr);
        let qauntity = tr.find(".product_quantity").val() ?? 0;
        let price = tr.find(".product_price").val() ?? 0;
        tr.find(".product_subtotal").val(price * qauntity);
    };

    const sub_total = function () {
        let trs = $("tbody tr");

        let sub_total = 0;
        trs.each(function () {
            let sub_quantity = $(this).find(".product_quantity").val() ?? 0;
            let sub_price = $(this).find(".product_price").val() ?? 0;

            sub_total += sub_quantity * sub_price;
        });

        $(".sub_total").val(sub_total);
    };

    const vat = function () {
        let sub_total = parseFloat($(".sub_total").val()) || 0;
        let discount_type = $(".descount_type").val();
        let discount_value = parseFloat($(".descount_value").val()) || 0;

        discount_value =
            discount_type == "percent"
                ? (total_due * discount_value) / 100
                : discount_value;

        let vat_value = (sub_total - discount_value) * 0.05;

        $(".vat").val(vat_value.toFixed(2));
    };

    const total_due = function () {
        let sub_total = parseFloat($(".sub_total").val()) || 0;
        let vat_value = parseFloat($(".vat").val()) || 0;
        let total_due = sub_total;
        let discount_type = $(".descount_type").val();
        let discount_value = parseFloat($(".descount_value").val()) || 0;
        let shipping = parseFloat($(".shipping").val()) || 0;

        discount_value =
            discount_type == "percent"
                ? (total_due * discount_value) / 100
                : discount_value;

        console.log(discount_value);

        total_due = total_due - discount_value;
        // if($('.descount_type').val() == 'percent'){
        //     total_due = total_due - (total_due * ($('.descount_value').val() ?? 1) / 100)
        // }else{
        //     total_due = total_due - ($('.descount_value').val() ?? 0 );
        // }
        total_due = total_due + shipping + vat_value;

        $(".total_due").val(total_due);
    };


    $("form").on("submit", function (e) {
        $("input.product_name").each(function () {
            $(this).rules("add", { required: true });
        });
        $("select.unit").each(function () {
            $(this).rules("add", { required: true });
        });
        $("input.product_quantity").each(function () {
            $(this).rules("add", { required: true });
        });
        $("input.product_price").each(function () {
            $(this).rules("add", { required: true });
        });
        $("input.product_subtotal").each(function () {
            $(this).rules("add", { required: true });
        });
        e.preventDefault();
    });


    $("form").validate({
        rules: {
            customer_name: { required: true },
            customer_email: { required: true, email: true },
            customer_mobile: {
                required: true,
                minlength: 10,
                maxlength: 14,
            },
            company_name: { required: true },
            invoice_number: { required: true},
            invoice_date: { required: true },
            sub_total: { required: true },
            descount_type: { required: true },
            descount_value: { digits: true },
            vat: { required : true },
            shipping: { digits: true },
            total_due: { required: true },
        },
        submitHandler: function (form) {
            form.submit();
        },
    });
});

let addAnotherRow = function (indexValue) {
    var tr = "";
    return (tr = `
                <tr class='order_details' id=${indexValue}>
                    <td class="px-3"><button type='button' class="btn btn-danger btn-sm remove-row"><i class="fa-solid fa-minus"></i></button></td>
                    <td>
                        <input type="text" class="form-control product_name"  name='product_name[${indexValue}]'>
                    </td>
                    <td>
                        <select class="form-select unit" aria-label="Default select example" name="product_unit[${indexValue}]">
                            <option selected></option>
                            <option value="piece">Piece</option>
                            <option value="g">G</option>
                            <option value="km">KG</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control product_quantity"  name='product_quantity[${indexValue}]'>
                    </td>
                    <td>
                        <input type="text" class="form-control product_price"  name='product_price[${indexValue}]'>
                    </td>
                    <td>
                        <input type="text" class="form-control product_subtotal"  readonly name='product_subtotal[${indexValue}]'>
                    </td>
                </tr>
            `);
};


