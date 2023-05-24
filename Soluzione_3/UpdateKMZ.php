<?php
/*
 * Questo script scarica il file kmz da mymaps
 * Il link è relativo alla mappa con l'intero percorso della Via Francigena e i punti di interesse
 *
 * Dato che il file kmz è uno zip di un file kml (un xml che descrive il  percorso e le icone) e una cartella
 * con le images "non standard", bisogna unzipparlo e salvarne il contenuto.
 * Sarà sufficiente processare il kml tramite, per esempio, leaflet per mostrare la mappa desiderata.
 *
 * Deve essere previsto un meccanismo di aggiornamento dei file, dato che non ha senso riscaricare i file ogni
 * volta che si accede alla mappa.
 * Una soluzione è dare la possibilità al gestore del sito, tramite il portale gestionale, di fare l'update quando
 * necessario.
 */
function unzipFile($file){
    $zip = new ZipArchive;
    $res = $zip->open($file);
    if ($res === TRUE) {
        $zip->extractTo('./');
        $zip->close();
        return 1;
    } else {
        echo 'doh!';
        echo $zip->getStatusString();
        echo "---";
        echo $res;
        return 0;
    }
}

//mappa GDD: 1rvOLHX9E5e4QFM2vXRhxbbdn7xSyMDon
//mappa DMO: 1WAJTbJqiQwrTpGF1PUjsE3DreaHFcYA

$url = str_replace(basename($_SERVER['PHP_SELF']), "home_map.html", "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
$mid = $_POST["mid"];

file_put_contents("map.kmz", fopen("https://www.google.com/maps/d/u/0/kml?mid=$mid", 'r'));

if(unzipFile("map.kmz")) header('Location: '.$url);

?>