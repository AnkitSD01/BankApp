<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function loadView(Request $request, $action)
    {
        $user = User::with('wallet')->find(Auth::id());
        $data = [];
        if ($action == "home") {
            $data['userData'] = $user;
        } else if ($action == "statement") {
            $user = User::with('wallet')->find(Auth::id());
            $data['statement'] = $user;
        }
        return view('user.' . $action, $data);
    }


    public function deposit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail(Auth::id());
        $user->depositFloat($request->input('amount')/100, ['description' => 'Deposit']);

        Session::flash('success', 'Money deposited successfully!');

        return redirect()->back();
    }


    public function withdraw(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail(Auth::id());

        if ($user->balance < $request->input('amount')) {
            $validator->errors()->add('amount', 'Insufficient balance');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->withdrawFloat($request->input('amount')/100, ['description' => 'Withdraw']);

        Session::flash('success', 'Money withdrawal successful!');

        return redirect()->back();
    }




    public function transfer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $userWallet = $user->wallet;
        if ($userWallet->balance < $request->input('amount')) {
            $validator->errors()->add('amount', 'Insufficient balance');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $recipientWallet = User::where('email', $request->input('email'))->first();

        DB::beginTransaction();

        try {
            $recipientWallet->depositFloat($request->input('amount')/100, ['description' => 'Transfer from ' . $user->email]);

            $userWallet->withdrawFloat($request->input('amount')/100, ['description' => 'Transfer to ' . $request->input('email')]);

            DB::commit();

            Session::flash('success', 'Money transfer successful!');

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();

            Session::flash('error', 'An error occurred during the money transfer. Please try again later.');

            return redirect()->back();
        }
    }
}
