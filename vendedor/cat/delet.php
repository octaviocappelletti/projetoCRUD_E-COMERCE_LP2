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

if (isset ($_GET["del"]) && $_GET["del"] == "yes") {
    $sql = "DELETE FROM cat WHERE id_cat ='".$_GET["id_cat"]."';";
    $result = mysqli_query($link, $sql);
    header("Location: /projetocrud/vendedor/cat");
    exit;
}

include("../../layout/header.php");
include("../menu.php");
?>
<section>
<br><br>DELETAR CATEGORIAS

Tem certeza que quer apagar a categora"<?=$row["nome_cat"];?>"?

<a href="/projetocrud/vendedor/cat/">
<input type="button" value="NÃO"></a>

<a href="/projetocrud/vendedor/cat/delet.php?id_cat=<?=$row["id_cat"];?>&del=yes">
<input type="submit" value="SIM"></a>
</section>
<?php
include("../../layout/footer.php");
?>