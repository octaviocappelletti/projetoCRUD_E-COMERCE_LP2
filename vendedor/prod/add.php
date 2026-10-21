<?php
include("../config.php");
include("../session.php");
validaSessao();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    if (!$nome_prod) {
        $erro = "Nome Vazio!";
    } elseif (!$preco) {
        $erro = "Nome Vazio!";
    } else {
        $link = mysqli_connect("localhost", "root", "", "sistema");
        $sql = "INSERT INTO prod(nome_prod, preco, id_cat) VALUES ('" . $nome_prod . "','" . $preco . "','" . $id_cat . "')";
        $result = mysqli_query($link, $sql);
        header("location:/projetocrud/vendedor/prod/");
        exit;
    }
}
include("../../layout/header.php");
include("../menu.php");
?>
<br><br>Adicionar PRODUTOS

<?php
if (isset($erro)){
echo "<span style=\"color:red, frint-style: italic;\">";
echo $erro;
}
?>

<?php 
$link_cat = mysqli_connect("localhost", "root", "", "sistema");
$sql_cat = "SELECT id_cat, nome_cat FROM cat";
$result_cat = mysqli_query($link_cat, $sql_cat);
?>

<form action="" method="post">

    <table>
        <tr>
            <td>Nome:</td>
            <td><input type="text" name="nome_prod" value="<?=isset($nome_prod)?$nome_prod:""; ?>" ></td>
            <td>Preço:</td>
            <td><input type="text" name="preco" value="<?=isset($preco)?$preco:""; ?>"></td>
            <td><label for="categoria" name="id_cat"<?=isset($id_cat)?$id_cat:""; ?>></label>
                <select name="id_cat" id="id_cat">
                    <?php 
                    while ($row = mysqli_fetch_assoc($result_cat)){
                    ?>
                    <option value="<?=$row["id_cat"];?>">
                        <?=$row["nome_cat"];?>
                    </option>
                    <?php 
                    }
                    ?>
                </select>
            </td>
            
            <td><br><br><input type="submit" value="Cadastrar"></td>
        </tr>
    </table>

</form>

<?php
include("../../layout/footer.php");
?>