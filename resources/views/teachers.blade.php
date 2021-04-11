@extends('layouts.app-teacher-dashboard')
@section('content')
	<div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center">
		<div class="row w-100 p-4">
			<div class="col-lg-3 pr-0">
				<div class="cont-upcoming-lesson">
					<div class="head-upcoming-lesson bg-dark mb-0 pb-2 pt-3 pl-3"><h4 class="font-weight-regular">Upcoming Lesson <span class="float-right pr-2" style="line-height: 1.5"><i class="fas fa-chevron-right"></i></span></h4></div>
					<div class="body-upcoming-lesson p-3">
						<label class="text-center w-100 font-weight-bold"><?php echo date('l, F, j, Y'); ?></label>
						<p class="text-center"><?php echo date('H:i A'); ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-5 offset-lg-1">
				<div class="card rounded-11px">
					<div class="card-body">
						<div class="cicle-active"></div>
						<h4 class="ml-3"> James Cameron</h4>
						Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis saepe modi, molestiae ad illum nihil at corrupti a, excepturi expedita repellendus quae vel possimus consequuntur rem! Ipsam itaque quis ex.
					</div>
				</div>
			</div>
			<div class="col-lg-4">

			</div>
		</div>
	</div>
@endsection
