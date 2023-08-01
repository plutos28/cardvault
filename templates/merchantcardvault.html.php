<div class="vault">
    <div class="vault-header">
        <h1>Cards</h1>
    </div>
    <div class="vault-cards">
        <?php foreach ($cards as $card): ?>
            <div class="merchant-card">
                <p><span style="font-weight: bold;">Card Number: </span><?=htmlspecialchars(base64_encode($card["cardnumber"]));?></p>
                <p><span style="font-weight: bold;">Cardholder Name: </span><?=htmlspecialchars(base64_encode($card["cardholder_name"]));?></p>
                <p><span style="font-weight: bold;">Security Code(CVC/CVV): </span><?=htmlspecialchars(base64_encode($card["cvv"]));?></p>
                <p><span style="font-weight: bold;">Expiration Date:</span>: <?=htmlspecialchars(base64_encode($card["expiration_date"]));?></p>

                <div class="card-modifiers">
                    <form action="deletecard.php" method="post">
                        <input type="hidden" name="card_id" value="<?=htmlspecialchars($card["id"]);?>">
                        <button class="card-modifier-btn delete-btn" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>