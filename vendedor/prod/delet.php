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

if (isset ($_GET["del"]) && $_GET["del"] == "yes") {
    $sql = "DELETE FROM prod WHERE id_prod ='".$_GET["id_prod"]."';";
    $result = mysqli_query($link, $sql);
    header("Location: /projetocrud/vendedor/prod");
    exit;
}

include("../../layout/header.php");
include("../menu.php");
?>
<section>
<br><br>DELETAR PRODUTOS

Tem certeza que quer apagar o produto"<?=$row["nome_prod"];?>"?

<a href="/projetocrud/vendedor/prod/">
<input type="button" value="NÃO"></a>

<a href="/projetocrud/vendedor/prod/delet.php?id_prod=<?=$row["id_prod"];?>&del=yes">
<input type="submit" value="SIM"></a>
</section>
<?php
include("../../layout/footer.php");
?>