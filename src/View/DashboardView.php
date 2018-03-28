<?php
/**
 * Created by PhpStorm.
 * User: bmk
 * Date: 28/03/2018
 */
$variable = require(__DIR__.'/../../app/template/base_layout_tpl.php');
print($variable['login']['HEADER']);
?>
<div class="row">
    <div class="col-md-8">
        <div id="ajax" style="height: 500px;overflow: auto;padding: 5px;border: solid 1px gray;">
            <?php foreach ($messages as $message): ?>
                <div class="list-group">
                    <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading"><?= $message->username ?> <span
                                    style="font-size: small"><?= $message->createdAt ?></span></h4>
                        <p class="list-group-item-text"><?= $message->message ?></p>
                    </a>
                </div>
            <?php endforeach; ?>


        </div>
        <form method="post" action="">
            <label>Message</label> <textarea rows="4" cols="50" name="message" class="form-control"></textarea>
            <input type="submit" class="btn btn-outline-info pull-left" value="submit">
        </form>
    </div>
    <div class="col-md-4" id="connected">
        <ul class="list-group">

            <?php if (sizeof($connecteds) > 0) {
                foreach ($connecteds as $connected): ?>
                    <li class="list-group-item">
                        <span class="badge" style="background: #1c7430!important;color:#1c7430 ">.</span>
                        <?= $connected->username ?>
                    </li>
                <?php endforeach;
            } ?>
        </ul>


    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script>

    setInterval(function () {
        $.post('/index/connected', function (data) {
            $("#connected").html(data);
        });

        $.post('/index/chat', function (datas) {
            $("#ajax").html(datas);
        });
    }, 500);
</script>


<?php print($variable['login']['FOOTER']); ?>
