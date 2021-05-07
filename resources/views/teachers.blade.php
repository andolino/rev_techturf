@extends('layouts.app-teacher-dashboard')
@section('content')
	<div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center">
		<div class="row w-100 p-4">
			{{-- left content --}}
			<div class="col-lg-3 pr-0">
				<div class="cont-upcoming-lesson">
					{{-- <div class="form-group ico-wrapper-find">
						<i class="fas fa-search"></i>
						<input type="text" class="form-control form-control-lg find-tutor-ipt" placeholder="Find Tutor">
					</div> --}}
					<div class="head-upcoming-lesson bg-dark mb-0 pb-2 pt-3 pl-3"><h5 class="font-weight-regular">Upcoming Lesson <span class="float-right pr-2" style="line-height: 1.5"><i class="fas fa-chevron-right"></i></span></h5></div>
					<div class="body-upcoming-lesson p-3">
						<label class="text-center w-100 font-weight-bold"><?php echo date('l, F, j, Y'); ?></label>
						<p class="text-center"><?php echo date('H:i A'); ?></p>
					</div>
					<div class="upcoming-lesson-list custom-scrollbar-css p-2 mCustomScrollbar" data-mcs-theme="minimal-dark">
						<div class="card-group b-bot-red">
							<div class="card">
								<div class="card-body">
									<label class="card-title">8:00 - 9:30am</label>
									<small class="float-right text-success">Class starts in 20mins</small>
									<h6 class="card-title font-weight-bold">Language 1</h6>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<img src="{{ asset('images/ellipse.png') }}" alt="">
									<small class="text-muted">Mr. James Cameron</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-yellow mt-2">
							<div class="card">
								<div class="card-body">
									<label class="card-title">8:00 - 9:30am</label>
									<small class="float-right text-success">Class starts in 20mins</small>
									<h6 class="card-title font-weight-bold">Language 1</h6>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<img src="{{ asset('images/ellipse.png') }}" alt="">
									<small class="text-muted">Mr. James Cameron</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-blue mt-2">
							<div class="card">
								<div class="card-body">
									<label class="card-title">8:00 - 9:30am</label>
									<small class="float-right text-success">Class starts in 20mins</small>
									<h6 class="card-title font-weight-bold">Language 1</h6>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<img src="{{ asset('images/ellipse.png') }}" alt="">
									<small class="text-muted">Mr. James Cameron</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-red mt-2">
							<div class="card">
								<div class="card-body">
									<label class="card-title">8:00 - 9:30am</label>
									<small class="float-right text-success">Class starts in 20mins</small>
									<h6 class="card-title font-weight-bold">Language 1</h6>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<img src="{{ asset('images/ellipse.png') }}" alt="">
									<small class="text-muted">Mr. James Cameron</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-yellow mt-2">
							<div class="card">
								<div class="card-body">
									<label class="card-title">8:00 - 9:30am</label>
									<small class="float-right text-success">Class starts in 20mins</small>
									<h6 class="card-title font-weight-bold">Language 1</h6>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<img src="{{ asset('images/ellipse.png') }}" alt="">
									<small class="text-muted">Mr. James Cameron</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-blue mt-2">
							<div class="card">
								<div class="card-body">
									<label class="card-title">8:00 - 9:30am</label>
									<small class="float-right text-success">Class starts in 20mins</small>
									<h6 class="card-title font-weight-bold">Language 1</h6>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<img src="{{ asset('images/ellipse.png') }}" alt="">
									<small class="text-muted">Mr. James Cameron</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-red mt-2">
							<div class="card">
								<div class="card-body">
									<label class="card-title">8:00 - 9:30am</label>
									<small class="float-right text-success">Class starts in 20mins</small>
									<h6 class="card-title font-weight-bold">Language 1</h6>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<img src="{{ asset('images/ellipse.png') }}" alt="">
									<small class="text-muted">Mr. James Cameron</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-yellow mt-2">
							<div class="card">
								<div class="card-body">
									<label class="card-title">8:00 - 9:30am</label>
									<small class="float-right text-success">Class starts in 20mins</small>
									<h6 class="card-title font-weight-bold">Language 1</h6>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<img src="{{ asset('images/ellipse.png') }}" alt="">
									<small class="text-muted">Mr. James Cameron</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-blue mt-2">
							<div class="card">
								<div class="card-body">
									<label class="card-title">8:00 - 9:30am</label>
									<small class="float-right text-success">Class starts in 20mins</small>
									<h6 class="card-title font-weight-bold">Language 1</h6>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<img src="{{ asset('images/ellipse.png') }}" alt="">
									<small class="text-muted">Mr. James Cameron</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-red mt-2">
							<div class="card">
								<div class="card-body">
									<label class="card-title">8:00 - 9:30am</label>
									<small class="float-right text-success">Class starts in 20mins</small>
									<h6 class="card-title font-weight-bold">Language 1</h6>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<img src="{{ asset('images/ellipse.png') }}" alt="">
									<small class="text-muted">Mr. James Cameron</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			{{-- mid content --}}

			<div class="col-lg-6 pr-2 pl-4">
				<div class="row mb-2">
					<div class="col-lg-12 float-right">
						<form class="form-inline float-right font-12">
							<label class="my-1 mr-2" for="inlineFormCustomSelectPref">Filter 1</label>
							<select class="custom-select my-1 rounded mr-3 rounded-pill font-14" id="inlineFormCustomSelectPref">
								<option selected>Choose...</option>
								<option value="1">One</option>
								<option value="2">Two</option>
								<option value="3">Three</option>
							</select>
							<label class="my-1 mr-2" for="inlineFormCustomSelectPref">Filter 1</label>
							<select class="custom-select my-1 rounded mr-3 rounded-pill font-14" id="inlineFormCustomSelectPref">
								<option selected>Choose...</option>
								<option value="1">One</option>
								<option value="2">Two</option>
								<option value="3">Three</option>
							</select>
							<label class="my-1 mr-2" for="inlineFormCustomSelectPref">Filter 1</label>
							<select class="custom-select my-1 rounded rounded-pill font-14" id="inlineFormCustomSelectPref">
								<option selected>Choose...</option>
								<option value="1">One</option>
								<option value="2">Two</option>
								<option value="3">Three</option>
							</select>
							{{-- <button type="submit" class="btn btn-primary my-1">Submit</button> --}}
						</form>
					</div>
				</div>
				<div class="card rounded-11px">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-1">
								<img src="{{ asset('images/ellipse-3.png') }}" alt="">
							</div>
							<div class="col-lg-11 pl-0">
								<div class="cicle-active"></div>
								<h4 class="ml-4"> James Cameron</h4>
								<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis saepe modi, molestiae ad 
									illum nihil at corrupti a, excepturi expedita repellendus quae vel possimus consequuntur rem! Ipsam itaque quis ex.</p>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="row cont-count-feeds">
							<div class="col-lg-1 text-right pl-1 pr-1 offset-lg-9 count-feeds-like">
								<i class="fas fa-heart"></i>
								<span class="font-12">100</span>
							</div>
							<div class="col-lg-1 text-center pl-1 pr-1 count-feeds-comment">
								<i class="fas fa-eye"></i>
								<span class="font-12">100</span>
							</div>
							<div class="col-lg-1 text-left pl-1 pr-1 count-feeds-dislikes">
								<i class="fas fa-minus-square"></i>
								<span class="font-12">100</span>
							</div>
						</div>
					</div>
				</div>
			</div>


			{{-- right content --}}
			<div class="col-lg-3 pr-0">
				<div class="cont-home-works">
					<div class="head-upcoming-lesson bg-dark mb-0 pb-2 pt-3 pl-3"><h5 class="font-weight-regular">Homeworks <span class="float-right pr-2" style="line-height: 1.5"><i class="fas fa-chevron-right"></i></span></h5></div>
					<div class="homework-list custom-scrollbar-css p-2 mCustomScrollbar" data-mcs-theme="minimal-dark">
						<div class="card-group b-bot-red">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-yellow">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-blue">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-red">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-yellow">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-blue">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-red">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-yellow">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-blue">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-red">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="cont-books-workbooks-shop mt-4">
					<div class="head-upcoming-lesson bg-dark mb-0 pb-2 pt-3 pl-3"><h5 class="font-weight-regular">Books/Workbooks Shop <span class="float-right pr-2" style="line-height: 1.5"><i class="fas fa-chevron-right"></i></span></h5></div>
					<div class="books-workbooks-list custom-scrollbar-css p-2 mCustomScrollbar" data-mcs-theme="minimal-dark">
						<div class="card-group b-bot-red">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-yellow">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-blue">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-red">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-yellow">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-blue">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-red">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-yellow">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-blue">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
						<div class="card-group b-bot-red">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Card title</h5>
									<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
								</div>
								<div class="card-footer">
									<small class="text-muted">Last updated 3 mins ago</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
