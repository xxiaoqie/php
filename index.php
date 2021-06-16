<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>邮箱系统</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/jquery-2.1.1.js"></script>
<style>
</style>
<script>
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
        window.onload = function(){
            document.getElementById("delSelected").onclick = function(){
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
<div class="mailcontainer" style="padding-left:15%;">
	<div> <a class="btn btn-default btn-sm" href="javascript:void(0);" id="delSelected">删除选中</a></div>
	<form id="form" action="del.php" method="post">
        <table class="table table-hover table-condensed">
            <tr class="success">
                <th width="1%" class=""><input type="checkbox" id="firstCb"></th>
                <th><table width="100%"><tr>
                	<td width="20%">发件人</td>
                    <td width="60%">主题</td>
                    <td width="20%">时间</td>
                </tr></table></th>
                <th width="5%">操作</th>
            </tr>
            <?php
				$sqlstr = "select * from receive order by id";
				$result = mysqli_query($conn,$sqlstr);
				while( $rows = mysqli_fetch_array($result) ) {
			?>
			<tr>
                <td><input type="checkbox" name="chk[]" value="<?php echo $rows['id']; ?>"/> </td>
                <td>
                	<a style="text-decoration:none" href="readmail.php?id=<?php echo $rows['id'];?>"><table width="100%"><tr>
                    	<td width="20%"><?php echo $rows['sender']; ?></td>
                        <td width="60%"><?php echo $rows['title']; ?></td>
                        <td width="20%"><?php echo $rows['stime']; ?></td>
                    </tr></table></a>
                </td>
				<td><a href="#" onclick="del(<?php echo $rows['id'];?>)">删除</a></td>
            </tr>
            <?php 
				}
			?>
    </table>
    </form>
</div>
</body>
</html>