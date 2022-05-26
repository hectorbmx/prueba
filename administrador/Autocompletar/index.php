<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/sistema.js"></script>
<title>Autocomplete usando PHP/MySQL y jQuery </title>

<style type="text/css">
*{ font-family:Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif}
.main{ margin:auto; border:1px solid #7C7A7A; width:40%; text-align:left; padding:30px; background:#85c587}
input[type=submit]{ background:#6ca16e; width:100%;
    padding:5px 15px; 
    background:#ccc; 
    cursor:pointer;
    font-size:16px;
   
}
input[type=text]{ margin: 5px;
   
}
</style>
</head>
<body bgcolor="#bed7c0">
<div class="main">
<h1>Autocomplete PHP/MySQL y jQuery </h1>
<br><br>
            <form>
                <div class="etiqueta">Ingrese paises: </div>
                <div class="input_container">
                    <input autocomplete="off" type="text" id="pais_id" onkeyup="autocompletar()">
                    <ul id="lista_id"></ul>
                </div>
            </form>  
<br><br> 
        <div class="footer">
            <a href="https://www.baulphp.com/">baulphp.com</a>
        </div><!-- footer -->
</div>
</body>
</html>