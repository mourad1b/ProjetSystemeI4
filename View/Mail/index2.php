<?php
/**
 * Created by PhpStorm.
 * User: loue
 * Date: 21/01/2016
 * Time: 11:41
 */
echo '<form method="post" action="supprimer_telephone.php">
<table>
<tr>
<td>libelle</td><td>objet</td><td>body</td><td>Supprimer</td>
</tr>';

/** @var Mail $mail */
foreach ($mails as $mail){
    echo '<tr>';
    echo '<td>' . $mail->getLibelle()  . '</td>';
    echo '<td>' . $mail->getObjet() . '</td>';
    echo '<td>' . $mail->getBody() . '</td>';
    echo '<td><input type="checkbox" name="id_rep[]" value="'. $mail->getId() .'" /></td></tr>';
}

echo '<tr><td colspan="4"><input type="submit" value="Effacer les numéros cochés" /></td></tr>
</table>
</form>';
?>