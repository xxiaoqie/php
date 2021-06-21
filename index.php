<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>邮箱系统</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/jquery-2.1.1.js"></script>
<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />-->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script type="text/javascript">
	function delall() {
		if(confirm("您确定要删除选中条目吗？")){
		   var flag = false;
			var cbs = document.getElementsByName("chk[]");
			for (var i = 0; i < cbs.length; i++) {
				if(cbs[i].checked){
					flag = true;
					break;
				}
			}
			if(flag){
				document.getElementById("form").submit();
			}
		}
	}
	function del(id){
		if(confirm("您确定要删除吗？")){
			//location.href="del.php?id="+id;
			$.ajax({
				   url:"del.php",
				   type:"POST",
				   data:{id:id},
				   success:function(result) {
					   alert(result);
					   location.reload();
				   }
				   });
		}
	}
	function SortTable(obj) {
		if(obj.innerHTML == "发件人") {
			location.href='index.php?order=name';
		} else if(obj.innerHTML == "时间") {
			location.href='index.php?order=time';	
		}
		
	}
	$(function(){
		var table= $("#myTable").DataTable({
			searching: false,
			ordering:  false,
			bLengthChange: false,
			bFilter: false,
			bSort: false,
			bInfo: false,
			bAutoWidth: false});
	});
	window.onload = function(){
		document.getElementById("firstCb").onclick = function(){
			var cbs = document.getElementsByName("chk[]");
			for (var i = 0; i < cbs.length; i++) {
				cbs[i].checked = this.checked;
			}
		}
	}
</script>
</head>

<body>
<?php
include_once("conn/conn.php");
?>
<div style="position: relative !important; margin-left:0px;" class="container-fluid">
	<!--头工具条-->
	<div style="padding:5px;"> <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="delall()">删除选中</a></div>
    <!--邮件信息-->
	<form id="form" action="del.php" method="post">
        <table id="myTable" class="table table-hover table-condensed">
            <thead><tr class="success">
                <th class=""><input type="checkbox" id="firstCb"></th>
                <th><table width="100%"><tr>
                	<td onclick="SortTable(this)" class="as" width="20%">发件人</td>
                    <td width="60%">主题</td>
                    <td onclick="SortTable(this)"  class="as" width="20%">时间</td>
                </tr></table></th>
                <th>操作</th>
            </tr></thead>
            <tbody>
            <?php
				$sqlstr = "select * from receive order by ";
				if(!isset($_GET['order'])) {
					$sqlstr = $sqlstr."id";
				} else {
					if($_GET['order'] == 'id') $sqlstr = $sqlstr."id";
					if($_GET['order'] == 'time') $sqlstr = $sqlstr."stime";
					if($_GET['order'] == 'name') $sqlstr = $sqlstr."sender";
				}
				$result = mysqli_query($conn,$sqlstr);
				while( $rows = mysqli_fetch_array($result) ) {
			?>
			<tr>
                <td><input type="checkbox" name="chk[]" value="<?php echo $rows['id']; ?>"/> </td>
                <td>
                	<a style="text-decoration:none;<?php if($rows['isread']) echo "color:#777";?>" href="readmail.php?id=<?php echo $rows['id'];?>"><table width="100%"><tr>
                    	<td style="text-overflow:ellipsis;overflow:hidden;display:inline-block;" width="20%"><?php echo $rows['sender']; ?></td>
                        <td style="text-overflow:ellipsis;overflow:hidden;display:inline-block;" width="60%"><?php echo $rows['title']; ?></td>
                        <td style="text-overflow:ellipsis;overflow:hidden;display:inline-block;" width="20%"><?php echo $rows['stime']; ?></td>
                    </tr></table></a>
                </td>
				<td><a href="#" onclick="del(<?php echo $rows['id'];?>)">删除</a></td>
            </tr>
            <?php 
				}
			?>
            </tbody>
    </table>
    </form>
	<!--尾工具条-->
	<div style="padding:5px;"> <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="delall()">删除选中</a></div>
</div>
</body>
</html>