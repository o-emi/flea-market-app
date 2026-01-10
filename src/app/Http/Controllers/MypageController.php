<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\Item;

class MypageController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $purchasedItems = Item::whereHas('purchases', function ($query) use ($user) {
        $query->where('user_id', $user->id);
        })->get();

        return view('mypage.index', compact('purchasedItems'));
    }

    public function edit()
    {
        return view('mypage.profile');
    }

    public function update(ProfileRequest $request)
    {

        auth()->user()->update(
            $request->only([
                'name',
                'postal_code',
                'address',
                'building_name',
            ])
        );

      return redirect()->route('mypage.index');
    }
}