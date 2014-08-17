<form name="paypalForm" action="http://getblockbox.com/getBlockBoxSaaS/gdurtan/wp-content/plugins/UiGEN-Core/core-files/paypal/paypal.php" method="post">
	
	<input type="hidden" name="id" value="123">
	<input type="hidden" name="CatDescription" value="Donation to bla bla">
	<input type="hidden" name="payment" value="0.10">  
	<input type="hidden" name="key" value="<? echo md5(date("Y-m-d:").rand()); ?>">                
                                    
<input TYPE="image" SRC="http://www.coachsbr.com/images/site/paypal_button.gif" name="paypal"  value="Payment via Paypal" >
</form>