<!DOCTYPE html>
<html>
	<head>
	<title>Finding Date of birth using NIC</title>
	</head>
	<body>
	<?php
	
		//$nic=$_POST['nic']; //getting NIC number using post method
		$nic="947061127V";
		print_r(calcNIC($nic)); //calling of the function calcNIC() from the same php file
		
		function calcNIC($nic)
		{
			//initialize funtion with one parameter
			if(strlen($nic)==10||strlen($nic)==12)
			{
				//NIC number validation(length=10 or 12)
				if(strlen($nic)==10)//OLDNIC format
				{
					$birth_year="19".substr($nic,0,2);
					//. -concadination function in strings 
					//substr(<variable>,start index,length)
					$calcDays=substr($nic,2,3);
				}
				else{//NEW NIC format
					$birth_year=substr($nic,0,4);
					$calcDays=substr($nic,4,3);
				}
				//////////////Year and Days found///////////////
				
				if($calcDays>500)
				{
					$calcDays=$calcDays-500;
					$gender="Female";
				}
				else{
					$gender="Male";
				}
				///////////////////Gender found/////////////////
				
				$mon=array("31","29","31","30","31","30","31","31","30","31","30","31");
				//Array initialization
				$i=0;
				while($mon[$i]<$calcDays)
				{
				//while(condition)
				$calcDays=$calcDays-$mon[$i];
				$i++;
				}
				///////////////////Month found/////////////////
				
				//Extra method to show days in two digits
				$i++;
				if($calcDays<10)
				{
				$calcDays="0".$calcDays;
				}
				
				//Extra method to show month in two digits
				if($i<10)
				{
				$birth_month="0".$i;
				}
				else{
				$birth_month=$i;
				}
				
				//////////////Date and Month created for 2 digits//////////////
				
				$birth_day=$calcDays;
				$date_of_birth=$birth_year."-".$birth_month."-".$birth_day;
				$from=new DateTime($date_of_birth);
				//php inbuilt function for time & date formatting
				$to=new DateTime('today');
				//'today' in DateTime() will set the date to the on the pc
				$age=$from->diff($to)->y;
				//diff() uses the same format type subtraction
				//->only returns the "year" from the subtraction
				
				//returning all from the method
				return[
					'gender'=>$gender,
					'dob'=>$date_of_birth,
					'age'=>$age
				];
				//input:
				//output:
		}
			
		}
	?>
	</body>
</html>	