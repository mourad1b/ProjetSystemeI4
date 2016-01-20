<?php

use Newsletter\Model\User;

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
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
            </tr>
            </thead>
            <tbody>
            <?php
            /** @var User $user */
            foreach ($users as $user){
                echo '<tr>';
                echo '<td>' . $user->getNom() . '</td>';
                echo '<td>' . $user->getPrenom() . '</td>';
                echo '<td>' . $user->getMail() . '</td>';
                echo '<td> ' . $user->getTelephone() . ' </td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>