<?php
		if(!function_exists("bdd"))
		{
			function bdd():PDO
			{
					try{
					$sdn = "mysql:host=127.0.0.1;dbname=Forum";
					$usr = "root";
					$pwd = "";
					$bdd = new PDO($sdn,$usr,$pwd);
					$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}catch(Exception $e)
				{
					die('Erreur: '.$e->getMessage());
				}
				return $bdd;
			}
		}

		if(!function_exists("empty_in_post"))
		{
			function empty_in_post(array $tab):bool
			{
				foreach ($tab as $key)
				{
						if(empty($_POST[$key]) || trim($_POST[$key])=="")
						{
							return true;
						}
				}
				return false;
			}
		}

		if(!function_exists("empty_in_get"))
		{
			function empty_in_get(array $tab):bool
			{
				foreach ($tab as $key)
				{
						if(empty($_GET[$key]) || trim($_GET[$key])=="")
						{
							return true;
						}
				}
				return false;
			}
		}
		if(!function_exists("e"))
		{
			function e(string $chaine):string
			{
				return htmlentities(htmlspecialchars($chaine));
			}
		}
		if(!function_exists("autor_by_post"))
		{
			function autor_by_post($post)
			{
				$id = $post['id_autor'];
				$q = bdd()->query("SELECT * FROM users_reseau WHERE user_id = '$id'")->fetch()['user_pseudo'];
				return $q;
			}
		}
