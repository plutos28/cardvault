<div class="vault">
    <div class="vault-header">
        <h1>My Cards</h1>
        <a href="#" hx-get="addcard.php" hx-target="body" hx-swap="beforeend" class="add-card-link"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="rgba(255,255,255,1)"></path></svg>
        Add Card</a>
    </div>
    <div class="vault-cards">
        <?php foreach ($cards as $card): ?>
            <div class="vault-card">
                <p><span style="font-weight: bold;">Card Number:</span> <?=htmlspecialchars($card["cardnumber"], ENT_QUOTES, "UTF-8");?></p>
                <p><span style="font-weight: bold;">Cardholder Name:</span>: <?=htmlspecialchars($card["cardholder_name"], ENT_QUOTES, "UTF-8");?></p>
                <p><span style="font-weight: bold;">Security Code(CVC/CVV):</span>: <?=htmlspecialchars($card["cvv"], ENT_QUOTES, "UTF-8");?></p>
                <p><span style="font-weight: bold;">Expiration Date:</span>: <?=htmlspecialchars($card["expiration_date"], ENT_QUOTES, "UTF-8");?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>