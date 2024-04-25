@extends('layouts/contentNavbarLayout')

@section('title', 'Worker List')

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
                <h5 class="card-header">Worker List</h5>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-end">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertLaborModal">Insert Worker</button>

            </div>
        </div>
      </div>
      <div class="modal fade" id="insertLaborModal" tabindex="-1" role="dialog" aria-labelledby="insertLaborModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="insertLaborModalLabel">Insert Labor</h5>

            </div>
            <div class="modal-body">
              <!-- Your form or content for inserting labor goes here -->
              <form id="formAuthentication" class="mb-3" method="POST">
                <div class="form-group">
                  <div class="container">
                    <div class="row">
                      <div class="col">
                        <label for="laborName">Labor Name</label>
                        <input type="text" class="form-control" name="labor" placeholder="Enter Labor Name">
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="Rate">Rate</label>
                        <input type="number" class="form-control" name="rate" placeholder="Enter Rate">
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
                        <th>Worker List</th>
                        <th>Rate</th>
                        <th>Modify</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                @foreach ($workers as $worker)
                <tr>
                    <td>{{ $worker->labor }}</td>
                    <td>₱{{ $worker->rate }}</td>
                    <td>
                        <button type="button" class="btn btn-primary p-2 open-modal update-modal" data-toggle="modal" data-target="#insertWorkerModalMod"
                                data-labor="{{ $worker->labor }}" data-rate="{{ $worker->rate }}">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                        <button type="button" class="btn btn-danger p-2 delete-modal" data-toggle="modal" data-target="#insertLaborModalDel" data-labor="{{ $worker->labor }}" id="del"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach


                </tbody>
            </table>

        </div>

    </div>

  </div>


</div>

<div class="modal fade" id="insertWorkerModalMod" tabindex="-1" role="dialog" aria-labelledby="insertWorkerModalMod" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="insertWorkerModalLabel">Modify Worker</h5>

            </div>
            <div class="modal-body-update">
              <!-- Your form or content for inserting labor goes here -->
              <form id="formAuthenticationModify" class="mb-3" method="POST">
                <div class="form-group">
                  <div class="container">

                    <div class="row">
                      <div class="col">
                        <h3 id = "laborMod" class = "text-center"></h3>
                        <input type="text" class="form-control" name="mod-labor" id = "laborInput" hidden>
                        <label for="Rate">Rate</label>
                        <input type="number" class="form-control" name="mod-rate" placeholder="Enter Rate" id = "RateInput">
                      </div>

                    </div>
                  </div>


                </div>

                <!-- Add more form fields as needed -->
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="update">Update</button>
            </div>
          </div>
        </div>
      </div>



      <div class="modal fade" id="insertWorkerModalDel" tabindex="-1" role="dialog" aria-labelledby="insertLaborModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="insertLaborModalLabel">Delete labor</h5>

            </div>
            <div class="modal-body-update">
              <!-- Your form or content for inserting labor goes here -->
              <form id="formAuthenticationDelete" class="mb-3" method="POST">
                <div class="form-group">
                  <div class="container">

                    <div class="row">
                      <div class="col">

                        <input type="text" class="form-control" name="del-labor" id = "labor-del" hidden>
                        <p>Are you sure you want to delete this labor? <br><h4 id = "del-labor"></h4></p>
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
<script src="{{ asset('assets/js/add-worker.js') }}"></script>
<script src="{{ asset('assets/js/workerSearch.js') }}"></script>
<script src="{{ asset('assets/js/update-worker-modal.js') }}"></script>
<script src="{{ asset('assets/js/modify-worker.js') }}"></script>
<script src="{{ asset('assets/js/update-worker.js') }}"></script>

<script src="{{ asset('assets/js/delete-worker.js') }}"></script>
@endsection
