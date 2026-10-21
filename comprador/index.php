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
$link = mysqli_connect("localhost", "root", "", "sistema");
$kw = trim($_GET["kw"] ?? "");
$sql = "SELECT p.id_prod, p.nome_prod, p.preco, c.nome_cat
        FROM prod p
        INNER JOIN cat c ON p.id_cat = c.id_cat ";

if ($kw !== ""){
    $sql .= " WHERE p.nome_prod LIKE ? OR c.nome_cat LIKE ?";
}
$sql .= " ORDER BY p.nome_prod";

$stmt = mysqli_prepare($link, $sql);
if ($kw !== "") {
    $busca = "%" . $kw . "%";
    mysqli_stmt_bind_param($stmt, "ss", $busca, $busca);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>


<a href='./carrinho.php'>Carrinho</a>

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
        <th>
            CATEGORIAS
        </th>
        

    </tr>


<?php 
while ($row = mysqli_fetch_assoc($result)){
?>
    <tr>
        <td>
            <a href="./carrinho.php?a=<?=$row["id_prod"];?>">(+)</a>
        </td>
        <td>
            <?=$row["nome_prod"];?>
        </td>
    
        <td>
           <?=$row["preco"];?>
        </td>
        <td>
            <a href="./categorias.php?a=<?=$row["nome_cat"];?>"><?=$row["nome_cat"];?></a>
           
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
