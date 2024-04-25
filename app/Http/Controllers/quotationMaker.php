<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\MaterialList;
use App\Models\WorkerList;
use App\Models\RequestorList;
use App\Models\Requests;
use App\Models\QuotationRecord;
use App\Models\ItemRecords;
use App\Models\LaborRecords;
use PDF;

class quotationMaker extends Controller
{
  public function materialList(Request $request)
  {
    $materials = DB::table('materiallist')
      ->orderBy('item', 'asc')
      ->get();

    $page = $request->input('page');
    return view('content.quotation.materialList', ['materials' => $materials, 'page' => $page]);
  }

  public function getMaterials()
  {
    $materials = DB::table('materiallist')
      ->orderBy('item', 'asc')
      ->get();
    return response()->json(['materials' => $materials]);
  }

  public function workersList()
  {
    $workers = DB::table('workerlist')
      ->orderBy('labor', 'asc')
      ->get();

    return view('content.quotation.workersList', ['workers' => $workers]);
  }

  /*



  Requestor List




  */

  public function requestorList()
  {
    $requestors = DB::table('requestorlist')
      ->orderBy('requestor', 'asc')
      ->get();

    return view('content.quotation.requestorList', ['requestors' => $requestors]);
  }

  public function addRequestorPro(Request $request)
  {
    $requestor = $request->input('requestor');
    $department = $request->input('department');
    $local = $request->input('local');

    // Check if the item name already exists
    $existingrequestor = RequestorList::where('requestor', $requestor)->first();

    if ($existingrequestor) {
      return response()->json(['status_code' => 1, 'message' => 'Requestor already exists']);
    }

    $add_requestor = RequestorList::create([
      'requestor' => $requestor,
      'department' => $department,
      'local' => $local,
    ]);

    // Retrieve paginated list of materials with 3 items per page and using the current page number
    $requestors = DB::table('requestorlist')
      ->orderBy('requestor', 'asc')
      ->get();

    $content = '';
    foreach ($requestors as $requestorI) {
      $content .=
        '<tr>
                    <td>' .
        $requestorI->requestor .
        '</td>
                    <td>' .
        $requestorI->department .
        '</td>
                    <td>' .
        $requestorI->local .
        '</td>
        <td>

                        <button type="button" class="btn btn-danger p-2" id="del"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>';
    }
    $quotContent = '';
    foreach ($requestors as $requestorI) {
      $quotContent .= '<option value = ' . $requestorI->requestor . '>' . $requestorI->requestor . '</option>';
    }

    if ($add_requestor) {
      return response()->json([
        'status_code' => 0,
        'message' => 'Requestor added successfully',
        'content' => $content,
        'quotContent' => $quotContent,
      ]);
    } else {
      return response()->json(['status_code' => 1, 'message' => 'Failed to add requestor'], 500);
    }
  }

  public function requestorSearch(Request $request)
  {
    $search = $request->input('searchValue');

    $searchResults = RequestorList::where('requestor', 'LIKE', "$search%")
      ->orderBy('requestor', 'asc')
      ->get();

    $searchContent = '';
    foreach ($searchResults as $searchResult) {
      $searchContent .=
        '<tr>
                <td>' .
        $searchResult->requestor .
        '</td>
                <td>' .
        $searchResult->department .
        '</td>
                <td>' .
        $searchResult->local .
        '</td>
                <td>

                        <button type="button" class="btn btn-danger p-2 delete-modal" data-toggle="modal" data-target="#insertReqListModalDel" data-requestor="' .
        $searchResult->requestor .
        '" id="del"><i class="fa-solid fa-trash"></i></button>
                    </td>
            </tr>';
    }

    return response()->json([
      'status_code' => 0,
      'searchContent' => $searchContent,
    ]);
  }

  public function deleteRequestorPro(Request $request)
  {
    $requestor = $request->input('del-requestor');

    $delete = RequestorList::where('requestor', $requestor)->delete();

    if ($delete) {
      return response()->json(['status_code' => 0]);
    }
  }
  /*




  WorkerList




  */

