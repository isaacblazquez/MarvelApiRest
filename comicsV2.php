<?php 
session_start();
require_once('includes\config.php'); ?>
<?php 

$limit=8;  //NUMERO DE ITEMS POR PAGINA

// SI VENGO DEL FORM RECIBO POR POST

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //GENERACION DE LA LLAMADA A API MARVEL
    $ApiURI="";
    $ApiURI.="http://gateway.marvel.com/v1/public/comics?";

    if (!empty($_POST['startName'])){
        $_SESSION['startName']=$_POST['startName'];
        $ApiURI.="&titleStartsWith=".$_POST['startName'];
    }
    if (!empty($_POST['format'])){
        if ($_POST['format']=="digital comic"){
            $_SESSION['format']=$_POST['format'];
            $ApiURI.="&format=digital%20comic";
        }else{
            $_SESSION['format']=$_POST['format'];
            $ApiURI.="&format=".$_POST['format'];
        }
    }
    if (!empty($_POST['formatType'])){
        $_SESSION['formatType']=$_POST['formatType'];
        $ApiURI.="&formatType=".$_POST['formatType'];
    }
    if (!empty($_POST['hasDigitalIssue'])){
        $_SESSION['hasDigitalIssue']=$_POST['hasDigitalIssue'];
        $ApiURI.="&hasDigitalIssue=".$_POST['hasDigitalIssue'];
    }
    if (!empty($_POST['startDate'])){
        $_SESSION['startDate']=$_POST['startDate'];
        $ApiURI.="&dateRange=".$_POST['startDate'];
        $ApiURI.="%2C";
        if (!empty($_POST['endDate'])){
            $_SESSION['endDate']=$_POST['endDate'];
            $ApiURI.=$_POST['endDate'];
        }
        if (empty($_POST['endDate'])){
            $_SESSION['endDate']=date('Y-m-d');
            $ApiURI.=date('Y-m-d');
        }
    }
    $ApiURI.='&limit='.$limit;
    $ApiURI.='&ts='.$currentTime;
    $ApiURI.='&apikey='.$pk;
    $ApiURI.='&hash='.$hash;

    //REALIZO LA LLAMADA A LA API DE MARVEL 

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $ApiURI);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response);

}

// SI VENGO DE PAGINACION RECIBO POR GET

if ($_SERVER["REQUEST_METHOD"] == "GET") { 
    //GENERACION DE LA LLAMADA A API MARVEL
    $ApiURI="";
    $ApiURI.="http://gateway.marvel.com/v1/public/comics?";

    if (!empty($_SESSION['startName'])){
        $ApiURI.="&titleStartsWith=".$_SESSION['startName'];
    }
    if (!empty($_SESSION['format'])){
        if ($_SESSION['format']=="digital comic"){
            $ApiURI.="&format=digital%20comic";
        }else{
            $ApiURI.="&format=".$_SESSION['format'];
        }
    }
    if (!empty($_SESSION['formatType'])){
        $ApiURI.="&formatType=".$_SESSION['formatType'];
    }
    if (!empty($_SESSION['hasDigitalIssue'])){
        $ApiURI.="&hasDigitalIssue=".$_SESSION['hasDigitalIssue'];
    }
    if (!empty($_SESSION['startDate'])){
        $ApiURI.="&dateRange=".$_SESSION['startDate'];
        $ApiURI.="%2C";
        if (!empty($_SESSION['endDate'])){
            $ApiURI.=$_SESSION['endDate'];
        }
        if (empty($_SESSION['endDate'])){
            $ApiURI.=date('Y-m-d');
        }
    }

    if((empty($_GET['page']))){
        $offset=0;
    }else{      
            $offset=$limit*($_GET['page']-1);        
    }

    $ApiURI.='&limit='.$limit;
    $ApiURI.='&offset='.$offset;
    $ApiURI.='&ts='.$currentTime;
    $ApiURI.='&apikey='.$pk;
    $ApiURI.='&hash='.$hash;

     //REALIZO LA LLAMADA A LA API DE MARVEL 

     $ch = curl_init();
     curl_setopt($ch, CURLOPT_HEADER, 0);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_URL, $ApiURI);
     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
     curl_setopt($ch, CURLOPT_VERBOSE, 0);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     $response = curl_exec($ch);
     curl_close($ch);
     $data = json_decode($response);

}


