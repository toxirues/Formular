<?php
declare(strict_types=1);
mb_internal_encoding("UTF-8");

$hlaska = '';
$uspech = false;
    if($_POST) // V tomhle poli _POST něco je, odeslal se formulář
    {
        // Podmínky
        if(isset($_POST['jméno']) && $_POST['jméno'] &&
            isset($_POST['email']) && $_POST['email'] &&
            isset($_POST['zprava']) && $_POST['zprava'] &&
            isset($_POST['rok']) && $_POST['rok'] )
        {
            // Sem přijde odeslání emailu
            $hlavicka = 'From:' . $_POST['email'];
            $hlavicka .= "\nMIME-Version: 1.0\n";
            $hlavicka .= "Content-Type: text/html; charset=\"utf-8\"\n";
            $adresa =  'nas@email.cz';
            $predmet = 'Nová zpráva z mailformu';
            $uspech = mb_send_mail($adresa, $predmet, $_POST['zprava'], $hlavicka);
        }
        else
            $hlaska = 'Formulář není správně vyplněný!';

        $hlaska = $uspech ? 'Email byl odeslán, již brzy Vám odpovíme!' : 'Email se nezdrařilo odeslat. Zkontrolujte si Vaši adresu.';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Formulář</title>
</head>
<body>
<p>Můžete mě kontaktovat pomocí formuláře níže.</p>

<form method="POST">
    <table>
        <tr>
            <td>Vaše jméno</td>
            <td><input name="jmeno" type="text" /></td>
        </tr>
        <tr>
            <td>Váš email</td>
            <td><input name="email" type="email" /></td>
        </tr>
        <tr>
            <td>Aktuální rok</td>
            <td><input name="rok" type="number" /></td>
        </tr>
    </table>
    <textarea name="zprava"></textarea><br />

    <input type="submit" value="Odeslat" />

    <?= '<p>' . $hlaska . '</p>' ?> <!-- < ?php echo($var); ?> is same shit as < ?= $var ?> -->
</form>

</body>
</html>