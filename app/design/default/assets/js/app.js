/**
 * Created by Ademu Anthony on 4/7/2015.
 */


jQuery(function () {
    $("input[name='Amount']").keyup(function () {
        var units = $("input[name='Amount']").val() / PRICE_PER_UNIT;
        $("input[name='Unit']").val(units.toFixed(2));
    });

    $("input[name='Unit']").keyup(function () {
        var amount = $("input[name='Unit']").val() * PRICE_PER_UNIT;
        $("input[name='Amount']").val(amount.toFixed(2));
    });
});


