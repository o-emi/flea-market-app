<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class MypageController extends Controller
{
    public function index()
    {
        return view('mypage.index');
    }

    public function edit()
    {
        return view('mypage.profile');
    }

    public function update(Request $request)
    {
        auth()->user()->update(
            $request->only([
                'name',
                'postal_code',
                'address',
                'building_name',
            ])
        );

      return redirect()->route('items.index');
    }
}