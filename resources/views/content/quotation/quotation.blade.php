@extends('layouts/contentNavbarLayout')

@section('title', 'Quotation Generator')

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
  .delete-row {



    overflow-y: auto;

}
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
#numWorker{
  font-style: italic;
}
  th{
    padding-top:15px;
    padding-left:15px;
    font-weight: normal;
  }
  td{
    padding-left:15px;
  }

  #materialBox {
    width: 100%;
    height: 17px;
    box-sizing: border-box;
    border: none;
    padding-left: 0;
    margin-left: 0;
  }


</style>
<div class="row gy-4">


  <!-- Transactions -->
  <div class="col-lg-12">
    <div class="card" style = "font-family: Calibri Light, sans-serif; font-size: 12px; color: black">
      <div class="container">
        <div class="row">
            <div class="col-md-8  " id = "printDocument">

<style>
  @media print{
    #ref{
      background-color: #ecf1f9;
      -webkit-print-color-adjust: exact;
    }
    #materialListD{
      display: block !important;
      padding: 0px;
      margin: 0px;

    }
    #materialBox{
      display: none !important;
      padding: 0px;
      margin: 0px;

    }
    #materialListD{
      display: block !important;
      padding: 0px;
      margin: 0px;
      text-align: center;
    }

    .left{
      text-align: left !important;
    }


    .it{
      text-align: center;
    }

}
</style>

              <div class="row" >
                <div class="col-md-12 ">
                  <form id = "formDocument">
                  <div class="card-body"style = "padding-bottom:0px;">


<table style="width:100%; table-layout: fixed;">
    <col style="width: 50%;">
    <col style="width: 50%;">
    <tr>
      <td style = "padding-left: 0; margin-left: 0;">

        <table style="width:100%; table-layout: fixed;">
        <col style="width: 25%;">
        <col style="width: 50%;">
        <tr>
          <td style="color:#305496; font-weight: bold;font-size:15px;">QUOTATION</td>
        </tr>
          <tr>
            <td style = "vertical-align: top;">Quotation#</td>
            <td name = "quotNO" id = "quotNO" style = "color: red; font-weight:bold;"></td>
          </tr>
          <tr>
            <td style = "vertical-align: top;">Quotation Date</td>
            <td name = "quoutDate" id = "quoutDate"></td>
          </tr>
          <tr>
            <td style = "vertical-align: top;">Validity</td>
            <td name = "validity" id = "validity"></td>
          </tr>
        </table>
      </td>
      <td style="vertical-align: top;">
      <div class="col-md-12 align-items-end">
<div class="card-body">
<div class="app-brand demo">
  <a href="{{url('/')}}" class="app-brand-link">
    <span class="app-brand-logo demo me-1">
      @include('_partials.macros',["height"=>60])
    </span>
  </a>

</div>
</div>
</div>
      </td>
    </tr>

</table>
</div>
</div>


</div>
<div class="row">
<div class="col-md-12 ">
<div class="card-body" style = "padding-top:0px;padding-bottom:8px;">
<table style="width:100%; border-radius: 10px; overflow: hidden; background-color: #ecf1f9; table-layout: fixed;" id = "ref" >
    <col style="width: 12%;">
    <col style="width: 38%;">
    <col style="width: 13%;">
    <col style="width: 37%;">
    <tr>
        <th style="vertical-align: top;">Reference#</th>
        <th style="vertical-align: top;" name = "refNO" id = "refNO"></th>
        <th style="vertical-align: top;">Quotation to</th>
        <th style="vertical-align: top; word-wrap: break-word;" name = "quotTo" id = "quotTo"></th>
    </tr>
    <tr>
        <td>Requestor</td>
        <td name = "requestorD" id = "requestorD"></td>
        <td>Attention</td>
        <td name = "attentionD" id = "attentionD"></td>
    </tr>
    <tr>
        <td>Department</td>
        <td name = "departmentD" id = "departmentD"></td>
        <td>Thru</td>
        <td name = "thruD" id = "thruD"></td>
    </tr>
    <tr>
        <td style="padding-bottom:15px;">Local No.</td>
        <td style="padding-bottom:15px;" name = "localD" id = "localD"></td>
        <td style="padding-bottom:15px;"></td>
        <td style="padding-bottom:15px;"></td>
    </tr>
</table>

</div>
</div>
</div>
<div class="row">
<div class="col-md-12 ">
<div>


<div class="card-body" style = "padding-top:0px;padding-bottom:0px;">
  <table style="width:100%; border-collapse: collapse;  table-layout: fixed;">
      <col style="width: 37%;">
      <col style="width: 16%;">
      <col style="width: 15%;">
      <col style="width: 15%;">
      <col style="width: 17%;">
      <tr style="color: black; font-weight: bold;font-weight: normal;" align = "center">
          <td colspan="5" style = "padding-left: 0; margin-left: 0;">SUBJECT:&nbsp<font name = "subjectD" id = "subjectD"></font></td>
      </tr>
      <tr style="color: black; font-weight: bold;font-weight: normal;" align = "left">
          <td colspan="5" style = "padding-left: 0; margin-left: 0;">Dear Ma'am/Sir,<font name = "subjectD" id = "subjectD"></font></td>
      </tr>
      <tr style="color: black; font-weight: bold;font-weight: normal;" align = "left">
          <td colspan="5" style = "padding-left: 0; margin-left: 0;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font name = "letterD" id = "letterD"></font></td>
      </tr>
  </table>
</div>
</div>
</div>
</div>

<div class="row">
<datalist id="datalistOptions">


@foreach($materialList as $material)
<option value = "{{ $material->item }}">{{ $material->item }}</option>
@endforeach
</datalist>


<datalist id="datalistOptionsLabor">


