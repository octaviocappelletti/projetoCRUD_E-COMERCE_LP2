
<?php
include("../config.php");
include("../session.php");
validaSessao();

if (!isset ($_GET["id_cat"]) || !$_GET["id_cat"]) {
    header("Location: /projetocrud/vendedor/cat/");
    exit;
}

$link = mysqli_connect("localhost", "root", "", "sistema");
$sql = "SELECT * FROM cat WHERE id_cat ='".$_GET["id_cat"]."';";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result) == 0) {
    header("Location: /projetocrud/vendedor/cat/");
    exit;
}
extract($row);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    if (!$nome_cat) {
        $erro = "Nome Vazio!";
    } else {
        $link = mysqli_connect("localhost", "root", "", "sistema");
        $sql = "UPDATE `cat` SET `nome_cat`='".$nome_cat."' WHERE  id_cat ='".$id_cat."'";
        $result = mysqli_query($link, $sql);
        header("location:/projetocrud/vendedor/cat/");
        exit;
    }
}
include("../../layout/header.php");
include("../menu.php");
?>
<br><br>EDITAR PRODUTOS

<?php
if (isset($erro)){
echo "<span style=\"color:red, frint-style: italic;\">";
echo $erro;
}
?>

<form action="" method="post">
    <input type="hidden" name="id_cat" value="<?=isset($id_cat) ?$id_cat:"";?>">

    
    <table>
        <tr>
            <td>Nome:</td>
            <td><input type="text" name="nome_cat" value="<?=isset($nome_cat)?$nome_cat:""; ?>" ></td>
            <td><input type="submit" value="Editar"></td>
        </tr>
    </table>
    
</form>

<?php
include("../../layout/footer.php");
?>