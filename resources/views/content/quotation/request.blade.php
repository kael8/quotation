@extends('layouts/contentNavbarLayout')

@section('title', 'Request')

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
<style>
  /* Style for the search list */
  .searchList {
    display: none;
    position: absolute;
    background-color: white;
    border: 1px solid #ccc;
    max-height: 200px;
    overflow-y: auto;
    width: 100%; /* Adjust width as needed */
  }
  .searchList ul {
    list-style-type: none;
    padding: 5px;
    margin: 0;
    cursor: pointer;
  }
  .searchList ul:hover {
    background-color: #f2f2f2;
  }
</style>
<div class="row gy-4">


  <!-- Transactions -->
  <div class="col-lg-12">
    <div class="card">
      <div class="container">
      <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <h5 class="card-header">Requests</h5>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-end">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertReqListModal">Insert Request</button>

            </div>
        </div>
      </div>
      <div class="modal fade" id="insertReqListModal" tabindex="-1" role="dialog" aria-labelledby="insertReqListModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="insertReqListModalLabel">Insert Request</h5>

            </div>
            <div class="modal-body">
              <!-- Your form or content for inserting labor goes here -->
              <form id="formAuthentication" class="mb-3" method="POST">
                <div class="form-group">
                  <div class="container">

                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-floating form-floating-outline mb-4">

                        <input class="form-control" list="datalistOptions" name = "requestorID" id="exampleDataList" placeholder="Type to search...">
                            <datalist id="datalistOptions">
                              @foreach($requestorList as $requestor)
                                <option value = "{{ $requestor->requestor }}"></option>
                              @endforeach
                            </datalist>
                            <label for="exampleDataList">Requestor</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-floating form-floating-outline mb-4">

                      <input type="text" class="form-control" name = "jobRequest">
                      <label for="exampleDataList">Job Request No.</label>
                      </div>

                      </div>

                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="department">Subject</label>

                        <textarea class="form-control" name="subject" placeholder="Enter Subject"></textarea>
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
                        <th>Job Request No.</th>
                        <th>Requestor</th>
                        <th>Subject</th>
                        <th>Modify</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                @foreach ($quotationReq as $quotation)
                <tr>
    <td>{{ $quotation->reqID }}</td>
    <td>{{ $quotation->requestor }}</td>
    <td>
    <span class="subject">{{ Str::limit($quotation->subject, 40) }}</span>
    <span class="full-subject" style="display: none;">{{ $quotation->subject }}</span>
    </td>
    <td>
        <button type="button" class="btn btn-danger p-2 delete-modal" data-toggle="modal" data-target="#insertReqListModalDel" data-reqID="{{ $quotation->reqID }}" id="del"><i class="fa-solid fa-trash"></i></button>
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

                        <input type="text" class="form-control" name="del-request" value = "{{ $quotation->reqID }}" id = "request-del" hidden>
                        <p>Are you sure you want to delete this requestor? <br><h4 id = "del-request"></h4></p>
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
<script src="{{ asset('assets/js/add-request.js') }}"></script>
<script src="{{ asset('assets/js/requestSearch.js') }}"></script>
<script src="{{ asset('assets/js/delete-request.js') }}"></script>
<script src="{{ asset('assets/js/modify-request.js') }}"></script>















<script>
  $(document).on('click', '.subject', function () {
    var subject = $(this).siblings('.subject');
            var fullSubject = $(this).siblings('.full-subject');
            if (fullSubject.is(":visible")) {
                $(this).show();
                fullSubject.hide();
            } else {
                $(this).hide();
                fullSubject.show();
            }
  });

  $(document).on('click', '.full-subject', function () {
    var subject = $(this).siblings('.subject');
            var fullSubject = $(this).siblings('.full-subject');
            if (fullSubject.is(":visible")) {
              $(this).siblings('.subject').show();
                fullSubject.hide();
            } else {
                $(this).hide();
                $(this).siblings('.subject').show();
            }
  });






    $(document).ready(function() {
        $('#search-box').on('input', function() {
            var query = $(this).val();
            if (query !== '') {
                // Simulated results, replace with actual search functionality
                var results = ['Result 1', 'Result 2', 'Result 3'];
                displayResults(results);
            } else {
                $('#search-results').removeClass('show'); // Hide the dropdown if the search box is empty
            }
        });
    });

    function displayResults(results) {
        var resultsContainer = $('#search-results').find('.dropdown-menu');
        resultsContainer.empty(); // Clear previous results
        if (results.length > 0) {
          console.log(results);
            results.forEach(function(result) {
                var listItem = $('<li class="dropdown-item"></li>').text(result);

                resultsContainer.append(listItem);
                console.log(resultsContainer);
            });
            $('#search-results').addClass('show'); // Show the dropdown
        } else {
            var noResultsItem = $('<li class="dropdown-item disabled"></li>').text('No results found');
            resultsContainer.append(noResultsItem);
            $('#search-results').addClass('show'); // Show the dropdown with "No results found" message
        }
    }
</script>




<script>
  const searchInput = document.getElementById('searchInput');
  const searchList = document.querySelector('.searchList');

  searchInput.addEventListener('input', function() {
    const searchText = searchInput.value.toLowerCase();

    // Show or hide the search list based on input
    if (searchText.trim() !== '') {
      searchList.style.display = 'block';
    } else {
      searchList.style.display = 'none';
    }

    // Filter and display matching items in the search list
    const items = searchList.querySelectorAll('ul');
    items.forEach(item => {
      const textContent = item.textContent.toLowerCase();
      if (textContent.includes(searchText)) {
        item.style.display = 'block';
      } else {
        item.style.display = 'none';
      }
    });
  });

  // Select the item when clicked and populate the input field
  searchList.addEventListener('click', function(event) {
    if (event.target.tagName === 'UL') {
      searchInput.value = event.target.textContent;
      searchList.style.display = 'none';
    }
  });

  // Hide the search list when clicking outside of it or the input
  document.addEventListener('click', function(event) {
    if (!searchList.contains(event.target) && event.target !== searchInput) {
      searchList.style.display = 'none';
    }
  });
</script>
@endsection
