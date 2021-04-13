(A) Instruction to create database and table
- Open phpmyadmin from server like xampp
- Click on import, then import alumni.sql file


(B) Instruction to connect to database

- Go in php folder of your project folder
- Inside php folder find login_detail.php inside that modify only following( line 5 ) 
	$database = "database_name_which_you_created";
	
	Suppose you created alumni then change like this
	$database = "alumni";
- Above if you are running on xampp server
- For other server change value of username, password, database name in login_detail.php accordingly