if (!empty($data)){
     //CALCULOS NECESARIOS PARA MOSTRAR DATOS PAGINADOS
    $total_items=$data->data->total;
    $total_pages=round($total_items/$limit);
    $items_x_pagina=$data->data->count;
}

// CONTROL 
// echo $ApiURI;
// var_dump($data);
// echo "OFFSET: ".$offset."</br>";
// echo "LIMIT: ".$limit."</br>";
// var_dump($data->data->results);

?>

<html lang="es" data-bs-theme="dark" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="generator" content="">
        <title>Marvel-pedia</title>
        <link href="css/font.css" rel="stylesheet" >
        <link href="css/bootstrap.min.css" rel="stylesheet" >
        <link href="css/OwnTheme.css" rel="stylesheet" >
    </head>
    <body class="my-bg">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <div class="container-fluid">
                   
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav me-auto mb-2 mb-md-0">
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="index.php">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Volver a resultados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Detalle del Comic</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container justify-content-center">
                <main>
                    <div class="py-5 text-center">
                    </div>
                    <section>
                        <div class="row justify-content-between pb-5">
                            <div class="col">
                                <h4 class="subtitle"> Resultados para los filtros aplicados en la busqueda:</h4>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 pb-5">
                            <?php
                            for ($j=0;$j<$items_x_pagina;$j++)
                            {
                            ?>
                            <div class="col">
                                <a href="comicV2.php?id=<?php echo $data->data->results[$j]->id; ?> ">
                                    <div class="card h-100 photo my-card shadow-red rounded">
                                        <img src="<?php echo $data->data->results[$j]->thumbnail->path.".".$data->data->results[$j]->thumbnail->extension; ?>" class="card-img" alt="...">
                                        <div class="glow-wrap">
                                            <i class="glow"></i>
                                        </div>
                                        <div class="cover">
                                            <h1 class="card-title h3 pt-5 pb-3 text-center"><?php echo $data->data->results[$j]->title; ?></h1>
                                        </div>
                                    </div>
                                </a>
                            </div>                          
                            <?php  
                            }
                            ?>
                        </div>  
                    </section> 


                    <section class="pb-5">
                    <?php
                    if((empty($_GET['page']))){ $actual_page=1; }else{ $actual_page=$_GET['page']; }
                    if ($total_pages>0){ 
                        if($total_pages>1) 
                            { ?>
                            <nav class="pagination-outer" aria-label="Page navigation">
                                <ul class="pagination">
                                <?php
                                    if ($actual_page>1)    {   echo '<li class="page-item"><a class="page-link" href="?page=1"> First </a></li>';                      }
                                    if ($actual_page-10>=1) {   echo '<li class="page-item"><a class="page-link" href="?page='.($actual_page-10).'"> - 10 </a></li>';   }
                                    if ($actual_page-5>=1)  {   echo '<li class="page-item"><a class="page-link" href="?page='.($actual_page-5).'"> - 5 </a></li>';     }
                                    if ($actual_page-1>=1)  {   echo '<li class="page-item"><a class="page-link" href="?page='.($actual_page-1).'"> < </a></li>';       }
                                    
                                    echo '<li class="page-item active"><a class="page-link" href="?page='.($actual_page).'"> '.($actual_page).' </a></li>';
                                    
                                    if ($actual_page+1<=$total_pages)   {   echo '<li class="page-item"><a class="page-link" href="?page='.($actual_page+1).'"> > </a></li>';       }
                                    if ($actual_page+5<=$total_pages)   {   echo '<li class="page-item"><a class="page-link" href="?page='.($actual_page+5).'"> + 5 </a></li>';     }
                                    if ($actual_page+10<=$total_pages)  {   echo '<li class="page-item"><a class="page-link" href="?page='.($actual_page+10).'"> + 10 </a></li>';   }
                                    if ($actual_page!=$total_pages)     {   echo '<li class="page-item"><a class="page-link" href="?page='.$total_pages.'"> Last </a></li>';        }
                                }
                            }
                                ?>
                                </ul>
                            </nav>
                    </section>
                </main>
            </div>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
    </body>
</html>