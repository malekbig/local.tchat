<?php
/**
 * Created by PhpStorm.
 * User: bmk
 * Date: 28/03/2018
 */
?>

<ul class="list-group">

    <?php if (sizeof($connecteds) > 0) {
        foreach ($connecteds as $connected): ?>
            <li class="list-group-item">
                <span class="badge" style="background: #1c7430!important;color:#1c7430 ">.</span>
                <?= $connected->username ?> <?= ($connected->id == $id) ? "<a href='/index/logout'>Déconnection</a>"
                    : "" ?>
            </li>
        <?php endforeach;
    } ?>
</ul>
