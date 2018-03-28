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

    <div class="col-md-offset-3 col-md-6 ">
        <center><span>  <?=$message?></span></center>
        <form method="post" action="">
            <div class="form-group">
                <label>Pseudo</label> <input type="text" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label>Mot de passe</label> <input type="password" class="form-control" name="password">
            </div>
            <a href="/index/login" class="btn btn-success">S'authentifier</a>
            <input type="submit" value="S'inscrice" class="btn btn-success">
        </form>
    </div>


</div>


<?php print($variable['login']['FOOTER']); ?>
