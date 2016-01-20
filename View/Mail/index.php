<?php

use Newsletter\Model\Mail;

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
        <table style="width: 100%;">
            <thead>
            <tr>
                <th>Libelle</th>
                <th>Objet</th>
                <th>Body</th>
            </tr>
            </thead>
            <tbody>
            <?php
            /** @var Mail $mail */
            foreach ($mails as $mail){
                echo '<tr>';
                echo '<td>' . $mail->getLibelle()  . '</td>';
                echo '<td>' . $mail->getObjet() . '</td>';
                echo '<td>' . $mail->getBody() . '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>