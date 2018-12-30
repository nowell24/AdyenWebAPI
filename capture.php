<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#btnSubmit').click(function(){
                    $.post('controller/CapturePayment.php', {amount: $('#amount').val(), 
                                                          paymentReference: $('#payment_reference').val(),
                                                          origPaymentReference: $('#orig_payment_reference').val()}, function(data){
                                console.log(data);
                                $("#result").html(data);
                                //send to webhook
                    });
                });
                
            });
            
        </script>
    </head>
    <body>
        Amount <input id="amount" name="amount"> <br>
        Payment Reference <input id="payment_reference" name="payment_reference"> <br>
        Orig Payment Reference <input id="orig_payment_reference" name="orig_payment_reference"> <br>
        <input type="button" value="Submit" id="btnSubmit">
        <div id="result"></div>
    </body>
</html>
