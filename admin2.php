<?php
	
	
	function recievefile(){
		//Create connection to the server
			@$connect=mysqli_connect("localhost","root","saazi","recess");
		//Select the database created
		//@$db=mysql_select_db("recess");
		@$first=$_POST['first'];
		@$staffId=$_POST['receiptNo'];
		@$Salary=$_POST['camount'];
		@$fname=$_POST['date'];
		@$lname=$_POST['memberId'];
		@$adminid = $_POST['adminstratorId'];
		@$staffId18=$_POST['submit'];
		@$staffId2=$_POST['adminsId'];
		@$staffId3=$_POST['adminspassword'];
		@$lamoun = $_POST['lamount'];
		@$lmember = $_POST['lmemberId'];
		@$ladId = $_POST['adminId'];
		@$username = $_POST['description'];
		@$memberid = $_POST['capital'];
		@$password = $_POST['imemberId'];
		//$contribute = $_POST['contribute'];
		@$adminid5 = $_POST['adminstratorId'];
		@$adminid57 = $_POST['ideaId'];
		
		@$repayDate2 = $_POST['rdate'];
		@$cedit1 = $_POST['ramount'];
		@$memberIdentity = $_POST['memberiD'];
		@$administratorIdentity = $_POST['adminstratid'];
		
		
		
		if($first=="contribution"){
			if(mysqli_query($connect,"INSERT INTO contribution(receiptNo,amount,date,memberId,status,administratorId) 
			VALUES('$staffId','$Salary','$fname','$lname','$staffId18','$adminid')")){}
			/*{
				echo "<script>alert('Submited successfully')</script>";

			}else{
				echo "<script>alert('Failed')</script>";

			}*/
			
			if(mysqli_query($connect, "INSERT INTO administrator(administratorId,password) 
			VALUES('$staffId2','$staffId3')")){}
			/*{
				echo "<script>alert('Submited successfully')</script>";
	
			}else{
				echo "<script>alert('Failed')</script>";
			
			}*/
			
			if($staffId18=="Accepted"){
				@$result="SELECT memberId,amount FROM contributioncheck WHERE memberId='$lname'";
				if($log=mysqli_query($connect, $result))
				{
					echo "<script>alert('Selected successfully')</script>";
					$row=mysqli_fetch_array($log);
			
					$newamount=$row['amount']+$Salary;
				
					@$result1="DELETE FROM contributioncheck WHERE memberId='$lname'";
					mysqli_query($connect, $result1);
					if(mysqli_query($connect,"INSERT INTO contributioncheck(memberId,amount) 
					VALUES('$lname','$newamount')")){}
					/*{
						echo "<script>alert('Submited successfully')</script>";
					
					}else{
						echo "<script>alert('Failed')</script>";

					}*/
					
				}
				
				/*else{
					//echo "<script>alert('Selected Failed')</script>";
				
				}*/
			}
		}
		
		if($first=="loan_request"){
			
			if($staffId18=="Accepted"){
				@$regular="SELECT memberId FROM regularmembers WHERE memberId = '$lmember'";
				if($regular1=mysqli_query($connect, $regular)){
					$row=mysqli_fetch_array($regular1);
					$memberid=$row['memberId'];
					
					@$contrib="SELECT amount FROM contributioncheck WHERE memberId = '$memberid'";
					if($contrib1=mysqli_query($connect, $contrib)){
						$row=mysqli_fetch_array($contrib1);
						$mamount=$row['amount'];
						$hamount=$mamount*0.5;
						
						if($hamount>=$lamoun){
							mysqli_query($connect,"INSERT INTO loan_request(amount,memberId,administratorId,status) 
								VALUES('$lamoun','$memberid','$ladId','$staffId18')");
						}else{
							mysqli_query($connect,"INSERT INTO loan_request(amount,memberId,administratorId,status) 
								VALUES('$lamoun','$memberid','$ladId','Rejected')");
						}
					}
				}
					
				
				
			}
		}
		
		if($first=="loan_repayment"){
			
			if($staffId18=="Accepted"){
				@$repay2="SELECT loan_repayment_date,debit FROM loan_repayment WHERE memberId = '$memberIdentity'";
				if($repay3=mysqli_query($connect, $repay2)){
					
					$cols9 = $repay3->num_rows;
					$maxd=0;
					for($j=0;$j<$cols9;++$j){
						$row=mysqli_fetch_array($repay3);
						$repdate=$row['loan_repayment_date'];
						if($repdate>$maxd){
							$maxd=$repdate;
							$rmount=$row['debit'];
						}
					}
					$debit1=$rmount-$cedit1;
					if($debit1<0){
						mysqli_query($connect,"INSERT INTO loan_repayment(loan_repayment_date,credit,debit,memberId,administratorId) 
							VALUES('$repayDate2','$cedit1','$debit1','$memberIdentity','$administratorIdentity')");
					}
					
				}else{
					@$repay="SELECT amount,status FROM loan_request WHERE memberId = '$memberIdentity' AND status='Accepted'";
					if($repay1=mysqli_query($connect, $repay)){
						$row=mysqli_fetch_array($repay1);
						$reamount=$row['amount'];
						$debit1=($reamount+($reamount*0.03))-$cedit1;
						
						if($staffId18=="Accepted" || $staffId18=="Rejected"){
							echo "$staffId18";
							mysqli_query($connect,"INSERT INTO loan_repayment(loan_repayment_date,credit,debit,memberId,administratorId) 
									VALUES('$repayDate2','$cedit1','$debit1','$memberIdentity','$administratorIdentity')");
						}
			
				
					}
				}
			}	
		}
		
		if($first=="idea"){
			if($staffId18=="Accepted" || $staffId18=="Rejected"){
				echo "$staffId18";
				if(mysqli_query($connect,"INSERT INTO idea(name,capital,description,memberId,administratorId,status) 
				VALUES('$adminid57','$memberid','$username','$password','$adminid5','$staffId18')"))
				{
					echo "<script>alert('Submited successfully')</script>";
			
				}else{
					echo "<script>alert('Failed')</script>";
			
				}
			}
			
		}

		
		
	}	
	
	function createforms(){
		//Get table name selected by the user 
		@$searchtype = $_POST['searchtype'];
		   //Connect to the server and database
		@ $db = new mysqli("localhost", "root","saazi","recess");
		//Check connection and return an error message if connection is not successful
		if(mysqli_connect_errno()){
			echo "Error:could not connect to database";
			exit;
		}
		//Retrive all data from the user specified table.
		$qury = "select * from .$searchtype" ;
		$result8 = $db->query($qury);
	
		@$num_r8 = $result8->num_rows;
		echo "<!DOCTYPE html>";
		echo "<html>";
			echo "<head>";
		
			
				echo "<meta charset='UTF-8'>";
				echo "<style type='text/css'>";

						echo "body{";
							echo "margin-left:10%;";
							echo "width:65em;";
							echo "border: .5em solid blue;";
							echo "border-radius: 5px;";
							echo "border-top: 3em solid blue;";
							echo "box-shadow: 4px 4px black;";
						echo "}";
						echo "table{";
							echo "background-color:whitesmoke;";
							echo "border: 0;";
							echo "margin-left:25%;";
							echo "margin-right:15%;";
							echo "align:center;";
						echo "}";
						
						
						echo "table tr td{";
							echo "cell-padding:2em;";
							echo "cell-spacing:4em;";
							echo "border-collapse:separate;";
							echo "text-align:center;";
							
						echo "}";
						echo "header{";
							echo " border:3px solid blue;";
							echo " background-color:blue;";
							echo " color:white;";
						echo "}";
				echo "</style>";

			echo "</head>";
			
		echo "<body>";
				echo "<header>";
				echo "<h1 align='center'><strong>FAMILY SACCO</strong></h1>";
				echo "</header>";
			echo "</p>"; 
				/*echo "<a href='admin2.php?action=addLoan' style='text-decoration:none;'><input type='button' value='LOAN REPAYMENT DETAILS' style='width:20%; margin-left:20%; background-color:lightblue;'></a>";*/
				echo "<a href='admin2.php?action=addinvest' style='text-decoration:none;'><input type='button' value='INVESTMENT DETAILS' style='width:15%; background-color:lightblue;'></a>";
				echo "<a href='admin2.php?action=addmember' style='text-decoration:none;'><input type='button' value='ADD MEMBERS' style='width:15%; background-color:lightblue;'></a>";
				echo "<a href='?action=homepage' style='text-decoration:none;'><input type='button' value='HOME PAGE' style='width:15%; background-color:lightblue;'></a>";
		
			echo "</p>"; 
			
			if($searchtype== "regularmembers"){
				$Count=0;
				$var=30*6*24*60*60;
				$date=date("Y-m-d");
				$you=date("Y-m-d",time()-$var);
				//echo date("Y-m-d H:i:s",time()-$var);
				echo "$date\n";
				echo "$you";
				
				/*if($you<$date){
					echo "$date is greater than $you";
				}*/
				@$connect=mysqli_connect("localhost","root","saazi","recess");
				
				@$result="SELECT memberId FROM member";
				if($log9=mysqli_query($connect, $result))
				{
				
					$num_r9 = $log9->num_rows;

					for($j=0;$j<$num_r9;++$j){
							$Count=0;
							echo "$j";
						$row9=mysqli_fetch_array($log9);
						$memb=$row9['memberId'];
						echo "the first member $memb\n\n";
						/*if($member>$you){
							echo "$member is greater than $you\n\n";
							$sum=$row['memberId'];
							echo "$sum\n\n";*/
							
						@$result="SELECT * FROM contribution WHERE memberId ='$memb'";
						if($log=mysqli_query($connect, $result))
						{
							$num_r = $log->num_rows;
							for($m=0;$m<$num_r;++$m){
								$row=mysqli_fetch_array($log);
								$date=$row['date'];
								if($date>$you){
									$Count++;
									echo "$Count\n";
								}
							}
							if($Count>=6){
								//$memberid=$da;
								$da=$row['memberId'];
								echo "with count greater than 5 $da\n";
								
								@$result2="SELECT memberId,username FROM member WHERE memberId ='$da'";
								if($log2=mysqli_query($connect, $result2))
								{
									$num_r2 = $log2->num_rows;
									
									for($n=0;$n<$num_r2;++$n){
										
										$row2=mysqli_fetch_array($log2);
										$member2=$row2['username'];
										
									}
									
								}
								
								@$result3="DELETE FROM regularmembers WHERE memberId='$da'";
								mysqli_query($connect, $result3);
								if(mysqli_query($connect,"INSERT INTO regularmembers(memberId,username) 
								VALUES('$da','$member2')")){}
								/*{
								echo "<script>alert('Submited successfully')</script>";
								
								}else{
								echo "<script>alert('Failed')</script>";
								
								}*/
							}
						}
						
						
						
					}	
				}
				$qury = "select * from regularmembers" ;
				$result8 = $db->query($qury);
	
				$num_r8 = $result8->num_rows;
				
				echo "<table border='1'>";
				echo "<tr>";
				echo "<td colspan='5' style='text-align:center'>"."LOAN DETAILS"."</td>";
				echo "</tr>";
				echo "<tr id='ni'>";
				echo "<td>"."memberId.</td>";
				echo "<td>"."username</td>";
				echo "</tr>";
				for($j=0;$j<$num_r8;++$j){
					$row=mysqli_fetch_array($result8);
					echo "<tr>";
					echo "<td>".$row['memberId']."</td>";
					echo "<td>".$row['username']."</td>";
					echo "</tr>";
				}
				echo "</table>";
				
			}	
			
			if($searchtype== "contributions pending"){
				@$myfile = fopen("recess.txt", "r") or die("Unable to open file!");
				//echo fread($myfile,filesize("recess.txt"));
				fclose($myfile);
				
				@$text=file_get_contents('recess.txt');
				@$textArray= explode("\n", $text);
				
				echo "<table border='1'>";
				echo "<tr>";
				echo "<td colspan='7' style='text-align:center'>"."CONTRIBUTION DETAILS"."</td>";
				echo "</tr>";
				echo "<tr id='ni'>";
				echo "<td>receiptNo</td>";
				echo "<td>amount</td>";
				echo "<td>date</td>";
				echo "<td>memberId</td>";
				echo "<td>status</td>";
				echo "</tr>";
				
				foreach($textArray as $element){
					
					$subArray= explode(" ", $element);
					
					if($subArray[0]== "contribution"){
						$camount=$subArray[1];
						$date=$subArray[2];
						$memberId=$subArray[3];
						$receiptNo=$subArray[4];
						$status="Pending";
						
						
						echo "<tr>";
						echo "<td>".$receiptNo."</td>";
						echo "<td>".$camount."</td>";
						echo "<td>".$date."</td>";
						echo "<td>".$memberId."</td>";
						echo "<td>".$status."</td>";
						echo "</tr>";
					}
					
				}
				echo "</table>";
			}
	
			if($searchtype== "loans pending"){
				@$myfile = fopen("recess.txt", "r") or die("Unable to open file!");
				//echo fread($myfile,filesize("recess.txt"));
				fclose($myfile);
				
				@$text=file_get_contents('recess.txt');
				@$textArray= explode("\n", $text);
				
				echo "<table border='1'>";
				echo "<tr>";
				echo "<td colspan='10' style='text-align:center'>"."PENDING LOAN DETAILS"."</td>";
				echo "</tr>";
				echo "<tr id='ni'>";
				echo "<td>"."amount</td>";
				echo "<td>"."memberId</td>";
				echo "<td>"."status</td>";
				echo "</tr>";
				
				foreach($textArray as $element){
					
					$subArray= explode(" ", $element);
					
					if($subArray[0]== "loan_request"){
						$lamount1=$subArray[1];
						$mem=$subArray[2];
						$status="Pending";
						
						
						echo "<tr>";
							echo "<td>".$lamount1."</td>";
							echo "<td>".$mem."</td>";
							echo "<td>".$status."</td>";
							
							echo "</tr>";
					}
					
				}
				echo "</table>";
			}
			
			if($searchtype== "worst idea"){
		
				@$connect=mysqli_connect("localhost","root","saazi","recess");
				@$res="SELECT investmentNo,name,description,loss,memberId FROM investment WHERE loss > '0' ORDER BY loss DESC";
				
				echo "<table border='1'>";
				echo "<tr>";
				echo "<td colspan='7' style='text-align:center'>"."IDEA DETAILS"."</td>";
				echo "</tr>";
				echo "<tr id='ni'>";
				echo "<td>"."investmentNo.</td>";
				echo "<td>"."idea name</td>";
				echo "<td>"."idea description.</td>";
				echo "<td>"."loss.</td>";
				echo "<td>"."memberId.</td>";
				echo "</tr>";
				
				
				if($guru=mysqli_query($connect, $res)){
					$colu = $guru->num_rows;
					for($j=0;$j<$colu;++$j){
						$row=mysqli_fetch_array($guru);
						$dats1=$row['loss'];
						$meh=$row['memberId'];
						$dats=$row['investmentNo'];
						$meh1=$row['name'];
						$description=$row['description'];
						
						
						echo "<tr>";
						echo "<td>".$dats."</td>";
						echo "<td>".$meh1."</td>";
						echo "<td>".$description."</td>";
						echo "<td>".$dats1."</td>";
						echo "<td>".$meh."</td>";
						echo "</tr>";
						
					}
				}
			}
			
			if($searchtype== "best idea"){
				
				@$connect=mysqli_connect("localhost","root","saazi","recess");
				@$res="SELECT investmentNo,name,description,profit,memberId FROM investment WHERE profit > '0' ORDER BY profit DESC";
				
				echo "<table border='1'>";
				echo "<tr>";
				echo "<td colspan='7' style='text-align:center'>"."IDEA DETAILS"."</td>";
				echo "</tr>";
				echo "<tr id='ni'>";
				echo "<td>"."investmentNo.</td>";
				echo "<td>"."idea name</td>";
				echo "<td>"."idea description.</td>";
				echo "<td>"."profit.</td>";
				echo "<td>"."memberId.</td>";
				echo "</tr>";
				
				
				if($guru=mysqli_query($connect, $res)){
					$colu = $guru->num_rows;
					for($j=0;$j<$colu;++$j){
						$row=mysqli_fetch_array($guru);
						$dats1=$row['profit'];
						$meh=$row['memberId'];
						$dats=$row['investmentNo'];
						$meh1=$row['name'];
						$description=$row['description'];
						
						
						echo "<tr>";
						echo "<td>".$dats."</td>";
						echo "<td>".$meh1."</td>";
						echo "<td>".$description."</td>";
						echo "<td>".$dats1."</td>";
						echo "<td>".$meh."</td>";
						echo "</tr>";
						
					}
				}
			}
			
			
			
			if($searchtype== "idea"){
			//output data selected in table format.
				
				echo "<table border='1'>";
				echo "<tr>";
				echo "<td colspan='7' style='text-align:center'>"."IDEA DETAILS"."</td>";
				echo "</tr>";
				echo "<tr id='ni'>";
				echo "<td>"."ideaId.</td>";
				echo "<td>"."capital</td>";
				echo "<td>"."description.</td>";
				echo "<td>"."memberId.</td>";
				echo "<td>"."administratorId.</td>";
				echo "<td>"."status.</td>";
				echo "</tr>";
				
				for($j=0;$j<$num_r8;++$j){
					$row = $result8->fetch_assoc();
					echo "<tr>";
					echo "<td>".$row['ideaId']."</td>";
					echo "<td>".$row['capital']."</td>";
					echo "<td>".$row['description']."</td>";
					echo "<td>".$row['memberId']."</td>";
					echo "<td>".$row['administratorId']."</td>";
					echo "<td>".$row['status']."</td>";
					echo "</tr>";
				}
				echo "</table>";
			
			}
			
			if($searchtype== "benefits"){
			//output data selected in table format.
				
				echo "<table border='1'>";
				echo "<tr>";
				echo "<td colspan='7' style='text-align:center'>"."IDEA DETAILS"."</td>";
				echo "</tr>";
				echo "<tr id='ni'>";
				echo "<td>"."benefitId.</td>";
				echo "<td>"."memberId</td>";
				echo "<td>"."profit.</td>";
				echo "<td>"."investmentNo.</td>";
				echo "</tr>";
				
				for($j=0;$j<$num_r8;++$j){
					$row = $result8->fetch_assoc();
					echo "<tr>";
					echo "<td>".$row['benefitId']."</td>";
					echo "<td>".$row['memberId']."</td>";
					echo "<td>".$row['profit']."</td>";
					echo "<td>".$row['investmentNo']."</td>";
					echo "</tr>";
				}
				echo "</table>";
			
			}
			
			
			if($searchtype== "contribution"){
			//Output selectyed data in table format
				
				echo "<table border='1'>";
				echo "<tr>";
				echo "<td colspan='7' style='text-align:center'>"."CONTRIBUTION DETAILS"."</td>";
				echo "</tr>";
				echo "<tr id='ni'>";
				echo "<td>receiptNo</td>";
				echo "<td>amount</td>";
				echo "<td>date</td>";
				echo "<td>memberId</td>";
				echo "<td>status</td>";
				echo "<td>administratorId</td>";
				echo "</tr>";
				//Loop through the number of rows selected.
				for($j=0;$j<$num_r8;++$j){
					$row = $result8->fetch_assoc();
					echo "<tr>";
					echo "<td>".$row['receiptNo']."</td>";
					echo "<td>".$row['amount']."</td>";
					echo "<td>".$row['date']."</td>";
					echo "<td>".$row['memberId']."</td>";
					echo "<td>".$row['status']."</td>";
					echo "<td>".$row['administratorId']."</td>";
					echo "</tr>";
				}
				echo "</table>";
			
			}
			
			if($searchtype== "loan_request"){
			//Output selectyed data in table format
				
				echo "<table border='1'>";
				echo "<tr>";
				echo "<td colspan='10' style='text-align:center'>"."STUDENTS DETAILS"."</td>";
				echo "</tr>";
				echo "<tr id='ni'>";
				echo "<td>"."loanId</td>";
				echo "<td>"."amount</td>";
				echo "<td>"."memberId</td>";
				echo "<td>"."administratorId</td>";
				echo "<td>"."status</td>";
				echo "</tr>";
				//Loop through the number of rows selected.
				for($j=0; $j<$num_r8; $j++){
					$row = $result8->fetch_assoc();
					echo "<tr>";
					echo "<td>".$row['loanId']."</td>";
					echo "<td>".$row['amount']."</td>";
					echo "<td>".$row['memberId']."</td>";
					echo "<td>".$row['administratorId']."</td>";
					echo "<td>".$row['status']."</td>";
					
					echo "</tr>";
				}
				echo "</table>";
				
			}	
		"</body>";
	}
	
	function createdatabase(){
		//Create connection to the server
		@$connect=mysqli_connect("localhost","root","saazi");
		//Test if connection is established 
		if($connect)
		{
			echo "Connected to the server<br/>";
		}
		
		else{
			echo "Connection failed<br/>";
		}
		
		//Create database "final" and check if it is created 
		if(mysqli_query($connect,"CREATE DATABASE recess")){
			echo "Database created";
		}
		
		else{
			echo "Database not created.<br/>";
		}
		
		//Select the database created
		$db=mysqli_select_db("recess");
		if($db){
			echo "Database selected";
		}
		
		else{
			echo "Database not selected selected";	
		}
		//Create table "stud" in the database selected
		$table1=mysqli_query($connect,"CREATE TABLE member
			(
			memberId VARCHAR(25) NOT NULL,
			username VARCHAR(25) NOT NULL,
			password VARCHAR(25) NOT NULL,
			administratorId VARCHAR(25) NOT NULL,
			PRIMARY KEY(memberId), 
			FOREIGN KEY(administratorId) REFERENCES administrator(administratorId)
		)");
		
		$table2=mysqli_query($connect,"CREATE TABLE contribution
			(
			receiptNo VARCHAR(25) NOT NULL PRIMARY KEY,
			amount VARCHAR(9) NOT NULL,
			date DATE NOT NULL,
			memberId VARCHAR(25) NOT NULL,
			status VARCHAR(10) NOT NULL,
			administratorId VARCHAR(25) NOT NULL,
			FOREIGN KEY(administratorId) REFERENCES administrator(administratorId)
		)");
		
		
		
		$table3=mysqli_query($connect,"CREATE TABLE loan_request
			(
			loanId int NOT NULL AUTO_INCREMENT,
			amount VARCHAR(15) NOT NULL,
			memberId VARCHAR(25) NOT NULL,
			administratorId VARCHAR(25) NOT NULL,
			PRIMARY KEY(loanId), 
			FOREIGN KEY(memberId) REFERENCES member(memberId), 
			FOREIGN KEY(administratorId) REFERENCES administrator(administratorId)
		)");
		
		$table4=mysqli_query($connect,"CREATE TABLE idea
			(
			ideaId int NOT NULL AUTO_INCREMENT,
			capital VARCHAR(9) NOT NULL,
			description VARCHAR(200) NOT NULL,
			memberId VARCHAR(25) NOT NULL,
			administratorId VARCHAR(25) NOT NULL,
			PRIMARY KEY(ideaId), 
			FOREIGN KEY(memberId) REFERENCES member(memberId), 
			FOREIGN KEY(administratorId) REFERENCES administrator(administratorId)
		)");
		
		$table5=mysqli_query($connect,"CREATE TABLE administrator
			(
			administratorId VARCHAR(25) NOT NULL PRIMARY KEY,
			password VARCHAR(25) NOT NULL
		)");
		
		$table6=mysqli_query($connect,"CREATE TABLE investment
			(
			investmentNo int NOT NULL AUTO_INCREMENT,
			date_of_investment date NOT NULL,
			initial_investment_price VARCHAR(9) NOT NULL,
			profit VARCHAR(9) NOT NULL,
			loss VARCHAR(9) NOT NULL,
			memberId VARCHAR(25) NOT NULL,
			administratorId VARCHAR(25) NOT NULL,
			PRIMARY KEY(investmentNo), 
			FOREIGN KEY(memberId) REFERENCES member(memberId), 
			FOREIGN KEY(administratorId) REFERENCES administrator(administratorId)
		)");
		
		$table7=mysqli_query($connect,"CREATE TABLE loan_repayment
			(
			loanRepaymentId int NOT NULL AUTO_INCREMENT,
			loan_repayment_date VARCHAR(9) NOT NULL,
			credit VARCHAR(9) NOT NULL,
			debit VARCHAR(9) NOT NULL,
			memberId VARCHAR(25) NOT NULL,
			administratorId VARCHAR(25) NOT NULL,
			PRIMARY KEY(loanRepaymentId), 
			FOREIGN KEY(memberId) REFERENCES member(memberId), 
			FOREIGN KEY(administratorId) REFERENCES administrator(administratorId)
		)");
		
		$table8=mysqli_query($connect,"CREATE TABLE benefits 
			(
			benefitId int NOT NULL AUTO_INCREMENT,
			profit VARCHAR(9) NOT NULL,
			loss VARCHAR(9) NOT NULL,
			investmentNo int NOT NULL,
			PRIMARY KEY(benefitId),
			FOREIGN KEY(investmentNo) REFERENCES investment(investmentNo)	
		)");
		
		
		$table9=mysqli_query($connect,"CREATE TABLE contributioncheck 
			(
			memberId VARCHAR(25) NOT NULL PRIMARY KEY,
			amount int NOT NULL
		)");
	
	}
	
	
	function showmember(){
		@$connect=mysqli_connect("localhost","root","saazi");
		@$db=mysqli_select_db($connect,"recess");
		
		@$username = $_POST['username'];
		@$memberid = $_POST['memberid'];
		@$password = $_POST['password'];
		@$contribute = $_POST['contribute'];
		@$adminid5 = $_POST['madminstratorId'];
		@$receipt = $_POST['reciept'];
		@$date = $_POST['date'];
		@$status = $_POST['status'];
		if(mysqli_query($connect,"INSERT INTO member(memberId,username,password,date,administratorId) 
		VALUES('$memberid','$username','$password','$date','$adminid5')"))
		{
		echo "<script>alert('Submited successfully')</script>";
		
		}else{
		echo "<script>alert('Failed')</script>";
		
		}
		
		if(mysqli_query($connect,"INSERT INTO contribution(receiptNo,amount,date,memberId,status,administratorId) 
			VALUES('$receipt','$contribute','$date','$memberid','$status','$adminid5')"))
		{
			echo "<script>alert('Submited successfully')</script>";
		
		}else{
			echo "<script>alert('Failed')</script>";
			
		}
		if(mysqli_query($connect,"INSERT INTO contributioncheck(memberId,amount) 
			VALUES('$memberid','$contribute')"))
		{
			echo "<script>alert('Submited successfully')</script>";
			header("location:admin2.php?action=addmember");
			
		}else{
			echo "<script>alert('Failed')</script>";
			header("location:admin2.php?action=addmember");

		}
		
	}
	
	function showinvest(){
	
		@$connect=mysqli_connect("localhost","root","saazi","recess");
		
		@$investnumber = $_POST['investnumber'];
		@$name = $_POST['name'];
		@$description = $_POST['description'];
		@$username = $_POST['member'];
		@$memberid = $_POST['date'];
		@$password = $_POST['price'];
		@$contri = $_POST['profit'];
		@$contribute = $_POST['loss'];
		@$adminid5 = $_POST['madminstratorId'];
		
		if(mysqli_query($connect,"INSERT INTO investment(investmentNo,name,description,date_of_investment,initial_investment_price,profit,loss,memberId,administratorId) 
		VALUES('$investnumber','$name','$description','$memberid','$password','$contri','$contribute','$username','$adminid5')"))
		{
		echo "<script>alert('Submited successfully')</script>";
		
		}else{
		echo "<script>alert('Failed')</script>";
		
		}
		
		$contri1=(0.3*$contri);
		$contri2=(0.05*$contri);
		$contri3=($contri-($contri2+$contri1));
		$max=0;
		$sum=0;
		$member1;
		
		@$res="SELECT memberId,date FROM member";
		if($guru=mysqli_query($connect, $res)){
			$colu = $guru->num_rows;
			for($j=0;$j<$colu;++$j){
				$row=mysqli_fetch_array($guru);
				$dats=$row['date'];
				$meh=$row['memberId'];
				
				@$res1="SELECT date_of_investment,memberId FROM investment";
				if($guru1=mysqli_query($connect, $res1)){
					$colu1 = $guru1->num_rows;
					for($m=($colu-1);$m<$colu;++$m){
						$row1=mysqli_fetch_array($guru1);
						$dats1=$row1['date_of_investment'];
						echo "$dats1";
						
					}
					
				
					if($memberid>$dats){
						echo "$memberid>>$dats";
		
						@$resul="SELECT memberId,amount FROM contributioncheck WHERE memberId='$meh'";
						if($lo=mysqli_query($connect, $resul))
						{
							$num = $lo->num_rows;
						
							
							for($n=0;$n<$num;++$n){
								$row2=mysqli_fetch_array($lo);
								$sum+=$row2['amount'];
								$amount=$row2['amount'];

								if($amount>$max){
									$max=$amount;
									$member1=$row['memberId'];
								}
								//echo "$sum";
							}
							
						}
					}
				}
			}
			echo "$sum";
			echo "$max";
			echo "$member1";
		}
		
		@$res2="SELECT memberId,date FROM member";
		if($guru8=mysqli_query($connect, $res2)){
			$colu = $guru8->num_rows;
			for($j=0;$j<$colu;++$j){
				$row4=mysqli_fetch_array($guru8);
				$dats2=$row4['date'];
				$meh1=$row4['memberId'];
				//echo "$dats2";
				//echo "$meh1";
				
				@$res3="SELECT date_of_investment FROM investment";
				if($guru7=mysqli_query($connect, $res3)){
					$colu1 = $guru7->num_rows;
					for($r=($colu-1);$r<$colu;++$r){
						$row5=mysqli_fetch_array($guru7);
						$dats3=$row5['date_of_investment'];
					}
					
				
			
					if(($contri!=0)&&($memberid>$dats2)){
						
						@$re4="SELECT *FROM investment";
						if($g=mysqli_query($connect, $re4)){
							$col = $g->num_rows;
							for($m=0;$m<($col-1);++$m){
								$row=mysqli_fetch_array($g);
								$loss=$row['loss'];
							}
							echo "$loss";
							echo "$col";
							
							@$resul4="SELECT memberId,amount FROM contributioncheck WHERE memberId='$meh1'";
							if($lo3=mysqli_query($connect, $resul4))
							{
								$num = $lo3->num_rows;
								echo "opened successful";
								
								for($n=0;$n<$num;++$n){
									$roww=mysqli_fetch_array($lo3);
									$amount0=$roww['amount'];
									$re=$roww['memberId'];
									if($loss != 0&&$re==$member1&&$amount0==$max){
										
									
										if(mysqli_query($connect,"INSERT INTO benefits(memberId,profit,investmentNo) 
										VALUES('$re','$contri2','$investnumber')"))
										{
											echo "<script>alert('Submited successfully')</script>";
											header("location:admin2.php?action=addinvest");
										}else{
											echo "<script>alert('Failed')</script>";
											header("location:admin2.php?action=addinvest");
										}
										
										
									}elseif($loss == 0&&$re==$member1&&$amount0==$max){
										$sharess=($max/$sum);
										$maxprofit=$contri3*$sharess;
										$newamount=$maxprofit+$contri2;
										
										if(mysqli_query($connect,"INSERT INTO benefits(memberId,profit,investmentNo) 
										VALUES('$re','$newamount','$investnumber')"))
										{
										echo "<script>alert('Submited successfully')</script>";
										header("location:admin2.php?action=addmember");
										}else{
										echo "<script>alert('Failed')</script>";
										header("location:admin2.php?action=addinvest");
										}
									}elseif($loss == 0&&$re!=$member1&&$amount0!=$max){
										$shares=($amount0/$sum);
										$maxprofit=$contri3*$shares;
										
										if(mysqli_query($connect,"INSERT INTO benefits(memberId,profit,investmentNo) 
										VALUES('$re','$maxprofit','$investnumber')"))
										{
										echo "<script>alert('Submited successfully')</script>";
										header("location:admin2.php?action=addinvest");
										}else{
										echo "<script>alert('Failed')</script>";
										header("location:admin2.php?action=addinvest");
										}
							
									}
								}
							}
							
						}
					}
				}
			}
		}	
	}
	/*function showLoan(){
	
		@$connect=mysqli_connect("localhost","root","saazi");
		
		@$db=mysqli_select_db($connect,"recess");
		
		@$repay1 = $_POST['repayId'];
		@$repayDate2 = $_POST['repayDate'];
		@$cedit1 = $_POST['credit'];
		@$debit1= $_POST['debit'];
		@$memberIdentity = $_POST['memberId'];
		@$administratorIdentity = $_POST['adminId'];
		if(mysqli_query($connect,"INSERT INTO loan_repayment(loan_repayment_date,credit,debit,memberId,administratorId) 
		VALUES('$repayDate2','$cedit1','$debit1','$memberIdentity','$administratorIdentity')"))
		{
		echo "<script>alert('Submited successfully')</script>";
			header("location:admin2.php?action=addLoan");
		}else{
		echo "<script>alert('Failed')</script>";
			header("location:admin2.php?action=addLoan");
		
		}
	
	}*/
	
	function addLoan(){
	
		echo "<!DOCTYPE html>";
		echo "<html>";
			echo "<head>";
		
			
				echo "<meta charset='UTF-8'>";
				echo "<style type='text/css'>";

						echo "body{";
							echo "margin-left:10%;";
							echo "width:65em;";
							echo "border: .5em solid blue;";
							echo "border-radius: 5px;";
							echo "border-top: 3em solid blue;";
							echo "box-shadow: 4px 4px black;";
						echo "}";
						echo "table{";
							echo "background-color:whitesmoke;";
							echo "border: 0;";
							echo "margin-left:10%;";
							echo "margin-right:10%;";
						echo "}";
						echo "td{";
						echo "	font-size: 1.5em;";
						echo "}";
						
						echo "table tr td{";
							echo "cell-padding:2em;";
							echo "cell-spacing:4em;";
							echo "border-collapse:separate;";
							echo "text-align:left;";
							echo "font-weight:bold;";
						echo "}";
						echo "header{";
							echo " border:3px solid blue;";
							echo " background-color:blue;";
							echo " color:white;";
						echo "}";
				echo "</style>";

			echo "</head>";
			echo "<body>";
				echo "<header>";
				echo "<h1 align='center'><strong>FAMILY SACCO</strong></h1>";
				echo "</header>";
				echo "</p>"; 
					
					echo "<a href='admin2.php?action=addinvest' style='text-decoration:none;'><input type='button' value='INVESTMENT DETAILS' style='width:15%; background-color:lightblue;'></a>";
					echo "<a href='admin2.php?action=addmember' style='text-decoration:none;'><input type='button' value='ADD MEMBERS' style='width:15%; background-color:lightblue;'></a>";
					echo "<a href='?action=homepage' style='text-decoration:none;'><input type='button' value='HOME PAGE' style='width:15%; background-color:lightblue;'></a>";
			
				echo "</p>";
				/*echo "<br/><h3 align='center'>ENTER LOAN REPAYMENT DETAILS</h3>";

				echo "<form action='admin2.php?action=showLoan' method='POST'>";

					echo "<table border='0'  cellspacing='50' align='CENTER'>";
					echo "<tr><td>REPAYMENT ID</td><td><input type='text' placeholder='' name = 'repayId'></td></tr>";
					echo "<tr><td>REPAYMENT DATE</td><td><input type='date' placeholder='' name = 'repayDate'></td></tr>";
					echo "<tr><td>CREDIT</td><td><input type='text' placeholder='' name = 'credit'></td></tr>";
					echo "<tr><td>DEBIT</td><td><input type='text' placeholder='' name = 'debit'></td></tr>";
					echo "<tr><td>MEMBER ID</td><td><input type='text' placeholder='' name = 'memberId'></td></tr>";
					echo "<tr><td>ADMINISTRATOR ID</td><td><input type='text' placeholder='' name = 'adminId'></td></tr>";
					echo "</table>";

					echo "<p align = 'center' >";
						echo "<input type='submit' value='Submit' style='width:15%; background-color:lightblue;'>";
					echo "</p>";
				echo "</form>";*/
			echo "</body>";
		echo "</html>";
	
	}
	
	@$act = $_REQUEST['action'];
	switch($act){
		case "addLoan":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		addLoan();  //call the function, which is in functions.php
		break;
		
		case "showLoan":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		showLoan();  //call the function, which is in functions.php
		break;
		
		case "showmember":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		showmember();  //call the function, which is in functions.php
		break;
		
		case "showinvest":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		showinvest();  //call the function, which is in functions.php
		break;
		
		case "createforms":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		createforms();  //call the function, which is in functions.php
		break;
		
		case "recievefile":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		recievefile();  //call the function, which is in functions.php
		break;
		
		case "addmember":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		addmember();  //call the function, which is in functions.php
		break;
		
		case "addinvest":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		addinvest();  //call the function, which is in functions.php
		break;
		
		case "homepage":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		homepage(); //call the function, which is in functions.php
		break;

		
		case "adminlogin1":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		adminlogin1(); //call the function, which is in functions.php
		break;
		
		case "file":  //imagine that you already put ?action=login somewhere eg. In your menu under a href or as your action in the form
		showfile(); //call the function, which is in functions.php
		break;
	}
	
	
	function showfile(){
		
		echo "<!DOCTYPE html>";
		echo "<html>";
			echo "<head>";
		
			
				echo "<meta charset='UTF-8'>";
				echo "<style type='text/css'>";

						echo "body{";
							echo "margin-left:10%;";
							echo "width:65em;";
							echo "border: .5em solid blue;";
							echo "border-radius: 5px;";
							echo "border-top: 3em solid blue;";
							echo "box-shadow: 4px 4px black;";
						echo "}";
						echo "table{";
							echo "background-color:whitesmoke;";
							echo "border: 0;";
							echo "margin-left:10%;";
							echo "margin-right:10%;";
						echo "}";
						echo "td{";
						echo "	font-size: 1.5em;";
						echo "}";
						
						echo "table tr td{";
							echo "cell-padding:2em;";
							echo "cell-spacing:4em;";
							echo "border-collapse:separate;";
							echo "text-align:left;";
							echo "font-weight:bold;";
						echo "}";
						echo "header{";
							echo " border:3px solid blue;";
							echo " background-color:blue;";
							echo " color:white;";
						echo "}";
				echo "</style>";

			echo "</head>";
			
			echo "<body>";
				echo "<header>";
					echo "<h1 align='center'><strong>FAMILY SACCO</strong></h1>";
				echo "</header>";
				
				echo "</p>"; 
					echo "<a href='admin2.php?action=file' style='text-decoration:none;'><input type='button' value='FILE' style='width:20%; margin-left:20%; background-color:lightblue;'></a>";
					echo "<a href='?action=homepage' style='text-decoration:none;'><input type='button' value='HOME PAGE' style='width:15%; background-color:lightblue;'></a>";
					echo "<a href='admin.php?action=addinvest' style='text-decoration:none;'><input type='button' value='INVESTMENT DETAILS' style='width:15%; background-color:lightblue;'></a>";
					echo "<a href='admin.php?action=addmember' style='text-decoration:none;'><input type='button' value='ADD MEMBERS' style='width:15%; background-color:lightblue;'></a>";
					
				echo "</p>"; 
				function fileopen(){
					@$myfile = fopen("recess.txt", "r") or die("Unable to open file!");
					echo fread($myfile,filesize("recess.txt"));
					fclose($myfile);
				}
						
				@$text=file_get_contents('recess.txt');
				@$textArray= explode("\n", $text);
				
				@$test="recess.txt";
				unlink($test);
				
				
				if($textArray != " "){
					foreach($textArray as $element){
						
						$subArray= explode(" ", $element);
						
						if($subArray[0]== "contribution"){
							$camount=$subArray[1];
							$date=$subArray[2];
							$memberId=$subArray[3];
							$receiptNo=$subArray[4];
							$dam="ID-A001";
							$l1=$subArray[0];
							
							/*echo "<p>";
							echo "<table border =\"1\" style='border-collapse: collapse'>";
							echo "<tr> \n";
							echo "<td>$element</td> \n";
							echo "</tr>";
							echo "</table>";
							echo "</p>";
							*/
							
							echo "<form action='admin2.php?action=recievefile' method='POST'>";
								echo "<p>";
								echo "\n\n<input type='text' name = 'first' value='$l1' style='width:10%'>";
								echo "<input type='text'  name = 'camount' value='$camount' style='width:10%'>";
								echo "<input type='text'  name = 'date' value='$date' style='width:10%'>";
								echo "<input type='text'  name = 'memberId' value='$memberId' style='width:10%'>";
								echo "<input type='text'  name = 'receiptNo' value='$receiptNo' style='width:10%'>\n";
								echo "<input type='hidden'  name = 'adminstratorId' value='$dam'>";
								echo "<input type='hidden' name = 'adminsId' value='$dam'>";
								echo "<input type='hidden'  name = 'adminspassword' value='12345'>\n";
								echo "<input type='submit' value='Accepted' name = 'submit'>\n";
								echo "<input type='submit'  value='Rejected' name = 'submit'>\n\n";
								echo "</p>";
							echo "</form>";
							
							
						}
						
						if($subArray[0]== "loan_request"){
							$lamount1=$subArray[1];
							$mem=$subArray[2];
							$ad="ID-A001";
							$l1=$subArray[0];
						
							/*	echo "<p>";
							echo "<table border =\"1\" style='border-collapse: collapse'>";
							echo "<tr> \n";
							echo "<td>$element</td> \n";
							echo "</tr>";
							echo "</table>";
							echo "</p>";*/
						
							echo "<form action='admin2.php?action=recievefile' method='POST'>";
								echo "<p>";
								echo "\n\n<input type='text' name = 'first' value='$l1' style='width:8%'>";
								echo "<input type='text'  name = 'lamount' value='$lamount1' style='width:8%'>";
								echo "<input type='text'  name = 'lmemberId' value='$mem' style='width:8%'>";
								echo "<input type='hidden'  name = 'adminId' value='$ad'>\n";
								echo "<input type='submit' value='Accepted' name = 'submit'>\n";
								echo "<input type='submit'  value='Rejected' name = 'submit'>\n\n";
								echo "</p>";
							echo "</form>";
							
						}
						
						if($subArray[0]== "loan_repayment"){
							$l1=$subArray[0];  //loan_repayment date amount member_Id loan_Id
							$date=$subArray[1];
							$amount=$subArray[2];
							$memb=$subArray[3];
							//$loanid=$subArray[4];
							$dame="ID-A001";

							echo "<form action='admin2.php?action=recievefile' method='POST'>";
								echo "<p>";
								echo "\n\n<input type='text' name = 'first' value='$l1' style='width:10%'>";
								echo "<input type='text'  name = 'rdate' value='$date' style='width:10%'>";
								echo "<input type='text'  name = 'ramount' value='$amount' style='width:10%'>";
								echo "<input type='textarea'  name = 'memberiD' value='$memb' style='width:10%'>";
								//echo "<input type='textarea'  name = 'loaniD' value='$loanid' style='width:10%'>";
								echo "<input type='hidden'  name = 'adminstratid' value='$dame'>";
								echo "<input type='submit' value='Accepted' name = 'submit'>\n";
								echo "<input type='submit'  value='Rejected' name = 'submit'>\n\n";
								echo "</p>";
							echo "</form>";
						
						}
						
						if($subArray[0]== "idea"){
							$l1=$subArray[0];
							$ideaId=$subArray[1];
							$capital=$subArray[2];
							$description=$subArray[3];
							$memb=$subArray[4];
							$dame="ID-A001";
							
							/*echo "<p>";
							echo "<table border =\"1\" style='border-collapse: collapse'>";
							echo "<tr> \n";
							echo "<td>$element</td> \n";
							echo "</tr>";
							echo "</table>";
							echo "</p>";*/
						
					
							echo "<form action='admin2.php?action=recievefile' method='POST'>";
								echo "<p>";
								echo "\n\n<input type='text' name = 'first' value='$l1' style='width:10%'>";
								echo "<input type='text'  name = 'ideaId' value='$ideaId' style='width:10%'>";
								echo "<input type='text'  name = 'capital' value='$capital' style='width:10%'>";
								echo "<input type='textarea'  name = 'description' value='$description' style='width:10%'>";
								echo "<input type='hidden'  name = 'adminstratorId' value='$dame'>";
								echo "<input type='text' name = 'imemberId' value='$memb' style='width:10%'>\n";
								echo "<input type='submit' value='Accepted' name = 'submit'>\n";
								echo "<input type='submit'  value='Rejected' name = 'submit'>\n\n";
								echo "</p>";
							echo "</form>";
						
						}
					}	
				echo "</body>";
			echo "</html>";
		
		}
	}


	function addmember(){
		
		echo "<!DOCTYPE html>";
		echo "<html>";
			echo "<head>";
		
			
				echo "<meta charset='UTF-8'>";
				echo "<style type='text/css'>";

						echo "body{";
							echo "margin-left:10%;";
							echo "width:65em;";
							echo "border: .5em solid blue;";
							echo "border-radius: 5px;";
							echo "border-top: 3em solid blue;";
							echo "box-shadow: 4px 4px black;";
						echo "}";
						echo "table{";
							echo "background-color:whitesmoke;";
							echo "border: 0;";
							echo "margin-left:10%;";
							echo "margin-right:10%;";
						echo "}";
						echo "td{";
						echo "	font-size: 1.5em;";
						echo "}";
						
						echo "table tr td{";
							echo "cell-padding:2em;";
							echo "cell-spacing:4em;";
							echo "border-collapse:separate;";
							echo "text-align:left;";
							echo "font-weight:bold;";
						echo "}";
						echo "header{";
							echo " border:3px solid blue;";
							echo " background-color:blue;";
							echo " color:white;";
						echo "}";
				echo "</style>";

			echo "</head>";
			
			echo "<body>";
				echo "<header>";
				echo "<h1 align='center'><strong>FAMILY SACCO</strong></h1>";
				echo "</header>";
				echo "</p>"; 
					/*echo "<a href='admin2.php?action=addLoan' style='text-decoration:none;'><input type='button' value='LOAN REPAYMENT DETAILS' style='width:20%; margin-left:20%; background-color:lightblue;'></a>";*/
					echo "<a href='admin2.php?action=addinvest' style='text-decoration:none;'><input type='button' value='INVESTMENT DETAILS' style='width:15%; background-color:lightblue;'></a>";
					echo "<a href='admin2.php?action=addmember' style='text-decoration:none;'><input type='button' value='ADD MEMBERS' style='width:15%; background-color:lightblue;'></a>";
					echo "<a href='?action=homepage' style='text-decoration:none;'><input type='button' value='HOME PAGE' style='width:15%; background-color:lightblue;'></a>";
			
				echo "</p>"; 
				echo "<br/><h3 align='center'>ADD NEW MEMBERS</h3>";

					echo "<form action='?action=showmember' method='POST'>";

						echo "<table border='0'  cellspacing='50' align='CENTER'>";
						echo "<tr><td>USERNAME</td><td><input type='text' placeholder='' name = 'username' required ></td></tr>";
						echo "<tr><td>MEMBER ID</td><td><input type='text' placeholder='' name = 'memberid' required ></td></tr>";
						echo "<tr><td>PASSWORD</td><td><input type='password' placeholder='' name = 'password' required ></td></tr>";
						echo "<tr><td>CONTRIBUTION</td><td><input type='text' placeholder='' name = 'contribute' required ><input type='hidden' value='ID-A001' name ='madminstratorId'></td></tr>";
						echo "<tr><td>DATE</td><td><input type='date' placeholder='' name = 'date' required ></td></tr>";
						echo "<tr><td>RECIEPT NO</td><td><input type='text' placeholder='' name = 'reciept' required ><input type='hidden' placeholder='' name = 'status' value='Accept'></td></tr>";
						echo "</table>";

						echo "<p align = 'center' >";
						echo "<input type='submit' value='Submit' style='width:15%; background-color:lightblue;'>";
						echo "</p>";
					echo "</form>";
			echo "</body>";
		echo "</html>";
	
	}
	
	function homepage(){
		
		echo "<!DOCTYPE html>";
		echo "<html>";
			echo "<head>";
		
			
				echo "<meta charset='UTF-8'>";
				echo "<style type='text/css'>";

						echo "body{";
							echo "margin-left:10%;";
							echo "width:65em;";
							echo "border: .5em solid blue;";
							echo "border-radius: 5px;";
							echo "border-top: 3em solid blue;";
							echo "box-shadow: 4px 4px black;";
						echo "}";
						echo "table{";
							echo "background-color:whitesmoke;";
							echo "border: 0;";
							echo "margin-left:10%;";
							echo "margin-right:10%;";
						echo "}";
						echo "td{";
						echo "	font-size: 1.5em;";
						echo "}";
						
						echo "table tr td{";
							echo "cell-padding:2em;";
							echo "cell-spacing:4em;";
							echo "border-collapse:separate;";
							echo "text-align:left;";
							echo "font-weight:bold;";
						echo "}";
						echo "header{";
							echo " border:3px solid blue;";
							echo " background-color:blue;";
							echo " color:white;";
						echo "}";
				echo "</style>";

			echo "</head>";
			
			echo "<body>";
				echo "<header>";
					echo "<h1 align='center'><strong>FAMILY SACCO</strong></h1>";
				echo "</header>";
				
				echo "</p>"; 
					echo "<a href='admin2.php?action=file' style='text-decoration:none;'><input type='button' value='FILE' style='width:20%; margin-left:20%; background-color:lightblue;'></a>";
					
					echo "<a href='admin2.php?action=addinvest' style='text-decoration:none;'><input type='button' value='INVESTMENT DETAILS' style='width:15%; background-color:lightblue;'></a>";
					echo "<a href='admin2.php?action=addmember' style='text-decoration:none;'><input type='button' value='ADD MEMBERS' style='width:15%; background-color:lightblue;'></a>";
					
				echo "</p>"; 
			

				
				prin();
			echo "</body>";
		echo "</html>";
	}
		
		function prin(){
			
			echo "<!DOCTYPE html>";
			echo "<html>";
				echo "<form action='admin2.php?action=createforms' method='POST'>";
				
					echo "<p>";
						echo "<label style='margin-left:70px; width:200px '>CLICK DROPDOWN TO SELECT REPORT TO BE DISPLAYED";
							echo "<select name='searchtype' style='width:200px;margin-left:65px'>";
								echo "<option value='loan_request' style='color:blue' >LOAN REPORT</option>";
								echo "<option value='idea' style='color:blue'>IDEA REPORT</option>";
								echo "<option value='benefits' style='color:blue'>BENEFITS REPORT</option>";
								echo "<option value='regularmembers' style='color:blue'>REGULAR MEMBERS</option>";
								echo "<option value='contribution' style='color:blue'>CONTRIBUTION REPORT</option>";
								echo "<option value='contributions pending' style='color:blue'>CONTRIBUTIONS PENDING</option>";
								echo "<option value='loans pending' style='color:blue'>LOANS PENDING</option>";
								echo "<option value='worst idea' style='color:blue'>WORST IDEA</option>";
								echo "<option value='best idea' style='color:blue'>BEST IDEA</option>";
							echo "</select>";
						echo "</label>";
					echo "</p>";
					
					echo "<p align = 'center' >";
					echo "<input type='submit' value='Submit' style='width:15%; background-color:lightblue;'>";
					echo "</p>";
				echo "</form>";
			echo "</html>";
		
		}
	
	function adminlogin1(){
		//Establish connection to the server and database
		$connect=mysqli_connect("localhost","root","saazi","recess");
		//Fetch user name and password from the form
		$uname=$_POST['adid'];
		$pword=$_POST['adpassword'];
		//Retrive all records from table stud 
		$result="SELECT *FROM administrator
				 WHERE administratorId='$uname' AND password='$pword'";
		$log=$connect->query($result);
		//If no record has username and password that match the input from the user 
		if(!$in=$log->fetch_assoc()){
			
			
			//Remain on the login interface if the user enters values that do not match
			header("location:adminstrator2.php");

		}
			//If any record matches the user input  log  the user in and notify the user
		else{
			homepage();
			
		};
		
	}
	

	function addinvest(){
	
		echo "<!DOCTYPE html>";
		echo "<html>";
			echo "<head>";
		
			
				echo "<meta charset='UTF-8'>";
				echo "<style type='text/css'>";

						echo "body{";
							echo "margin-left:10%;";
							echo "width:65em;";
							echo "border: .5em solid blue;";
							echo "border-radius: 5px;";
							echo "border-top: 3em solid blue;";
							echo "box-shadow: 4px 4px black;";
						echo "}";
						echo "table{";
							echo "background-color:whitesmoke;";
							echo "border: 0;";
							echo "margin-left:10%;";
							echo "margin-right:10%;";
						echo "}";
						echo "td{";
						echo "	font-size: 1.5em;";
						echo "}";
						
						echo "table tr td{";
							echo "cell-padding:2em;";
							echo "cell-spacing:4em;";
							echo "border-collapse:separate;";
							echo "text-align:left;";
							echo "font-weight:bold;";
						echo "}";
						echo "header{";
							echo " border:3px solid blue;";
							echo " background-color:blue;";
							echo " color:white;";
						echo "}";
				echo "</style>";

			echo "</head>";
			echo "<body>";
				echo "<header>";
				echo "<h1 align='center'><strong>FAMILY SACCO</strong></h1>";
				echo "</header>";
				echo "</p>"; 
					/*echo "<a href='admin2.php?action=addLoan' style='text-decoration:none;'><input type='button' value='LOAN REPAYMENT DETAILS' style='width:20%; margin-left:20%; background-color:lightblue;'></a>";8*/
					echo "<a href='admin2.php?action=addinvest' style='text-decoration:none;'><input type='button' value='INVESTMENT DETAILS' style='width:15%; background-color:lightblue;'></a>";
					echo "<a href='admin2.php?action=addmember' style='text-decoration:none;'><input type='button' value='ADD MEMBERS' style='width:15%; background-color:lightblue;'></a>";
					echo "<a href='?action=homepage' style='text-decoration:none;'><input type='button' value='HOME PAGE' style='width:15%; background-color:lightblue;'></a>";
			
				echo "</p>"; 
				echo "<br/><h3 align='center'>ENTER INVESTMENT DETAILS</h3>";

				echo "<form action='?action=showinvest' method='POST'>";

					echo "<table border='0'  cellspacing='50' align='CENTER'>";
					echo "<tr><td>INVESTMENT No</td><td><input type='text' placeholder='' name = 'investnumber'></td></tr>";
					echo "<tr><td>MEMBER ID</td><td><input type='text' placeholder='' name = 'member'></td></tr>";
					echo "<tr><td>IDEA NAME</td><td><input type='text' placeholder='' name = 'name'></td></tr>";
					echo "<tr><td>DESCRIPTION</td><td><input type='textarea' placeholder='' name = 'decription'></td></tr>";
					echo "<tr><td>DATE OF INVESTMENT</td><td><input type='date' placeholder='' name = 'date'></td></tr>";
					echo "<tr><td>INITIAL INVESTMENT PRICE</td><td><input type='text' placeholder='' name = 'price'></td></tr>";
					echo "<tr><td>PROFITS</td><td><input type='text' placeholder='' name = 'profit'></td></tr>";
					echo "<tr><td>LOSSES</td><td><input type='text' placeholder='' name = 'loss'><input type='hidden' value='ID-A001' name ='madminstratorId'></td></tr>";
					echo "</table>";

					echo "<p align = 'center' >";
						echo "<input type='submit' value='Submit' style='width:15%; background-color:lightblue;'>";
					echo "</p>";
				echo "</form>";
			echo "</body>";
		echo "</html>";
	
	}
?>