  public function addWorkerPro(Request $request)
  {
    $workerName = $request->input('labor');
    $rate = $request->input('rate');

    // Check if the item name already exists
    $existingWorker = WorkerList::where('labor', $workerName)->first();

    if ($existingWorker) {
      return response()->json(['status_code' => 1, 'message' => 'Worker already exists']);
    }

    $add_worker = WorkerList::create([
      'labor' => $workerName,
      'rate' => $rate,
    ]);

    // Retrieve paginated list of materials with 3 items per page and using the current page number
    $workers = DB::table('workerlist')
      ->orderBy('labor', 'asc')
      ->get();

    $content = '';
    foreach ($workers as $worker) {
      $content .=
        '<tr>
                    <td>' .
        $worker->labor .
        '</td>
                    <td>₱' .
        $worker->rate .
        '</td>
        <td>
          <button type="button" class="btn btn-primary p-2 open-modal update-modal" data-toggle="modal" data-target="#insertWorkerModalMod"
                  data-labor="' .
        $worker->labor .
        '" data-rate="' .
        $worker->rate .
        '">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                        <button type="button" class="btn btn-danger p-2" id="del"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>';
    }

    if ($add_worker) {
      return response()->json([
        'status_code' => 0,
        'message' => 'Worker added successfully',
        'content' => $content,
      ]);
    } else {
      return response()->json(['status_code' => 1, 'message' => 'Failed to add worker'], 500);
    }
  }

  public function workerSearch(Request $request)
  {
    $search = $request->input('searchValue');

    $searchResults = WorkerList::where('labor', 'LIKE', "$search%")
      ->orderBy('labor', 'asc')
      ->get();

    $searchContent = '';
    foreach ($searchResults as $searchResult) {
      $searchContent .=
        '<tr>
                <td>' .
        $searchResult->labor .
        '</td>
                <td>₱' .
        $searchResult->rate .
        '</td>
                <td>
                        <button type="button" class="btn btn-primary p-2 open-modal update-modal" data-toggle="modal" data-target="#insertWorkerModalMod"
                                data-labor="' .
        $searchResult->labor .
        '" data-rate="' .
        $searchResult->rate .
        '">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                        <button type="button" class="btn btn-danger p-2 delete-modal" data-toggle="modal" data-target="#insertWorkerModalDel" data-labor="' .
        $searchResult->labor .
        '" id="del"><i class="fa-solid fa-trash"></i></button>
                    </td>
            </tr>';
    }

    return response()->json([
      'status_code' => 0,
      'searchContent' => $searchContent,
    ]);
  }
  public function updateWorkerPro(Request $request)
  {
    $laborName = $request->input('mod-labor');
    $rate = $request->input('mod-rate');

    $add_worker = WorkerList::updateOrCreate(
      ['labor' => $laborName], // Condition for update
      ['rate' => $rate] // Data to update or insert
    );

    return response()->json(['status_code' => 0]);
  }

  public function deleteWorkerPro(Request $request)
  {
    $labor = $request->input('del-labor');

    $delete = WorkerList::where('labor', $labor)->delete();

    if ($delete) {
      return response()->json(['status_code' => 0]);
    }
  }

  public function addMaterialPro(Request $request)
  {
    $itemName = $request->input('itemName');
    $price = $request->input('price');
    $unit = $request->input('unit');

    // Check if the item name already exists
    $existingMaterial = MaterialList::where('item', $itemName)->first();

    if ($existingMaterial) {
      return response()->json(['status_code' => 1, 'message' => 'Item already exists']);
    }

    $add_material = MaterialList::create([
      'item' => $itemName,
      'price' => $price,
      'unit' => $unit,
    ]);

    // Get the current page number from the URL query parameters
    $page = request()->query('page', $request->input('page', 1));

    // Retrieve paginated list of materials with 3 items per page and using the current page number
    $materials = DB::table('materiallist')
      ->orderBy('item', 'asc')
      ->get();

    $content = '';
    foreach ($materials as $material) {
      $content .=
        '<tr>
                    <td>' .
        $material->item .
        '</td>
                    <td>₱' .
        $material->price .
        '</td>
                    <td>' .
        $material->unit .
        '</td>
        <td>
          <button type="button" class="btn btn-primary p-2 open-modal update-modal" data-toggle="modal" data-target="#insertItemModalMod"
                  data-item="' .
        $material->item .
        '" data-price="' .
        $material->price .
        '" data-unit="' .
        $material->unit .
        '">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                        <button type="button" class="btn btn-danger p-2" id="del"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>';
    }

    if ($add_material) {
      return response()->json([
        'status_code' => 0,
        'message' => 'Material added successfully',
        'content' => $content,
      ]);
    } else {
      return response()->json(['status_code' => 1, 'message' => 'Failed to add material'], 500);
    }
  }

