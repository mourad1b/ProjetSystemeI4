<?php

use nsNewsletter\Model\Newsletter;

?>
<div class="row">
    <div class="small-12 small-centered column">
        <div class="row">
            <form action="index.php" method="post">
                <div class="large-12 columns">
                    <div class="row collapse prefix-radius">
                        <div class="small-12 columns">
                            <div class="row collapse">

                                <div class="small-2 columns">

                                   <!-- <input type="submit" class="button postfix" value="Rechercher"> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php if (isset($flash)) {
            echo '<div data-alert class="alert-box success radius">';
            echo $flash;
            echo '</div>';

        }?>

        <h3>Newsletter Index</h3>

    </div>
</div>