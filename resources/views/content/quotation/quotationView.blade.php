@extends('layouts/contentNavbarLayout')

@section('title', 'Quotation View')

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
            <td name = "quotNO" id = "quotNO" style = "color: red; font-weight:bold;">{{ $quotationRec->quotation_number}}</td>
          </tr>
          <tr>
            <td style = "vertical-align: top;">Quotation Date</td>
            <td name = "quoutDate">{{ $quotationRec->quotation_date}}</td>
          </tr>
          <tr>
            <td style = "vertical-align: top;">Validity</td>
            <td name = "validity">{{ $quotationRec->validity}}</td>
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
        <th style="vertical-align: top;" name = "refNO" id = "refNO">{{ $quotationRec->reference_number}}</th>
        <th style="vertical-align: top;">Quotation to</th>
        <th style="vertical-align: top; word-wrap: break-word;" name = "quotTo" id = "quotTo">{{ $quotationRec->quotation_to}}</th>
    </tr>
    <tr>
        <td>Requestor</td>
        <td name = "requestorD" id = "requestorD">{{ $quotationRec->requestor}}</td>
        <td>Attention</td>
        <td name = "attentionD" id = "attentionD">{{ $quotationRec->inCharge}}</td>
    </tr>
    <tr>
        <td style = "vertical-align: top;">Department</td>
        <td style = "vertical-align: top;" name = "departmentD" id = "departmentD">{{ $quotationRec->department}}</td>
        <td style = "vertical-align: top;">Thru</td>
        <td style = "vertical-align: top;" name = "thruD" id = "thruD">{{ $quotationRec->thru}}</td>
    </tr>
    <tr>
        <td style="padding-bottom:15px;">Local No.</td>
        <td style="padding-bottom:15px;" name = "localD" id = "localD">{{ $quotationRec->local}}</td>
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
          <td colspan="5" style = "padding-left: 0; margin-left: 0;">SUBJECT:&nbsp<font name = "subjectD" id = "subjectD">{{ $quotationRec->subject}}</font></td>
      </tr>
      <tr style="color: black; font-weight: bold;font-weight: normal;" align = "left">
          <td colspan="5" style = "padding-left: 0; margin-left: 0;">Dear Ma'am/Sir,</td>
      </tr>
      <tr style="color: black; font-weight: bold;font-weight: normal;" align = "left">
          <td colspan="5" style = "padding-left: 0; margin-left: 0;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font name = "letterD" id = "letterD">{{ $quotationRec->letter}}</font></td>
      </tr>
  </table>
</div>
</div>
</div>
</div>

<div class="row">

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

</tr>
@foreach($itemRec as $n)
<tr style="color:#3a3838;">
<td style="border: 1px solid #3a3838; text-align: left; padding: 0;">
<p name="materialListDN[]" id="materialListD" class="left" style="margin: 0; padding: 0;">{{ $n->item }}</p>
</td>

<td style="border: 1px solid #3a3838; padding: 0;">
<p name="materialQtDN[]" id="materialListD" style="margin: 0; padding: 0;">{{ $n->quantity }}</p>
</td>
<td style="border: 1px solid #3a3838; padding: 0;">
<p name="unitList[]" id="materialListD" style="margin: 0; padding: 0;">{{ $n->unit }}</p>
</td>
<td style="border: 1px solid #3a3838; padding: 0;">
<p name="rateList[]" id="materialListD" style="margin: 0; padding: 0;">₱{{ $n->rate }}</p>
</td>
<td style="border: 1px solid #3a3838; padding: 0;">
<p name="amountList[]" id="materialListD" style="margin: 0; padding: 0;">₱{{ $n->amount }}</p>
</td>

</tr>
@endforeach


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
    <td name = "itemTotalD" id = "itemTotalD" style = "padding-left: 0; margin-left: 0;">₱{{ $quotationRec->itemTotal}}</td>
</tr>
</table>

@php
    $brCount1 = $quotationRec->br1; // Assuming $quotationRec->br2 contains the number from the database
@endphp
<div id="content1">


@for ($i = 0; $i < $brCount1; $i++)
    <br>
