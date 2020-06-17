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

if(!function_exists("e"))
{
    function e(string $str):string
    {
        return htmlentities(htmlspecialchars($str));
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

        $prof = getCnxEleve()->query("SELECT * FROM professeur WHERE id_prof=$id")->fetch();
        return $prof["prenom_prof"]." ".$prof['nom_prof'];
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
if(!function_exists("cours_of"))
{
    function cours_of(int $id):string
    {
        $cours = getCnxEleve()->query("SELECT * FROM cours WHERE id_prof = $id")->fetchAll();
        $html_cours = "";
        foreach($cours as $cour)
        {
            $html_cours .= "<span style='font-size:12px;'>".$cour['nom_classe'].":".$cour['nom_cours']."</span><br>";
        }
        return $html_cours;
    }
}
if(!function_exists("setProf_of_cours"))
{
    function setProf_of_cours($cours_name, $classe, $id):bool
    {
        $q  = getCnxEleve()->prepare("UPDATE cours SET id_prof=? WHERE nom_cours=? AND nom_classe=?");
        return $q->execute(  [  $id,    $cours_name,    $classe ] );
    }
}
if(!function_exists("conserve_param"))
{
    function conserve_param(array $data, $key, $value):string
    {
        return http_build_query(array_merge($data, [$key => $value]));
    }
}
if(!function_exists("conserve_with_params"))
{
    function conserve_with_params(array $data, array $params):string
    {
        return http_build_query(array_merge($data,$params));
    }
}
if(!function_exists("column_sortable"))
{
    function column_sortable(string $sortKey, string $label, array $data):string
    {
        $trie   = $data["trie"] ?? null;
        $dir    = $data["direction"] ?? null;
        $icon   = "";
        if($trie == $sortKey)
        {
            $icon   = in_array($dir, ["asc", "ASC"]) ? "▲" : "▼";
        }
        $url    = conserve_with_params($data, ["trie" => $sortKey,
        "direction" => in_array($dir, ["asc", "ASC"]) && ($trie == $sortKey) ? "DESC" : "ASC"]);

        return "<a href=?$url>".$icon." ".$label."</a>";
    }
}