  public function materialSearch(Request $request)
  {
    $search = $request->input('searchValue');

    $searchResults = MaterialList::where('item', 'LIKE', "$search%")
      ->orderBy('item', 'asc')
      ->get();

    $searchContent = '';
    foreach ($searchResults as $searchResult) {
      $searchContent .=
        '<tr>
                <td>' .
        $searchResult->item .
        '</td>
                <td>₱' .
        $searchResult->price .
        '</td>
                <td>' .
        $searchResult->unit .
        '</td>
                <td>
                        <button type="button" class="btn btn-primary p-2 open-modal update-modal" data-toggle="modal" data-target="#insertItemModalMod"
                                data-item="' .
        $searchResult->item .
        '" data-price="' .
        $searchResult->price .
        '"
                                data-unit="' .
        $searchResult->unit .
        '">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                        <button type="button" class="btn btn-danger p-2 delete-modal" data-toggle="modal" data-target="#insertItemModalDel" data-item="' .
        $searchResult->item .
        '" id="del"><i class="fa-solid fa-trash"></i></button>
                    </td>
            </tr>';
    }

    return response()->json([
      'status_code' => 0,
      'searchContent' => $searchContent,
    ]);
  }
  public function updateMaterialPro(Request $request)
  {
    $itemName = $request->input('mod-item');
    $price = $request->input('mod-price');

    $add_material = MaterialList::updateOrCreate(
      ['item' => $itemName], // Condition for update
      ['price' => $price] // Data to update or insert
    );

    return response()->json(['status_code' => 0]);
  }

  public function deleteMaterialPro(Request $request)
  {
    $item = $request->input('del-item');

    $delete = MaterialList::where('item', $item)->delete();

    if ($delete) {
      return response()->json(['status_code' => 0]);
    }
  }

  /*


  Request


  */

  public function request()
  {
    $quotationReq = DB::table('quotation_request')
      ->join('requestorlist', 'requestorlist.id', '=', 'quotation_request.requestor_id')
      ->select('quotation_request.job_request_no as reqID', 'requestorlist.requestor', 'quotation_request.subject')
      ->where('quotation_request.status', '!=', 'generated')
      ->orderBy('quotation_request.job_request_no', 'asc')
      ->get();
    $requestorList = DB::table('requestorlist')
      ->orderBy('requestor', 'asc')
      ->get();

    return view('content.quotation.request', ['quotationReq' => $quotationReq, 'requestorList' => $requestorList]);
  }

  public function addRequestPro(Request $request)
  {
    $requestor = $request->input('requestorID');
    $subject = $request->input('subject');
    $jobRequest = $request->input('jobRequest');

    // Check if the item name already exists
    $existingrequestor = RequestorList::where('requestor', $requestor)->first();

    if ($existingrequestor) {
      $checkJobRequestNo = Requests::where('job_request_no', $jobRequest)->first();
      if (!$checkJobRequestNo) {
        $add_request = Requests::create([
          'job_request_no' => $jobRequest,
          'requestor_id' => $existingrequestor->id,
          'subject' => $subject,
        ]);
        return response()->json([
          'status_code' => 0,
          'message' => 'Request added successfully',
        ]);
      } else {
        return response()->json(['status_code' => 1, 'message' => 'Job Request No. already exist']);
      }
    } else {
      return response()->json(['status_code' => 1, 'message' => 'Requestor does not exists']);
    }
  }

