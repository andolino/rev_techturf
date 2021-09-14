@extends('layouts.app-admin')
@section('content')
      <main>
          <div class="container-fluid px-4">
              <h1 class="mt-4">Teachers Wallet</h1>
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
                                  <th>Student Name</th>
                                  <th>Teachers Name</th>
                                  <th>Currency</th>
                                  <th>Date</th>
                                  <th>Transaction ID.</th>
                                  <th>Amount.</th>
                              </tr>
                          </thead>
                          
                          <tfoot>
                              <tr>
                                <th>Student Name</th>
                                <th>Teachers Name</th>
                                <th>Currency</th>
                                <th>Date</th>
                                <th>Transaction ID.</th>
                                <th>Amount.</th>
                              </tr>
                          </tfoot>
                          <tbody>
                            @foreach ($paymentTransaction as $row)
                                <tr>
                                  <td>{{ $row->student_name }}</td>
                                  <td>{{ $row->teacher_name }}</td>
                                  <td>{{ $row->currency }}</td>
                                  <td>{{ date('m/d/Y H:i', strtotime($row->response_date)) }}</td>
                                  <td>{{ $row->trans_id }}</td>
                                  <td>{{ number_format($row->amount, 2) }}</td>
                                </tr>
                            @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </main>
      
@endsection
