<?php 
session_start();
//Limpieza de variables de sesion si es nueva busqueda.
if ($_SERVER["REQUEST_METHOD"] == "GET") { if (isset($_GET['newSearch'])){ session_unset(); } }
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
        <main class="mt-5 form-search w-100 m-auto form-bg shadow-red rounded">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-215.19 -86.608 1000 402.473" enable-background="new -215.19 -86.608 1000 402.473" xml:space="preserve">
            <g>
                <rect x="-215.19" y="-86.608" fill="#ED1D24" width="1000" height="402.473"/>
                <g>
                    <path fill="#FFFFFF" d="M631.063,7.184v-61.603H459.644l-28.191,205.803L403.557-54.418H341.74l6.925,54.915    c-7.14-14.068-32.449-54.915-88.146-54.915c-0.367-0.024-61.901,0-61.901,0l-0.237,299.974L153.324-54.418l-80.959-0.047    L25.753,256.349L25.777-54.42h-77.483l-27.933,174.585l-27.208-174.583h-77.508v337.906h61.036V120.618l27.764,162.866h32.449    l27.374-162.866v162.866H81.935l7.14-51.995h47.374l7.116,51.995l115.521,0.071h0.094v-0.071h0.072h0.072V173.799l14.162-2.063    l29.319,111.819h0.072h59.61h0.07l-0.024-0.071h0.106h0.072l-38.475-131.057c19.498-14.422,41.513-51.047,35.654-86.084V66.32    c0.07,0.474,36.316,217.38,36.316,217.38l71.065-0.216L515.83-22.8v306.285h115.236v-60.773h-54.7v-77.496h54.7V83.518h-54.7    V7.184H631.063z M96.265,177.905l16.758-144.461l17.4,144.461H96.265z M273.684,111.201c-4.697,2.278-9.595,3.417-14.363,3.417    V5.927c0.083,0,0.179-0.022,0.297-0.022c4.78-0.024,40.419,1.446,40.419,53.774C300.037,87.052,287.916,104.299,273.684,111.201     M754.044,222.665v60.772H641.63V-54.465h60.526v277.13H754.044z"/>
                </g>
            </g>
        </svg>
        <!--Esta imagen, o el texto representado en ella, consiste sólo en formas geométricas simples y texto. Esto no alcanza el umbral de originalidad necesario para que esté protegido por derechos de autor, por lo tanto, está en dominio público. No obstante, podría estar sujeto a otro tipo de restricciones. Véase WP:PD#Fonts and typefaces o Template talk:PD-textlogo para más información.
        -->
        <h4 class="text-center pt-2 subtitle mayusculas">Buscador de comics en Marvel</h4>
            <form action="comicsV2.php" method="post">
                <div class="row g-3">
                    <div class="col-12 pt-4 my-2">
                        <label for="startName" class="form-label">Title starts with</label>
                        <input id="startName" name="startName" class="form-control" type="text" />
                        <div class="invalid-feedback">
                            Por favor seleccione una opcion valida.
                        </div>
                    </div>
                    <div class="col-12 my-2">
                        <label for="formato" class="form-label">Format</label>
                        <select class="form-select" name="format" id="formato" required="">
                            <option value="">Seleccione...</option>
                            <option value="comic">Comic</option>
                            <option value="magazine">Magazine</option>
                            <option value="digital comic">Digital Comic</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor seleccione una opcion valida.
                        </div>
                    </div>
                    <div class="col-12 my-2">
                        <label for="formatType" class="form-label">Format Type</label>
                        <select class="form-select" name="formatType" id="type" required="">
                            <option value="">Seleccione...</option>
                            <option value="comic">Comic</option>
                            <option value="collection">Coleccion</option>
                            
                        </select>
                        <div class="invalid-feedback">
                            Por favor seleccione una opcion valida.
                        </div>
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="startDate" class="form-label">Fecha Inicio</label>
                        <input id="startDate" name="startDate" class="form-control" type="date" />
                        <div class="invalid-feedback">
                            Por favor seleccione una opcion valida.
                        </div>
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="endDate" class="form-label">Fecha Fin</label>
                        <input id="endDate" name="endDate" class="form-control" type="date" />
                        <div class="invalid-feedback">
                            Por favor seleccione una opcion valida.
                        </div>
                    </div>
                    <div class="my-2">
                        Disponible digitalmente:
                        <div class="form-check">
                            <input id="hasDigitalIssue" name="hasDigitalIssue" type="radio" value="true"  class="form-check-input" checked="" required="">
                            <label class="form-check-label" for="hasDigitalIssue">Si</label>
                        </div>
                        <div class="form-check">
                            <input id="NohasDigitalIssue" name="hasDigitalIssue" type="radio" value="false" class="form-check-input" required="">
                            <label class="form-check-label" for="NohasDigitalIssue">No</label>
                        </div>
                    </div>
                    <hr class="">
                    <div class="col-12">
                        <button class="w-100 btn btn-danger btn-lg" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </main>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    </body>
</html>


