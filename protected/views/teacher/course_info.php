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
                    <li><a href="/Teacher/SearchStudent">学生查询</a></li>
                    <li><a href="/Teacher/SearchCourses/" class="active">我的课程</a></li>
<!--                    <li><a href="/Teacher/NeedEnterScoreList">成绩录入</a></li>-->
                    <li><a href="/Teacher/index/">个人信息</a></li>
                    <li><a href="/site/logout/">退出</a></li>
                    <a href="#top" class="close toggle-btn"><i class="fa fa-remove"></i></a>
				</ul>
			</nav>
			<!-- 主体 -->
			<div id="mainbody" class="clean">
				<table >
					<thead>
						<tr>
							<th colspan="3" style="text-align:left; font-weight:700; font-size: 15px; padding-left: 20px">课程信息</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>课程名</td>
							<td><?php echo $course->name; ?></td>
						</tr>
						<tr>
							<td>上课地点</td>
							<td><?php echo $course->address; ?></td>
						</tr>
						<tr>
							<td>上课时间</td>
							<td><?php echo $course->time; ?></td>
						</tr>
						<tr>
							<td>开始时间</td>
							<td><?php echo $course->begintime; ?></td>
						</tr>
						<tr>
							<td>结束时间</td>
							<td><?php echo $course->endtime; ?></td>
						</tr>
						<tr>
							<td>任课教师</td>
							<td><a href="/Teacher/InfoTeacher/id/<?php echo $teacher->id ?>"><?php echo $teacher->username; ?></a></td>
						</tr>
						<tr>
							<td>选课人数</td>
							<td><?php echo $course->has_num . '/' . $course->num; ?></td>
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