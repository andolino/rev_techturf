@extends('layouts.app-teacher-dashboard')
@section('content')
	<div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center">
		<div class="row w-100 p-4">
			<div class="cont-account-settings col-lg-5 m-auto custom-shadow p-0 background-none">
        <div class="head-upcoming-lesson bg-dark mb-0 pb-2 pt-3 pl-3">
          <h5 class="font-weight-regular">Upcoming Lesson </h5>
        </div>
        <div class="p-3">
          <div class="row mt-5">
            <teacher-acct-settings></teacher-acct-settings>
            {{-- <div class="col-lg-4 text-right">
              <img src="{{ asset('images/ellipse-4.png') }}" alt="">
              <div class="value">0</div>
              <input type="range" min="0" max="10" step="1" value="0">
            </div>
            <div class="col-lg-8"></div> --}}
          </div>
        </div>
      </div>
		</div>
	</div>


@endsection
