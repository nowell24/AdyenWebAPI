<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript"
            src="https://checkoutshopper-test.adyen.com/checkoutshopper/assets/js/sdk/checkoutSDK.1.6.4.min.js"></script>
            <script type="text/javascript"
            src="PaymentSession.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#btnSubmit').click(function(){
                    $.post('controller/GetSession.php', {amount: $('#amount').val(), 
                                                          shopper_reference: $('#shopperReference').val(), 
                                                          payment_reference: $('#paymentReference').val()}, function(data){
                            console.log(JSON.parse(data).paymentSession);
                            initiateCheckout(JSON.parse(data).paymentSession);
                    });
                });
                chckt.hooks.beforeComplete = function (node, paymentData) {
                    console.log(paymentData.payload);

                    $.post('controller/GetPaymentResult.php', {payload: paymentData.payload}, function(data){
                        $("#result").html(data);
                        //send to webhook
                    });
                    return false; 
                };
            });
            
        </script>
    </head>
    <body>
        Amount <input id="amount" name="amount"> <br>
        Shopper Reference <input id="shopper_reference" name="shopper_reference"> <br>
        Payment Reference <input id="payment_reference" name="payment_reference"> <br>
        <input type="button" value="Submit" id="btnSubmit">
        
        <div class="checkout-container">
            <div class="checkout" id="checkout">
                <!-- The checkout interface will be rendered here -->
            </div>
        </div>
        <div id="result"></div>
    </body>
</html>
