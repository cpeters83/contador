<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <title>Login</title>
        <link href="login.css" rel="stylesheet" type="text/css">
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

         
        if (isset($_POST['username'], $_POST['password'])){
				try {
					$connection = new PDO($dsn, $username, $password, $options);
					$usuario = $_POST["username"];                
					$password = $_POST["password"];
					$sql = "SELECT id, password FROM cuentas WHERE username = :username";            
					$statement = $connection->prepare($sql);
					$statement->bindValue(':username', $usuario);
					$statement->execute();
					$count = $statement->rowCount(); 
					$results = $statement->fetchAll();
					
					foreach($results as $results){
						$hash = $results["password"];
					}


					if($count > 0)  
					{
						if(password_verify($password,$hash))
						{
							echo "existe";
						}else{
							echo "password incorrecta";
						}
					}else{
						echo "no existe";
					}
                  



				} catch(PDOException $error) {
					echo $sql . "<br>" . $error->getMessage();
				}
				
				unset($hash,$usuario,$password);
		                   
        }
        
?>


	<body>
		<div class="login">
			<h1>Login</h1>
			<form action="index.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
			</form>
		</div>
	</body>
</html>