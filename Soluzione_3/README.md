# How to do

## La pagina ```gestione.html```
Questa pagina, attualmente molto semplice, permette di aggiornare la mappa.
Per farlo è sufficiente inserire il codice mid (map identification) presente nel link dove si trova la mappa.
Per esempio, dato il link della mappa DMO [https://www.google.com/maps/d/u/0/viewer?mid=1WAJTbJqiQwrTpGF1PUjsE3DreaHFcYA](https://www.google.com/maps/d/u/0/viewer?mid=1WAJTbJqiQwrTpGF1PUjsE3DreaHFcYA), è sufficiente copiare ed incollare il campo 

```mid: 1WAJTbJqiQwrTpGF1PUjsE3DreaHFcYA```

ed incollarlo, cliccare su ```aggiorna mappa``` e verrà scaricata la nuova mappa con le ultime località.

## La pagina ```home_map.html```
Questa è una pagina di esempio su come implementare la mappa leaflet partendo da un file ```.kml```.

Per farlo, si importa lo script L.KML.js che si occuperà di interpretare il file KML. Successivamente, si crea un div che conterrà la mappa,
e uno script si occuperà di interpretare il file KML con annesse immagini (poste nella cartella images) e fare il rendering della mappa nel div desiderato.

## ```UpdateKMZ```
Pagina Php che scarica il file KMZ e ne fa l'unzip, salvandolo in locale.
Infine, fa il redirect su ```home_map.html```