  public function requestSearch(Request $request)
  {
    $search = $request->input('searchValue');

    $searchResults = Requests::select(
      'quotation_request.job_request_no as reqID',
      'requestorlist.requestor',
      'quotation_request.subject'
    )
      ->where('quotation_request.job_request_no', 'LIKE', "$search%")
      ->where('quotation_request.status', '!=', 'completed')
      ->join('requestorlist', 'requestorlist.id', '=', 'quotation_request.requestor_id')
      ->orderBy('quotation_request.job_request_no', 'asc')
      ->get();

    $searchContent = '';
    foreach ($searchResults as $searchResult) {
      $searchContent .=
        '<tr>
                <td>' .
        $searchResult->reqID .
        '</td>
                <td>' .
        $searchResult->requestor .
        '</td>
                <td>
                <span class="subject">' .
        Str::limit($searchResult->subject, 40) .
        '</span>
                <span class="full-subject" style="display: none;">' .
        $searchResult->subject .
        '</span>
        </td>
                <td>

                        <button type="button" class="btn btn-danger p-2 delete-modal" data-toggle="modal" data-target="#insertReqListModalDel" data-reqID="' .
        $searchResult->reqID .
        '" id="del"><i class="fa-solid fa-trash"></i></button>
                    </td>
            </tr>';
    }

    return response()->json([
      'status_code' => 0,
      'searchContent' => $searchContent,
    ]);
  }

  public function deleteRequestPro(Request $request)
  {
    $requests = $request->input('del-request');

    $delete = Requests::where('job_request_no', $requests)->delete();

    if ($delete) {
      return response()->json(['status_code' => 0]);
    }
  }

  /*




  Quotation Generator




  */

  public function quotation()
  {
    $requestorList = DB::table('requestorlist')
      ->orderBy('requestor', 'asc')
      ->get();
    $materialList = DB::table('materiallist')
      ->orderBy('item', 'asc')
      ->get();
    $laborList = DB::table('workerlist')
      ->orderBy('labor', 'asc')
      ->get();
    $requestNo = DB::table('quotation_request')
      ->leftJoin('quotation_record', 'quotation_record.reference_number', '=', 'quotation_request.job_request_no')
      ->whereNull('quotation_record.reference_number')
      ->get();

    return view('content.quotation.quotation', [
      'requestorList' => $requestorList,
      'materialList' => $materialList,
      'laborList' => $laborList,
      'requestNo' => $requestNo,
    ]);
  }
  public function quotationRequestor(Request $request)
  {
    $r = $request->input('requestor');

    $requestor = DB::table('requestorlist')
      ->where('requestor', '=', $r)
      ->orderBy('requestor', 'asc')
      ->first();
    if ($requestor) {
      return response()->json([
        'status_code' => 0,
        'requestors' => $requestor->requestor,
        'department' => $requestor->department,
        'local' => $requestor->local,
      ]);
    }
  }
  public function quotationRequestDetails(Request $request)
  {
    $referenceNo = $request->input('referenceNo');

    $request = DB::table('quotation_request')
      ->select(
        'requestorlist.requestor',
        'requestorlist.local',
        'quotation_request.subject',
        'requestorlist.department'
      )
      ->join('requestorlist', 'requestorlist.id', '=', 'quotation_request.requestor_id')
      ->where('job_request_no', '=', $referenceNo)

      ->first();

    if ($request) {
      return response()->json([
        'status_code' => 0,
        'requestor' => $request->requestor,
        'local' => $request->local,
        'subject' => $request->subject,
        'department' => $request->department,
      ]);
    }
  }
  public function quotationThru(Request $request)
  {
    $attentionInput = $request->input('attentionInput');

    $thruRes = DB::table('requestorlist')
      ->where('requestor', '=', $attentionInput)
      ->orderBy('requestor', 'asc')
      ->first();
    if ($thruRes) {
      return response()->json([
        'status_code' => 0,
        'thru' => $thruRes->department,
      ]);
    }
  }

  public function quotationMaterialData(Request $request)
  {
    $material = $request->input('material');
    $quantity = $request->input('quantity');

    $matRes = DB::table('materiallist')
      ->where('item', '=', $material)
      ->first();

    if ($matRes) {
      return response()->json([
        'status_code' => 0,
        'unit' => $matRes->unit,
        'rate' => $matRes->price,
        'amount' => $matRes->price * $quantity,
        'item' => $matRes->item,
      ]);
    } else {
      return response()->json([
        'status_code' => 3,
        'unit' => '',
        'rate' => '',
        'amount' => '',
        'item' => '',
      ]);
    }
  }

