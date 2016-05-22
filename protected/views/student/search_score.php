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
                    <!-- <li><a href="/Student/SearchTeacher/">教师查询</a></li> -->
                    <li><a href="/Student/SearchScore/" class="active">成绩查询</a></li>
                    <li><a href="/Student/index/">个人信息</a></li>
                    <li><a href="/site/logout/">退出</a></li>
                    <a href="#top" class="close toggle-btn"><i class="fa fa-remove"></i></a>
                </ul>
			</nav>
			<!-- 主体 -->
			<div id="mainbody" class="clean">
				<h3>我的成绩</h3>
				<?php if($courses) { ?>
				<table>
					<tr>
						<th>课程名</th>
						<th>学生姓名</th>
						<th>成绩</th>
					</tr>
                    <?php foreach($courses as $val){ ?>
					<tr>
						<td><?php echo Courses::getNameById($val->courses_id); ?></td>
						<td><?php echo Student::getNameById($val->student_id)?></td>
						<td><?php echo $val->score === null? '尚未录入': $val->score ?></td>
                    </tr>
                    <?php }?>
				</table>
                    <?php if(isset($courses)){?>
                        <div class="pages">
                            <?php $this->widget('CLinkPager',array( 'header'=>'', 'prevPageLabel' => '上一页', 'nextPageLabel' => '下一页', 'firstPageLabel' => false, 'lastPageLabel' => false,'pages' => $pages, 'maxButtonCount'=>5, 'htmlOptions'=>array ('class'=>'pager') ) ); ?>
                        </div>
                    <?php }?>
				<?php } else { ?>
					<div class="message yellow">
						<h3>暂无成绩</h3>
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