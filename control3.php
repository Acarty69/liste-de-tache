<?php
// permet de créer une session qui permettra de stocker les données de l'utilisateur
session_start();




    // $testarray=explode("\n",$test);
    // $test=$_POST['titre'];
    // $test2=$_POST['tache'];


    
    //permet de faire les différentes action si et seulement si les valeurs titre et taches sont rentré

    if(isset($_POST['titre']) and (isset($_POST['tache'])))
    {  
        // si la valeur session tache est initialisé fait les actions qu'il y a en dessous

        if(isset($_SESSION['tache'])){
            
            // si la valeur date est initialisé fait les action qu'il y a en dessous

            if (isset($_POST['date']))
        {
            // la valeur date rentré par l'utilisateur est transformé en date

        $date= new DateTime($_POST['date']);

        // crée une date sous le même format que celle rentré par l'utilisateur jour-mois-année
        
        $date2= new DateTime(date("d-m-Y"));

        // si $date < $date2 alors

        if ($date < $date2)

        {
            //affiche a l'utilisateur

            echo "Ta tache aurait du être faite plus tôt elle sera donc stocké dans un fichier text 'expiré.txt ";  
            file_put_contents('expiré.txt',"<br>Titre de la tache expiré :". $_POST['titre'] . "\n<br>" . "Tache expiré : " . $_POST['tache'] . "\n<br>");

        }

        //sinon du if ($date < $date2)

        else

        {
            //affiche a l'utilisateur

        echo " tu as encore le temps de faire ta tache ";

        // si la valeur fini est rentré par l'utilisateur 

        if(isset($_POST['fini']) and $_POST['fini'] == "oui")
            {

                // met dans le fichier tachefini.txt la valeur entrée apres la première

            file_put_contents('tachefini.txt', "<br>Titre de la tache fini :". $_POST['titre'] . "\n<br>" . "Tache fini : " . $_POST['tache'] . "\n<br>" ,FILE_APPEND);

            }

            // sinon du if(isset($_POST['fini']) and $_POST['fini'] == "oui")

            else

            {
                // crée un tableau avec comme clé [$_POST['titre'] et comme valeur $_POST['tache']

                $_SESSION['tache'][$_POST['titre']] = $_POST['tache'];
                //file_put_contents('tache.txt',$_POST['titre']."\n".$_POST['tache'] ."\n",FILE_APPEND);
            }
        }
        }

        else

        {
            //affiche a l'utilisateur "rentre la date" si la date n'est pas rentrée

            echo " rentre la date ";
        }
    }    

        //sinon du  if(isset($_SESSION['tache']))
        else{
            $_SESSION['tache']=[];
        }
        
        

        
       
        // array_push($tache,[$_POST['titre'] => $_POST['tache']]);
        // $tache += [$_POST['titre'] => $_POST['tache']];
        

        // si le bouton tout supprimer supprtout est cliqué par l'utilisateur
        if(isset($_POST['supprtout']))
    {
        // foreach ($_SESSION['tache'] as $value) {
        //     unset($_SESSION['tache'][array_search($value,$_SESSION['tache'])]);
        // }
        // file_put_contents('tache.txt'," ");

        //détruit la session

        session_destroy();

        //vide le fichier tachefini.txt

        file_put_contents('tachefini.txt'," ");

        //vide le fichier tache.txt

        file_put_contents('tache.txt'," ");

         //vide le fichier expiré.txt

        file_put_contents('expiré.txt'," ");
        
        //saute une ligne puis affiche a l'utilisateur

        echo " <br> toute les taches ont bien été supprimer <br>";

    }

    //si le bouton "supprime une tache au hasard" est cliqué par l'utilisateur

    if(isset($_POST['suprr']))
    {

        //le nombre d'élément contenue dans le tableau $_SESSION['tache'] est attribué a $number

        $number=count($_SESSION['tache']);

        //supprime de $_SESSION['tache'] l'élément situé a l'index aléatoire entre le premier élément (0) et le dernier élément ($number-2) et supprime un élément (1)

        array_splice($_SESSION['tache'],rand(0,$number-2),1);
    }

    //si le bouton "Affiche mes taches" est cliqué par l'utilisateur

    if(isset($_POST['affiche']))

    {
    //     echo " voici vos taches pas fini : <br> ";
    //     foreach ($_SESSION['tache'] as $key => $value)
    //     {
    //         echo $key . "<br>". $value ."<br>";
    //     }
    //     $tachefini=file_get_contents('tachefini.txt');
    //    // echo "voici vos taches fini : <br>" . $tachefini. "<br>";
    //     $arraytachefini=explode("\n",$tachefini);
    //     echo "<br> Vos taches finis sont : <br><br>";
    //     foreach ($arraytachefini as $value)
    //     {
    //         echo $value . "<br>";
    //     }

    //Parcours tout le tableau $_SESSION['tache'] la valeur $_POST['date'] est affécté a $ladate puis affiche a l'utilisateur une div pour chacune de ses tâches
    // avec du texte les valeurs $ladate,$key(le titre de la tache) ,$value(le description de la tâche)
    $ladate= $_POST['date'];
    foreach ($_SESSION['tache'] as $key => $value) {

        
       
        
        echo "<div class='test'>
        <p class='padding'> Le nom de la tache que tu dois faire pour le $ladate <br> Dont le titre est :  $key <br> C'est ca : $value . <br> <br> <br>
        </p>


        </div>";
    }

    //$tachefini récupère le contenue du fichier tachefini.txt

    $tachefini=file_get_contents('tachefini.txt');

    //$tacheexpire récupère le contenue du fichier éxpiré.txt

    $tacheexpire=file_get_contents('expiré.txt');

    // crée 2div différente pour les taches finis et expirés

    echo "<div class='test' ><p class='padding'> Vos Tache finis se trouve ici: <br>
        $tachefini </p></div>";
        echo "<div class='test' ><p class='padding'> Vos Tache éxpiré se trouve ici: <br>
        $tacheexpire </p></div>";
    }
   
}
    
    else
    {
        echo "Vérifie que tu as bien remplie toute les cases";
    }
    
   

    var_dump($_SESSION['tache']);
    
    // $test=file_get_contents('tache.txt');
    // echo $test;
    // if(isset($_SESSION['time']))
    //     {
    //     $_SESSION['time'][$_POST['date']]=$_SESSION['tache'];

    //     }
    //     else 
    //     {
    //     $_SESSION['time']=[];
    //     }
    
?>


<html>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Document</title>
    </head>
    <body>
        <form method="post">
            <input type="text" name="titre" placeholder="Titre">
            <br>
            <input type="textarea" name="tache" placeholder="Tache">
            <br>
            <input type="text" placeholder="Finis ? oui ou non" name="fini">
            <br>
            <input type="text" placeholder="Pour quand dois-tu la finir (format jj-mm-aaaa)" name="date">
            <p>Que souhaite-tu faire</p>
            <input class="submit" type="submit" value="Mettre en ligne ma tache">

            <input class="submit" type="submit" name="supprtout" value="tout supprimer">
            <input class="submit" type="submit" name="suprr" value="supprime une tache au hasard">
            <input class="submit" type="submit" name="affiche" value="Afficher mes taches">
            
            

        </form>
    </body>
    </html>
    