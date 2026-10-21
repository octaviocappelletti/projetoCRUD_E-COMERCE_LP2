
<?php
include("../config.php");
include("../session.php");
validaSessao();

if (!isset ($_GET["id_prod"]) || !$_GET["id_prod"]) {
    header("Location: /projetocrud/vendedor/prod/");
    exit;
}

$link = mysqli_connect("localhost", "root", "", "sistema");
$sql = "SELECT * FROM prod WHERE id_prod ='".$_GET["id_prod"]."';";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result) == 0) {
    header("Location: /projetocrud/vendedor/prod/");
    exit;
}
extract($row);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    if (!$nome_prod) {
        $erro = "nome Vazio!";
    } elseif (!$preco) {
        $erro = "Nome Vazio!";
    } else {
        $link = mysqli_connect("localhost", "root", "", "sistema");
        $sql = "UPDATE `prod` SET `nome_prod`='".$nome_prod."',`preco`='".$preco."' WHERE  id_prod ='".$id_prod."'";
        $result = mysqli_query($link, $sql);
        header("location:/projetocrud/vendedor/prod/");
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
    <input type="hidden" name="id_prod" value="<?=isset($id_prod) ?$id_prod:"";?>">

    
    <table>
        <tr>
            <td>Nome:</td>
            <td><input type="text" name="nome_prod" value="<?=isset($nome_prod)?$nome_prod:""; ?>" ></td>
            <td>Preço:</td>
            <td><input type="text" name="preco" value="<?=isset($preco)?$preco:""; ?>"></td>
            <td><input type="submit" value="Editar"></td>
        </tr>
    </table>
    
</form>

<?php
include("../../layout/footer.php");
?>