<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
<?php include_once("conn/conn.php"); ?>
<?php 
$sqlstr = "select * from receive where id = ".$_GET['id'];
$result = mysqli_query($conn,$sqlstr);
$row = mysqli_fetch_array($result);
$sqlstr = "update receive set isread = 1 where id = ".$_GET['id'];
mysqli_query($conn,$sqlstr);
?>
<title><?php echo $row['title'] ?></title>
</head>

<body>
<!--左侧导航栏-->
<nav style="position: absolute;height:100px;width:150px">12123123</nav>
<div style="position: relative !important; margin-left:150px;" class="container-fluid">
	<!--头工具条-->
	<div class="text-left" style=" background-color:#C1D9F3; padding:5px">
    	<a class="btn btn-default btn-sm" href="del.php?id=<?php echo $row['id']; ?>" >删除</a>
    </div>
    
    <!--信件信息-->
    <div class="mail-box-header" style="background-color:#eff5fb; padding:10px">
    	<h2><strong><?php echo $row['title'] ?></strong></h2>
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
    
    <div class="mail-box">
    	<div class="mail-body"><?php echo $row['content']; ?></div>
    </div>
    
	<!--尾工具条-->
	<div class="text-left" style=" background-color:#C1D9F3; padding:5px" >
    	<a class="btn btn-default btn-sm" href="del.php?id=<?php echo $row['id']; ?>" >删除</a>
    </div>
</div>
</body>
</html>