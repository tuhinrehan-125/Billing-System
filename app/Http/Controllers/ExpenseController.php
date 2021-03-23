<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Expense;
use App\Category;
use App\SubCategory;
use App\Employee;
use App\ExpenseDetails;
use App\NoteSheetProcessComment;
use App\NoteSheetProcess;
use App\Bank;
use App\Branch;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function data()
    {
        $expense = Expense::with('NoteSheet')->where('delete_status', 1)->get();
        return view('backend.expense.index', compact('expense'));
    }
    public function penddingData()
    {

        $expense = Expense::where('delete_status', 1)->where('status', 0)->get();
        return view('backend.expense.processingExpense', compact('expense'));
    }
    public function penddingDetails($id)
    {
        $expense = Expense::findOrFail($id);
        $expenseDetails = ExpenseDetails::where('delete_status', 1)->where('expense_id', $id)->get();
        $noteSheet = NoteSheetProcess::where('notesheet_id', $id)->first();
        $noteComments = NoteSheetProcessComment::where('notesheet_id', $id)->get();
        return view('backend.expense.processingExpenseDetails', compact('expense', 'expenseDetails', 'noteComments', 'noteSheet'));
    }
    public function approveExpense()
    {
        $expense = Expense::with('NoteSheet')->where('delete_status', 1)->where('status', 1)->get();
        return view('backend.expense.approveExpense', compact('expense'));
    }

    // For payment of of approved expanse.
    public function paymentExpense()
    {
        $expense = Expense::with('Banks')->where('delete_status', 1)->where('status', 1)->get();
        $bank = Bank::all();
        $branch = Branch::all();
        return view('backend.expense.paymentExpense', compact('expense', 'bank', 'branch'));
    }
    public function payEdit($id)
    {
        $expense = Expense::findOrFail($id);
        return $expense;
    }

    public function paymentCashStore(Request $request)
    {
        //return $request;
        $expense = Expense::findOrFail($request->id);

        $pre_paid = $expense->paid;

        //$expense->paid = $request->amounts + $pre_paid;

        $totalAmount = $expense->paid + $request->amount;
        $totalAmount2 = $expense->paid + $request->amounts;

        if ($expense->total_expense >= $totalAmount && $request->amounts == 0) {

            $pre_paid = $expense->paid;
            $expense->paid = $request->amount + $pre_paid;
            $expense->bank_id = $request->bank_id;
            $expense->branch_id = $request->branch_id;
            $expense->account_no = $request->account_no;

            $expense->save();
            Toastr::success('Payment Information', 'Success');
            return back();
            return response()->json(['success']);
        }
        if ($expense->total_expense >= $totalAmount2) {
            $expense->bank_id = $request->bank_id;
            $expense->branch_id = $request->branch_id;
            $expense->account_no = $request->account_no;
            $pre_paid = $expense->paid;
            $expense->paid = $request->amounts + $pre_paid;

            $expense->save();
            Toastr::success('Payment Information', 'Success');
            return back();
            return response()->json(['success']);
        } else {
            Toastr::success('Payment Information', 'Not Success');
            return back();
            return response()->json(['not_success']);
        }
    }

    // public function paymentBankStore(Request $request)
    // {
    //     //return $request;
    //     $expense = Expense::findOrFail($request->id);

    //     $expense->bank_id = $request->bank_id;
    //     $expense->branch_id = $request->branch_id;
    //     $expense->account_no = $request->account_no;

    //     $pre_paid = $expense->paid;
    //     $expense->paid = $request->amounts + $pre_paid;
    //     $expense->save();
    //     Toastr::success('Payment Information', 'Success');
    //     return back();
    //     return response()->json(['success']);
    // }



    public function Create()
    {
        $category = Category::where('delete_status', 1)->get();
        $subcategory = SubCategory::where('delete_status', 1)->get();
        $employee = Employee::where('delete_status', 1)->get();
        return view('backend.expense.create', compact('category', 'subcategory', 'employee'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'employee_id'=>'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'employee_id' => 'required',
            'total_expense' => 'required',
        ]);

        $total = $request->total_expense;
        $paid = $request->paid;
        $due = $request->due;
        if ($due < 0) {
            Toastr::error('Your paid value is not valid', 'Error');
            return back();
        }
        $expense = new Expense();
        $expense->employee_id = $request->employee_id;
        $expense->category_id = $request->category_id;
        $expense->subcategory_id = $request->subcategory_id;
        $expense->total_expense = $request->total_expense;
        $expense->paid = $request->paid;
        $expense->comments = $request->comments;
        $expense->due = $request->due;
        $expense->date = date('m-d-Y');
        $expense->user_id = Auth::user()->id;
        if ($expense->save()) {
            $noteSheetProcess = new NoteSheetProcess();
            $noteSheetProcess->notesheet_id = $expense->id;
            $noteSheetProcess->save();
            foreach ($request->amount as $key => $fdata) {
                $expenseDetails = new ExpenseDetails();
                $expenseDetails->expense = $request->expense[$key];
                $expenseDetails->expense_id = $expense->id;
                $expenseDetails->amount = $request->amount[$key];
                $expenseDetails->date = date('m-d-Y');
                $expenseDetails->save();
            }
        }
        Toastr::success('Sub Expense Created', 'Success');
        return back();
        // return $expense;
    }
    public function edit($id)
    {
        $category = Category::where('delete_status', 1)->get();
        $subcategory = SubCategory::where('delete_status', 1)->get();
        $employee = Employee::where('delete_status', 1)->get();
        $expense = Expense::findOrFail($id);
        $expenseDetails = ExpenseDetails::where('expense_id', $expense->id)->where('delete_status', 1)->get();
        return view('backend.expense.edit', compact('expense', 'expenseDetails', 'category', 'subcategory', 'employee'));
    }
    public function update(Request $request)
    {
        //  return $request;
        //  $this->validate($request,[
        //      'name'=>'required',
        //  ]);
        $expense = Expense::findOrFail($request->id);
        $expense->employee_id = $request->employee_id;
        $expense->category_id = $request->category_id;
        $expense->subcategory_id = $request->subcategory_id;
        $expense->total_expense = $request->total_expense;
        $expense->paid = $request->paid;
        $expense->comments = $request->comments;
        $expense->due = $request->due;
        $expense->date = date('m-d-Y');
        $expense->user_id = Auth::user()->id;
        if ($expense->save()) {
            foreach ($request->amount as $key => $fdata) {
                $exd = ExpenseDetails::where('id', $request->exdetails_id)->first();
                if ($exd) {
                    $expenseDetails = ExpenseDetails::where('id', $request->exdetails_id)->first();
                    $expenseDetails->expense = $request->expense[$key];
                    $expenseDetails->expense_id = $expense->id;
                    $expenseDetails->amount = $request->amount[$key];
                    $expenseDetails->date = date('m-d-Y');
                    $expenseDetails->save();
                } else {
                    $expenseDetails = new ExpenseDetails();
                    $expenseDetails->expense = $request->expense[$key];
                    $expenseDetails->expense_id = $expense->id;
                    $expenseDetails->amount = $request->amount[$key];
                    $expenseDetails->date = date('m-d-Y');
                    $expenseDetails->save();
                }
            }
        }
        Toastr::success('Sub Expense Update', 'Success');
        return back();
    }
    public function SoftDelete($id)
    {
        //  return $id;
        $expense = Expense::findOrFail($id);
        if ($expense->delete_status == 1) {
            $expense->delete_status = 0;
            $exDetails = ExpenseDetails::where('expense_id', $expense->id)->update(array('delete_status' => 0));
        } else {
            $expense->delete_status = 1;
            $exDetails = ExpenseDetails::where('expense_id', $expense->id)->update(array('delete_status' => 1));
        }
        $expense->save();
        Toastr::success('Sub Expense Delete', 'Success');
        return back();
        return response()->json(['success']);
    }
    public function SoftDeleteExDe($id)
    {
        $exDetails = ExpenseDetails::findOrFail($id);
        $exDetails->delete_status = 0;
        $exDetails->save();
        $expense = Expense::findOrFail($exDetails->expense_id);
        $expense->total_expense = $expense->total_expense - $exDetails->amount;
        $expense->due = $expense->due - $exDetails->amount;
        $expense->save();
        Toastr::success('Sub Expense Details Delete Successful', 'Success');
        return back();
    }
    public function acceptExpense(Request $request, $id)
    {

        $expense = Expense::findOrFail($id);
        $authID = Auth::user();

        $noteSheetProcess = NoteSheetProcess::where('notesheet_id', $id)->first();

        if ($authID->role_id == 3) {
            $noteSheetProcess->managing_director_status = 1;
        } else if ($authID->role_id == 4) {
            $noteSheetProcess->director_finance_status = 1;
        } else if ($authID->role_id == 2) {
            $noteSheetProcess->chairmen_status = 1;
            $noteSheetProcess->clearence_status = 1;
            $expense->status = 1;
            $expense->save();
        } else {
            Toastr::error('You request canceled', 'error');
            return back();
        }

        $noteSheetProcess->save();
        $noteSheetComments = new NoteSheetProcessComment();
        $noteSheetComments->admin_id = Auth::user()->id;
        $noteSheetComments->notesheet_id = $id;
        $noteSheetComments->comments = $request->comments;
        $noteSheetComments->save();
        Toastr::success('You request accepted', 'Success');
        return back();
    }
    public function cancelExpense(Request $request, $id)
    {
        $expense = Expense::findOrFail($id);
        $noteSheetProcess = NoteSheetProcess::where('notesheet_id', $id)->first();
        $noteSheetProcess->clearence_status = 1;
        $expense->status = 0;
        $expense->save();
        $noteSheetProcess->save();
        $noteSheetComments = new NoteSheetProcessComment();
        $noteSheetComments->admin_id = Auth::user()->id;
        $noteSheetComments->notesheet_id = $id;
        $noteSheetComments->comments = $request->comments;
        $noteSheetComments->save();
        Toastr::error('Expanse canceled', 'error');
        return back();
    }
    public function printExpanse($id)
    {
        return view('backend.invoice.expanseINvoice');
    }
}