  public function quotationLaborData(Request $request)
  {
    $labor = $request->input('labor');
    $count = $request->input('count');
    $day = $request->input('day');

    $labRes = DB::table('workerlist')
      ->where('labor', '=', $labor)
      ->first();

    if ($labRes) {
      return response()->json([
        'status_code' => 0,
        'rate' => $labRes->rate,
        'amount' => $labRes->rate * $count * $day,
        'labor' => $labRes->labor,
      ]);
    } else {
      return response()->json([
        'status_code' => 3,
        'rate' => '',
        'amount' => '',
        'labor' => '',
      ]);
    }
  }

  public function quotationDoc(Request $request)
  {
    $fields = [
      'quotNO',
      'quotDate',
      'validity',
      'refNO',
      'quotTo',
      'requestorD',
      'attentionD',
      'subjectD',
      'letterD',
      'quantityList',
      'materialList',
      'unitList',
      'amountList',
      'rateList',
      'laborList',
      'countList',
      'dayList',
      'rateLaborList',
      'amountLaborList',
      'departmentD',
      'thruD',
      'localD',
      'itemTotalD',
      'laborTotalD',
      'itemSubTotalD',
      'numItem',
      'laborSubTotalD',
      'numWorker',
      'overheadProfitD',
      'total',
      'numWords',
      'prepD',
      'checD',
      'apprD',
      'br1',
      'br2',
    ];

    $error = false;

    foreach ($fields as $field) {
      $$field = $request->input($field);
      if (empty($$field)) {
        $error = true;
        break; // Stop loop once an empty field is found
      }
    }

    if ($error) {
      return response()->json([
        'status_code' => 2,
        'message' => 'One or more required fields are empty.',
      ]);
    }

    // Your existing logic here...

    $quotNO = $request->input('quotNO');

    $searchResults = QuotationRecord::where('quotation_number', '=', "$quotNO")->first();

    if ($searchResults) {
      return response()->json([
        'status_code' => 1,
        'message' => 'Quotation number already exist.',
      ]);
    }

    $quotDate = $request->input('quotDate');
    $validity = $request->input('validity');
    $refNO = $request->input('refNO');
    $quotTo = $request->input('quotTo');
    $requestorD = $request->input('requestorD');
    $attentionD = $request->input('attentionD');

    $subjectD = $request->input('subjectD');
    $letterD = $request->input('letterD');

    $quantityList = $request->input('quantityList');
    $materialList = $request->input('materialList');
    $unitList = $request->input('unitList');

    $amountList = $request->input('amountList');
    $rateList = $request->input('rateList');

    $amountList = array_map(function ($amount) {
      return str_replace('₱', '', $amount);
    }, $amountList);

    $rateList = array_map(function ($rate) {
      return str_replace('₱', '', $rate);
    }, $rateList);

    $laborList = $request->input('laborList');
    $countList = $request->input('countList');
    $dayList = $request->input('dayList');
    $rateLaborList = $request->input('rateLaborList');
    $amountLaborList = $request->input('amountLaborList');

    $rateLaborList = str_replace('₱', '', $rateLaborList);

    $amountLaborList = str_replace('₱', '', $amountLaborList);

    $departmentD = $request->input('departmentD');
    $thruD = $request->input('thruD');
    $localD = $request->input('localD');
    $itemTotalD = $request->input('itemTotalD');
    $itemTotalD = str_replace('₱', '', $itemTotalD);

    $laborTotalD = $request->input('laborTotalD');
    $laborTotalD = str_replace('₱', '', $laborTotalD);

    $itemSubTotalD = $request->input('itemSubTotalD');
    $itemSubTotalD = str_replace('₱', '', $itemSubTotalD);

    $numItem = $request->input('numItem');
    $numItem = str_replace(' Items', '', $numItem);

    $laborSubTotalD = $request->input('laborSubTotalD');
    $laborSubTotalD = str_replace('₱', '', $laborSubTotalD);

    $numWorker = $request->input('numWorker');
    $numWorker = str_replace('Workers', '', $numWorker);

    $overheadProfitD = $request->input('overheadProfitD');
    $overheadProfitD = str_replace('₱', '', $overheadProfitD);

    $total = $request->input('total');
    $total = str_replace('PHP ', '', $total);

    $numWords = $request->input('numWords');

    $prepD = $request->input('prepD');
    $checD = $request->input('checD');
    $apprD = $request->input('apprD');
    $br1 = $request->input('br1');
    $br2 = $request->input('br2');

    $quotRec = QuotationRecord::create([
      'quotation_number' => $quotNO,
      'quotation_date' => $quotDate,
      'validity' => $validity,
      'reference_number' => $refNO,
      'requestor' => $requestorD,
      'quotation_to' => $quotTo,
      'inCharge' => $attentionD,
      'subject' => $subjectD,
      'letter' => $letterD,
      'preparedBy' => $prepD,
      'checkedBy' => $checD,
      'approvedBy' => $apprD,
      'department' => $departmentD,
      'local' => $localD,
      'thru' => $thruD,
      'itemTotal' => $itemTotalD,
      'laborTotal' => $laborTotalD,
      'numItem' => $numItem,
      'numLabor' => $numWorker,
      'overhead_profit' => $overheadProfitD,
      'total' => $total,
      'numWords' => $numWords,
      'br1' => $br1,
      'br2' => $br2,
    ]);

    // Determine the number of items in the lists (assuming they all have the same length)
    $numItems = count($quantityList);

    // Loop through the lists and insert corresponding values into the database
    for ($i = 0; $i < $numItems; $i++) {
      ItemRecords::create([
        'quantity' => $quantityList[$i],
        'item' => $materialList[$i],
        'unit' => $unitList[$i],
        'amount' => $amountList[$i],
        'rate' => $rateList[$i],
        'quotation_number' => $quotNO,
      ]);
    }

    $numLabors = count($laborList);

    for ($i = 0; $i < $numLabors; $i++) {
      LaborRecords::create([
        'labor' => $laborList[$i],
        'count' => $countList[$i],
        'working_days' => $dayList[$i],
        'rate' => $rateLaborList[$i],
        'amount' => $amountLaborList[$i],
        'quotation_number' => $quotNO,
      ]);
    }

    Requests::updateOrCreate(
      ['job_request_no' => $refNO], // Condition for update
      ['status' => 'generated'] // Data to update or insert
    );

    return response()->json([
      'status_code' => 0,
      'message' => 'Quotation details was added successfully.',
    ]);
  }

