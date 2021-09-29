@extends('layouts.app-student-dashboard')
@section('content')
	<div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center">
		<div class="row w-100 p-4">
			<div class="cont-account-settings col-lg-6 m-auto custom-shadow p-0 background-none">
        <div class="head-upcoming-lesson bg-dark mb-0 pb-2 pt-3 pl-3">
          <h5 class="font-weight-regular">Purchase History </h5>
        </div>
        <div class="p-3">
            {{-- <teachers-purchase-history></teachers-purchase-history> --}}
            <table class="table table-striped font-14" id="">
              <thead>
                <tr>
                  <th>Course Purchased</th>
                  <th>Tutor</th>
                  <th>Date</th>
                  <th>Total Price</th>
                  <th>Payment Type</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($purchases as $item)
                <tr>
                  <td>{{ $item->title }}</td>
                  <td>{{ $item->teacher_name }}</td>
                  <td>{{ date('F j, Y', strtotime($item->response_date)) }}</td>
                  <td>{{ number_format($item->gross_amount, 2) }}</td>
                  <td>{{ 'Stripe' }}</td>
                  <td><button type="button"
                              class="btn btn-default btn-sm btn-dashboard mb-3 p-2 font-12 w-100">See Invoice</button></td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
		</div>
	</div>
@endsection
