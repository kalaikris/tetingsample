var cartCount = 0;
let jsonServiceData = sessionStorage.getItem("jsonServiceData");
if (jsonServiceData && jsonServiceData!='') {
    let globalStationData = JSON.parse(jsonServiceData);

    globalStationData.forEach(function(globalStationObj) {
        globalStationObj.service_collection.forEach(function(serviceColObj) {
            serviceColObj.service_group.forEach(function(serviceGrpObj) {
                serviceGrpObj.service_array.forEach(function(serviceObj) {
                    if (serviceObj.isSelected) {
                        cartCount++;
                    }
                });
            });
        });
    });
}
$('.cart-count').text(cartCount);

if (cartCount > 0) {
    $('.service-id').text(cartCount + ' Service');
    if($('#my_cart')) $('#my_cart').attr('onclick', 'location.href="checkout.php"');
    if($('#cart-nav')) $('#cart-nav').attr('onclick', 'location.href="checkout.php"');
} else {
    $('.service-id').text('No Service');
    if($('#my_cart')) $('#my_cart').attr('onclick', "swal('No service added in cart !')");
    if($('#cart-nav')) $('#cart-nav').attr('onclick', "swal('Add atleast 1 service !')");
}