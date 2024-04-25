@extends('layouts/contentNavbarLayout')

@section('title', 'Quotation Records')

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
                <h5 class="card-header">Quotation Records</h5>
            </div>

        </div>
      </div>




        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Quotation #</th>
                        <th>Requestor</th>
                        <th>Reference #</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                @foreach ($quotationRec as $quotation)
                <tr>
    <td>{{ $quotation->quotation_number }}</td>
    <td>{{ $quotation->requestor }}</td>
    <td>{{ $quotation->reference_number }}</td>
    <td>
    <span class="subject">{{ Str::limit($quotation->subject, 40) }}</span>
    <span class="full-subject" style="display: none;">{{ $quotation->subject }}</span>
    </td>
    <td>{{ $quotation->quotation_date }}</td>
    <td>
        <button type="button" class="btn btn-danger p-2 delete-modal" data-toggle="modal" data-target="#insertReqListModalDel" data-quotation_number="{{ $quotation->quotation_number }}" id="del"><i class="fa-solid fa-trash"></i></button>
        |
        <a href = "/quotation/quotation-view?quotNo={{ $quotation->quotation_number }}" class = "btn btn-primary p-2"><i class="fa-solid fa-eye"></i></a>
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
              <h5 class="modal-title" id="insertReqListModalLabel">Delete Quotation Record</h5>

            </div>
            <div class="modal-body-update">
              <!-- Your form or content for inserting labor goes here -->
              <form id="formAuthenticationDelete" class="mb-3" method="POST">
                <div class="form-group">
                  <div class="container">

                    <div class="row">
                      <div class="col">

                        <input type="text" class="form-control" name="del-request" id = "request-del" hidden>
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



<script>
    $(document).on('click', '.delete-modal', function () {
  var quotationNo = $(this).data('quotation_number');



  $('#request-del').val(quotationNo);
  $('#del-request').text(quotationNo);
});


$(document).on('click', '#delete', function () {
  var quot = $('#request-del').val();
  var csrfToken = $('meta[name="csrf-token"]').attr('content');



  $.ajax({
      type: 'POST',
      url: '/quotation-delete',
      data: { quot:quot },
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success: function (response) {

        if (response.status_code == '0') {

var successMessage =
            '<div class="alert alert-success mx-auto" style="width: 90%;" role="alert">Quotation deleted successfully.</div>';
          $('.modal-body-update').prepend(successMessage);

          $('.table-border-bottom-0').html(response.content);

          // Close modal after 2 minutes
          setTimeout(function () {
            // Close modal
            $('#insertItemModalDel').modal('hide');
            // Clear form fields
            $('#formAuthenticationDelete')[0].reset();
            // Reload table content after closing modal
            $('.alert.alert-success').remove();
            location.reload();
          }, 1000); // 2 minutes timeout

        } else if (response.status_code == '1') {

        }
      }
    });
});
</script>















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
