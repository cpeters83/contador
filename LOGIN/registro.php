<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <title>Register</title>
        <link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    

<?php
        /*Parametros de conexion a base de datos*/
        $host       = "localhost";
        $username   = "root";
        $password   = "M3tr02017";
        $dbname     = "testing";
        $dsn        = "mysql:host=$host;dbname=$dbname"; 
        $options    = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        function escape($html) {
            return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
        }

         
        if (isset($_POST['username'])){
       
            
           try  {
                $connection = new PDO($dsn, $username, $password, $options);
                $new_user = array(
                "username" => $_POST['username'],
                "password"  =>  password_hash($_POST['password'], PASSWORD_DEFAULT),
                "email" => $_POST['email']
                );

                $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "cuentas",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
                );
                
                $statement = $connection->prepare($sql);
                $statement->execute($new_user);
                


            } catch(PDOException $error) {
                echo $sql . "<br>" . $error->getMessage();
            }

        unset($_POST["username"],$_POST["email"],$_POST["password"]);
            
        }
        
?>


	<body>
		<div class="register">
			<h1>Registro de nuevo usuario</h1>
			<form action="registro.php" method="post" autocomplete="off">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<label for="email">
					<i class="fas fa-envelope"></i>
				</label>
                <input type="email" name="email" placeholder="Email" id="email" required>
                <input type="submit" value="Registrar nuevo usuario">
             </form>
		</div>
	</body>
</html>