<?php 
include("../config.php");
include("../session.php");
validaSessao(); 
include("../../layout/header.php");
 
include("../menu.php");
?>


<br><br>Categoria<br><br>

<a href="/projetocrud/vendedor/cat/add.php"><input type="button" value="+ Adicionar"></a><br><br>
<section>
<?php 
$link = mysqli_connect("localhost", "root", "", "sistema");
$sql = "SELECT * FROM cat ORDER BY nome_cat";
$result = mysqli_query($link, $sql);
echo"<br><br>";
echo "<table border = '1px'>";

    echo "<tr>";
        echo "<th>";
            echo "CATEGORIAS";
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
            <?=$row["nome_cat"];?>
        </td>
    
        <td>
           <a href="/projetocrud/vendedor/cat/edit.php?id_cat=<?=$row["id_cat"];?>">Editar</a>
           
        </td>
        <td>
           <a href="/projetocrud/vendedor/cat/delet.php?id_cat=<?=$row["id_cat"];?>">Apagar</a>
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