@foreach($laborList as $labor)
<option value = "{{ $labor->labor }}">{{ $labor->labor }}</option>
@endforeach
</datalist>
<div class="col-md-12 ">
<div class="card-body" style = "padding-top:10px;" >
<table style="width:100%; border-collapse: collapse; table-layout: fixed; text-align: center;">
<col style="width: 37%;">
<col style="width: 16%;">
<col style="width: 15%;">
<col style="width: 15%;">
<col style="width: 17%;">
<tbody id="materialTable">
<tr style="color:#f2f2f2; text-align:center;">
<td style="border: 1px solid #3a3838; background-color: #3a3838;-webkit-print-color-adjust: exact;">Item Description</td>
<td style="border: 1px solid #3a3838; background-color: #3a3838;-webkit-print-color-adjust: exact;">Qty</td>
<td style="border: 1px solid #3a3838; background-color: #3a3838;-webkit-print-color-adjust: exact;">Unit</td>
<td style="border: 1px solid #3a3838; background-color: #3a3838;-webkit-print-color-adjust: exact;">Rate</td>
<td style="border: 1px solid #3a3838; background-color: #3a3838;-webkit-print-color-adjust: exact;">Amount</td>
<td style="border: 1px solid #3a3838; background-color: #3a3838;-webkit-print-color-adjust: exact;"></td> <!-- New cell for the delete button -->
</tr>
<tr style="color:#3a3838;">
<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" class="it">
<input list="datalistOptions" name="materialList[]" id="materialBox" class="materialBox">
<p name="materialListDN[]" id="materialListD" class="left" style="display: none;"></p>
</td>
<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" class="it">
<input type="number" style="text-align:center;" id="materialBox" class="materialQty" name="quantityList[]" value="" />
<p name="materialQtDN[]" id="materialListD" style="display: none;"></p>
</td>
<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name="unitList[]"></td>
<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name="rateList[]"></td>
<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name="amountList[]"></td>
<td style="border: 1px solid #3a3838; padding: 0; margin: 0;">
<button class="delete-row" style = "padding: 0; margin: 0;border: none;"><i class="fa-solid fa-trash-can" style="color: #ff0000;vertical-align: middle;"></i></button> <!-- Delete button -->
</td>
</tr>
</tbody>
</table>
<table style="width:100%; border-collapse: collapse;  table-layout: fixed;text-align:center;">
    <col style="width: 37%;">
    <col style="width: 16%;">
    <col style="width: 15%;">
    <col style="width: 15%;">
    <col style="width: 17%;">
<tr style="color:#3a3838;  color: #808080;">
  <td colspan="5" style="border: 1px solid #3a3838;-webkit-print-color-adjust: exact;">Network Cabling</td>
</tr>
<tr style="color: black; font-weight: bold;">
    <td></td>
    <td></td>
    <td colspan="2">Subtotal</td>
    <td name = "itemTotalD" id = "itemTotalD" style = "padding-left: 0; margin-left: 0;"></td>
</tr>
</table>

<div id="content1">
    <!-- Content for div 1 will be added here -->
</div>








<!-- Labor Table -->
<table style="width:100%; border-collapse: collapse;  table-layout: fixed; text-align:center;">
    <col style="width: 37%;">
    <col style="width: 16%;">
    <col style="width: 15%;">
    <col style="width: 15%;">
    <col style="width: 17%;">
    <tbody id = "laborTable">
  <tr style="color:#f2f2f2;">
      <td style="border: 1px solid #3a3838; background-color: #3a3838;-webkit-print-color-adjust: exact;">Labor Description</td>
      <td style="border: 1px solid #3a3838; background-color: #3a3838;-webkit-print-color-adjust: exact;">Count</td>
      <td style="border: 1px solid #3a3838; background-color: #3a3838;-webkit-print-color-adjust: exact;">Working Days</td>
      <td style="border: 1px solid #3a3838; background-color: #3a3838;-webkit-print-color-adjust: exact;">Rate</td>
      <td style="border: 1px solid #3a3838; background-color: #3a3838;-webkit-print-color-adjust: exact;">Amount</td>
  </tr>

  <tr style="color:#3a3838;">
      <td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;">

        <input list="datalistOptionsLabor" name = "laborList[]" id="materialBox" class ="laborBox">
        <p name = "laborListDN[]" id = "materialListD" class = "left" style = "display: none;"></p>

      </td>
      <td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;">
        <input type="number" style=" text-align:center;" id="materialBox" name="countList[]" class ="countList" value= ""/>
        <p name = "countListDN[]" id = "materialListD" class = "it" style = "display: none;"></p>
      </td>
      <td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;">
        <input type="number" style=" text-align:center;" id="materialBox" name="dayList[]" class ="dayList" value= ""/>
        <p name = "dayListDN[]" id = "materialListD" class = "it" style = "display: none;"></p>
      </td>
      <td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name = "rateLaborList[]"></td>
      <td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name = "amountLaborList[]"></td>
      <td style="border: 1px solid #3a3838; padding: 0; margin: 0;">
<button class="delete-row" style = "padding: 0; margin: 0;border: none;"><i class="fa-solid fa-trash-can" style="color: #ff0000;vertical-align: middle;"></i></button>
</td>
  </tr>
</tbody>


<table style="width:100%; border-collapse: collapse;  table-layout: fixed; text-align:center;">
<col style="width: 37%;">
    <col style="width: 16%;">
    <col style="width: 15%;">
    <col style="width: 15%;">
    <col style="width: 17%;">
<tr style="color:#3a3838; text-align: center; color: #808080;">
  <td colspan="5" style="border: 1px solid #3a3838;-webkit-print-color-adjust: exact;">Labor</td>
</tr>
<tr style="color: black; font-weight: bold;" align = "center">
    <td></td>
    <td></td>
    <td colspan="2">Subtotal</td>
    <td name = "laborTotalD" id = "laborTotalD" style = "padding-left: 0; margin-left: 0;"></td>
</tr>
</table>

<table style="width:100%; border-collapse: collapse;  table-layout: fixed;">
    <col style="width: 37%;">
    <col style="width: 16%;">
    <col style="width: 15%;">
    <col style="width: 15%;">
    <col style="width: 17%;">
<tr>

</tr>
<tr style="color:#3a3838;">
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td colspan="2" style="border-top: 2px solid #8ea9db; padding-left: 0; margin-left: 0;">Material Sub Total</td>
    <td style="border-top: 2px solid #8ea9db;padding-left: 0; margin-left: 0;"></td>
    <td style="border-top: 2px solid #8ea9db;padding-left: 0; margin-left: 0; text-align: center;" name = "itemSubTotalD" id = "itemSubTotalD"></td>
