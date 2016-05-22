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
					<li><a href="/background/TeacherInfo/">教师管理</a></li>
					<li><a href="/background/CoursesList/">课程管理</a></li>
					<li><a href="/background/index/" class="active">个人信息</a></li>
                    <li><a href="/site/logout/">退出</a></li>
                    <a href="#top" class="close toggle-btn"><i class="fa fa-remove"></i></a>
				</ul>
			</nav>
			<!-- 主体 -->
			<div id="mainbody" class="clean">
				<h3>基本信息</h3>
				<div>
					<ul>
<!--						<li><img class="head-photo" src="/images/head.jpg" alt=""></li>-->
						<li>名称：<?php echo $user->username; ?></li>
<!--						<li>邮箱：123456@qq.com</li>-->
<!--						<li>等级：管理员</li>-->
					</ul>
					<div class="btns">
						<a href="/background/ChangePassword" class="btn blue">修改密码</a>
					</div>
				</div>
			</div>
			<!-- 边栏 -->
			<div id="mainbody" class="clean">
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