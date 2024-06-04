<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function getDashboard(Request $request) {
        $getUserId = Auth::id();
        $getNote = Note::where('user_id', $getUserId)->get();
        $getIncome = Note::where('user_id', $getUserId)->where('type', 'income')->sum('amount');
        $getSpending = Note::where('user_id', $getUserId)->where('type', 'spending')->sum('amount');
        $getAmount = $getIncome - $getSpending;

        return view('home', [ 'notes' => $getNote, 'income' => $getIncome, 'spending' => $getSpending, 'amount' => $getAmount ]);
    }

    public function getUpdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $getNote = Note::where('id', $validate['id'])->get()->first();
        if (!$getNote || !($getNote->user_id == Auth::id())) return redirect('/')->withErrors([ 'error' => "You don't have permission!" ]);

        return view('update', [ 'note' => $getNote ]);
    }

    public function addData(Request $request) {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:income,spending',
            'date' => 'required|date',
            'amount' => 'required|integer',
            'note' => 'required'
        ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        Note::create([
            'user_id' => Auth::id(),
            'amount' => $validate['amount'],
            'note' => $validate['note'],
            'date' => $validate['date'],
            'type' => $validate['type']
        ]);

        return redirect('/')->with('success', 'Note added successfully!');
    }

    public function updateData(Request $request) {
        $validator = Validator::make($request->all(), [
            'noteid' => 'required|integer',
            'type' => 'required|in:income,spending',
            'date' => 'required|date',
            'amount' => 'required|integer',
            'note' => 'required'
        ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $getNote = Note::where('id', $validate['noteid'])->get()->first();
        if ($getNote->user_id !== Auth::id()) return redirect('/')->withErrors([ 'error' => "You don't have permission!" ]);

        $getNote->update([
            'type' => $validate['type'],
            'date' => $validate['date'],
            'amount' => $validate['amount'],
            'note' => $validate['note'],
        ]);

        return redirect('/')->with('success', 'Note updated successfully!');
    }

    public function deleteData(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $getNote = Note::where('id', $validate['id']);
        if ($getNote->get()->first()->user_id !== Auth::id()) return redirect('/')->withErrors([ 'error' => "You don't have permission!" ]);

        $getNote->delete();
        return redirect('/')->with('success', 'Note deleted successfully!');
    }
}