</tr>
<tr style="color:#3a3838;">
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td colspan="2" style = "color: #808080;padding-left: 0; margin-left: 0; font-style: italic;" name = "numItem" id = "numItem">0 Item</td>
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td syle = "padding-left: 0; margin-left: 0;"></td>
</tr>
<tr style="color:#3a3838;">
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td colspan="2" style = "padding-left: 0; margin-left: 0;">Labor Sub Total</td>
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td style = "padding-left: 0; margin-left: 0;text-align: center;" name = "laborSubTotalD" id = "laborSubTotalD"></td>
</tr>
<tr style="color:#3a3838;">
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td style = "padding-left: 0; margin-left: 0;color: #808080; font-weight: style;" colspan="2" name = "numWorker" id = "numWorker">0 Worker</td>
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td style = "padding-left: 0; margin-left: 0;"></td>
</tr>
<tr style="color:#3a3838;">
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td style = "padding-left: 0; margin-left: 0;" colspan="2">Overhead/Profit</td>
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td style = "padding-left: 0; margin-left: 0;text-align: center;" name = "overheadProfitD" id = "overheadProfitD"></td>
</tr>
<tr style="color:#3a3838;">
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td style = "padding-left: 0; margin-left: 0;" colspan="2" style="border-top: 2px solid #8ea9db;">Total</td>
    <td style="border-top: 2px solid #8ea9db; padding-left: 0; margin-left: 0;"></td>
    <td style="border-top: 2px solid #8ea9db; color: red; font-weight: bold; padding-left: 0; margin-left: 0;text-align: center;" name = "total" id = "total"></td>
</tr>
<tr style="color:#3a3838;">
    <td></td>
    <td colspan="2" style = "color: #808080;">Total in words</td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td></td>
    <td colspan="3" style="color:black;font-weight: bold; font-size:15px;" name = "numWords" id = "numWords"></td>
</tr>
</table>

<div id="content2">
    <!-- Content for div 2 will be added here -->
</div>

<div class = "card-footer">
<table style="width:100%; border-collapse: collapse;  table-layout: fixed;">
    <col style="width: 33.33%;">
    <col style="width: 33.33%;">
    <col style="width: 33.33%;">


<tr style="font-size: 10px; text-align:center; font-style:italic;">
    <td>PREPARED BY:</td>
    <td>CHECKED BY</td>
    <td>APPROVED BY</td>


</tr>
<tr style="color:#3a3838; text-align:center;">
    <td><br></td>
    <td></td>
    <td></td>


</tr>
<tr style="color:black; text-align:center; font-weight: bold;">
    <td name = "prepD" id = "prepD">JESTONI FUELLAS</td>
    <td name = "checD" id = "checD">JHOMAR VERGARA</td>
    <td name = "apprD" id = "apprD">EDMON BENTABAL</td>


</tr>
<tr style="font-size: 10px; text-align:center; font-style:italic;">
    <td>PROJECT COORDINATOR</td>
    <td>PROJECT COORDINATOR</td>
    <td>MANAGER</td>


</tr>
</table>
</div>
</div>
</div>
</div>
                  </form>

            </div>
            <div class="col-md-4  ">
              <div class=" mb-3">

                <div class="card-body">
                  <form id = "formRequestor">
                    <div class="form-floating form-floating-outline mb-4">
                      <select class="form-select" name = "requestor" id = "req" aria-label="Default select example"  style="vertical-align: top;">
                      @foreach($requestorList as $requestor)
                                            <option value = "{{ $requestor->requestor }}">{{ $requestor->requestor }}</option>
                                          @endforeach
                      </select>
                      <label for="exampleFormControlSelect1">Requestor</label>
                    </div>
                  </form>
                  <div class="form-floating form-floating-outline mb-4">
                    <input type="text" class="form-control" id="quotationNo"  />
                    <label for="exampleFormControlInput1">Quotation No</label>
                  </div>



                  <div class="form-floating form-floating-outline mb-4">
                  <input class="form-control" list="datalistOptionsQuotationTo" name = "quotationTO" id="quotationTo" placeholder="Type to search...">
                            <datalist id="datalistOptionsQuotationTo">

                                <option value = "ROHM ELECTRONICS PHILIPPINES INCORPORATED"></option>

                            </datalist>
                            <label for="exampleDataList">Quotation to</label>
                  </div>
                  <div class="form-floating form-floating-outline mb-4">
                  <select class="form-select" name = "attention" id = "attentionInput" aria-label="Default select example"  style="vertical-align: top;">
                      @foreach($requestorList as $requestor)
                                            <option value = "{{ $requestor->requestor }}">{{ $requestor->requestor }}</option>
                                          @endforeach
                      </select>

                    <label for="exampleFormControlInput1">Attention</label>
                  </div>

                  <div class="form-floating form-floating-outline mb-4">
                    <textarea  class="form-control" name="subject" id="subjectInput" cols="30" rows="10"></textarea>
                    <label for="exampleFormControlInput1">Subject</label>
                  </div>
                  <div class="form-floating form-floating-outline mb-4">
                    <textarea  class="form-control" name="letter" id="letterInput" cols="30" rows="10"></textarea>
                    <label for="exampleFormControlInput1">Letter</label>
                  </div>

                  <div class="form-floating form-floating-outline mb-4">
                    <select class="form-select" id = "referenceNo" aria-label="Default select example"  style="vertical-align: top;">
                      @foreach($requestNo as $n)
                        <option value = "{{ $n->job_request_no }}">{{ $n->job_request_no }}</option>
                      @endforeach
                    </select>

                    <label for="exampleFormControlInput1">Reference No</label>
                  </div>


                  <div class="demo-inline-spacing">
                    <button type="button" class=" btn btn-primary" id = "itemAddButton" style = "width: 45%;">
                      <i class="fa-solid fa-square-plus"></i> &nbspAdd Item
                    </button>
                    <button type="button" class=" btn btn-primary" id = "laborAddButton" style = "width: 45%;">
                      <i class="fa-solid fa-square-plus"></i> &nbspAdd Labor
                    </button>

                    <button class=" btn btn-primary" onclick="printContent()" style = "height: 38px; width: 45%; font-size: 12px;">Print Document</button>

                    <button type="button" class=" btn btn-primary" data-toggle="modal" data-target="#insertReqListModal" style = "width: 45%;">Add People</button>

                    <button type="button" class=" btn btn-primary" data-toggle="modal" data-target="#apprModal" style = "width: 45%;">Approver</button>

                    <button type="button" class=" btn btn-primary" id = "saveButton" style = "width: 45%;">Save</button>

                    <input type="number" id="brCount1" min="0" value="0" onchange="updateBr('content1', 'brCount1')">


                    <input type="number" id="brCount2" min="0" value="0" onchange="updateBr('content2', 'brCount2')">
                </div>

              </div>

            </div>

          </div>

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
                        <input type="number" class="form-control" name="local" placeholder="Enter Local No.">
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



      <div class="modal fade" id="apprModal" tabindex="-1" role="dialog" aria-labelledby="apprModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="apprModalLabel">Approver</h5>

            </div>
            <div class="modal-body">
              <!-- Your form or content for inserting labor goes here -->
              <form id="formAuthentication" class="mb-3" method="POST">
                <div class="form-group">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="prep">Prepared By</label>
                        <input type="text" class="form-control" id = "prepBy" name="prepBys" placeholder="">
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="department">Checked By</label>
                        <input type="text" class="form-control" id = "checkBy" name="checkBys" placeholder="">
                      </div>
                      <div class="col-md-6">
                        <label for="local">Manager</label>
                        <input type="text" class="form-control" id = "manageBy" name="manageBys" placeholder="">
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





