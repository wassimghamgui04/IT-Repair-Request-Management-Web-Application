<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include("../Modele/intervantion.php");
    include("../Modele/User.php");

    function AjouterInter()
    {
        session_start();
        $user = $_SESSION["user"];
        if (!empty($_POST["id"])) {
            $id = $_POST["id"];
            $idDem = $_POST["idDem"];
            $idTech = $user->id;
            $dateInter = date("Y-m-d");
            $com = $_POST["com"];
            $inter = new Intervention($id, $idDem, $idTech, $dateInter, $com);
            return ($inter->ajouterInter());
        } else return 0;
    }
    
    function ModifierInter()
    {
        session_start();
        $user = $_SESSION["user"];
        if (!empty($_POST["id"])) {
            $id = $_POST["id"];
            $idDem = $_POST["idDem"];
            $idTech = $user->id;
            $dateInter = date("Y-m-d");
            $com = $_POST["com"];
            $inter = new Intervention($id, $idDem, $idTech, $dateInter, $com);
            return ($inter->modifierInter());
        } else return 0;
    }
    
    function SupprimerInter()
    {
        if (!empty($_GET['idSUP'])) {
            $id = $_GET['idSUP'];
            $idDem = "";
            $idTech = "";
            $dateInter = "";
            $com = "";
            $inter = new Intervention($id, $idDem, $idTech, $dateInter, $com);
            return ($inter->supprimerInter());
        } else return 0;
    }
    
    if (isset($_POST["ajouter"])) {
        $ajout = AjouterInter();
        if ($ajout)
            echo '<script>alert("Intervention ajouté")</script>';
        else
            echo '<script>alert("Référence non fournie ou Erreur d\'ajout!")</script>';
        echo '<script>document.location="../Vue/View_interADD.php"</script>';
    }
    
    if (isset($_POST["modifier"])) {
        $mod = ModifierInter();
        if ($mod)
            echo '<script>alert("Intervention modifié")</script>';
        else
            echo '<script>alert("Référence non fournie ou Erreur de modification!")</script>';
        echo '<script>document.location="../Vue/View_interADD.php"</script>';
    }
    
    if (isset($_GET['idSUP'])) {
        $suppr = SupprimerInter();
        if ($suppr)
            echo '<script>alert("Intervention supprimé")</script>';
        else
            echo '<script>alert("Référence non fournie ou Erreur de suppression!")</script>';
        echo '<script>document.location="../Vue/View_interADD.php"</script>';
    }?>
</body>
</html>