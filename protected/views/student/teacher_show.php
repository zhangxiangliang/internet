<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0, width=device-width, user-scalable=no">
	<link rel="stylesheet" href="/css/internet-back.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<title>互联网+ 后台管理系统</title>
</head>
<body>
	<div id="content">
		<header id="header">
			<div class="container">
				<h1>互联网+</h1>
				<h2>实践基地实训后台管理系统</h2>
			</div>
		</header>
		<div class="container">
			<a href="#nav" class="open toggle-btn">
				<i class="fa fa-reorder"></i>
			</a>
			<nav id="nav">
				<ul>
                    <li><a href="/Student/SearchCourses/">我的课程</a></li>
                    <li><a href="/Student/PublicCoursesList/">选课</a></li>
                    <!-- <li><a href="/Student/SearchTeacher/" class="active">教师查询</a></li> -->
                    <li><a href="/Student/SearchScore/">成绩查询</a></li>
                    <li><a href="/Student/index/">个人信息</a></li>
                    <li><a href="/site/logout/">退出</a></li>
                    <a href="#top" class="close toggle-btn"><i class="fa fa-remove"></i></a>
				</ul>
			</nav>
			<!-- 主体 -->
			<div id="mainbody" class="clean">
				<h3>在校老师</h3>
				<?php if($teacher) { ?>
				<table>
					<tr>
						<th>工号</th>
						<th>教师名</th>
					</tr>
                    <?php foreach($teacher as $val){ ?>
					<tr>
						<td><?php echo $val->job_number;?></td>
						<td><?php echo $val->username;?></td>
					</tr>
                    <?php }?>
				</table>
                    <?php if(isset($teacher)){?>
                        <div class="pages">
                            <?php $this->widget('CLinkPager',array( 'header'=>'', 'prevPageLabel' => '上一页', 'nextPageLabel' => '下一页', 'firstPageLabel' => false, 'lastPageLabel' => false,'pages' => $pages, 'maxButtonCount'=>5, 'htmlOptions'=>array ('class'=>'pager') ) ); ?>
                        </div>
                    <?php }?>
				<?php } else { ?>
					<div class="message yellow">
						<h3>暂无公开课程</h3>
						<p>请联系老师或者管理员</p>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<footer id="footer" style="clear: both;">
		<div class="container">
			<h5>&copy; Copyright 互联网+ </h5>
		</div>
	</footer>
</body>
</html>