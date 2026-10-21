<?php 
include("../config.php");
include("../session.php");
validaSessao(); 
include("../../layout/header.php");
 
include("../menu.php");
?>


<br><br>PRODUTOS<br><br>

<a href="/projetocrud/vendedor/prod/add.php"><input type="button" value="+ Adicionar"></a><br><br>
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

echo"<br><br>";
echo "<table border = '1px'>";

    echo "<tr>";
        echo "<th>";
            echo "NOME";
        echo "</th>";
        echo "<th>";
            echo "PREÇO";
        echo "</th>";
        echo "<th>";
            echo "CATEGORIA";
        echo "</th>";
        echo "<th>";
            echo "EDITAR";
        echo "</th>";
        echo "<th>";
            echo "APAGAR";
        echo "</th>";

    echo "</tr>";

while ($row = mysqli_fetch_assoc($result)){
?>
    <tr>
        <td>
            <?=$row["nome_prod"];?>
        </td>
    
        <td>
           <?=$row["preco"];?>
        </td>
        <td>
           <?=$row["nome_cat"]; ?>
        </td>
        <td>
           <a href="/projetocrud/vendedor/prod/edit.php?id_prod=<?=$row["id_prod"];?>">Editar</a>
           
        </td>
        <td>
           <a href="/projetocrud/vendedor/prod/delet.php?id_prod=<?=$row["id_prod"];?>">Apagar</a>
        </td>
    </tr>
<?php 
}

?>
</table>
</section>

<?php 
include("../../layout/footer.php");
?>
