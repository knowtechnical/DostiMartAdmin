<?php
@session_start();
$mysystem = getHostByName(php_uname('n'));
@$link = mysqli_connect("localhost", "u889212106_sale", "FHUdOAST3dov", "u889212106_sale");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}   

echo "<pre>";
 $date = date('Y-m-d');
  echo $sqlrow = "SELECT * FROM quiz q JOIN quiz_answer qa ON qa.fk_question_id =  q.q_id
                where q_start_date  = '$date'
                ORDER BY rand() LIMIT 1";
    $resultrow = mysqli_query($link, $sqlrow);

	while ($row1 = mysqli_fetch_array($resultrow, MYSQLI_ASSOC)) {
			$checkid[] = $row1;					
	}
//	print_r($checkid[0]);
	print_r($checkid[0]['qa_id']);	print_r($checkid[0]['fk_mobile']);
	
	        $mobile = $checkid[0]['fk_mobile'];
		echo	$sql_update = "UPDATE quiz SET	q_winning_status  = '$mobile' where  q_id = ".$checkid[0]['fk_question_id'];
			$query = mysqli_multi_query($link, $sql_update);
		
		

?>