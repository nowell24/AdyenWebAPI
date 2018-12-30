<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#btnSubmit').click(function(){
                    $.post('controller/GetRecurringDetails.php', {shopperReference: $('#shopper_reference').val()}, function(data){
                            var card = JSON.parse(data);
                            var cardDetails = card.details;
                            var html = '<tr>';
                            html += '<td>Payment Variant</td>';
                            html += '<td>Expiry</td>';
                            html += '<td>Card No ends</td>';
                            html += '<td>Recurring Detail Reference</td>';
                            html += '</tr>';
                            for(var x=0;x<cardDetails.length;x++)
                            {
                                html += '<tr>';
                                html += '<td>'+cardDetails[x].RecurringDetail.variant+'</td>';
                                html += '<td>'+cardDetails[x].RecurringDetail.card.expiryMonth+'/'+cardDetails[x].RecurringDetail.card.expiryYear+'</td>';
                                html += '<td>'+cardDetails[x].RecurringDetail.card.number+'</td>';
                                html += '<td>'+cardDetails[x].RecurringDetail.recurringDetailReference+'</td>';
                                html += '</tr>';
                            }
                            $("#result").html(html);
                    });
                });
            });
            
        </script>
    </head>
    <body>
        Shopper Reference <input id="shopper_reference" name="shopper_reference"> <br>
        <input type="button" value="Submit" id="btnSubmit">
        
        <table id="result"></table>
    </body>
</html>