  public function quotationView(Request $request)
  {
    $quotNO = $request->input('quotNo');

    $quotationRec = QuotationRecord::where('quotation_number', '=', "$quotNO")->first();
    $itemRec = ItemRecords::where('quotation_number', '=', "$quotNO")->get();
    $laborRec = LaborRecords::where('quotation_number', '=', "$quotNO")->get();

    return view('content.quotation.quotationView', [
      'quotationRec' => $quotationRec,
      'itemRec' => $itemRec,
      'laborRec' => $laborRec,
    ]);
  }

  public function quotationRecords(Request $request)
  {
    $quotationRec = QuotationRecord::all();

    return view('content.quotation.quotationRecords', [
      'quotationRec' => $quotationRec,
    ]);
  }

  public function quotationDel(Request $request)
  {
    $quotNO = $request->input('quot');

    $ref = QuotationRecord::where('quotation_number', '=', "$quotNO")->first();

    $quotationRec = QuotationRecord::where('quotation_number', $quotNO)->delete();
    $itemRec = ItemRecords::where('quotation_number', $quotNO)->delete();
    $laborRec = LaborRecords::where('quotation_number', $quotNO)->delete();

    $updateRequest = Requests::updateOrCreate(
      ['job_request_no' => $ref->reference_number], // Condition for update
      ['status' => 'pending'] // Data to update or insert
    );

    return response()->json([
      'status_code' => 0,
      'message' => 'Deleted Successfully',
    ]);
  }
}
