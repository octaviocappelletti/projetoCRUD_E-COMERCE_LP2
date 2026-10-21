<?php
include("../config.php");
include("../session.php");
validaSessao();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    if (!$nome_categoria) {
        $erro = "Nome Vazio!";
    } else {
        $link = mysqli_connect("localhost", "root", "", "sistema");
        $sql = "INSERT INTO cat(nome_cat) VALUES ('$nome_categoria')";
        $result = mysqli_query($link, $sql);
        header("location:/projetocrud/vendedor/cat/");
        exit;
    }
}
include("../../layout/header.php");
include("../menu.php");
?>
<br><br>Adicionar CATEGORIA

<?php
if (isset($erro)){
echo "<span style=\"color:red, frint-style: italic;\">";
echo $erro;
}
?>

<form action="" method="post">

    <table>
        <tr>
            <td>Nome:</td>
            <td><input type="text" name="nome_categoria" value="<?=isset($nome_categoria)?$nome_categoria:""; ?>" ></td>
            <td><input type="submit" value="Cadastrar"></td>
        </tr>
    </table>

</form>

<?php
include("../../layout/footer.php");
?>