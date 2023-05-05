 <!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
    <button class="buy_card_btn2" id="pay" onclick="payment()"> Make Payment</button>
</body>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script>
function payment()
{
    
    $.ajax({
    type : "GET",
    dataType : "json",
    url : "payment_creation.php"
    }).done(function(data){
    
        if(data.status == 200)
        {
            var txn_id = data.order_id;
            var price1 = data.total_amount;
            var options = {
            "key": data.rzp_authkey, // Enter the Key ID generated from the Dashboard
            "amount": price1, // Amount is in currency subunits.currency is INR. Hence, 50000 refers to 50000 paise
            "currency": "INR",
            "name": 'karthickraja',
            "description": "Choose Payment Mode",
            "image":"https://www.sterlingholidays.com/logos/sterling-logo.png",
            "order_id": txn_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            "handler": function (response)
            {
                console.log(response);
            },
            "prefill": {
            "name": "karthick", // pass customer name
            "email": 'A@A.COM',// customer email
            "contact": '+919123456780' //customer phone no.
            },
            "notes": {
            "address": "Razorpay Corporate Office"
            },
            "theme": {
            "color": "#F37254"
            }
            };
            console.log(options);
            var rzp1 = new Razorpay(options);
            rzp1.open();
            $('#payment_button').prop('disabled', false);
        }
        else
        {
            console.log('error');
            //swal('Error',data.message,'error');
        }
    
    })
    
}
</script>