@endfor
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
  @foreach($laborRec as $n)
  <tr style="color:#3a3838;">
      <td style="border: 1px solid #3a3838; padding-left: 0;text-align: left; margin-left: 0;">
        <p name = "laborList[]" id = "materialListD" class = "laborBox"style="margin: 0; padding: 0;">{{ $n->labor }}</p>
      </td>
      <td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;">
        <p name = "countList[]" id = "materialListD" class = "countList"style="margin: 0; padding: 0;">{{ $n->count }}</p>
      </td>
      <td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;">
        <p name = "dayList[]" id = "materialListD" class = "dayList"style="margin: 0; padding: 0;">{{ $n->working_days }}</p>
      </td>
      <td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name = "rateLaborList[]"style="margin: 0; padding: 0;">₱{{ $n->rate }}</td>
      <td style="border: 1px solid #3a3838; padding-left: 0; margin-left: 0;" name = "amountLaborList[]"style="margin: 0; padding: 0;">₱{{ $n->amount }}</td>

  </tr>
  @endforeach
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
    <td name = "laborTotalD" id = "laborTotalD" style = "padding-left: 0; margin-left: 0;">₱{{ $quotationRec->laborTotal}}</td>
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
    <td style="border-top: 2px solid #8ea9db;padding-left: 0; margin-left: 0; text-align: center;" name = "itemSubTotalD" id = "itemSubTotalD">₱{{ $quotationRec->itemTotal}}</td>
</tr>
<tr style="color:#3a3838;">
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td colspan="2" style="color: #808080; padding-left: 0; margin-left: 0; font-style: italic;" name="numItem" id="numItem">
    @if($quotationRec->numItem > 1)
        {{ $quotationRec->numItem }} Items
    @else
        {{ $quotationRec->numItem }} Item
    @endif
</td>
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td syle = "padding-left: 0; margin-left: 0;"></td>
</tr>
<tr style="color:#3a3838;">
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td colspan="2" style = "padding-left: 0; margin-left: 0;">Labor Sub Total</td>
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td style = "padding-left: 0; margin-left: 0;text-align: center;" name = "laborSubTotalD" id = "laborSubTotalD">₱{{ $quotationRec->laborTotal}}</td>
</tr>
<tr style="color:#3a3838;">
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td style = "padding-left: 0; margin-left: 0;color: #808080; font-weight: style;" colspan="2" name = "numWorker" id = "numWorker">
    @if($quotationRec->numLabor > 1)
        {{ $quotationRec->numLabor }} Workers
    @else
        {{ $quotationRec->numLabor }} Worker
    @endif
  </td>
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td style = "padding-left: 0; margin-left: 0;"></td>
</tr>
<tr style="color:#3a3838;">
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td style = "padding-left: 0; margin-left: 0;" colspan="2">Overhead/Profit</td>
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td style = "padding-left: 0; margin-left: 0;text-align: center;" name = "overheadProfitD" id = "overheadProfitD">₱{{ $quotationRec->overhead_profit }}</td>
</tr>
<tr style="color:#3a3838;">
    <td style = "padding-left: 0; margin-left: 0;"></td>
    <td style = "padding-left: 0; margin-left: 0;" colspan="2" style="border-top: 2px solid #8ea9db;">Total</td>
    <td style="border-top: 2px solid #8ea9db; padding-left: 0; margin-left: 0;"></td>
    <td style="border-top: 2px solid #8ea9db; color: red; font-weight: bold; padding-left: 0; margin-left: 0;text-align: center;" name = "total" id = "total">₱{{ $quotationRec->total }}</td>
</tr>
<tr style="color:#3a3838;">
    <td></td>
    <td colspan="2" style = "color: #808080;">Total in words</td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td></td>
    <td colspan="3" style="color:black;font-weight: bold; font-size:15px;" name = "numWords" id = "numWords">{{ $quotationRec->numWords }}</td>
</tr>
</table>
@php
    $brCount2 = $quotationRec->br2; // Assuming $quotationRec->br2 contains the number from the database
@endphp

<div id="content2">
@for ($i = 0; $i < $brCount2; $i++)
    <br>
@endfor
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
    <td name = "prepD" id = "prepD">{{ $quotationRec->preparedBy}}</td>
    <td name = "checD" id = "checD">{{ $quotationRec->checkedBy}}</td>
    <td name = "apprD" id = "apprD">{{ $quotationRec->checkedBy}}</td>


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

                    <div class="form-floating form-floating-outline mb-4">


                  <div class="demo-inline-spacing">


                    <button class=" btn btn-primary" onclick="printContent()" style = "height: 38px; width: 45%; font-size: 12px;">Print Document</button>





                </div>

              </div>

            </div>

          </div>

        </div>

  </div>


</div>






<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>






<script>




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

  }
</script>
@endsection
