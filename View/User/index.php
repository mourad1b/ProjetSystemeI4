<?php

use nsNewsletter\Model\User;

?>
<div class="row">
    <div class="small-12 small-centered column">
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
                var_dump($users);
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