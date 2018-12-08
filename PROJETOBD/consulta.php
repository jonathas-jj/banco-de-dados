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
        <title>Consulta</title>
            
    
       <!DOCTYPE html>

        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
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
            $conn =  mysqli_connect($servername, $username, $password,$dbname);
            if (mysqli_connect_errno()) {
                die("Connection failed: " . $conn->connect_error);
            } else {echo "CONEXÃO FEITA!</BR>";}
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
               
                    if ($_POST["tipo_consulta"]=="mostrar FILMEs"){
                        $sql="SELECT `COD_FILME` as 'CÓDIGO', `TITULO`, `DESCRICAO` AS 'DESCIÇÃO', `NACIONALIDADE`, `DURACAO` AS 'DURAÇÃO', `ANO` FROM FILME";
                           
                    }
                   
                    elseif ($_POST["tipo_consulta"]=="mostrar SERIADOs") {
                        $sql="select `COD_SERIADO` as 'CÓDIGO', `TITULO`, `DESCRICAO`AS 'DESCIÇÃO', `NACIONALIDADE`, `ANO` FROM SERIADO";
                                 
                    }
                    elseif ($_POST["tipo_consulta"]=="mostrar TEMPORADAs") {
                        $sql="SELECT `NUM_TEMPORADA` as 'NÚMERO DA TEMP.', `COD_SERIADO` FROM TEMPORADA";
                                 
                    }
                    elseif ($_POST["tipo_consulta"]=="mostrar EPÍSODIOs") {
                        $sql="SELECT `NUM_EPISODIO` as 'NÚMERO DO EPISÓDIO', `TITULO`, `DESCRICAO` AS 'DESCIÇÃO', `DURACAO` AS 'DURAÇÃO', `NUM_TEMPORADA` AS 'NÚMERO DA TEMPORADA', `COD_SERIADO` AS 'CÓDIGO DO SERIADO' FROM EPISODIO";
                                 
                    }
                    elseif ($_POST["tipo_consulta"]=="mostrar ATOREs") {
                        $sql="SELECT `COD_PROFISSIONAL` as 'CÓDIGO', `NOME`, `ANO_NASCIMENTO` AS 'ANO DE NASCIMENTO', `SEXO`, `NACIONALIDADE` FROM PROFISSIONAL WHERE FLAG_ATOR=1 ";
                                 
                    }
                    elseif ($_POST["tipo_consulta"]=="mostrar DIRETOREs") {
                         $sql="SELECT `COD_PROFISSIONAL` as 'CÓDIGO', `NOME`, `ANO_NASCIMENTO` AS 'ANO DE NASCIMENTO', `SEXO`, `NACIONALIDADE` FROM PROFISSIONAL WHERE FLAG_DIRETOR=1 ";
                                                            
                    }
                    elseif ($_POST["tipo_consulta"]=="CONTAR NACIONALIDADE DOS PROFISSIONAIS CADASTRADOS") {
                         $sql="SELECT NACIONALIDADE, COUNT(*) as 'NÚMERO DE PESSOAS' FROM PROFISSIONAL GROUP BY NACIONALIDADE order by COUNT(*) ";
                                                            
                    }
                   
                    elseif ($_POST["tipo_consulta"]=="DURAÇÃO MEDIA DOS filmes") {
                         $sql="SELECT concat(AVG(DURACAO),' MIN') AS 'DURAÇÃO MÉDIA' FROM FILME ";
                                                            
                    }
                    elseif ($_POST["tipo_consulta"]=="episódios de cada seriado") {
                         $sql="SELECT SERIADO.TITULO AS 'TITULO SERIADO', TEMPORADA.NUM_TEMPORADA AS 
                                 'NÚMERO DA TEMPORADA', EPISODIO.NUM_EPISODIO AS 'NÚMERO EPISÓDIO', EPISODIO.TITULO 
                                  FROM SERIADO,TEMPORADA,EPISODIO WHERE SERIADO.COD_SERIADO=EPISODIO.COD_SERIADO
                                 AND TEMPORADA.NUM_TEMPORADA=EPISODIO.NUM_TEMPORADA
                                  AND TEMPORADA.COD_SERIADO= SERIADO.COD_SERIADO ORDER BY SERIADO.TITULO , TEMPORADA.NUM_TEMPORADA ASC,EPISODIO.NUM_EPISODIO ASC";
                                                            
                    }
                    elseif ($_POST["tipo_consulta"]=="Filmes e seus atores") {
                         $sql="SELECT FILME.TITULO , PROFISSIONAL.NOME  FROM FILME,ATUAEMFILME, PROFISSIONAL WHERE ATUAEMFILME.COD_PROFISSIONAL=PROFISSIONAL.COD_PROFISSIONAL AND  ATUAEMFILME.COD_FILME=FILME.COD_FILME ORDER BY FILME.TITULO";
                                                            
                    }
                  
                    elseif ($_POST["tipo_consulta"]=="MOSTRAR NACIONALIDADES COM MAIS DE 5 FILMES") {
                         $sql="SELECT NACIONALIDADE, COUNT(*) FROM FILME GROUP BY NACIONALIDADE HAVING COUNT(*)>2";
                                                            
                    }
                    elseif ($_POST["tipo_consulta"]=="MOSTRAR FILMES COM DURACAO MAIOR QUE A MEDIA") {
                         $sql="SELECT TITULO, DURACAO FROM FILME WHERE DURACAO > (SELECT avg(DURACAO) FROM FILME) ORDER BY TITULO";
                                                            
                    }
                    elseif ($_POST["tipo_consulta"]=="Ordenar filmes por ano de lançamento") {
                         $sql="SELECT * FROM FILME ORDER BY ANO DESC";
                                                            
                    }
                    elseif ($_POST["tipo_consulta"]=="profissionais com Gabriel no início do nome") {
                         $sql="SELECT nome FROM profissional WHERE nome like 'gabriel%'";
                                                            
                    }
                    elseif ($_POST["tipo_consulta"]=="quantidade de atuações de cada ator") {
                         $sql="SELECT PROFISSIONAL.NOME,COUNT(PROFISSIONAL.COD_PROFISSIONAL) AS 'ATUAÇÕES' FROM ATUAEMFILME, PROFISSIONAL WHERE PROFISSIONAL.COD_PROFISSIONAL=ATUAEMFILME.COD_PROFISSIONAL GROUP BY NOME ORDER BY NOME";
                                                            
                    }
                    elseif ($_POST["tipo_consulta"]=="Retorna todos os filmes dos Anos 90") {
                         $sql="SELECT TITULO, ANO FROM FILME where ANO between '1990' and '1999' order by ANO desc ";
                                                            
                    }
                    elseif ($_POST["tipo_consulta"]=="todos os atores que são também diretores") {
                         $sql=" SELECT COD_PROFISSIONAL AS 'CÓDIGO',NOME,ANO_NASCIMENTO ,SEXO,NACIONALIDADE FROM PROFISSIONAL where FLAG_ATOR=True AND FLAG_DIRETOR=True ORDER BY NOME";
                                                            
                    }
                  
               
               
                   $dados = mysqli_query($conn,$sql);
            
                             
                    // calcula quantos dados retornaram
                    $total = mysqli_num_rows($dados);
                    $cabecalho_tab= '<tr>';
                     $salva_cabecalho=array();
                    while (($cabecalho = mysqli_fetch_field($dados))&& ($total>0)) {
                        $cabecalho_tab=$cabecalho_tab. ' <th>'.$cabecalho->name.'</th> ';
                        array_push($salva_cabecalho, $cabecalho->name);
                    }
                    
                    $cabecalho_tab= $cabecalho_tab.'</tr>';
                    
                    while(($linha = mysqli_fetch_array($dados))&& ($total>0)){
                        $linhas_tab=$linhas_tab.'<tr>';
                        foreach ($salva_cabecalho as $nome_campo){
                            $linhas_tab=$linhas_tab.'<td>'.$linha[$nome_campo].'</td>' ;
                        }   
                        $linhas_tab= $linhas_tab.'</tr>';
                        
                    }
                   
                    
                    
                    $tabela= '<div class="container- container" style=" width:  60%; margin-right: 70%">'
                            . '<h2>Resultado da pesquisa</h2>'
                           . ' <p>Tabela de dados:</p>    '        
                          . '  <table class="table">'
                           . '   <thead>'
                          
                             . $cabecalho_tab    
                           
                           . '   </thead>'
                            . '  <tbody>'
                            . $linhas_tab              
                            . '  </tbody>'
                          . '  </table>'
                           . '</div>';
                     
                
                
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
           <h1>Consulta</h1>
           <h3>Escolha um tipo de consulta ao banco de dados</h3>


        </div> 
     </div>
 <div class="">
   
 
     <div id="Consulta" class="container- container" style=" width: 70%">
         
       <?php if ((isset($_POST['Qual_form'])) && ($_POST['Qual_form']==1)){ echo $messagem;} ?>
        <div class="panel panel-primary"  >
            <div class="panel-heading"  style="margin: 0px; padding: 0px"> <h3 style="margin: 0px; padding: 5px">Consultar</h3>
            </div>
            <div class="panel-body" >
               <div class="container">
                    
                   <form action="consulta.php" method="post">
                        <input type="hidden" name="Qual_form" value="1">
                        <div class="form-group">
                          <label for="text">Tipo de consulta:</label>
                          <select name="tipo_consulta" id="tipo_consulta">
                              <option> CONTAR NACIONALIDADE DOS PROFISSIONAIS CADASTRADOS</option>                              
                              <option> DURAÇÃO MEDIA DOS filmes</option>  
                              <option> episódios de cada seriado</option> 
                               <option> Filmes e seus atores</option> 
                               <option>mostrar FILMEs</option>
                               <option>mostrar SERIADOs</option>
                               <option>mostrar TEMPORADAs</option>
                               <option>mostrar EPÍSODIOs</option>
                               <option>mostrar ATOREs</option>
                               <option>mostrar DIRETOREs</option> 
                               <option>MOSTRAR NACIONALIDADES COM MAIS DE 5 FILMES</option>  
                               <option>MOSTRAR FILMES COM DURACAO MAIOR QUE A MEDIA </option>  
                               <option>Ordenar filmes por ano de lançamento</option>
                               <option>profissionais com Gabriel no início do nome</option>  
                               <option>quantidade de atuações de cada ator</option>                          
                                
                               <option> Retorna todos os filmes dos Anos 90</option> 
                               <option> todos os atores que são também diretores</option> 
                               
                               
                          </select>
                        </div>
                        
                       
                                               
                           <button type="submit" class="btn btn-default">Executar</button>
                           <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { 
                                    echo $tabela;                              
                                ;}
                            ?>
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
