<?php

use nsNewsletter\Model\Groupe;
use nsNewsletter\Model\GroupeUser;

?>
<div class="small-6 small-centered column">
    <?php if (isset($flash)) {
        echo '<div id="setTimeout" data-alert class="alert alert-success">';
        echo $flash;
        echo '</div>';
    }?>
</div>