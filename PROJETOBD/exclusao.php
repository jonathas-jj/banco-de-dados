<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

   
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

       
    <meta charset="UTF-8">
    <head>
        <title>EXCLUSÃO</title>
            
    
       <!DOCTYPE html>

        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         <script>
            
              $(document).ready(function() {

                 document.getElementById("div_cod").style.display="none";
                 document.getElementById("div_cod2").style.display="none";
            

                });
             function myfunction(){
                  /*document.getElementById("mySelect")*/
                  if(document.getElementById("tabela").selectedIndex =="2"){
                      document.getElementById("div_cod").style.display="none";
                      document.getElementById("div_cod2").style.display="inline";
                    } 
                  else if(document.getElementById("tabela").selectedIndex == "3"){
                      document.getElementById("div_cod").style.display="inline";
                     document.getElementById("div_cod2").style.display="inline";
                  }else { 
                    document.getElementById("div_cod").style.display="none";
                    document.getElementById("div_cod2").style.display="none";
                    } 
             }   
         </script>
        <style>
        /* Remove the navbar's default rounded borders and increase the bottom margin */ 
        .navbar {
          margin-bottom: 20px;
          border-radius: 0;
          margin-left: 5%;
          margin-right: 5%;
          background-color: blue;
        }
        .form-control{
            width: 300px;
            
            
        }    
        /* Remove the jumbotron's default bottom margin */ 
         .jumbotron {
          margin-bottom: 0;
          margin-top: 2%;
          margin-left: 5%;
          margin-right: 5%;
          background-image: url(imagens/imagemtopo.png);
           background-repeat: no-repeat;
            background-size: 100% 100%;
            min-height:300px; 
        }

        /* Add a gray background color and some padding to the footer */
        footer {
          background-color: #f2f2f2;
          padding: 25px;
        }
        .container-fluid bg-3 text-center{
            margin-left: 5%;
          margin-right: 5%;
          background-color: blue;
        }
        </style>
   </head>
<body >
   <?php
    header("Content-Type: text/html; charset=utf8 ",true);
            
            $sql="";
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname= "PROJETO_BD";       
            // Create connection
            $conn = new mysqli($servername, $username, $password,$dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {echo "CONEXÃO FEITA!</BR>";}
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
               if (isset($_POST["Qual_form"])){
                    if ($_POST["tabela"]=="FILME"){
                        $sql='delete from ATUAEMFILME where cod_filme='.$_POST["codigo"].";";
                        $sql=$sql.'  delete from DIRIGEFILME where cod_filme='.$_POST["codigo"].";";   
                        $sql=$sql.' delete from '.$_POST["tabela"].' where cod_filme='.$_POST["codigo"].";";                   
                            
                    }
                    elseif ($_POST["tabela"]=="SERIADO") {
                        $sql=$sql.'delete from EPISODIO where cod_seriado='.$_POST["codigo"].";";
                        $sql=$sql.'delete from TEMPORADA where cod_seriado='.$_POST["codigo"].";";
                        $sql=$sql.'delete from ATUAEMSERIADO where cod_seriado='.$_POST["codigo"].";";
                        $sql=$sql.'  delete from DIRIGESERIADO where cod_seriado='.$_POST["codigo"].";";   
                        $sql=$sql.' delete from '.$_POST["tabela"].' where cod_seriado='.$_POST["codigo"].";";
                    }
                   elseif ($_POST["tabela"]=="TEMPORADA") {
                        $sql='delete from EPISODIO where cod_seriado='.$_POST["codigo3"].' AND num_temporada='.$_POST["codigo"].";";      
                        $sql=$sql.'delete from TEMPORADA where cod_seriado='.$_POST["codigo3"].' AND num_temporada='.$_POST["codigo"].";";     
                    }
                    elseif ($_POST["tabela"]=="EPISODIO") {
                        $sql='delete from EPISODIO where cod_seriado='.$_POST["codigo3"].' AND num_temporada='.$_POST["codigo2"].' AND num_episodio='.$_POST["codigo"].";"; 
                    }
                    elseif ($_POST["tabela"]=="ATOR") {
                        $sql='delete from ATUAEMFILME where cod_profissional='.$_POST["codigo"].";";
                        $sql=$sql.' delete from ATUAEMSERIADO where cod_profissional='.$_POST["codigo"].";";
                        $sql=$sql.' delete from PROFISSIONAL where cod_profissional='.$_POST["codigo"].";";  
                    }
                    elseif ($_POST["tabela"]=="DIRETOR") {
                        $sql='delete from DIRIGEFILME where cod_profissional='.$_POST["codigo"].";";        
                        $sql=$sql.' delete from DIRIGESERIADO where cod_profissional='.$_POST["codigo"].";";  
                        $sql=$sql.' delete from PROFISSIONAL where cod_profissional='.$_POST["codigo"].";";  
                    }
                    
                   echo "teste";  
               }
               $p=strtok($sql, ";");
               while ($p){
                   
                if ($conn->query($p.";") === TRUE) {

                     $messagem='<div id ="mensagem" class="alert alert-success"><strong>Success!</strong> Linha Excluida com sucesso!!.</div>';
                }else{
                    $messagem='<div id ="mensagem" class="alert alert-danger">  <strong>Danger!</strong>  Error: ' . $sql .' '. $conn->error.'</div>';
                }
                $p=strtok(";");
               }
               $conn->close();
            }
        ?>
