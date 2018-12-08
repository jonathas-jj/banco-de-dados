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
        <title>INCLUSÃO</title>
            
    
       <!DOCTYPE html>

        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         <script> 
            
                function myfunction(){
                    if(document.getElementById("diretor_ator").checked==true){
                        document.getElementById("filme_diretor").disabled=false;  
                        document.getElementById("seriado_diretor").disabled=false;   

                    }else{ document.getElementById("filme_diretor").disabled=true; 
                           document.getElementById("seriado_diretor").disabled=true;
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
<body>
   <?php
    header("Content-Type: text/html; charset=utf8 ",true);
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
                $Qual_form =$_POST["Qual_form"];
                
                if($Qual_form==1) {
                   
                   $sql = 'INSERT INTO FILME (TITULO,DESCRICAO,NACIONALIDADE,DURACAO,ANO) VALUES 
                    ("'.$_POST["titulo_filme"].'","'.$_POST["descricao_filme"].'","'.$_POST["nacionalidade_filme"].'",'.$_POST["duracao_filme"].','.$_POST["ano_filme"].');' ;
                    echo'<script> $(document).ready(function() { window.location.hash = "#mensagem";}); </script>';
                   }
                   
                elseif($Qual_form==2) {
                   echo'ALTER TABLE SERIADO AUTO_INCREMENT = (SELECT MAX(COD_SERIADO) FROM SERIADO) + 1;<script> $(document).ready(function() { window.location.hash = "#mensagem";}); </script>';
                    $sql = 'INSERT INTO SERIADO (TITULO,DESCRICAO,NACIONALIDADE,ANO) VALUES 
                    ("'.$_POST["titulo_seriado"].'","'.$_POST["descricao_seriado"].'","'.$_POST["nacionalidade_seriado"].'",'.$_POST["ano_seriado"].');' ;
                }
                
                elseif($Qual_form==3) {
                     echo '<script> $(document).ready(function() { window.location.hash = "#mensagem";}); </script>'; 
                    
                     $sql = 'INSERT INTO TEMPORADA(NUM_TEMPORADA, COD_SERIADO)  VALUES ( '.$_POST["num_temporada"].' , '.strtok($_POST["seriado_temporada"], " ").' ) ;';
                }
                
                elseif($Qual_form==4) {
                    echo'<script> $(document).ready(function() { window.location.hash = "#mensagem";}); </script>';
                    $sql = 'INSERT INTO EPISODIO(NUM_EPISODIO, TITULO, DESCRICAO, DURACAO, NUM_TEMPORADA, COD_SERIADO) VALUES ('.$_POST["num_episodio"].',"'.$_POST["titulo_episodio"].'","'.$_POST["descricao_episodio"].'", '.$_POST["duracao_episodio"].' ,'.$_POST["temporada_episodio"].','.strtok($_POST["seriado_episodio"]," ").');';
                    
                }
              
                elseif($Qual_form==5) {
                                   
                    echo'<script> $(document).ready(function() { window.location.hash = "#mensagem";}); </script>';
                    $sql = "INSERT INTO `PROFISSIONAL`( `NOME`, `IDADE`, `SEXO`, `NACIONALIDADE`, `FLAG_ATOR`, `FLAG_DIRETOR`) "
                            . "VALUES ('".$_POST["Nome_ator"]."',".$_POST["idade_ator"].",'".$_POST["radiosexo"]."','".$_POST["nacionalidade_ator"]."', true, false ); ";
                     foreach ($_POST["filme_ator"] as $selectedOption) {
                        $sql2 =$sql2." insert into ATUAEMFILME select max(cod_profissional),".strtok($selectedOption, " ")." from PROFISSIONAL;";
                        }
                     foreach ($_POST["seriado_ator"] as $selectedOption) {
                        $sql2 =$sql2." insert into ATUAEMSERIADO select max(cod_profissional),".strtok($selectedOption, " ")." from PROFISSIONAL;";
                        }
                    
                }
                
                elseif($Qual_form==6) {
                    echo'<script> $(document).ready(function() { window.location.hash = "#mensagem";}); </script>';
                    $marcado=0;
                    if(isset($_POST['diretor_ator'])){ $marcado=true;}
                       $sql = "INSERT INTO `PROFISSIONAL`( `NOME`, `IDADE`, `SEXO`, `NACIONALIDADE`, `FLAG_ATOR`, `FLAG_DIRETOR`) "
                         . "VALUES ('".$_POST["Nome_diretor"]."',".$_POST["idade_diretor"].",'".$_POST["radiosexo2"]."','".$_POST["nacionalidade_diretor"]."', ".$marcado.", true ); ";
                     if($marcado) {
                         echo "//".$sql2;
                        foreach ($_POST["filme_diretor"] as $selectedOption) {
                            
                             $sql2 =$sql2." insert into ATUAEMFILME select max(cod_profissional),".strtok($selectedOption, " ")." from PROFISSIONAL ;";
                        }
                        
                        foreach ($_POST["seriado_diretor"] as $selectedOption) {
                            $sql2 =$sql2." insert into ATUAEMSERIADO select max(cod_profissional),".strtok($selectedOption, " ")." from PROFISSIONAL;";
                        }     
                        
                     } 
                    foreach ($_POST["filme_diretor2"] as $selectedOption) {
                         $sql2 =$sql2." insert into DIRIGEFILME select max(cod_profissional),".strtok($selectedOption, " ")." from PROFISSIONAL;";
                    }
                   foreach ($_POST["seriado_diretor2"] as $selectedOption) {
                            $sql2 =$sql2." insert into DIRIGESERIADO select max(cod_profissional),".strtok($selectedOption, " ")." from PROFISSIONAL;";
                        }  
                }
                
                if ($conn->query($sql) === TRUE) {
                   
                    $messagem='<div id ="mensagem" class="alert alert-success"><strong>Success!</strong> Tabela inserida com sucesso!!.</div>';
                   if(($Qual_form==5) || ($Qual_form==6)){
                       echo "akiakaiakia";
                       $p = strtok($sql2, ";");
                       while (($p !== false) ){
                           echo $p."/<br>";                         
                            if ($conn->query($p.";") === TRUE) {
                                $p=strtok(";");
                                 $messagem='<div id ="mensagem" class="alert alert-success"><strong>Dados inseridos!</strong> Tabela inserida com sucesso!!.</div>';
                            }else{
                                  $messagem='<div id ="mensagem" class="alert alert-danger">  <strong>Danger!</strong>  Error: ' . $p .' '. $conn->error.'</div>';
                                  break;
                            }
                            
                        }
                   }
                    
                } else {
                    $messagem='<div id ="mensagem" class="alert alert-danger">  <strong>Danger!</strong>  Error: ' . $sql .' '. $conn->error.'</div>';
                    
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
     <div class="container text-center"> 
        <div class="page-header" style=" width: 70%; margin-bottom: 20px;">
           <h1>Escolha uma tabela para inserir</h1>


        </div> 
     </div>
 <div class="">
   
 
     <div id="Filme" class="container- container" style=" width: 70%">
         
       <?php if ((isset($_POST['Qual_form'])) && ($_POST['Qual_form']==1)){ echo $messagem;} ?>
        <div class="panel panel-primary"  >
            <div class="panel-heading"  style="margin: 0px; padding: 0px"> <h3 style="margin: 0px; padding: 5px">Filme</h3></div>
            <div class="panel-body" >
               <div class="container">
                    
                   <form action="insercao.php" method="post">
                      <input type="hidden" name="Qual_form" value="1">
                      <div class="form-group">
                        <label for="text">Título:</label>
                        <input type="text" class="form-control" id="titulo_filme" placeholder="digite o titulo" maxlength="40" name="titulo_filme">
                      </div>
                      <div class="form-group">
                         <label for="text">Descrição:</label><br>
                        <textarea class="form-control" placeholder="Descreva o filme" id="descricao_filme" name="descricao_filme" ></textarea>
                      </div>
                       <div class="form-group">
                        <label for="text">Nacionalidade:</label>
                        <input type="text" class="form-control" id="nacionalidade_filme" placeholder="digite a nacionalidade" maxlength="40" name="nacionalidade_filme">
                      </div>
                      <div class="form-group">
                        <label for="text">Duração:</label>
                        <input type="number" class="form-control" min="30" id="duracao_filme" placeholder="digite o duração" maxlength="40" name="duracao_filme">
                      </div>
                      <div class="form-group">
                        <label for="text">Ano:</label>
                        <input type="number" class="form-control" min="1900" max="2090" id="ano_filme" placeholder="digite o ano" maxlength="40" name="ano_filme">
                      </div>
                      <button type="submit" class="btn btn-default">Enviar</button>
                    </form>
                  </div>
                
            </div>
        </div>
    </div> 
    <div id="Seriado" class="container-fluid"style=" width: 70%">
       <?php if ((isset($_POST['Qual_form'])) && ($_POST['Qual_form']==2)){ echo $messagem;} ?>
        <div class="panel panel-primary"  >
            <div class="panel-heading"  style="margin: 0px; padding: 0px"> <h3 style="margin: 0px; padding: 5px">Seriado</h3></div>
            <div class="panel-body">
                  <div class="container">
                    
                        <form action="insercao.php"method="post">
                            <input type="hidden" name="Qual_form" value="2">
                           <div class="form-group">
                             <label for="text">Título:</label>
                             <input type="text" class="form-control" id="titulo_seriado" placeholder="digite o titulo" maxlength="40" name="titulo_seriado">
                           </div>
                           <div class="form-group">
                             <label for="text">Descrição:</label><br>
                             <textarea class="form-control" placeholder="Descreva o seriado" id="descricao_seriado" name="descricao_seriado" ></textarea>
                           </div>
                            <div class="form-group">
                             <label for="text">Nacionalidade:</label>
                             <input type="text" class="form-control" id="nacionalidade_seriado" placeholder="digite a nacionalidade" maxlength="40" name="nacionalidade_seriado">
                           </div>
                            <div class="form-group">
                             <label for="text">Ano:</label>
                             <input type="number" class="form-control" min="1900" max="2090" id="ano" placeholder="digite o ano" maxlength="40" name="ano_seriado">
                           </div>
                           <button type="submit" class="btn btn-default">Enviar</button>
                         </form>
                  </div>
            
            </div>
        </div>
    </div>
    <div id="Temporada" class="container-fluid"style=" width: 70%">
       <?php if ((isset($_POST['Qual_form'])) && ($_POST['Qual_form']==3)){ echo $messagem;} ?>
        <div class="panel panel-primary"  >
            <div class="panel-heading"  style="margin: 0px; padding: 0px"> <h3 style="margin: 0px; padding: 5px">Temporada</h3></div>
            <div class="panel-body">
                <div class="container">
                    
                   <form action="insercao.php"method="post">
                       <input type="hidden" name="Qual_form" value="3">
                        <div class="form-group">
                            <label for="sel1">Selecione um seriado:</label>
                                <select class="form-control" id="seriado_temporada" name="seriado_temporada">
                                    <?php
                                    $s="";
                                        $conn = new mysqli($servername, $username, $password,$dbname);
                                        $sql = "SELECT COD_SERIADO,titulo FROM SERIADO;";
                                        $result = $conn->query($sql); 
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $s =$s."<option>" . $row["COD_SERIADO"] . " - " . $row["titulo"] . "</option> \n";
                                            
                                        }
                                        echo $s;
                                    } else {
                                        echo "<option>Nenhum seriado cadastrado</option>";
                                    }

                                          
                                    $conn->close();
                                    ?>
                                  
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="text">Número da temporada:</label>
                            <input type="number" class="form-control" min="0" id="num_temporada" placeholder="digite o numero da temporada" maxlength="40" name="num_temporada">
                        </div>
                       <button type="submit" class="btn btn-default">Enviar</button>
                   </form>
                </div>    
                
            </div>
        </div>
    </div> 
    <div id="Episodio" class="container-fluid"style=" width: 70%">
       <?php if ((isset($_POST['Qual_form'])) && ($_POST['Qual_form']==4)){ echo $messagem;} ?>
        <div class="panel panel-primary"  >
            <div class="panel-heading"  style="margin: 0px; padding: 0px"> <h3 style="margin: 0px; padding: 5px">Episodio</h3></div>
            <div class="panel-body">
                
                 <div class="container">
                    
                        <form action="insercao.php"method="post">
                            <input type="hidden" name="Qual_form" value="4">
                            <div class="form-group">
                             <label for="text">Numero do episódio:</label>
                             <input type="number" class="form-control" min="0" id="num_episodio" placeholder="digite a duração do episodio" maxlength="40" name="num_episodio">
                           </div>
                           <div class="form-group">
                             <label for="text">Título:</label>
                             <input type="text" class="form-control" id="titulo_episodio" placeholder="digite o titulo" maxlength="40" name="titulo_episodio">
                           </div>
                           
                            <div class="form-group">
                             <label for="text">Descrição:</label>
                             <textarea class="form-control" placeholder="Descreva o episódio" id="descricao_episodio" name="descricao_episodio" ></textarea>
                           </div>
                           <div class="form-group">
                             <label for="text">Duração:</label>
                             <input type="number" class="form-control" min="10" id="duracao_episodio" placeholder="digite a duração do episodio" maxlength="40" name="duracao_episodio">
                           </div>
                            <div class="form-group">
                                <label for="sel1">Selecione um seriado:</label>
                                <select class="form-control" id="seriado_episodio" name="seriado_episodio">
                                    <?php
                                                                                
                                        echo $s;
                                           
                                    ?>
                                  
                                </select>
                            </div>
                            <div class="form-group">
                             <label for="text">Temporada:</label>
                             <input type="number" class="form-control" min="1" id="temporada_episodio" placeholder="digite a duração do episodio" maxlength="40" name="temporada_episodio">
                           </div>
                           <button type="submit" class="btn btn-default">Enviar</button>
                         </form>
                 </div>
            </div>
        </div>
    </div>
    <div id="Ator" class="container-fluid"style=" width: 70%">
       <?php if ((isset($_POST['Qual_form'])) && ($_POST['Qual_form']==5)){ echo $messagem;} ?>
        <div class="panel panel-primary"  >
            <div class="panel-heading"  style="margin: 0px; padding: 0px"> <h3 style="margin: 0px; padding: 5px">Ator</h3></div>
            <div class="panel-body">
                <div class="container">
                    
                        <form action="insercao.php"method="post">
                           <input type="hidden" name="Qual_form" value="5"> 
                           <div class="form-group">
                             <label for="text">Nome:</label>
                             <input type="text" class="form-control" id="Nome_ator" placeholder="digite o nome" maxlength="40" name="Nome_ator">
                           </div>
                            <div class="form-group">
                                 <label for="radio">Sexo:</label> 
                                <div class="radio">
                                
                                 <label><input type="radio" name="radiosexo" value="M">Masculino</label>
                                 </div>
                                 <div class="radio">
                                  <label> <input type="radio" name="radiosexo" value="F">Feminino</label>
                                 </div>
                                 <div class="radio disabled">
                                   <label><input type="radio" name="radiosexo" value="O">Outros</label>
                                 </div> 
                            </div>    
                           <div class="form-group">
                             <label for="text">Ano de nascimento:</label>
                             <input type="number" class="form-control" min="30" id="idade_ator" placeholder="digite o Ano de nascimento" maxlength="40" name="idade_ator">
                           </div>
                            <div class="form-group">
                             <label for="text">Nacionalidade:</label>
                             <input type="text" class="form-control" id="nacionalidade_ator" placeholder="digite a nacionalidade" maxlength="40" name="nacionalidade_ator">
                           </div>
                            <div class="form-group">
                                 <label for="sel2">Filme em que atua (segure o shift para selecionar mais de 1):</label>
                                  <select multiple class="form-control" id="sel2" id="filme_ator" name="filme_ator[]">
                                    <?php 
                                        $sel_ator="";
                                        $conn = new mysqli($servername, $username, $password,$dbname);
                                        $sql = "SELECT COD_filme,titulo FROM FILME;";
                                        $result = $conn->query($sql); 
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                $sel_ator =$sel_ator."<option>" . $row["COD_filme"] . " - " . $row["titulo"] . "</option> \n";

                                            }
                                            echo $sel_ator;
                                        } else {
                                            echo "<option>Nenhum seriado cadastrado</option>";
                                        }
                                        $conn->close();
                                    ?>
                                 </select>
                             </div>
                            <div class="form-group">
                                 <label for="sel3">Seriado em que atua (segure o shift para selecionar mais de 1):</label>
                                  <select multiple class="form-control" id="sel2" id="seriado_ator" name="seriado_ator[]">
                                    <?php 
                                        $sel_seriado="";
                                        $conn = new mysqli($servername, $username, $password,$dbname);
                                        $sql = "SELECT COD_SERIADO,titulo FROM SERIADO;";
                                        $result = $conn->query($sql); 
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                $sel_seriado= $sel_seriado."<option>" . $row["COD_SERIADO"] . " - " . $row["titulo"] . "</option> \n";

                                            }
                                            echo $sel_seriado;
                                        } else {
                                            echo "<option>Nenhum seriado cadastrado</option>";
                                        }
                                        $conn->close();
                                    ?>
                                 </select>
                             </div>
                           <button type="submit" class="btn btn-default">Enviar</button>
                         </form>
                 </div>
            </div>
        </div>
    </div>
    <div id="Diretor" class="container-fluid"style=" width: 70%">
       <?php if ((isset($_POST['Qual_form'])) && ($_POST['Qual_form']==6)){ echo $messagem;} ?>
        <div class="panel panel-primary"  >
            <div class="panel-heading"  style="margin: 0px; padding: 0px"> <h3 style="margin: 0px; padding: 5px">Diretor</h3></div>
            <div class="panel-body">
                
                <div class="container">
                    
                        <form action="insercao.php"method="post">
                            <input type="hidden" name="Qual_form" value="6">
                           <div class="form-group">
                             <label for="text">Nome:</label>
                             <input type="text" class="form-control" id="Nome_diretor" placeholder="digite o nome" maxlength="40" name="Nome_diretor">
                           </div>
                            <div class="form-group">
                                 <label for="radio">Sexo:</label> 
                                <div class="radio">
                                
                                 <label><input type="radio" name="radiosexo2" checked value="M">Masculino</label>
                                 </div>
                                 <div class="radio">
                                  <label> <input type="radio" name="radiosexo2" value="F">Feminino</label>
                                 </div>
                                 <div class="radio disabled">
                                   <label><input type="radio" name="radiosexo2" value="O" >Outros</label>
                                 </div> 
                            </div>    
                           <div class="form-group">
                             <label for="text">Ano de nascimento:</label>
                             <input type="number" class="form-control" min="30" id="idade_diretor" placeholder="digite o Ano de nascimento" maxlength="40" name="idade_diretor">
                           </div>
                            <div class="form-group">
                             <label for="text">Nacionalidade:</label>
                             <input type="text" class="form-control" id="nacionalidade_diretor" placeholder="digite a nacionalidade" maxlength="40" name="nacionalidade_diretor">
                           </div>
                           <div class="form-group"> 
                                <div class="checkbox">
                                    <label><input type="checkbox"  onclick="myfunction()"name="diretor_ator" id="diretor_ator" value="">É Ator?</label>
                                 </div>
                            </div>
                            <div class="form-group">
                                 <label for="sel2">Filme  que atua (segure o shift para selecionar mais de 1):</label>
                                 <select multiple disabled="true"  class="form-control" id="filme_diretor"  name="filme_diretor[]">
                                    <?php 
                                     
                                            echo $sel_ator;
                                   
                                    ?>
                                 </select>
                             </div>
                            <div class="form-group">
                                 <label for="sel2">Seriado  que atua (segure o shift para selecionar mais de 1):</label>
                                 <select multiple disabled="true;" class="form-control" id="seriado_diretor"  name="seriado_diretor[]">
                                    <?php 
                                     
                                            echo  $sel_seriado;
                                   
                                    ?>
                                 </select>
                             </div>
                            <div class="form-group">
                                 <label for="sel2">Filme  que Dirige (segure o shift para selecionar mais de 1):</label>
                                 <select multiple class="form-control" id="filme_diretor2"  name="filme_diretor2[]">
                                    <?php 
                                     
                                            echo $sel_ator;
                                   
                                    ?>
                                 </select>
                             </div>
                            <div class="form-group">
                                 <label for="sel2">Seriado  que Dirige (segure o shift para selecionar mais de 1):</label>
                                 <select multiple  class="form-control" id="seriado_diretor2"  name="seriado_diretor2[]">
                                    <?php 
                                     
                                            echo  $sel_seriado;
                                   
                                    ?>
                                 </select>
                             </div>
                           <button type="submit" class="btn btn-default">Enviar</button>
                         </form>
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
