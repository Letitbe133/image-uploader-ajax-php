# Image uploader PHP

Le but : créer un système d'upload simple mais fonctionnel permettant d'uploader sur un serveur une ou plusieurs images et de les sauvegarder en base de données.

# Steps

Les différentes étapes

## Création de la structure de fichiers

> **image_upload/**
> 
> > index.php
> 
> > **api/**
> > > **config/**
>>>> Database.php
>
>>> **models/**
>>>> Image.php
>
>>> **routes/**
>>>> save.php
>
>> **app/**
>>> **includes/**
>>>> header.php
>>>> footer.php
>
>>> **js/**
>>>> main.js
>
>> **uploads/**

## Création de la base de données

> BDD : images
> 
> > Table : images :
> > 
> > > Fields :
> > > **id**: INT, AI, PRIMARY KEY
> > > **username**: varchar(100)
> > > **save_name**: varchar(100)
> > > **size**: INT
> > > **type** : varchar(20)
> > > **local_path** : varchar(100)
> > > **created_at**: DATETIME, DEFAULT 'CURRENT_TIMESTAMP'

## index.php

### Contenu HTML

CSS && JS links :

-   [Materialize](
https://materializecss.com/getting-started.html) : https://materializecss.com/getting-started.html

Formulaire d'upload :

> **action** : ""
> **method** : POST
> 
> inputs:
> 
> > **file**:
> type=file
> name=image[]
> multiple
> 
> > **submit**: type=submit, value=Upload

## api/

### api/config/Database.php

-   La classe **Database** contient les propriétés nécessaires pour se connecter à la base de données et une méthode **connect()** qui retourne un objet PDO
-   La connection se fait à l'intérieur d'un bloc try{} catch{}

### api/models/Image.php

-   La classe **Image** contient les propriétés spécifiques à l'objet Image, un constructeur **construct()** qui prend en paramètre un objet PDO, une méthode **save_images()** qui prend en paramètre un tableau d'images
- Cette classe gère les requêtes à la base de donnée et ne fait que retourner le résultat

### api/routes/save.php

- C'est dans ce fichier qu'on va récupérer le contenu de l'input de type "file",
- Filtrer et formater les données
- Appeler la méthode **save_images()** de l'objet **Image** en lui passant un tableau d'images,
- Retourner le résultat au à l'utilisateur



## app/

### app/includes/
- Contient les fichiers :
> header.php
> footer.php

qui seront inclus dans index.php

### app/js
- Contient le fichier main.js qui permettra de faire un appel **AJAX** vers l'API

## uploads/
- Contient les fichiers images sauvegardés localement sur le serveur

# Ressources

- php.net : ([https://www.php.net/](https://www.php.net/))
- strtolower() : ([https://www.php.net/manual/en/function.strtolower.php](https://www.php.net/manual/en/function.strtolower.php))
- pathinfo() : (https://www.php.net/manual/en/function.pathinfo.php)
- time() : (https://www.php.net/manual/en/function.time.php)
- uniqid() : (https://www.php.net/manual/en/function.uniqid.php)
- array_push() : (https://www.php.net/manual/en/function.array-push.php)
- move_uploaded_file() : (https://www.php.net/manual/en/function.move-uploaded-file.php)
