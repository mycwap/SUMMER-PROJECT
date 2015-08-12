<?php
					
				
    					 
						$delivery_option = $_COOKIE["delivery_option"];

						 

						if($delivery_option == "2")
						{
							header('Location: search2.php');  // collect page
						}

						else if($delivery_option == "1"){
							header('Location: search1.php');  // delivery page
						}

?>