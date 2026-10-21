<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="../style_comp.css">

<?php 
        include("./config.php");
        include("../layout/header.php");
    ?>

<section>
<form>
    <input type="text" name="kw" value = "<?=(isset($_GET["kw"]) && $_GET["kw"]) ? $_GET["kw"]:"";?>">
    <input type="submit" value="BUSCAR">
</form>
</section>

<section>



<?php 
$url = $_SERVER['REQUEST_URI'];
$componentes = parse_url($url);
$nome_cat = substr($componentes['query'], 2);


$link = mysqli_connect("localhost", "root", "", "sistema");
$kw = trim($_GET["kw"] ?? "");
$sql = "SELECT p.id_prod ,p.nome_prod, p.preco, c.nome_cat
        FROM prod p
        INNER JOIN cat c ON p.id_cat = c.id_cat
        WHERE c.nome_cat = ?";

$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "s", $nome_cat);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


?>
<h1><?= $nome_cat ; ?></h1>

<table border = '1px'>

    <tr>
        <th>
            CARRINHO
        </th>
        <th>
            NOME
        </th>
        <th>
            PREÇO
        </th>

    </tr>


<?php 
while ($row = mysqli_fetch_assoc($result)){
?>
    <tr>
        <td>
            <a href="../comprador/carrinho.php?a=<?=$row["id_prod"];?>">(+)</a>
        </td>
        <td>
            <?=$row["nome_prod"];?>
        </td>
    
        <td>
           <?=$row["preco"];?>
        </td>
    </tr>
<?php 
}

?>
</table>
<button onclick="history.back()">Voltar</button>
</section>

<?php 
include("../layout/footer.php");
?>
