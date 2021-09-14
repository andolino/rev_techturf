@extends('layouts.app-admin')
@section('content')
      <main>
          <div class="container-fluid px-4">
              <h1 class="mt-4">Students Payments</h1>
              <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">List of Payments</li>
              </ol>
              <div class="card mb-4">
                  <div class="card-header">
                      <i class="fas fa-table me-1"></i>
                      {{-- DataTable Example --}}
                  </div>
                  <div class="card-body">
                      <table id="dtStudentPayment">
                          <thead>
                              <tr>
                                  <th>Teacher Name</th>
                                  <th>Student Name</th>
                                  <th>Lesson Type</th>
                                  <th>Date</th>
                                  <th>Transaction ID.</th>
                                  <th>Charge ID.</th>
                                  <th>Amount</th>
                                  <th>Refund Amount</th>
                                  <th>Currency</th>
                                  <th>Transaction Type</th>
                              </tr>
                          </thead>
                          
                          <tfoot>
                              <tr>
                                <th>Teacher Name</th>
                                <th>Student Name</th>
                                <th>Lesson Type</th>
                                <th>Date</th>
                                <th>Transaction ID.</th>
                                <th>Charge ID.</th>
                                <th>Amount</th>
                                <th>Refund Amount</th>
                                <th>Currency</th>
                                <th>Transaction Type</th>
                              </tr>
                          </tfoot>
                          <tbody>
                            @foreach ($paymentTransaction as $row)
                                <tr>
                                  <td>{{ $row->teacher_name }}</td>
                                  <td>{{ $row->student_name }}</td>
                                  <td>{{ $row->title }}</td>
                                  <td>{{ date('m/d/Y H:i', strtotime($row->response_date)) }}</td>
                                  <td>{{ $row->user_id }}</td>
                                  <td>{{ $row->charge_id }}</td>
                                  <td>{{ $row->amount }}</td>
                                  <td>{{ $row->refund_amount }}</td>
                                  <td>{{ $row->currency }}</td>
                                  <td>{{ strtoupper($row->trans_type) }}</td>
                                </tr>
                            @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </main>
      
@endsection
