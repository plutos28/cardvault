<div id="modal" _="on closeModal add .closing then wait for animationend then remove me">
	<div class="modal-underlay" _="on click trigger closeModal"></div>
	<div class="modal-content add-modal">
		<button class="modal-close-button" _="on click trigger closeModal">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z" fill="rgba(0,0,0,1)"></path></svg>
		</button>
		<h1>Edit Credit Card Details</h1>
		<form class="modal-form" action="editcard.php" method="post">
			<label for="cardnumber">Card Number</label>
	        <input type="text" name="cardnumber" id="cardnumber" value="<?=$card["cardnumber"]?>">

	        <label for="cardholder_name">Cardholder Name</label>
	        <input type="cardholder_name" name="cardholder_name" id="cardholder_name"  value="<?=$card["cardholder_name"]?>">

	        <!-- CVV is specific to visa/mastercard? (change to security code or something and say something like Security Code (CVV/CVC)) -->
	        <label for="cvv">CVV</label>
	        <input type="cvv" name="cvv" id="cvv" value="<?=$card["cvv"]?>">


	        <label for="expiration_date">Expiration Date(MM/YY)</label>
	        <input type="expiration_date" name="expiration_date" id="expiration_date"  value="<?=$card["expiration_date"]?>">

	        <input type="hidden" name="user_id" value="<?=$_SESSION['id']?>">

            <button class="add-card-button" _="on click trigger closeModal" type="submit">
            Submit</button>
        </form>
	</div>
</div>

