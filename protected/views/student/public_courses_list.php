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
                    <li><a href="/Student/PublicCoursesList/"  class="active">选课</a></li>
                    <!-- <li><a href="/Student/SearchTeacher/">教师查询</a></li> -->
                    <li><a href="/Student/SearchScore/">成绩查询</a></li>
                    <li><a href="/Student/index/">个人信息</a></li>
                    <li><a href="/site/logout/">退出</a></li>
                    <a href="#top" class="close toggle-btn"><i class="fa fa-remove"></i></a>
				</ul>
			</nav>
			<!-- 主体 -->
			<div id="mainbody" class="clean">
				<h3>可选课程</h3>
				<?php if($courses) { ?>
				<table>
					<tr>
						<th>课程名</th>
						<th>开始时间</th>
						<th>结束时间</th>
						<th>上课地点</th>
						<th>任课教师</th>
                        <th>操作</th>
					</tr>
                    <?php foreach($courses as $val){
                    		$teacher = Teacher::getNameById($val->teacher_id);
                    		if(!$teacher) {
                          		continue;
                          	}
                    ?>
					<tr>
						<td><?php echo $val->name; ?></td>
						<td><?php echo $val->begintime; ?></td>
						<td><?php echo $val->endtime; ?> </td>
						<td><?php echo $val->address; ?></td>
						<td><?php echo $teacher ?></td>
                        <td class="big-td">
                            <a href="/student/SelectCourses?id=<?php echo $val->id; ?>" class="btn blue small">选课</a>
                        </td>
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
						<h3>暂无可选课程</h3>
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