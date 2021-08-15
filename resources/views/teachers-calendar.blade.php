@extends('layouts.app-teacher-dashboard')
@section('content')
	<div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center">
		<div class="row w-100 p-4">
			<div class="cont-account-settings col-lg-10 m-auto custom-shadow p-0 background-none">
        <div class="head-upcoming-lesson bg-dark mb-0 pb-2 pt-3 pl-3">
          <h5 class="font-weight-regular">Today's Schedule </h5>
        </div>
        <div class="p-3">
            <teachers-calendar></teachers-calendar>
        </div>
      </div>
		</div>
	</div>
@endsection
