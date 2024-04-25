@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

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
                <h5 class="card-header">Material List</h5>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-end">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertItemModal">Insert Item</button>

            </div>
        </div>
      </div>
      <div class="modal fade" id="insertItemModal" tabindex="-1" role="dialog" aria-labelledby="insertItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="insertItemModalLabel">Insert Item</h5>

            </div>
            <div class="modal-body">
              <!-- Your form or content for inserting item goes here -->
              <form id="formAuthentication" class="mb-3" method="POST">
                <div class="form-group">
                  <div class="container">
                    <div class="row">
                      <div class="col">
                        <label for="itemName">Item Name</label>
                        <input type="text" class="form-control" name="itemName" placeholder="Enter item name">
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="Price">Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Enter price">
                      </div>
                      <div class="col-md-6">
                        <label for="Unit">Unit</label>
                        <select name="unit" class="form-control">
                          <option value="pcs">pcs</option>
                          <option value="pc">pc</option>
                          <option value="pack">pack</option>
                          <option value="meters">meters</option>
                          <option value="pc/pcs">pc/pcs</option>
                          <option value="set">set</option>
                          <option value="roll">roll</option>
                        </select>
                      </div>
                    </div>
                  </div>


                </div>
                <input type = 'number' name = 'page' value = '{{ $page }}' hidden>
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
                        <th>Product List</th>
                        <th>Price</th>
                        <th>Unit</th>
                        <th>Modify</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                @foreach ($materials as $material)
                <tr>
                    <td>{{ $material->item }}</td>
                    <td>₱{{ $material->price }}</td>
                    <td>{{ $material->unit }}</td>
                    <td>
                        <button type="button" class="btn btn-primary p-2 open-modal update-modal" data-toggle="modal" data-target="#insertItemModalMod"
                                data-item="{{ $material->item }}" data-price="{{ $material->price }}" data-unit="{{ $material->unit }}">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                        <button type="button" class="btn btn-danger p-2 delete-modal" data-toggle="modal" data-target="#insertItemModalDel" data-item="{{ $material->item }}" id="del"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach


                </tbody>
            </table>

        </div>

    </div>

  </div>


</div>

<div class="modal fade" id="insertItemModalMod" tabindex="-1" role="dialog" aria-labelledby="insertItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="insertItemModalLabel">Modify Item</h5>

            </div>
            <div class="modal-body-update">
              <!-- Your form or content for inserting item goes here -->
              <form id="formAuthenticationModify" class="mb-3" method="POST">
                <div class="form-group">
                  <div class="container">

                    <div class="row">
                      <div class="col">
                        <h3 id = "itemMod" class = "text-center"></h3>
                        <input type="text" class="form-control" name="mod-item" id = "itemInput" hidden>
                        <label for="Price">Price</label>
                        <input type="number" class="form-control" name="mod-price" placeholder="Enter price" id = "priceInput">
                      </div>

                    </div>
                  </div>


                </div>
                <input type = 'number' name = 'page' value = '{{ $page }}' hidden>
                <!-- Add more form fields as needed -->
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="update">Update</button>
            </div>
          </div>
        </div>
      </div>



      <div class="modal fade" id="insertItemModalDel" tabindex="-1" role="dialog" aria-labelledby="insertItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="insertItemModalLabel">Delete Item</h5>

            </div>
            <div class="modal-body-update">
              <!-- Your form or content for inserting item goes here -->
              <form id="formAuthenticationDelete" class="mb-3" method="POST">
                <div class="form-group">
                  <div class="container">

                    <div class="row">
                      <div class="col">

                        <input type="text" class="form-control" name="del-item" id = "item-del" hidden>
                        <p>Are you sure you want to delete this item? <br><h4 id = "del-item"></h4></p>
                      </div>

                    </div>
                  </div>


                </div>
                <input type = 'number' name = 'page' value = '{{ $page }}' hidden>
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
<script src="{{ asset('assets/js/add-material.js') }}"></script>
<script src="{{ asset('assets/js/materialSearch.js') }}"></script>
<script src="{{ asset('assets/js/update-material-modal.js') }}"></script>

<script src="{{ asset('assets/js/modify-material.js') }}"></script>
<script src="{{ asset('assets/js/update-material.js') }}"></script>
<script src="{{ asset('assets/js/delete-material.js') }}"></script>
@endsection
