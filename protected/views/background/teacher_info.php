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
					<li><a href="/background/StudentInfo/">学生管理</a></li>
					<li><a href="/background/TeacherInfo/" class="active">教师管理</a></li>
					<li><a href="/background/CoursesList/">课程管理</a></li>
					<li><a href="/background/index/">个人信息</a></li>
                    <li><a href="/site/logout/">退出</a></li>
					<a href="#top" class="close toggle-btn"><i class="fa fa-remove"></i></a>
				</ul>
			</nav>
			<!-- 主体 -->
			<div id="mainbody" class="clean">
				<table >
					<thead>
						<tr>
							<th colspan="3" style="text-align:left; font-weight:700; font-size: 15px; padding-left: 20px">教师信息</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>姓名</td>
							<td><?php echo $teacher->username; ?></td>
						</tr>
						<tr>
							<td>工号</td>
							<td><?php echo $teacher->job_number; ?></td>
						</tr>
						<tr>
							<td>个人简介</td>
							<td><?php echo $teacher->introduction ?></td>
						</tr>
						<tr>
							<td>教授课程</td>
							<td>
								<?php foreach ($courses as $course) { ?>
										<div style="margin-top: 10px"><?php echo $course->name . ' - ' . $course->begintime; ?></div>
								<?php } ?>
							</td>
						</tr>
					</tbody>
				</table>
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