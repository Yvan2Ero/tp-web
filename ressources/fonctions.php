<?php

define("USER", "root");
define("PWD", "");
define("MON_EMAIL", "yvankanaj@gmail.com");

if(!function_exists('empty_in_post'))
{
    function empty_in_post(array $array)
    {
        foreach($array as $elt)
        {
            if(empty($_POST[$elt]) || trim($_POST[$elt])=="")
            {
                return true;
            }
        }
        return false;
    }
}

if(!function_exists('empty_in_get'))
{
    function empty_in_get(array $array)
    {
        foreach($array as $elt)
        {
            if(empty($_GET[$elt]) || trim($_GET[$elt])=="")
            {
                return true;
            }
        }
        return false;
    }
}

if(!function_exists("echaper"))
{
    function echaper(string $str):string
    {
        return htmlentities($str);
    }
}
if(!function_exists("getCnxEleve"))
{
    function getCnxEleve():PDO
    {  
        global $user; global $pwd;
        try {
            $sdn = "mysql:host=127.0.0.1;dbname=Lycee;port=3306;charset=utf8";
            $cnx = new PDO($sdn, USER, PWD);
        } catch (PDOException $e) {
            die("Ereur de connection à la base de données!");
        }
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $cnx;
    }
}

if(!function_exists("getCnxReseau"))
{
    function getCnxReseau():PDO
    {
        try {
            $sdn = "mysql:host=localhost;dbname=Forum;port=3306;charset=utf8";
            $cnx = new PDO($sdn, USER, PWD);
        } catch (PDOException $e) {
            die("Ereur de connection à la base de données!".$e->getMessage());
        }
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $cnx;
    }
}
if(!function_exists("convert"))
{
    function convert(string $str):string
    {
            return $str = str_replace('è','e',str_replace('à','a',str_replace('ç','c',str_replace('é','e', $str))));
    }
}
if(!function_exists("exists_pseudo"))
{
    function exists_pseudo(string $pseudo):bool
    {
        $q = getCnxReseau()->prepare("SELECT user_id FROM users_reseau
                                     WHERE user_pseudo = :pseudo");
        $q->execute(["pseudo" => $pseudo]);
        if(!$q)
        {
            return false;
        }
        else{
            return !empty($q->fetchAll());
        }
    }
}

if(!function_exists("exists_email"))
{
    function exists_email(string $email):bool
    {
        $q = getCnxReseau()->prepare("SELECT user_id FROM users_reseau
                                     WHERE user_email = :email");
        $q->execute(["email" => $email]);
        if(!$q)
        {
            return false;
        }
        else{
            return !empty($q->fetchAll());
        }
    }
}

if(!function_exists("get_teacher"))
{
    function get_teacher(string $matiere, string $classe):string
    {
        $id = getCnxEleve()->query("SELECT id_prof FROM cours
                                    WHERE nom_cours = '$matiere 'AND nom_classe = '$classe'")->fetch()['id_prof'];

        $nom = getCnxEleve()->query("SELECT nom_prof FROM professeur WHERE id_prof=$id")->fetch()['nom_prof'];
        return $nom;
    }
}
if(!function_exists("get_ses"))
{
    function get_ses(string $key)
    {
        if(array_key_exists($key, $_SESSION))
            return $_SESSION[$key];
    }
}
if(!function_exists("prof_autorisation"))
{
    function prof_autorisation()
    {
        $q = getCnxEleve()->prepare("SELECT id_prof FROM cours WHERE nom_cours = ? AND nom_classe = ?");
        $q->execute([$_SESSION['cours_sel'], $_SESSION['classe']]);
        return($q->fetch()["id_prof"] == $_SESSION["id_admin"]);
    }
}