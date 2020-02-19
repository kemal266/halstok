<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hal Stok - Giriş</title>
</head>
<body>
<h3>Giriş</h3>
    <form id="login-form" method="post" action="validate.php" >
        <table>
            <tr>
                <td><label for="users_username">kullanici adi</label></td>
                <td><input type="text" name="users_username" id="users_username"></td>
            </tr>
            <tr>
                <td><label for="users_pass">sifre</label></td>
                <td><input type="users_pass" name="users_pass" id="users_pass"></input></td>
            </tr>
            <tr>
                <td><input type="submit" value="giris yap" />
            </tr>
        </table>
    </form>
</body>
</html>