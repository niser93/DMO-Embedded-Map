# Studio di fattibilità

## Requisiti

Si richiede una pagina web che contenga una mappa presa da MyMaps (ne faccia, cioè, l'embedding).

La mappa, almeno attualmente, di cui si vuole fare l'embedding è:

[VIA FRANCIGENA NEL SUD](https://www.google.com/maps/d/embed?mid=1rvOLHX9E5e4QFM2vXRhxbbdn7xSyMDon&ehbc=2E312F)

Si richiede, inoltre, che rimangano possibili nell'embedded map alcune azioni possibili sulla mappa originale, tra cui:

TODO: da definire


## Analisi preliminare

Dati i requisiti, è possibile intraprendere diverse strade, a seconda di alcune preferenze, limiti e necessità.

Bisogna tener conto che il requisito presume l'utilizzo di uno strumento di Google, pertanto ci sono limitazioni imposte dal produttore e potrebbe esserci il rischio di lockin (essere, cioè, dipendenti da Google riguardo a futuri aggiornamenti/modifiche/dismissioni del prodotto attuale).

### Soluzione 1 - Embedding di Google

Google permette di creare un iframe che mostri la mappa prescelta.

Questa soluzione è stata implementata in [main.html](./Soluzione%201/main.html).
La soluzione è indubbiamente valida, rispondendo ai requisiti richiesti.

Tuttavia, l'impostazione grafica non può essere variata. Essa rappresenta solo una "finestra" sulla visualizzazione standard che ha Google MyMaps.
Inoltre, la dismissione dello strumento MyMaps o la modifica del link, richiederebbe una modifica anche della pagina web utilizzata.

#### PRO
* La soluzione rispetta totalmente i requisiti
* Semplice da implementare
* Semplice da manutenere

#### CONTRO
* Totale dipendenza dallo strumento MyMaps
* Modifiche effettuate sulla mappa originale immediatamente visibili sul sito web (non esiste un passaggio collaudo/produzione)
* Integrazione scarsa o assente tra il sito web ospite e la mappa ospitata
* Utilizzo dell'iframe, che comporta problemi tecnici ben conosciuti (vedi [4 IFrame Security Concerns You Should Know](https://blog.bitsrc.io/4-security-concerns-with-iframes-every-web-developer-should-know-24c73e6a33e4))


### Soluzione 2 - Utilizzo di API di Google Maps

Non c'è possibilità di utilizzare delle API per Google MyMaps.

Come è possibile vedere da [Interact with My Maps API](https://support.google.com/maps/thread/22025555/interact-with-my-maps-api?hl=en), Google non ha previsto API per MyMaps.

Pertanto, non sembra sia possibile la soluzione di fare l'embedding della mappa tramite script (per esempio usando javascript) e customizzare tale visualizzazione utilizzando le API di Google Maps.

Nel thread citato, si cita il file KML, e si propone di utilizzare questo.

Sarebbe, in linea di massima, possibile esportare il file KML ed utilizzarlo integrandolo con le API Google Maps (vedi [Using KMZ Files in Google Maps](https://stackoverflow.com/questions/9810332/using-kmz-files-in-google-maps))


#### PRO
* La soluzione rispetta i requisiti, purché tramite javascript si customizzi adeguatamente la mappa importata
* Utilizzo di API ben conosciute e collaudate
* Modifica asincrona. Sarebbe possibile modificare la mappa e solo successivamente richiederne l'aggiornamento sul sito web (divisione tra collaudo e produzione)
* Ottima integrazione tra sito web ospite e mappa ospitata

#### CONTRO
* Dipendenza dall'API Google Maps. Queste API hanno dei costi e degli utilizzi limitati, di cui si dovrà tenere conto
* Implementazione complessa
* Manutenzione complessa


### Soluzione 3 - Download del file KMZ e Leaflet

In questa soluzione, si propone di aggiornare la mappa sul sito in maniera asincrona.
Questo porta con sè una serie di benefici, tra cui il poter gestire la mappa in maniera autonoma e successivamente aggiornare il sito web.

La soluzione è così composta:

**Pagina di gestione**
Verrà creata una pagina di gestione, il cui scopo sarà quello di aggiornare la mappa sul sito tramite semplici click. La pagina di gestione dovrà essere accessibile solo dal gestore del sito web.

**Mappa**
La mappa potra quindi essere integrata in qualsiasi pagina web richiamandola tramite javascript.
Di questo verrà fornita una pagina di esempio e istruzioni su come importarla dentro un div.

#### PRO
* Rispetto dei requisiti
* Utilizzo di protocolli open
* Indipendenza da MyMaps. In caso di problematiche legate a MyMaps (o alla sua eventuale dismissione), sarà sufficiente create/importare/esportate il file in formato KMZ su un'altra piattaforma che ne permetta la gestione
* Aggiornamento asincrono. Divisione tra ambiente di test e produzione
* Facilità di gestione
* Facilità di manutenzione

#### CONTRO
* L'utilizzo di leaflet potrebbe fornire un'interfaccia di qualità inferiore rispetto a MyMaps
* Mancanza di alcune interazioni offerte da Google Maps


