<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet" />
<?php include_once("conn/conn.php"); ?>
<?php 
$sqlstr = "select * from receive where id = ".$_GET['id'];
$result = mysqli_query($conn,$sqlstr);
$row = mysqli_fetch_array($result)
?>
<title><?php echo $row['title'] ?></title>
</head>

<body>
<div class="container-fluid">
	<div style=" background-color:#C1D9F3; padding:5px" class="form-horizontal">
    	<a class="btn btn-default btn-sm" href="del.php?id=<?php echo $row['id']; ?>" >删除</a>
    </div>
    <div style="background-color:#eff5fb; padding:10px">
    	<h4><strong><?php echo $row['title'] ?></strong></h4>
        <table>
        	<tr>
            	<td>发件人</td>
            	<td><?php echo $row['sender']; ?></td>
            </tr>
        	<tr>
            	<td>时间</td>
            	<td><?php echo $row['stime']; ?></td>
            </tr>
        </table>
    </div>
    <div style="padding:20px 10px" class="">
    	<?php echo $row['content']; ?>
    </div>
	<div style=" background-color:#C1D9F3; padding:5px" >
    	<a class="btn btn-default btn-sm" href="del.php?id=<?php echo $row['id']; ?>" >删除</a>
    </div>
</div>
</body>
</html>