<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function () {
  $('#add').on('click', function (e) {
    e.preventDefault();
    $('.alert.alert-danger').remove();

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var requestor = $('input[name="requestor"]').val();
    var department = $('input[name="department"]').val();



    $.ajax({
      type: 'POST',
      url: '/add-requestorPro',
      data: $('#formAuthentication').serialize(),
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success: function (response) {
        if (response.status_code == '0') {
          // Append success message to modal body
          var successMessage = '<div class="alert alert-success" role="alert">Requestor added successfully.</div>';
          $('.modal-body').prepend(successMessage);

          $('.table-border-bottom-0').html(response.content);
          $('#req').html(response.quotContent);
          $('#attentionInput').html(response.quotContent);

          // Close modal after 2 minutes
          setTimeout(function () {
            // Close modal
            $('#insertReqListModal').modal('hide');
            // Clear form fields
            $('#formAuthentication')[0].reset();
            // Reload table content after closing modal
            $('.alert.alert-success').remove();
          }, 1000); // 2 minutes timeout
        } else if (response.status_code == '1') {
          var errorMessage = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
          $('.modal-body').prepend(errorMessage);
        }
      }
    });
  });
});









function updateBr(contentId, inputId) {
    var brCount = document.getElementById(inputId).value;
    var contentDiv = document.getElementById(contentId);
    var brElements = contentDiv.getElementsByTagName('br');
    var currentBrCount = brElements.length;

    // Remove excess <br> elements
    for (var i = currentBrCount; i > brCount; i--) {
        contentDiv.removeChild(brElements[i - 1]);
    }

    // Add <br> elements
    for (var i = currentBrCount; i < brCount; i++) {
        contentDiv.innerHTML += '<br>';
    }
}

</script>




<script>
  $(document).on('change', '#req', function () {
    var requestor = $('requestor').val();
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

  // Populate modal fields with the data

  $.ajax({
      type: 'POST',
      url: '/quotation-requestor',
      data: $('#formRequestor').serialize(),
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success: function (response) {

        if (response.status_code == '0') {


          $('#requestorD').text(response.requestors);
          $('#departmentD').text(response.department);
          $('#localD').text(response.local);
        } else if (response.status_code == '1') {
          var errorMessage = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
          $('.modal-body').prepend(errorMessage);
        }
      }
    });


});


$(document).on('keyup', '#quotationNo', function (e) {
  e.preventDefault();

    var quotationNo = $('#quotationNo').val();

    $('#quotNO').text(quotationNo);
});

$(document).on('change', '#referenceNo', function (e) {
  e.preventDefault();

    var referenceNo = $('#referenceNo').val();


    var csrfToken = $('meta[name="csrf-token"]').attr('content');

  // Populate modal fields with the data

  $.ajax({
      type: 'POST',
      url: '/quotation-requestDetails',
      data: { referenceNo:referenceNo },
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success: function (response) {

        if (response.status_code == '0') {

          $('#refNO').text(referenceNo);
          $('#departmentD').text(response.department);
          $('#localD').text(response.local);
          $('#subjectD').text(response.subject);
          $('#requestorD').text(response.requestor);

        } else if (response.status_code == '1') {
          var errorMessage = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
          $('.modal-body').prepend(errorMessage);
        }
      }
    });
});

var currentDate = new Date();

        // Array of month names
        var monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];

        // Calculate validity date (6 months from current date)
        var validityDate = new Date(currentDate);
        validityDate.setMonth(validityDate.getMonth() + 6);

        // Format validity date
        var formattedValidityDate = monthNames[validityDate.getMonth()] + " " + validityDate.getDate() + ", " + validityDate.getFullYear();

        // Format current date
        var formattedCurrentDate = monthNames[currentDate.getMonth()] + " " + currentDate.getDate() + ", " + currentDate.getFullYear();

        // Calculate validity period
        var validityPeriod = "(6 Months)";

        // Set content of the element with id "quoutDate"
        document.getElementById("quoutDate").innerText = formattedCurrentDate;

        // Set content of the element with id "validity"
        document.getElementById("validity").innerText = validityPeriod + " Valid until " + formattedValidityDate;


$(document).on('keyup', '#quotationTo', function (e) {
  e.preventDefault();

    var quotationTo = $('#quotationTo').val();

    $('#quotTo').text(quotationTo);
});

$(document).on('keyup', '#prepBy', function (e) {
  e.preventDefault();

    var prepBy = $('#prepBy').val();

    $('#prepD').text(prepBy);
});

$(document).on('keyup', '#checkBy', function (e) {
  e.preventDefault();

    var checkBy = $('#checkBy').val();

    $('#checD').text(checkBy);
});

$(document).on('keyup', '#manageBy', function (e) {
  e.preventDefault();

    var manageBy = $('#manageBy').val();

    $('#apprD').text(manageBy);
});

$(document).on('change', '#attentionInput', function (e) {
  e.preventDefault();

    var attentionInput = $('#attentionInput').val();

    $('#attentionD').text(attentionInput);

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

  // Populate modal fields with the data

  $.ajax({
      type: 'POST',
      url: '/quotation-thru',
      data: {
        attentionInput: attentionInput
    },
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success: function (response) {

        if (response.status_code == '0') {


          $('#thruD').text(response.thru);
        } else if (response.status_code == '1') {
          var errorMessage = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
          $('.modal-body').prepend(errorMessage);
        }
      }
    });


});

$(document).on('keyup', '#thruInput', function (e) {
  e.preventDefault();

    var thruInput = $('#thruInput').val();

    $('#thruD').text(thruInput);
});

$(document).on('keyup', '#subjectInput', function (e) {
  e.preventDefault();

    var subjectInput = $('#subjectInput').val();

    $('#subjectD').text(subjectInput);
});

$(document).on('keyup', '#letterInput', function (e) {
  e.preventDefault();

    var letterInput = $('#letterInput').val();

    $('#letterD').text(letterInput);
});



var itemTotal = 0;
var laborTotal = 0;

