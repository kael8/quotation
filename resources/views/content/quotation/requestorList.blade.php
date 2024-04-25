@extends('layouts/contentNavbarLayout')

@section('title', 'Requestor List')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')

<div class="row gy-4">


  <!-- Transactions -->
  <div class="col-lg-12">
    <div class="card">
      <div class="container">
      <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <h5 class="card-header">Requestor List</h5>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-end">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertReqListModal">Insert Worker</button>

            </div>
        </div>
      </div>
      <div class="modal fade" id="insertReqListModal" tabindex="-1" role="dialog" aria-labelledby="insertReqListModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="insertReqListModalLabel">Insert Requestor</h5>

            </div>
            <div class="modal-body">
              <!-- Your form or content for inserting labor goes here -->
              <form id="formAuthentication" class="mb-3" method="POST">
                <div class="form-group">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="reqName">Requestor Name</label>
                        <input type="text" class="form-control" name="requestor" placeholder="Enter Requestor Name">
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="department">Department</label>
                        <input type="text" class="form-control" name="department" placeholder="Enter Department">
                      </div>
                      <div class="col-md-6">
                        <label for="local">Local No.</label>
                        <input type="text" class="form-control" name="local" placeholder="Enter Local No.">
                      </div>

                    </div>
                  </div>


                </div>

                <!-- Add more form fields as needed -->
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="add">Add</button>
            </div>
          </div>
        </div>
      </div>



        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Requestor</th>
                        <th>Department</th>
                        <th>Local No.</th>
                        <th>Modify</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                @foreach ($requestors as $requestor)
                <tr>
                    <td>{{ $requestor->requestor }}</td>
                    <td>{{ $requestor->department }}</td>
                    <td>{{ $requestor->local }}</td>
                    <td>

                        <button type="button" class="btn btn-danger p-2 delete-modal" data-toggle="modal" data-target="#insertReqListModalDel" data-requestor="{{ $requestor->requestor }}" id="del"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach


                </tbody>
            </table>

        </div>

    </div>

  </div>


</div>





      <div class="modal fade" id="insertReqListModalDel" tabindex="-1" role="dialog" aria-labelledby="insertReqListModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="insertReqListModalLabel">Delete Requestor</h5>

            </div>
            <div class="modal-body-update">
              <!-- Your form or content for inserting labor goes here -->
              <form id="formAuthenticationDelete" class="mb-3" method="POST">
                <div class="form-group">
                  <div class="container">

                    <div class="row">
                      <div class="col">

                        <input type="text" class="form-control" name="del-requestor" id = "requestor-del" hidden>
                        <p>Are you sure you want to delete this requestor? <br><h4 id = "del-requestor"></h4></p>
                      </div>

                    </div>
                  </div>


                </div>

                <!-- Add more form fields as needed -->
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="delete">Delete</button>
            </div>
          </div>
        </div>
      </div>

<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/js/add-requestor.js') }}"></script>
<script src="{{ asset('assets/js/requestorSearch.js') }}"></script>
<script src="{{ asset('assets/js/delete-requestor.js') }}"></script>
<script src="{{ asset('assets/js/modify-requestor.js') }}"></script>
@endsection
