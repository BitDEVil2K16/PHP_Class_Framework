# PHP_Class_Framework
Ein Framework aka System was für dich Websites erstellen kann mit dem ein oder anderen Feature.

Requirements:
- [X] Webspace oder Local [XAMP](https://www.apachefriends.org/de/index.html)
- [x] PHP >= 7.4.x
- Mit den Extensions bei bedarf oder nutzen
  - MySQL
  - Curl
  - rewrite
  - header


## Details (Beispiele):
```php
    // Beispiel js Librarys
    <?= $this->anjascript->jQuery() ?>
    <?= $this->anjascript->jQueryUi() ?>
    // Würde Jquery und jQueryUi in der Heute Aktuellsten Version verlinken 
    // und damit im gesamten System nutzbar machen
    <?= $this->anjascript->higlightjs('github-dark-dimmed') ?>
    // Die zusatz angabe ist der Skin der genutzt werden soll für HiglightJs
    // Weitere angaben sind auch bei Jquery und Co verfügbar
    // Da ist es bei JqueryUi nur minimal anders es würde die version und skin benötigen
    // Beispiele:
    <?= $this->anjascript->jQuery('3.6.0') ?>
    <?= $this->anjascript->jQueryUi('1.12.1','sunny') ?>
```

Eine ausfürliche Anleitungen / Wiki und so weiter folgen nach und nach!
Ich will versuchen den gesamten Schinken so einfach wie möglich zu gestalten

Das Ganze ist Opensource und man kann es für sein Vorhaben anpassen wie man es Möchte!
Vorausgesetzt man hat ein wenig Ahnung von dem, was man tut!

Ps: Lass den Code für dich Arbeiten, das erleichtert einiges. :+1:
