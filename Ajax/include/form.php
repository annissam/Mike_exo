<?php
sleep(30);
	if(isset($_POST) &&isset($_FILES)){
		$data['file'] = $_FILES;
		$data['text'] = $_POST;
		echo json_encode($data);
	}