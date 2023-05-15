<?php 
require_once('includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") { 
    $id=$_GET['id'];
    $ApiURI='http://gateway.marvel.com/v1/public/comics/'.$id.'?ts='.$currentTime.'&apikey='.$pk.'&hash='.$hash;
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
    // var_dump($data->data->results[0]);
    //print_r($data->data->results[0]);
   //  var_dump($data);
    
 } ?>

<html lang="es" data-bs-theme="dark" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="generator" content="">
        <title>Marvel-pedia</title>
        <link href="css/bootstrap.css" rel="stylesheet" >
        
        <link href="css/OwnTheme.css" rel="stylesheet" >
    </head>
    <body class="my-bg">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <!-- <a class="navbar-brand" href="#">Buscador de comics en Marvel</a> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:history.go(-1)">Volver a resultados</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Detalle del Comic</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section>
            <div class="mt-5 row p-5">
                <div class="col-4">
                    <style>figure:after{background-image: url(<?php echo $data->data->results[0]->thumbnail->path.'.'.$data->data->results[0]->thumbnail->extension; ?>);}</style>
                    <figure>
                        <img class="img-fluid" src="<?php echo $data->data->results[0]->thumbnail->path.'.'.$data->data->results[0]->thumbnail->extension; ?>" alt="Imagen de <?php echo $data->data->results[0]->title;?>">
                    </figure>
                </div>
                <div class="col-8">
                    <div class="col-12">
                        <?php echo '<h1 class="whitesmoke mayusculas">'.$data->data->results[0]->title."</h1>"; ?>
                    </div>
                    <div class="col-12">
                        <ul class="nav nav-pills" id="myTab" role="tablist">
                            <li class="my-btn ms-1 nav-item" role="presentation">
                                <button class="nav-link active" id="informacion-tab" data-bs-toggle="tab" data-bs-target="#informacion-tab-pane" type="button" role="tab" aria-controls="informacion-tab-pane" aria-selected="true">informacion</button>
                            </li>
                            <li class="my-btn  ms-1 nav-item" role="presentation">
                                <button class="nav-link" id="personajes-tab" data-bs-toggle="tab" data-bs-target="#personajes-tab-pane" type="button" role="tab" aria-controls="personajes-tab-pane" aria-selected="true">personajes</button>
                            </li>
                            <li class="my-btn ms-1 nav-item" role="presentation">
                                <button class="nav-link" id="creadores-tab" data-bs-toggle="tab" data-bs-target="#creadores-tab-pane" type="button" role="tab" aria-controls="creadores-tab-pane" aria-selected="false">creadores</button>
                            </li>
                            <li class="my-btn ms-1 nav-item" role="presentation">
                                <button class="nav-link" id="codigos-tab" data-bs-toggle="tab" data-bs-target="#codigos-tab-pane" type="button" role="tab" aria-controls="codigos-tab-pane" aria-selected="false">codigos</button>
                            </li>
                            <li class="my-btn ms-1 nav-item" role="presentation">
                                <button class="nav-link" id="fechas-tab" data-bs-toggle="tab" data-bs-target="#fechas-tab-pane" type="button" role="tab" aria-controls="fechas-tab-pane" aria-selected="false" >fechas</button>
                            </li>
                            <li class="my-btn ms-1 nav-item" role="presentation">
                                <button class="nav-link" id="variantes-tab" data-bs-toggle="tab" data-bs-target="#variantes-tab-pane" type="button" role="tab" aria-controls="variantes-tab-pane" aria-selected="false" >variantes</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="informacion-tab-pane" role="tabpanel" aria-labelledby="informacion-tab" tabindex="0">
                                <div class="p-5 row row-cols-1 row-cols-md-1 row-cols-lg-2">
                                    <div class="col order-md-2">
                                        <?php echo '<h4 class="subtitle ">DESCRIPCION</h4><p class="subtitle">'.$data->data->results[0]->description."</p>"; ?>
                                    </div>
                                    <div class="col order-md-1">
                                        <?php echo '<h4 class="subtitle ">FORMATO: '.$data->data->results[0]->format."</h4>"; ?>
                                        <?php echo '<h4 class="subtitle ">PAGINAS: '.$data->data->results[0]->pageCount."</h4>"; ?>
                                        <?php echo '<h4 class="subtitle ">PRECIO: '.$data->data->results[0]->prices[0]->price.'</h4>'; ?>
                                    </div>
                                
                                </div>
                                <div class="p-5 row">
                                
                                </div>
                            </div>
                            <div class="tab-pane fade" id="personajes-tab-pane" role="tabpanel" aria-labelledby="personajes-tab" tabindex="0">
                                <?php 
                                    $arrayCharacters=$data->data->results[0]->characters->items;
                                    if (count($arrayCharacters)==0){
                                        echo ' <div class="p-5 row">';
                                            echo ' <div class="col">';
                                                echo '<p class="subtitle text-danger"> No se han recibido datos de personajes desde Marvel para este comic</p>';
                                            echo ' </div>';
                                        echo ' </div>';
                                    }else{
                                        echo ' <div class="p-5 row row-cols-1 row-cols-md-1 row-cols-lg-3">';
                                    for ($i=0;$i<count($arrayCharacters);$i++){
                                        ?>
                                        <div class="col">
                                            <?php
                                            echo '<p class="subtitle">'.$arrayCharacters[$i]->name.'</p>';
                                            ?>
                                        </div>
                                        <?php 
                                        } 
                                        echo ' </div> ';
                                    }
                                ?>  
                            </div>
                            <div class="tab-pane fade" id="creadores-tab-pane" role="tabpanel" aria-labelledby="creadores-tab" tabindex="0">
                                <div class=" p-5 row row-cols-1 row-cols-md-1 row-cols-lg-3">
                                    <?php 
                                    $arrayCreators=$data->data->results[0]->creators->items;
                                    for ($i=0;$i<count($arrayCreators);$i++){
                                        ?>
                                        <div class="col">
                                            <?php
                                            switch($arrayCreators[$i]->role){
                                                case 'inker': 
                                                    echo '<h4>Entintador</h4><p class="subtitle">'.$arrayCreators[$i]->name."</p>";
                                                    break;
                                                case 'colorist': 
                                                    echo '<h4>Colorista</h4><p class="subtitle">'.$arrayCreators[$i]->name."</p>";
                                                    break;
                                                case 'writer': 
                                                    echo '<h4>Escritor</h4><p class="subtitle">'.$arrayCreators[$i]->name."</p>";
                                                    break;
                                                case 'penciler': 
                                                    echo '<h4>Dibujante</h4><p class="subtitle">'.$arrayCreators[$i]->name."</p>";
                                                    break;
                                                case 'colorist (cover)': 
                                                    echo '<h4>Colorista (portada)</h4><p class="subtitle">'.$arrayCreators[$i]->name."</p>";
                                                    break;
                                                case 'penciler (cover)': 
                                                    echo '<h4>Dibujante (portada)</h4><p class="subtitle">'.$arrayCreators[$i]->name."</p>";
                                                    break;
                                                case 'letterer': 
                                                    echo '<h4>Rotulista (portada)</h4><p class="subtitle">'.$arrayCreators[$i]->name."</p>";
                                                    break;
                                                default:
                                                    echo '<h4>'.$arrayCreators[$i]->role.'</h4><p class="subtitle">'.$arrayCreators[$i]->name."</p>";

                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>  


                                </div>
                            </div>
                            <div class="tab-pane fade" id="codigos-tab-pane" role="tabpanel" aria-labelledby="codigos-tab" tabindex="0">
                                <div class="p-5 row row-cols-1 row-cols-md-2 row-cols-lg-4 justify-content-around">
                                    <div class="col">
                                        <?php echo '<h4>EAN</h4><p class="subtitle"> '.$data->data->results[0]->ean."</p>"; ?>
                                    </div>
                                    <div class="col">
                                        <?php echo '<h4>ISBN</h4><p class="subtitle"> '.$data->data->results[0]->isbn."</p>"; ?>
                                    </div>
                                    <div class="col">
                                        <?php echo '<h4>ISSN</h4><p class="subtitle"> '.$data->data->results[0]->issn."</p>"; ?>
                                    </div>
                                    <div class="col">
                                        <?php echo '<h4>UPC</h4><p class="subtitle"> '.$data->data->results[0]->upc."</p>"; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="fechas-tab-pane" role="tabpanel" aria-labelledby="fechas-tab" tabindex="0">
                            <div class="p-5 row row-cols-1 row-cols-md-1 row-cols-lg-2 justify-content-around">
                                                <?php 
                                                $arrayDates=$data->data->results[0]->dates;
                                                for ($i=0;$i<count($arrayDates);$i++){
                                                    ?>
                                                    <div class="col">
                                                        <?php
                                                        switch($arrayDates[$i]->type){
                                                            case 'onsaleDate': 
                                                                echo '<h4>Fecha en venta</h4><p class="subtitle">'.$arrayDates[$i]->date."</p>";
                                                                break;
                                                            case 'focDate': 
                                                                echo '<h4>Fecha F.O.C.</h4><p class="subtitle">'.$arrayDates[$i]->date."</p>";
                                                                break;
                                                            case 'unlimitedDate': 
                                                                echo '<h4>Fecha unlimited</h4><p class="subtitle">'.$arrayDates[$i]->date."</p>";
                                                                break;
                                                            case 'digitalPurchaseDate': 
                                                                echo '<h4>Compra Digital</h4><p class="subtitle">'.$arrayDates[$i]->date."</p>";
                                                                break;
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>  


                                            </div>
                            </div>
                            
                            
                            <div class="tab-pane fade" id="variantes-tab-pane" role="tabpanel" aria-labelledby="variantes-tab" tabindex="0">
                                <div class="pt-5 row row-cols-1 row-cols-md-1 row-cols-lg-3">
                                    <?php
                                    $arrayVariants=$data->data->results[0]->variants;
                                    for ($i=0;$i<count($arrayVariants);$i++){
                                        $ApiURI_variants=$arrayVariants[$i]->resourceURI.'?ts='.$currentTime.'&apikey='.$pk.'&hash='.$hash;
                                        $ch = curl_init();
                                        curl_setopt($ch, CURLOPT_HEADER, 0);
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                        curl_setopt($ch, CURLOPT_URL, $ApiURI_variants);
                                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                        curl_setopt($ch, CURLOPT_VERBOSE, 0);
                                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                        $response_variants = curl_exec($ch);
                                        curl_close($ch);
                                        $data_variants = json_decode($response_variants);
                                    ?>
                                        <div class="col">
                                            <img class="m-5 d-block img-thumbnail my-thumbnail" src="<?php echo $data_variants->data->results[0]->thumbnail->path.".".$data_variants->data->results[0]->thumbnail->extension; ?>" alt="Imagen de <?php echo $data_variants->data->results[0]->title;?>">
                                        </div>  
                                    <?php  }     ?>           
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div> 
        </section>   
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
    </body>
</html>