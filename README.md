# Olimpiadi Raffaellesche
Piattaforma web per le Olimpiadi Raffaellesche, organizzate dall'Accademia Raffaello di Urbino e svolte in occasione del 500° anniversario della morte di Raffaello.

## Funzionalità
Tramite questa piattaforma è possibile:
 - Registrare e gestire gli utenti;
 - Modificare il comportamento e lo svolgimento del quiz (come l'impostazione della data e dell'ora di inizio e di fine, oppure la durata complessiva);
 - Gestire le domande e le immagini allegate a queste;
 - Controllare in tempo reale l'andamento del quiz e degli utenti che lo stanno svolgendo.

## Realizzazione
Il software è stato realizzato utilizzando le tecnologie web (HTML, CSS, JavaScript) e il linguaggio di programmazione back-end PHP.
E' possibile installare questa piattaforma nel proprio server (o in generale in un qualsiasi computer che esegue una distribuzione Linux). I pacchetti consigliati sono:

 - Apache2 (il web server);
 - PHP7 (ad esempio 7.3 o 7.4);
 - MySQL versione 5.7 (è consigliata questa versione per poter eseguire anche la versione di PhpMyAdmin integrata nelle repository di Debian, la versione 4.6.6; tuttavia se si usa una versione differente è possibile selezionare la versione di MySQL che più si desidera).

### Per installare i pacchetti in Linux:

    apt install apache2 php
(per Debian e distro derivate, come Ubuntu, Linux Mint, Pop!_OS)

    dnf install apache2 php
(per Fedora e distro derivate)

    pacman -S apache2 php
(per Arch Linux e derivate, come Manjaro)

Per altre distribuzioni fare riferimento alla guida della propria distribuzione.

Riguardo all'installazione di MySQL riferirsi alla [guida di installazione ufficiale di MySQL](https://dev.mysql.com/doc/refman/8.0/en/linux-installation.html).
## Autori
Federico Arduini, Rocco Nori, Christian Chiuselli, Martin Berardi, Filippo Sani, Lorenzo Annibalini, della classe 5AIN dell'Istituto Tecnico Industriale Statale "Enrico Mattei" di Urbino - PU
