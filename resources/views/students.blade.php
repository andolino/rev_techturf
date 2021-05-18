@extends('layouts.app-student-dashboard')

@section('content')
<div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center">
    <div class="row w-100 p-4">
        {{-- left content --}}
        <div class="col-lg-3 pr-0">
						
            <div class="form-group ico-wrapper-find">
                <form action="{{ url('students') }}" method="get">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control form-control-lg find-tutor-ipt font-14" placeholder="Find Tutor" name="q">
                </form>
            </div>
            <div class="cont-upcoming-lesson">
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
            @if ($teachers)
                <fetch-feeds :findtutor="{{ $teachers }}"></fetch-feeds>
            @else
                <fetch-feeds></fetch-feeds>
            @endif
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