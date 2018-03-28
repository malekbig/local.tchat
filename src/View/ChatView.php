<?php
/**
 * Created by PhpStorm.
 * User: bmk
 * Date: 28/03/2018
 */
foreach ($messages as $message): ?>
    <div class="list-group">
        <a href="#" class="list-group-item">
            <h4 class="list-group-item-heading"><?= $message->username ?> <span
                        style="font-size: small"><?= $message->createdAt ?></span></h4>
            <p class="list-group-item-text"><?= $message->message ?></p>
        </a>
    </div>
<?php endforeach; ?>