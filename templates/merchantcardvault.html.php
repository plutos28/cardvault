<div class="vault">
    <div class="vault-header">
        <h1>Cards</h1>
    </div>
    <div class="vault-cards">
        <?php foreach ($cards as $card): ?>
            <div class="vault-card">
                <p><span style="font-weight: bold;">Card Number: </span><?=htmlspecialchars($card["cardnumber"], ENT_QUOTES, "UTF-8");?></p>
                <p><span style="font-weight: bold;">Cardholder Name: </span><?=htmlspecialchars($card["cardholder_name"], ENT_QUOTES, "UTF-8");?></p>
                <p><span style="font-weight: bold;">Security Code(CVC/CVV): </span><?=htmlspecialchars($card["cvv"], ENT_QUOTES, "UTF-8");?></p>
                <p><span style="font-weight: bold;">Expiration Date:</span>: <?=htmlspecialchars($card["expiration_date"], ENT_QUOTES, "UTF-8");?></p>

                <div class="card-modifiers">
                    <form action="deletecard.php" method="post">
                        <input type="hidden" name="card_id" value="<?=htmlspecialchars($card["id"], ENT_QUOTES, "UTF-8");?>">
                        <button class="card-modifier-btn delete-btn" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>