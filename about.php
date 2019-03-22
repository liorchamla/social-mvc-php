<?php

/**
 * FICHIER DE COMPREHENSION DU FONCTIONNEMENT DE CE SITE !
 * -------------------------
 * Lancez le dans votre navigateur ;-)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compréhension du réseau social MVC</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Catamaran:400,700|Istok+Web:400,700|Martel:400,700');

        body {
            font-family: Martel;
            margin: 0 auto;
            width: 60%;
        }

        h1 {
            font-family: Catamaran;
        }

        h2, h3, h4, h5, h6 {
            font-family: "Istok Web";
        }
    </style>
</head>
<body>
    <h1>Bien comprendre le site créé autour de la POO et du pattern <em>MVC</em></h1>
    <p>Ce site a été construit en très grande partie grâce à la POO et en suivant le modèle de conception (patron de conception ou "design pattern") MVC !</p>
    <h2>1. Rappel des concepts clés</h2>
    <p>Avant de se pencher spécifiquement sur la conception du site, parlons des concepts clés</p>
    <h2>1.1 Programmation Orientée Objets (POO)</h2>
    <p>La programmation orientée objets permet de voir le code de son programme / site / application sous la forme de différents Objets qui regroupent des propriétés et des comportements. Cela apporte plusieurs avantages</p>
    <ul>
        <li><strong>Clarté du code :</strong> au lieu d'avoir un ensemble désordonné de fonctions et de variables, on regroupe ces variables et fonctions dans des entités cohérentes qu'on appelle des classes et qui sont la représentation des objets qui seront utilisés</li>
        <li><strong>Protection face aux erreurs potentielles des développeurs :</strong> On empêche les développeurs de mal utiliser nos classes grâce notamment à l'<em>encapsulation des données et méthodes</em> et au système d'exceptions</li>
        <li><strong>Réutilisabilité du code :</strong> On peut réutiliser de larges partie de notre code grâce au concept d'héritage mais aussi grâce à la composition !</li>
    </ul>
    <p>On utilise les classes partout dans ce site, ainsi que les objets, l'héritage, l'encapsulation des données et méthodes, les méthodes et propriétés statiques etc. Il faut donc avoir une bonne idée de la POO avant d'essayer d'étudier ce site (même si bizarrement, étudier ce site vous aidera à comprendre mieux la POO aussi ..)</p>

    <h2>1.2 Le patron de conception (Design Pattern) MVC</h2>
    <p>Ce site est construit entièrement autour du modèle MVC (Model / Views / Controller) qui postule qu'une application web doit séparer ce qui concerne le traitement de la requête HTTP (analyse de la requête et production d'une réponse) du ce qui concerne l'accès aux données et de ce qui concerne enfin les détails et modalités d'affichage.</p>
    <ul>
        <li><strong>Le controller gère la requête HTTP : </strong>Le but unique et ultime du controller est d'analyser la requête HTTP (quelles sont les demandes, les informations passées en GET ou en POST, quel est l'état de la SESSION ?) afin d'en déduire les actions à mener (faut-il aller chercher des données dans la base ? En ajouter ? En modifier ?) et enfin afficher une vue ou rediriger vers une autre page.</li>
        <li><strong>Le model gère l'accès aux données : </strong>Il est interdit au controller de se connecter directement à la base de données et de manipuler lui même les données. Il délègue ce travail au model, dont c'est la mission exclusive. Le model n'a d'ailleurs pas le droit de toucher à la requête HTTP ou à la Reponse HTTP. Il ne fait que manipuler les données de la base sur ordre du controller.</li>
        <li><strong>La vue ne gère que l'affichage des données : </strong>Le fichier de vue a pour mission de détailler la façon d'afficher les choses, il ne gère pas la requête HTTP (rôle du controller), il ne se connecte pas à la base (rôle du model), il ne fait qu'afficher !</li>
    </ul>
    <h2>2. Organisation des fichiers</h2>
    <h3>2.1 Le dossier <em>libraries</em></h3>
    <p>Ce dossier contient des librairies utiles, présentées sous forme de classes. Outre les controllers et les models dont on parlera plus tard, il contient 3 classes <em>utilitaires</em> dont les méthodes sont static afin d'être appelées directement sur les classes et donc de ne pas avoir systématiquement à instancier des objets :</p>
    <ul>
        <li>La classe Session : elle permet de faciliter tout ce qui a un rapport avec la session HTTP (gestion des messages flash, utilitaires concernant la connexion de l'utilisateur, etc)</li>
        <li>La classe Http : elle permet de faciliter les redirections</li>
        <li>La classe Request : elle permet d'extraire facilement des données de la Requête HTTP, que ce soit en GET ou en POST</li>
    </ul>
    <h3>2.2 Le dossier libraries/controllers</h3>
    <p>Il contient les classes des Controllers, celles qui sont utilisées pour répondre à une requête HTTP envoyée par un visiteur.</p>
    <p>Ces classes possèdent des méthodes qui seront appelées à chaque requête d'un utilisateur afin de prendre en charge la requête, de controller que tout ce qui est nécessaire est présent, d'extraire les données du GET ou du POST, d'intéragir avec les données par le biais des models et d'afficher enfin une réponse à l'utilisateur, soit par le biais d'affichage de PHTML (les vues) soit par une redirection.</p>
    <h4>2.2.1 Héritage de la classe abstraite <em>Controller</em></h4>
    <p>Comme tous les controllers partageaient des méthodes et des propriétés communes, on les a rassemblées dans une classe Controller qui est abstraite (car on ne souhaite pas qu'un développeur s'en serve directement). Le fait que tous les controllers héritent de cette classe Controller qui possèdent des méthodes et propriétés leur permet, eux aussi, d'en bénéficier.</p>
    <p><strong>Si, dans un controller vous voyez par exemple qu'on utilise la fonction $this->redirectWithError(...) et que vous ne voyez pas où est définie cette fonction dans ce controller, il y a de fortes chances pour qu'elle provienne en fait du Controller parent ;-)</strong></p>
    <h4>2.2.2 Les controllers, leurs buts et leurs outils</h4>
    <p>Chaque controller peut avoir le nombre de fonction qu'il veut. Le but de chaque fonction est de :</p>
    <ul>
        <li>Controller la requête HTTP (extraire les données du GET ou du POST, vérifier les erreurs, la Session HTTP, etc)</li>
        <li>Aller chercher ou manipuler des données grâce à un Model</li>
        <li>Renvoyer une réponse qui soit un affichage d'une vue (fichiers PHTML) ou une redirection, bref : répondre au visiteur !</li>
    </ul>
    <p>Chaque controller possède un Model qui lui permet de discuter avec la base de données. Le model est construit automatiquement à la naissance du controller.</p>
    <p>Un controller possède aussi (merci à l'héritage de la classe abstraite Controller) des méthodes permettant de rediriger et de faire des messages d'erreur facilement !</p>

    <h3>2.3 Le dossier libraries/models</h3>
    <p>Ce dossier contient les classes qui représentent les Models !</p>
    <h4>2.3.1 Responsabilités des Models dans le pattern MVC</h4>
    <p>Le but d'un model est de faire l'intermédiaire entre nous et la base de données. Ils nous facilitent la gestion des données et surtout ils permettent de tout gérer d'un même endroit. Si un changement survient sur la base ou dans les tables, les models seront les seuls fichiers à modifier.</p>
    <p><strong>Il est interdit à un model de se servir des données de la Requête HTTP ou de la Session !</strong> Ce n'est pas le travail des models mais des Controllers. Les models ne sont là que pour intéragir avec la base de données !</p>

    <h4>2.3.2 Héritage de la classe abstraite <em>Model</em></h4>
    <p>Comme les models avaient tous des méthodes et prioriétés identiques, on a rassemblé dans une classe Model abstraite tout ce qui était semblable, pour ne pas le répéter.</p>

    <h4>2.3.3 Les outils que possèdent nos Models</h4>
    <p>Toutes les classes de model qui héritent de la classe abstraite Model ont directement accès à certaines méthodes utiles :</p>
    <ul>
        <li><strong>findAll() :</strong> elle permet d'aller chercher toutes les lignes d'une table</li>
        <li><strong>find($id) : </strong> elle permet d'aller chercher une ligne en particulier dans la table</li>
        <li><strong>delete($id) : </strong> elle permet d'aller supprimer une ligne en particulier dans la table</li>
        <li><strong>insert($array) : </strong> elle permet d'insérer une nouvelle ligne dans la table</li>
        <li><strong>update($array) :</strong> elle permet de mettre à jour une ligne dans la table</li>
    </ul>

    <h1>Le fonctionnement !</h1>
    <p>Maintenant que l'on connait la structure de l'application, il faut comprendre comment elle fonctionne.</p>
    <h2>1. Un fichier pour les gouverner tous : index.php</h2>
    <p>Dans cette application, la seule page qui sera appelée par l'utilisateur c'est toujours <strong>index.php</strong> ! Quelque soit l'action que l'utilisateur veut faire, il appellera index.php et c'est en fonction des paramètres GET que l'on passera à index.php que le site saura réagir !</p>

    <h3>1.1 Choisir le controller qu'on souhaite appeler</h3>
    <p>Puisque tout passe toujours par le fichier index.php, comment lui dire quel controller on veut appeler, quelle partie du site on veut utiliser ?</p>
    <p>Il suffit de lui passer en GET un paramètre nommé <strong>controller</strong> et qui contiendra le <strong>préfixe</strong> du controller que l'on souhaite appeler. Par exemple :</p>
    <ul>
        <li><strong>index.php?controller=users</strong> appellera le controller UsersController</li>
        <li><strong>index.php?controller=status</strong> appellera le controller StatusController</li>
        <li><strong>index.php?controller=cocorico</strong> appellera le controller CocoricoController</li>
    </ul>
    <p>Si l'on ne précise pas à l'index.php quel controller on veut appeler, il appellera par défaut le controller StatusController !</p>

    <h3>1.2 Choisir l'action que l'on souhaite effectuer sur le controller</h3>
    <p>On sait comment expliquer au site quel controller on veut appeler, mais comment ljui dire quelle est la fonction du controller que l'on veut appeler ?</p>
    <p>Pareil ! En lui passant l'information en GET avec le paramètre <strong>task</strong> :</p>
    <ul>
        <li><strong>index.php?controller=users&task=save</strong> appellera la méthode save() du UsersController</li>
        <li><strong>index.php?controller=status&task=show</strong> appellera la méthode show() du StatusController</li>
        <li><strong>index.php?task=save</strong> appellera la méthode save() du StatusController (n'oubliez pas, quand on ne précise pas de paramètre controller dans le GET, c'est le StatusController qui est appelé par défaut)</li>
        <li><strong>index.php</strong> appellera la fonction index() du StatusController</li>
    </ul>
    <p>Lorsqu'on ne précise pas de paramètre <strong>task</strong>, le site prendra la tâche <strong>index</strong> par défaut.</p>

    <h2>2. Le fichier de configuration</h2>
    <p>Comme nous sommes désormais surs que toutes les pages s'affichent en passant par l'index.php, si on souhaite qu'une fonction ou une librarie soit disponible dans tous nos autres fichiers, il suffit de faire un <strong>require</strong> au niveau de notre index.php.</p>
    <p>Le fichier de configuration contient donc des constantes utiles dans tout le site, et qui seront donc faciles à modifier en cas de besoin, et aussi les require les plus utiles (Session.php, Request.php et Http.php, mais vous pouvez vous-mêmes en rajouter !).</p>

    <h1>Et voilà ! A vous de vous amuser !</h1>
    <p>Lisez les fichiers de code, en commençant par l'index.php et le configuration.php, allez voir les controllers, essayez de créer votre propre controller et faites un CRUD sur une nouvelle table ! Faites vous plaisir</p>
    <a href="index.php">Voir le réseau social MVC</a>

</body>
</html>
