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
        $erro = "Preço Vazio!";
    } elseif (!$id_cat) {
        $erro = "Categoria Vazia!";
    } else {
        $link = mysqli_connect("localhost", "root", "", "sistema");
        $sql = "UPDATE `prod` SET `nome_prod`='".$nome_prod."',`preco`='".$preco."',`id_cat`='".$id_cat."' WHERE  id_prod ='".$id_prod."'";
        $result = mysqli_query($link, $sql);
        header("location:/projetocrud/vendedor/prod/");
        exit;
    }
}
include("../../layout/header.php");
include("../menu.php");
?>

<?php 
$link_cat = mysqli_connect("localhost", "root", "", "sistema");
$sql_cat = "SELECT id_cat, nome_cat FROM cat";
$result_cat = mysqli_query($link_cat, $sql_cat);
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
            
            <td><label for="categoria" name="id_cat"<?=isset($id_cat)?$id_cat:""; ?>></label>
                <select name="id_cat" id="id_cat">
                    <option value="">Selecione uma categoria...</option>
                    <?php 
                    while ($row = mysqli_fetch_assoc($result_cat)){
                    ?>
                    <option value="<?=$row["id_cat"];?>">
                        
                        <?= $row["nome_cat"];?>
                    </option>
                    <?php 
                    }
                    ?>
                </select>
            </td>
            <td><input type="submit" value="Editar"></td>
            
        </tr>
    </table>
    
</form>

<?php
include("../../layout/footer.php");
?>
