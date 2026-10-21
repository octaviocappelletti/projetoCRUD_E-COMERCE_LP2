<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="../style_comp.css">

<?php 
    include("./config.php");
  





if (isset($_GET["a"])) { 
 if (isset($_COOKIE["carrinho"])) { 
  if (strpos($_COOKIE["carrinho"], "'".$_GET["a"]."'") === false) { 
   setcookie("carrinho", $_COOKIE["carrinho"].",'".$_GET["a"]."'", 
    time()+60*60*24*30); 
  } 
 } else { 
  setcookie("carrinho", "'".$_GET["a"]."'", time()+60*60*24*30); 
 } 
 header("Location: ./carrinho.php"); 
 exit; 
} elseif (isset($_GET["r"])) { 
 if (isset($_COOKIE["carrinho"])) { 
  if (strpos($_COOKIE["carrinho"], "'".$_GET["r"]."'") !== false) { 
   $carrinho = $_COOKIE["carrinho"]; 
   $carrinho = str_replace(",'".$_GET["r"]."'," , ",", $carrinho); 
   $carrinho = str_replace("'".$_GET["r"]."'," , "", $carrinho); 
   $carrinho = str_replace(",'".$_GET["r"]."'" , "", $carrinho); 
   $carrinho = str_replace("'".$_GET["r"]."'" , "", $carrinho); 
   setcookie("carrinho", $carrinho, time()+60*60*24*30); 
  } 
 } 
 header("Location: ./carrinho.php"); 
 exit; 
} 
    include("../layout/header.php");


?> 
 <section>

  <a href="./index.php">Voltar</a><br><br> 
 
  <?php 
  if (isset($_COOKIE["carrinho"])) { 
   $link = mysqli_connect("localhost", "root", "", "sistema"); 
   $sql = "SELECT * FROM prod WHERE 
    id_prod IN (".$_COOKIE["carrinho"].") ORDER BY nome_prod"; 
   $result = mysqli_query($link, $sql); 
?>

   <table border = '1px'>

    <tr>
        
        <th>
            NOME
        </th>
        <th>
            PREÇO
        </th>
        <th>
            Remover
        </th>
        

    </tr>


<?php 
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
            <a href="./carrinho.php?r=<?=$row["id_prod"];?>">(-)</a>
        </td>
    </tr>
<?php 
}
?>

</table>
<button onclick="history.back()">Voltar</button>
</section>
<?php 
  }else { 
   echo "Sem carrinho!<br>"; 
}
?>


<?php 
include("../layout/footer.php");
?>

