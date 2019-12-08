<!DOCTYPE html>

<html lang="en">

<head>
		<title>Course Edit</title>
		
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: GOOGLE FONTS -->
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<!-- end: GOOGLE FONTS -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="{{Asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{Asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
		<link rel="stylesheet" href="{{Asset('bower_components/themify-icons/themify-icons.css')}}">
		<link rel="stylesheet" href="{{Asset('bower_components/flag-icon-css/css/flag-icon.min.css')}}">
		<link rel="stylesheet" href="{{Asset('bower_components/animate.css/animate.min.css')}}">
		<link rel="stylesheet" href="{{Asset('bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css')}}">
		<link rel="stylesheet" href="{{Asset('bower_components/switchery/dist/switchery.min.css')}}">
		<link rel="stylesheet" href="{{Asset('bower_components/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css')}}">
		<link rel="stylesheet" href="{{Asset('bower_components/ladda/dist/ladda-themeless.min.css')}}">
		<link rel="stylesheet" href="{{Asset('bower_components/slick.js/slick/slick.css')}}">
		<link rel="stylesheet" href="{{Asset('bower_components/slick.js/slick/slick-theme.css')}}">
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: Packet CSS -->
		<link rel="stylesheet" href="{{Asset('assets/css/styles.css')}}">
		<link rel="stylesheet" href="{{Asset('assets/css/plugins.css')}}">
		<link rel="stylesheet" href="{{Asset('assets/css/themes/lyt1-theme-1.css')}}" id="skin_color">
		<!-- end: Packet CSS -->
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<!-- end: HEAD -->
	<body>
		<div id="app">
			<!-- sidebar -->
			{!!View('center.menu') !!}
			<!-- / sidebar -->
			<div class="app-content">
				<!-- start: TOP NAVBAR -->
				<header class="navbar navbar-default navbar-static-top">
					<!-- start: NAVBAR HEADER -->
					{!!View('center.nav')!!}
					<!-- end: NAVBAR HEADER -->
					<!-- start: NAVBAR COLLAPSE -->
					{!!View('center.top')!!}
					<!-- end: NAVBAR COLLAPSE -->
				</header>
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: BREADCRUMB -->
						<div class="breadcrumb-wrapper">
							<h4 class="mainTitle no-margin"><i class="fa fa-edit"></i> Course Edit</h4>
							
							<ul class="pull-right breadcrumb">
								<li>
									<a href="{{Asset('center/home')}}"><i class="fa fa-home margin-right-5 text-large text-dark"></i>Home</a>
								</li>
								<li>
									<i class="fa fa-graduation-cap"></i> Student
								</li>
							</ul>
						</div>					
						
						@if (count($errors) > 0)
						<div class="alert alert-danger">
						<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
						</ul>
						</div><br>
						@endif
						
						@if(Session::has('message'))
						<Br><p class="text-center list-group-item list-group-item-success">{{ Session::get('message') }}</p>
						@endif
						
						<script>

						function getFee(id)
						{
						
						var xmlhttp;
						if (window.XMLHttpRequest)
						{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
						}
						else
						{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp.onreadystatechange=function()
						{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
						{
						document.getElementById("fee").innerHTML=xmlhttp.responseText;
						}
						}
						xmlhttp.open("GET","../../../getFee.php?id="+id,true);
						xmlhttp.send();
						}
						</script>
						
						<!-- end: BREADCRUMB -->
						<!-- start: FEATURED BOX LINKS -->
						
						<div class="container-fluid container-fullw">
						<div class="row">
						<div class="col-md-12">
						<div class="panel panel-white">
						<div class="panel-body">
						<h5 class="over-title"><i class="fa fa-edit"></i> Edit</h5>
						<form action="{!! Asset('center/student/courseEdit/'.$res->student_id) !!}" method="post" class="form-login">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
						<div class="col-md-10">
						<fieldset>
						<legend>
						Current Course Details
						</legend>
						
						<div class="form-group">
						<label> Course </label>
						<div class="form-group">
						<select name="course_id" class="form-control" required  disabled="disabled">
						<option value="">Select Course</option>
						<?php
						$courses = DB::table("course")->where('status',0)->get();
						foreach($courses as $course)
						{
						?>
						<option value="{{$course->id}}" <?php if($course->id == $res->course_id){ echo "selected"; } ?>>{{$course->name}}</option>
						<?php } ?>
						</select>
						</div>
						</div>
						
						<div class="form-group" >
						<label>Batch</label>
						<div class="form-group">
						<select name="batch" class="form-control" required disabled="disabled">
						<option value="">Select Batch</option>
						<?php
						$btc = DB::table("course_batch")->where('course_id',$res->course_id)->get();
						foreach($btc as $bt)
						{
						?>
						<option value="{{$bt->batch_name}}" <?php if($bt->batch_name == $res->batch){ echo "selected"; } ?>>{{$bt->batch_name}}</option>
						<?php } ?>
						</select>
						</div>
						</div>
						
						
						<?php 
						$feeSum = DB::table('fee')->where('student_id',$res->student_id)->where('course_id',$res->course_id)->where('type',1)->lists('amount');
						?>
						
						<div class="form-group">
						<label>Course Fee</label>
						<div class="form-group">
						<input type="text" class="form-control"  value="{{$res->course_fee}}" disabled="disabled">
						</div>
						</div>
						
						<div class="form-group">
						<label>Total Fee Deposited</label>
						<div class="form-group">
						<input type="text" class="form-control"  value="{{array_sum($feeSum)}}" disabled="disabled">
						</div>
						</div>

						</fieldset>
						<fieldset>
						<legend>
						Course Details
						</legend>
						<input type="hidden" name="old_course" value="{{$res->id}}">
						<div class="form-group">
						<label> Course <span class="symbol required"></span> </label>
						<div class="form-group">
						<select name="course_id" class="form-control" required onchange="getFee(this.value)">
						<option value="">Select Course</option>
						<?php
						$courses = DB::table("course")->where('status',0)->get();
						foreach($courses as $course)
						{
						?>
						<option value="{{$course->id}}">{{$course->name}}</option>
						<?php } ?>
						</select>
						</div>
						</div>
						<span id="fee">
						<div class="form-group" >
						<label>Batch</label>
						<div class="form-group">
						<select name="batch" class="form-control" required>
						<option value="">Select Batch</option>
						</select>
						</div>
						</div>
						
						<div class="form-group">
						<label>Course Fee <span class="symbol required"></span></label>
						<div class="form-group">
						<input type="number"  name="course_fee" id="course_fee" class="form-control"  value="" required>
						</div>
						</div>
						</span>				
						
						<div class="form-group">
						<label> Joining Date <span class="symbol required"></span></label>
						<div class="form-group">
						<input type="text"  name="joining_date" id="datepicker3" class="form-control"  value="{{old('joining_date')}}" required >
						</div>
						</div>
						
						<?php if(array_sum($feeSum) > 0){ ?>
						
						<div class="form-group">
						<label> Do you want to less old course deposit fee from this course ? <span class="symbol required"></span></label>
						<div class="form-group">
						<select name="old_course_fee" class="form-control">
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
						</div>
						</div>
						<?php } ?>
						
						<div class="form-group">
						<label>Any Other Discount ( <i>Optional</i> )</label>
						<div class="form-group">
						<input type="number"  name="discount" id="discount" class="form-control"  value="{{old('discount')}}">
						</div>
						</div>
						
						<div class="form-group">
						<label> Any reason for course leaving  ( <i>Optional</i> )</label>
						<div class="form-group">
						<textarea name="reason" class="form-control" ></textarea>
						</div>
						</div>
						
						<div class="form-group">						
						<div class="form-group">
						<button type="submit" class="btn btn-wide btn-success">Save</button>
						
						</div>
						</div>
						
						</fieldset>												
						</form>
						</div>
						</div>
						</div>
						</div>
						</div>
						</div>
						</div>
						
			</div>
			</div>
			</div>
			<!-- start: FOOTER -->
			{!!View('center.footer')!!}
			<!-- end: FOOTER -->
			
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		
		<script src="{{Asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
		<script src="{{Asset('bower_components/components-modernizr/modernizr.js')}}"></script>
		<script src="{{Asset('bower_components/js-cookie/src/js.cookie.js')}}"></script>
		<script src="{{Asset('bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}"></script>
		<script src="{{Asset('bower_components/jquery-fullscreen/jquery.fullscreen-min.js')}}"></script>
		<script src="{{Asset('bower_components/switchery/dist/switchery.min.js')}}"></script>
		<script src="{{Asset('bower_components/jquery.knobe/dist/jquery.knob.min.js')}}"></script>
		<script src="{{Asset('bower_components/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js')}}"></script>
		<script src="{{Asset('bower_components/slick.js/slick/slick.min.js')}}"></script>
		<script src="{{Asset('bower_components/jquery-numerator/jquery-numerator.js')}}"></script>
		<script src="{{Asset('bower_components/ladda/dist/spin.min.js')}}"></script>
		<script src="{{Asset('bower_components/ladda/dist/ladda.min.js')}}"></script>
		<script src="{{Asset('bower_components/ladda/dist/ladda.jquery.min.js')}}"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="{{Asset('bower_components/Chart-js/Chart.min.js')}}"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: Packet JAVASCRIPTS -->
		<script src="{{Asset('assets/js/letter-icons.js')}}"></script>
		<script src="{{Asset('assets/js/main.js')}}"></script>
		<!-- end: Packet JAVASCRIPTS -->
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="{{Asset('assets/js/index.js')}}"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Index.init();
			});
		</script>
		
		<!-- end: JavaScript Event Handlers for this page -->
	</body>


</html>