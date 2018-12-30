<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#btnSubmit').click(function(){
                    $.post('controller/AuthoriseRecurring.php', {amount: $('#amount').val(), 
                                                          shopperReference: $('#shopper_reference').val(), 
                                                          paymentReference: $('#payment_reference').val(),
                                                          selPaymentReference: $('#sel_payment_reference').val(),
                                                          email: $('#email').val()}, function(data){
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
        Shopper Reference <input id="shopper_reference" name="shopper_reference"> <br>
        Payment Reference <input id="payment_reference" name="payment_reference"> <br>
        Selected Payment Reference <input id="sel_payment_reference" name="sel_payment_reference"> <br>
        Email <input id="email" name="email"> <br>
        <input type="button" value="Submit" id="btnSubmit">
        <div id="result"></div>
    </body>
</html>