<div class="jumbotron">
  <div class="container text-center">
   
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
        <a class="navbar-brand" href="index.php">Inicio</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
         <li><a href="insercao.php">Inserção</a></li>
        <li><a href="atualizacao.php">Atualização</a></li>
        <li><a href="consulta.php">Consulta</a></li>
        <li><a href="exclusao.php">Exclusão</a></li>
      </ul>

    </div>
  </div>
</nav>


    

<div class="">  
 <div data-spy="scroll" data-target=".navbar" data-offset="50" >
     <div class="div1" style=" margin-left: 10%"> 
        <div class="page-header" style=" width: 70%; margin-bottom: 20px;">
           <h1>Exclusão</h1>
           <h3>Escolha uma tabela e insira o código do elemento pra excluir</h3>


        </div> 
     </div>
 <div class="">
   
 
     <div id="Exclusao" class="container- container" style=" width: 70%">
         
       <?php if ((isset($_POST['Qual_form'])) && ($_POST['Qual_form']==1)){ echo $messagem;} ?>
        <div class="panel panel-primary"  >
            <div class="panel-heading"  style="margin: 0px; padding: 0px"> <h3 style="margin: 0px; padding: 5px">Excluir</h3>
            </div>
            <div class="panel-body" >
               <div class="container">
                    
                   <form action="exclusao.php" method="post">
                        <input type="hidden" name="Qual_form" value="1">
                        <div class="form-group">
                          <label for="text">Tabela:</label>
                          <select name="tabela" id="tabela" onchange="myfunction();">
                               <option>FILME</option>
                               <option>SERIADO</option>
                               <option>TEMPORADA</option>
                               <option>EPISODIO</option>
                               <option>ATOR</option>
                               <option>DIRETOR</option>  
                          </select>
                        </div>
                        <div class="form-group">
                             <label for="number">Código:</label>
                             <input type="number" class="form-control" min="1" id="codigo" placeholder="digite o código" maxlength="40" name="codigo">
                        </div>
                        <div class="form-group"id="div_cod">
                             <label for="number">Código temporada:</label>
                             <input type="number" class="form-control" min="1" id="codigo2" placeholder="digite o código" maxlength="40" name="codigo2">
                        </div>
                        <div class="form-group" id="div_cod2">
                             <label for="number">Código Série:</label>
                             <input type="number" class="form-control" min="1" id="codigo3" placeholder="digite o código" maxlength="40" name="codigo3">
                        </div>
                        
                        <br><br><br>
                        
                           <button type="submit" class="btn btn-default">Executar</button>
                    </form>
                  </div>
                
            </div>
        </div>
    </div> 
    
    </div>

  </div>
</div>    
<footer class="container-fluid text-center">
  <p>UERJ - CIÊNCIA DA COMPUTAÇÃO 2018.2</p>  
  
</footer>


     
</body>
</html>
