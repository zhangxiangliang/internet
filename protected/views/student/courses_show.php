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
                    <li><a href="/Student/SearchCourses/" class="active">我的课程</a></li>
                    <li><a href="/Student/PublicCoursesList/">选课</a></li>
                    <!-- <li><a href="/Student/SearchTeacher/">教师查询</a></li> -->
                    <li><a href="/Student/SearchScore/">成绩查询</a></li>
                    <li><a href="/Student/index/">个人信息</a></li>
                    <li><a href="/site/logout/">退出</a></li>
                    <a href="#top" class="close toggle-btn"><i class="fa fa-remove"></i></a>
				</ul>
			</nav>
			<!-- 主体 -->
			<div id="mainbody" class="clean">
                <?php $form=$this->beginWidget('CActiveForm', array( 'id'=>'login-form', 'enableClientValidation'=>true, 'clientOptions'=>array( 'validateOnSubmit'=>true, ), )); ?>
                <div class="search">
                    <?php echo $form->textField($model,'name',array('placeholder'=>'搜索课程名')); ?>
                    <?php echo CHtml::submitButton( '搜索',$htmlOptions=array ('class'=>'btn blue')); ?>
                </div>
                <?php $this->endWidget(); ?>
				<h3>我的课程</h3>
				<?php if($courses) { ?>
				<table>
					<tr>
						<th>课程名</th>
						<th>上课时间</th>
						<th>上课地点</th>
						<th>任课教师</th>
                        <th>操作</th>
					</tr>
                    <?php foreach($courses as $val){
                          $course = Courses::getModelById($val->courses_id);
                          $teacher = Teacher::getNameById($course->teacher_id);
                          if(!$course || !$teacher) {
                          	continue;
                          }
                    ?>
					<tr>
						<td><a href="/Student/InfoCourse/id/<?php echo $course->id ?>"><?php echo $course->name; ?></a></td>
						<td><?php echo $course->time; ?></td>
						<td><?php echo $course->address; ?></td>
						<td><a href="/student/InfoTeacher/id/<?php echo $course->teacher_id;?>"><?php echo $teacher; ?></a></td>
                        <td class="big-td">
                            <a href="/student/StudentDelCourses/courses_id/<?php echo $course->id;?>/sc_id/<?php echo $val->id;?>" class="btn blue small">退选</a>
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
						<h3>暂无课程</h3>
						<p>请进行选课</p>
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