<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

   
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

     
    <head>
        <meta charset="UTF-8">
        <title>Projeto banco de dados</title>
   
    
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

       
<div class="container-fluid bg-3 text-center"> 
   <div class="page-header"> 
       <h2>Projeto Banco de dados </h2>
    </div>
 
</div>
    
<div class="container-fluid bg-3 text-center"style=" width: 50%">    
  <h3>Escolha uma opção :</h3><br>
  <div class="row">
      <div class="col-sm-3" >
      <p>Inserção</p>
     <a href="insercao.php"> <img src="imagens/insercao.jpeg" class="img-responsive"class="img-thumbnail" style="width:100%" alt="Image"></a>
    </div>
    <div class="col-sm-3"> 
      <p>Atualização</p>
     <a href="atualizacao.php">  <img src="imagens/atualizacao.jpeg" class="img-responsive"class="img-thumbnail"style="width:100%" alt="Image"></a>
    </div>
    <div class="col-sm-3"> 
      <p>Consulta</p>
     <a href="consulta.php">  <img src="imagens/consulta.jpg" class="img-responsive" class="img-thumbnail" style="width:100%" alt="Image"></a>
    </div>
    <div class="col-sm-3">
      <p>Exclusão</p>
    <a href="exclusao.php">   <img src="imagens/exclusao.jpg" class="img-responsive" class="img-thumbnail" style="width:100%" alt="Image"></a>
    </div>
  </div>
</div><br><br>
    

<footer class="container-fluid text-center">
  <p>UERJ - CIÊNCIA DA COMPUTAÇÃO 2018.2</p>  
  
</footer>



        <?php
        // put your code here
       
        ?>
    </body>
</html>
