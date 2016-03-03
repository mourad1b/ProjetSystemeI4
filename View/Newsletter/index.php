<?php

use nsNewsletter\Model\Newsletter;

?>

<div class="row">
    <div class="small-12 small-centered column">
        <div class="small-6 small-centered column">
            <?php if (isset($flash)) {
                echo '<div id="" data-alert class="alert alert-box alert-success">';
                echo $flash;
                echo '</div>';
                echo '</div>';echo '<div id="flashMessage" class="alert hidden">';
                echo $flash;
                echo '</div>';
            }?>
        </div>
        <div class="panel panel-info">
            <?php
            //require('../View/Mail/addMailForm.php');
            ?>
        </div>
    </div>
</div>