$(document).ready(function(){
    // Add event listener to quantity input
    $(document).on('input', 'input[name^="quantityList"]', function () {
        var rowIndex = $(this).closest('tr').index(); // Get the index of the row
        var material = $(this).closest('tr').find('input[name^="materialList"]').val(); // Get the value of material
        var quantity = $(this).val(); // Get the value of quantity

        var csrfToken = $('meta[name="csrf-token"]').attr('content');


        // Make AJAX request to retrieve data
        $.ajax({
            type: 'POST',
            url: '/quotationMaterial-data',
            data: { material: material, quantity: quantity },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {

                // Update unit, rate, and amount fields in the same row

                itemSumCal(rowIndex, response);
                itemSubTotalCal();
                // Output the total sum
                $('#itemTotalD').text('₱ ' + itemTotal);
                $('#itemSubTotalD').text('₱ ' + itemTotal);


                $('#overheadProfitD').text('₱ ' + (itemTotal + laborTotal) * 0.15);

                $('#total').text('PHP ' + (((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));
                $('#numWords').text(test(((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));

                document.getElementsByName('materialQtDN[]')[rowIndex-1].innerText = quantity;

            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
});

$(document).ready(function(){
    // Add event listener to quantity input
    $(document).on('input', 'input[name^="materialList"]', function () {
        var rowIndex = $(this).closest('tr').index(); // Get the index of the row
        var quantity = $(this).closest('tr').find('input[name^="quantityList"]').val(); // Get the value of material
        var material = $(this).val(); // Get the value of quantity

        var csrfToken = $('meta[name="csrf-token"]').attr('content');


        // Make AJAX request to retrieve data
        $.ajax({
            type: 'POST',
            url: '/quotationMaterial-data',
            data: { material: material, quantity: quantity },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {

                // Update unit, rate, and amount fields in the same row

                itemSumCal(rowIndex, response);

                $('#overheadProfitD').text('₱ ' + (itemTotal + laborTotal) * 0.15);
                $('#total').text('PHP ' + (((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));
                $('#numWords').text(test(((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));
                // Output the total sum
                $('#itemTotalD').text('₱ ' + itemTotal);



            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
});

var itemLimit = 1;
document.getElementById('itemAddButton').addEventListener('click', function() {
  if(itemLimit < 25)
  {
    var newRow = document.createElement('tr');
newRow.style.color = '#3a3838'; // Set text color
newRow.style.border = '1px solid #3a3838'; // Set border style
newRow.style.paddingLeft = '0'; // Set padding-left (use camelCase for hyphenated CSS properties)
newRow.style.marginLeft = '0'; // Set margin-left (use camelCase for hyphenated CSS properties)
var html = '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" class="it">';
html += '<input list="datalistOptions" name="materialList[]" id="materialBox" class="materialBox">';
html += '<p name="materialListDN[]" id="materialListD" style="display: none; padding: 0px; margin: 0px;" class="left"></p>';
html += '</td>';
html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" class="it">';
html += '<input type="number" style="text-align:center;" id="materialBox" class="materialQty" name="quantityList[]" value=""/>';
html += '<p name="materialQtDN[]" id="materialListD" style="display: none;"></p></td>';
html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name="unitList[]"></td>';
html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name="rateList[]"></td>';
html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name="amountList[]"></td>';
html += '<td style="border: 1px solid #3a3838; padding: 0; margin: 0;">';
html += '<button class="delete-row" style = "padding: 0; margin: 0;border: none;"><i class="fa-solid fa-trash-can" style="color: #ff0000;vertical-align: middle;"></i></button>';
html += '</td>';
newRow.innerHTML = html;
document.querySelector('#materialTable').appendChild(newRow);
    itemLimit += 1;


  }
});










//Labor Table
$(document).ready(function(){
    // Add event listener to quantity input
    $(document).on('input', 'input[name^="countList"]', function () {
        var rowIndex = $(this).closest('tr').index(); // Get the index of the row
        var labor = $(this).closest('tr').find('input[name^="laborList"]').val(); // Get the value of material
        var count = $(this).val(); // Get the value of quantity
        var day = $(this).closest('tr').find('input[name^="dayList"]').val();

        var csrfToken = $('meta[name="csrf-token"]').attr('content');


        // Make AJAX request to retrieve data
        $.ajax({
            type: 'POST',
            url: '/quotationLabor-data',
            data: { labor: labor, count: count, day: day },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {


                // Update unit, rate, and amount fields in the same row

                laborSumCal(rowIndex, response);

                $('#overheadProfitD').text('₱ ' + (itemTotal + laborTotal) * 0.15);
                $('#total').text('PHP ' + (((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));
                $('#numWords').text(test(((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));
                // Output the total sum
                $('#laborTotalD').text('₱ ' + laborTotal);
                $('#laborSubTotalD').text('₱ ' + laborTotal);

                document.getElementsByName('countListDN[]')[rowIndex-1].innerText = count;

            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
    $(document).on('input', 'input[name^="dayList"]', function () {
        var rowIndex = $(this).closest('tr').index(); // Get the index of the row
        var labor = $(this).closest('tr').find('input[name^="laborList"]').val(); // Get the value of material
        var day = $(this).val(); // Get the value of quantity
        var count = $(this).closest('tr').find('input[name^="countList"]').val();

        var csrfToken = $('meta[name="csrf-token"]').attr('content');



        // Make AJAX request to retrieve data
        $.ajax({
            type: 'POST',
            url: '/quotationLabor-data',
            data: { labor: labor, count: count, day: day },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {


                // Update unit, rate, and amount fields in the same row

                laborSumCal(rowIndex, response);
                $('#overheadProfitD').text('₱ ' + (itemTotal + laborTotal) * 0.15);
                $('#total').text('PHP ' + (((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));
                $('#numWords').text(test(((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));
                // Output the total sum
                $('#laborTotalD').text('₱ ' + laborTotal);
                $('#laborSubTotalD').text('₱ ' + laborTotal);

                document.getElementsByName('dayListDN[]')[rowIndex-1].innerText = day;

            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });

    $(document).on('input', 'input[name^="laborList"]', function () {
        var rowIndex = $(this).closest('tr').index(); // Get the index of the row
        var day = $(this).closest('tr').find('input[name^="dayList"]').val(); // Get the value of material
        var labor = $(this).val(); // Get the value of quantity
        var count = $(this).closest('tr').find('input[name^="countList"]').val();

        var csrfToken = $('meta[name="csrf-token"]').attr('content');



        // Make AJAX request to retrieve data
        $.ajax({
            type: 'POST',
            url: '/quotationLabor-data',
            data: { labor: labor, count: count, day: day },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {



                // Update unit, rate, and amount fields in the same row

                laborSumCal(rowIndex, response);
                $('#overheadProfitD').text('₱ ' + (itemTotal + laborTotal) * 0.15);
                $('#total').text('PHP ' + (((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));

                $('#numWords').text(test(((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));
                // Output the total sum
                $('#laborTotalD').text('₱ ' + laborTotal);
                $('#laborSubTotalD').text('₱ ' + laborTotal);

            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
});

var laborLimit = 1;
document.getElementById('laborAddButton').addEventListener('click', function() {

  if(laborLimit < 20)
  {
    var newRow = document.createElement('tr');
    newRow.style.color = '#3a3838';

    var html = '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;"><input list="datalistOptionsLabor" name = "laborList[]" id="materialBox" class ="laborBox"><p name = "laborListDN[]" id = "materialListD" class = "left" style = "display: none;"></p>';

    html += '</td>';
    html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;"><input type="number" style=" text-align:center;" id="materialBox" name="countList[]" class ="countList" value= ""/><p name = "countListDN[]" id = "materialListD" class = "it" style = "display: none;"></p></td>';
    html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;"><input type="number" style=" text-align:center;" id="materialBox" name="dayList[]" class ="dayList" value= ""/><p name = "dayListDN[]" id = "materialListD" class = "it" style = "display: none;"></p></td>';
    html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name="rateLaborList[]"></td>';
    html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name="amountLaborList[]"></td>';
    html += '<td style="border: 1px solid #3a3838; padding: 0; margin: 0;">';
    html += '<button class="delete-row" style = "padding: 0; margin: 0;border: none;"><i class="fa-solid fa-trash-can" style="color: #ff0000;vertical-align: middle;"></i></button>';
    html += '</td>';

    newRow.innerHTML = html;
    document.querySelector('#laborTable').appendChild(newRow);
    laborLimit += 1;
  }
});


function laborSumCal(rowIndex, response)
{
  if(response.status_code === 3)
  {
    document.getElementsByName('rateLaborList[]')[rowIndex-1].innerText = response.rate;
    document.getElementsByName('amountLaborList[]')[rowIndex-1].innerText = response.amount;
    document.getElementsByName('laborListDN[]')[rowIndex-1].innerText = response.labor;
  }
  else
  {
    document.getElementsByName('rateLaborList[]')[rowIndex-1].innerText = '  ₱' + response.rate;
    document.getElementsByName('amountLaborList[]')[rowIndex-1].innerText = '  ₱' + response.amount;
    document.getElementsByName('laborListDN[]')[rowIndex-1].innerText = response.labor;
  }
  laborSubTotalCal();
}

function laborSubTotalCal()
{
  // Get all cells with the name "amountList[]"
  var amountCells = document.querySelectorAll('td[name="amountLaborList[]"]');
  // Initialize the total sum variable
  var totalSum = 0;
  var numLabor = 0;
  // Iterate over each cell and accumulate their values
  amountCells.forEach(function(cell) {
    var amount = parseFloat(cell.textContent.trim().replace(/[^0-9.-]+/g,""));
    if (!isNaN(amount)) {
      totalSum += amount;
      numLabor += 1;
    }
  });
  laborTotal = totalSum;
  $('#overheadProfitD').text('₱ ' + (itemTotal + laborTotal) * 0.15);
                $('#total').text('PHP ' + (((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));

                $('#numWords').text(test(((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));
                // Output the total sum
                $('#laborTotalD').text('₱ ' + laborTotal);
                $('#laborSubTotalD').text('₱ ' + laborTotal);


                $('#itemTotalD').text('₱ ' + itemTotal);
                $('#itemSubTotalD').text('₱ ' + itemTotal);
                $('#overheadProfitD').text('₱ ' + (itemTotal + laborTotal) * 0.15);

                $('#total').text('PHP ' + (((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));
                $('#numWords').text(test(((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));

  if(numLabor > 1)
  {
    $('#numWorker').text(numLabor + ' Workers');
  }
  else{
    $('#numWorker').text(numLabor + ' Worker');
  }
}

function itemSumCal(rowIndex, response)
{
  if(response.status_code === 3)
  {
    document.getElementsByName('unitList[]')[rowIndex-1].innerText = response.unit;
    document.getElementsByName('rateList[]')[rowIndex-1].innerText = response.rate;
    document.getElementsByName('amountList[]')[rowIndex-1].innerText = response.amount;
    document.getElementsByName('materialListDN[]')[rowIndex-1].innerText = response.item;
  }
  else
  {

    document.getElementsByName('unitList[]')[rowIndex-1].innerText = response.unit;
  document.getElementsByName('rateList[]')[rowIndex-1].innerText = '  ₱' + response.rate;
  document.getElementsByName('amountList[]')[rowIndex-1].innerText = '  ₱' + response.amount;
  document.getElementsByName('materialListDN[]')[rowIndex-1].innerText = response.item;
  }

  itemSubTotalCal();
}

function itemSubTotalCal()
{
  // Get all cells with the name "amountList[]"
  var amountCells = document.querySelectorAll('td[name="amountList[]"]');
  // Initialize the total sum variable
  var totalSum = 0;
  var numItem = 0;
  // Iterate over each cell and accumulate their values
  amountCells.forEach(function(cell) {
    var amount = parseFloat(cell.textContent.trim().replace(/[^0-9.-]+/g,""));
    if (!isNaN(amount)) {
      totalSum += amount;
      numItem += 1;
    }
  });


  itemTotal = totalSum;
  $('#itemTotalD').text('₱ ' + itemTotal);
                $('#itemSubTotalD').text('₱ ' + itemTotal);
                $('#overheadProfitD').text('₱ ' + (itemTotal + laborTotal) * 0.15);

                $('#total').text('PHP ' + (((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));
                $('#numWords').text(test(((itemTotal + laborTotal) * 0.15) + itemTotal + laborTotal));
  if(numItem > 1)
  {
    $('#numItem').text(numItem + ' Items');
  }
  else{
    $('#numItem').text(numItem + ' Item');
  }
}






//Numbers To Words

/**
 * Function to convert a given number into words.
 * @param {number} n - The number to be converted into words.
 * @returns {string} - The word representation of the given number.
 */
function test(n) {
    if (isNaN(n) || n < 0)
        return false;

    // Split the number into integer and fractional parts
    const [integerPart, fractionalPart] = String(n).split('.');

    // Convert the integer part into words
    let integerWords = '';
    if (integerPart === '0') {
        integerWords = 'Zero';
    } else {
        integerWords = translate(parseInt(integerPart));
    }

    // If there's no fractional part, add "Pesos"
    let fractionalWords = '';
    if (!fractionalPart || parseInt(fractionalPart) === 0) {
        fractionalWords = ' Pesos';
    } else {
        fractionalWords = ' Pesos and';
        // Convert the fractional part into words
        if (parseInt(fractionalPart) < 10) {
            fractionalWords += ' ' + single_digit[parseInt(fractionalPart)];
        } else {
            fractionalWords += ' ' + translate(parseInt(fractionalPart));
        }
        fractionalWords += ' Centavos';
    }

    // Concatenate the integer and fractional parts
    let result = integerWords + fractionalWords.trim() + '.';
    return result.trim();
}


// Arrays to hold words for single-digit, double-digit, and below-hundred numbers
const single_digit = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
const double_digit = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
const below_hundred = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

// Recursive function to translate the number into words
function translate(n) {
    let word = "";
    if (n < 10) {
        word = single_digit[n] + ' ';
    } else if (n < 20) {
        word = double_digit[n - 10] + ' ';
    } else if (n < 100) {
        let rem = translate(n % 10);
        word = below_hundred[Math.floor(n / 10) - 2] + ' ' + rem;
    } else if (n < 1000) {
        word = single_digit[Math.floor(n / 100)] + ' Hundred ' + translate(n % 100);
    } else if (n < 1000000) {
        word = translate(Math.floor(n / 1000)).trim() + ' Thousand ' + translate(n % 1000);
    } else if (n < 1000000000) {
        word = translate(Math.floor(n / 1000000)).trim() + ' Million ' + translate(n % 1000000);
    } else {
        word = translate(Math.floor(n / 1000000000)).trim() + ' Billion ' + translate(n % 1000000000);
    }
    return word;
}



function printContent() {
    // Store the values of materialBox inputs before modifying the DOM
    var materialBoxValues = [];
    var materialBoxes = document.querySelectorAll('.materialBox');
    materialBoxes.forEach(function(box) {
        materialBoxValues.push(box.value);
    });

    var materialQtyValues = [];
    var materialQties = document.querySelectorAll('.materialQty');
    materialQties.forEach(function(box) {
      materialQtyValues.push(box.value);
    });

    var laborBoxValues = [];
    var laborBoxes = document.querySelectorAll('.laborBox');
    laborBoxes.forEach(function(box) {
      laborBoxValues.push(box.value);
    });

    var countListValues = [];
    var countLists = document.querySelectorAll('.countList');
    countLists.forEach(function(box) {
      countListValues.push(box.value);
    });

    var dayListValues = [];
    var dayLists = document.querySelectorAll('.dayList');
    dayLists.forEach(function(box) {
      dayListValues.push(box.value);
    });


    var brCount1 = $('#brCount1').val();
    var brCount2 = $('#brCount2').val();


    // Get the original content of the document
    var old_str = document.body.innerHTML;

    // Modify the DOM for printing
    var header_str = '<html><head><title>' + document.title + '</title>';
    header_str += '<style>';
    header_str += 'th { padding-top: 15px; padding-left: 15px; font-weight: normal; font-size: 12px; }';
    header_str += 'td { padding-left: 15px; font-size: 12px; }';
    header_str += 'p { font-size: 12px; }';
    header_str += '@media print { .materialBox { display: none !important; } }'; // Hide materialBox inputs when printing
    header_str += '</style>';
    header_str += '</head><body>';

    var footer_str = '</body></html>';
    var new_str = document.getElementById('printDocument').innerHTML; // Get content from the container

    // Set the modified content to the document body
    document.body.innerHTML = header_str + new_str + footer_str;

    // Print the document
    window.print();

    // Restore the original content
    document.body.innerHTML = old_str;

    // Restore the values of materialBox inputs after printing
    materialBoxes.forEach(function(box, index) {
      var materialBox = document.getElementsByClassName('materialBox')[index];
      if (materialBox) {
          materialBox.value = materialBoxValues[index];
      }
    });

    materialQties.forEach(function(box, index) {
      var materialQty = document.getElementsByClassName('materialQty')[index];
      if (materialQty) {
          materialQty.value = materialQtyValues[index];
      }
    });

    laborBoxes.forEach(function(box, index) {
      var laborBox = document.getElementsByClassName('laborBox')[index];
      if (laborBox) {
        laborBox.value = laborBoxValues[index];
      }
    });

    countLists.forEach(function(box, index) {
      var countList = document.getElementsByClassName('countList')[index];
      if (countList) {
        countList.value = countListValues[index];
      }
    });

    dayLists.forEach(function(box, index) {
      var dayList = document.getElementsByClassName('dayList')[index];
      if (dayList) {
        dayList.value = dayListValues[index];
      }
    });

    $('#brCount1').val(brCount1);
    $('#brCount2').val(brCount2);


    document.getElementById('itemAddButton').addEventListener('click', function() {
  if(itemLimit < 20)
  {
    var newRow = document.createElement('tr');
newRow.style.color = '#3a3838'; // Set text color
newRow.style.border = '1px solid #3a3838'; // Set border style
newRow.style.paddingLeft = '0'; // Set padding-left (use camelCase for hyphenated CSS properties)
newRow.style.marginLeft = '0'; // Set margin-left (use camelCase for hyphenated CSS properties)
var html = '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" class="it">';
html += '<input list="datalistOptions" name="materialList[]" id="materialBox" class="materialBox">';
html += '<p name="materialListDN[]" id="materialListD" style="display: none; padding: 0px; margin: 0px;" class="left"></p>';
html += '</td>';
html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" class="it">';
html += '<input type="number" style="text-align:center;" id="materialBox" class="materialQty" name="quantityList[]" value=""/>';
html += '<p name="materialQtDN[]" id="materialListD" style="display: none;"></p></td>';
html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name="unitList[]"></td>';
html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name="rateList[]"></td>';
html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name="amountList[]"></td>';
html += '<td style="border: 1px solid #3a3838; padding: 0; margin: 0;">';
html += '<button class="delete-row" style = "padding: 0; margin: 0;border: none;"><i class="fa-solid fa-trash-can" style="color: #ff0000;vertical-align: middle;"></i></button>';
html += '</td>';
newRow.innerHTML = html;
document.querySelector('#materialTable').appendChild(newRow);
    itemLimit += 1;
  }
});


var laborLimit = 1;
document.getElementById('laborAddButton').addEventListener('click', function() {

  if(laborLimit < 20)
  {
    var newRow = document.createElement('tr');
    newRow.style.color = '#3a3838';

    var html = '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;"><input list="datalistOptionsLabor" name = "laborList[]" id="materialBox" class ="laborBox"><p name = "laborListDN[]" id = "materialListD" class = "left" style = "display: none;"></p>';

    html += '</td>';
    html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;"><input type="number" style=" text-align:center;" id="materialBox" name="countList[]" class ="countList" value= ""/><p name = "countListDN[]" id = "materialListD" class = "it" style = "display: none;"></p></td>';
    html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;"><input type="number" style=" text-align:center;" id="materialBox" name="dayList[]" class ="dayList" value= ""/><p name = "dayListDN[]" id = "materialListD" class = "it" style = "display: none;"></p></td>';
    html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name="rateLaborList[]"></td>';
    html += '<td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name="amountLaborList[]"></td>';
    html += '<td style="border: 1px solid #3a3838; padding: 0; margin: 0;">';
    html += '<button class="delete-row" style = "padding: 0; margin: 0;border: none;"><i class="fa-solid fa-trash-can" style="color: #ff0000;vertical-align: middle;"></i></button>';
    html += '</td>';

    newRow.innerHTML = html;
    document.querySelector('#laborTable').appendChild(newRow);
    laborLimit += 1;
  }
});


    return false;
}


$(document).ready(function() {
    // Add event listener to delete buttons
    $(document).on('click', '.delete-row', function() {
        var row = $(this).closest('tr');
        row.remove();

        laborSubTotalCal();
        itemSubTotalCal()
    });

});







$(document).on('click', '#saveButton', function (e) {
  e.preventDefault();

  var quotNO = $('#quotNO').text();
  var quotDate = $('#quoutDate').text();
  var validity = $('#validity').text();
  var refNO = $('#refNO').text();
  var quotTo = $('#quotTo').text();
  var requestorD = $('#requestorD').text();
  var attentionD = $('#attentionD').text();
  var departmentD = $('#departmentD').text();
  var thruD = $('#thruD').text();
  var localD = $('#localD').text();
  var subjectD = $('#subjectD').text();
  var letterD = $('#letterD').text();
  var itemTotalD = $('#itemTotalD').text();
  var laborTotalD = $('#laborTotalD').text();
  var itemSubTotalD = $('#itemSubTotalD').text();
  var numItem = parseFloat($('#numItem').text());

  var laborSubTotalD = $('#laborSubTotalD').text();
  var numWorker = parseFloat($('#numWorker').text());


  var overheadProfitD = $('#overheadProfitD').text();
  var total = $('#total').text();
  var prepD = $('#prepD').text();
  var checD = $('#checD').text();
  var apprD = $('#apprD').text();
  var numWords = $('#numWords').text();
  var br1 = $('#brCount1').val();
  var br2 = $('#brCount2').val();

  // Retrieve values of elements with the name "quantityList[]"
var quantityList = $('[name="quantityList[]"]').map(function() {
    return $(this).val();
}).get();
var materialList = $('[name="materialList[]"]').map(function() {
    return $(this).val();
}).get();
var unitList = $('[name="unitList[]"]').map(function() {
    return $(this).text();
}).get();
var amountList = $('[name="amountList[]"]').map(function() {
    return $(this).text();
}).get();
var rateList = $('[name="rateList[]"]').map(function() {
    return $(this).text();
}).get();


var laborList = $('[name="laborList[]"]').map(function() {
    return $(this).val();
}).get();
var countList = $('[name="countList[]"]').map(function() {
    return $(this).val();
}).get();
var dayList = $('[name="dayList[]"]').map(function() {
    return $(this).val();
}).get();
var rateLaborList = $('[name="rateLaborList[]"]').map(function() {
    return $(this).text();
}).get();
var amountLaborList = $('[name="amountLaborList[]"]').map(function() {
    return $(this).text();
}).get();




console.log("quotNO:", quotNO);
console.log("quotDate:", quotDate);
console.log("validity:", validity);
console.log("refNO:", refNO);
console.log("quotTo:", quotTo);
console.log("requestorD:", requestorD);
console.log("attentionD:", attentionD);
console.log("departmentD:", departmentD);
console.log("thruD:", thruD);
console.log("localD:", localD);
console.log("subjectD:", subjectD);
console.log("letterD:", letterD);
console.log("itemTotalD:", itemTotalD);
console.log("laborTotalD:", laborTotalD);
console.log("itemSubTotalD:", itemSubTotalD);
console.log("numItem:", numItem);
console.log("laborSubTotalD:", laborSubTotalD);
console.log("numWorker:", numWorker);
console.log("overheadProfitD:", overheadProfitD);
console.log("total:", total);
console.log("prepD:", prepD);
console.log("checD:", checD);
console.log("apprD:", apprD);

// Printing values from lists
console.log("quantityList:", quantityList);
console.log("materialList:", materialList);
console.log("unitList:", unitList);
console.log("amountList:", amountList);
console.log("rateList:", rateList);
console.log("laborList:", laborList);
console.log("countList:", countList);
console.log("dayList:", dayList);
console.log("rateLaborList:", rateLaborList);
console.log("amountLaborList:", amountLaborList);



    var csrfToken = $('meta[name="csrf-token"]').attr('content');


    $.ajax({
    type: 'POST',
    url: '/quotation-document',
    data: {
        quotNO: quotNO,
        quotDate: quotDate,
        validity: validity,
        refNO: refNO,
        quotTo: quotTo,
        requestorD: requestorD,
        attentionD: attentionD,
        departmentD: departmentD,
        thruD: thruD,
        localD: localD,
        subjectD: subjectD,
        letterD: letterD,
        itemTotalD: itemTotalD,
        laborTotalD: laborTotalD,
        itemSubTotalD: itemSubTotalD,
        numItem: numItem,
        laborSubTotalD: laborSubTotalD,
        numWorker: numWorker,
        overheadProfitD: overheadProfitD,
        total: total,
        prepD: prepD,
        checD: checD,
        apprD: apprD,
        quantityList: quantityList,
        materialList: materialList,
        unitList: unitList,
        amountList: amountList,
        rateList: rateList,
        laborList: laborList,
        countList: countList,
        dayList: dayList,
        rateLaborList: rateLaborList,
        amountLaborList: amountLaborList,
        numWords: numWords,
        br1:br1,
        br2:br2
    },
    dataType: 'json',
    headers: {
        'X-CSRF-TOKEN': csrfToken
    },
    success: function(response) {
        if (response.status_code == '0') {
            $('#thruD').text(response.thru);
        } else if (response.status_code == '1') {
            var errorMessage = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
            $('.modal-body').prepend(errorMessage);
        }
    }
});



});
</script>
@endsection
