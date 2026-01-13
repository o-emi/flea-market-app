<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;


class MypageController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $page = $request->query('page', 'sell');

        $sellItems = Item::where('user_id', $user->id)->get();

        $purchasedItems = $user->purchasedItems;

        return view('mypage.index', compact(
        'user',
        'page',
        'sellItems',
        'purchasedItems'
    ));
}


public function edit()
{
    $user = auth()->user();

    return view('mypage.profile', compact('user'));
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