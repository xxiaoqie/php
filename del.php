<?php include_once("conn/conn.php");?>
<?php
	$result;
	$sqlstr;
	if(isset($_POST['id'])) {
		header('Content-Type:application/json; charset=utf-8');	
		$sqlstr = "delete from receive where id = ".$_POST['id'];
		$result = "成功删除".mysqli_query($conn,$sqlstr)."条记录";
		exit(json_encode($result));
	}
	if(isset($_POST['chk'])) {
		$sqlstr = "delete from receive where id in(". join(',',$_POST['chk']).")";
		$result = mysqli_query($conn,$sqlstr);
		# $result = "成功删除".mysqli_num_rows($result)."条记录";
		echo "<script>";
		echo "alert('".$result."');";
		echo "window.location.href='index.php';";
        echo "</script>";
		# header("Location: index.php"); 
	}
	if(isset($_GET['id'])) {
		$sqlstr = "delete from receive where id = ". $_GET['id'];
		$result = mysqli_query($conn,$sqlstr);
		if($result) {
			echo "<script>";
			echo "alert('删除成功');";
			echo "window.location.href='index.php';";
			echo "</script>";
		} else {
			echo "<script>";
			echo "alert('删除失败');";
			echo "history.back();";
			echo "</script>";
		}
	}
?>