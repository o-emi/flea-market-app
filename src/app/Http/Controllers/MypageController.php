<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Storage;


class MypageController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $page = $request->query('page', 'sell');

        $sellItems = Item::where('user_id', $user->id)->get();

        $purchasedItems = $user->purchasedItems()->get();

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
        $user = auth()->user();

        if ($request->hasFile('profile_image')) {

            if ($user->profile_image_path) {
                Storage::disk('public')->delete($user->profile_image_path);
            }

            $path = $request->file('profile_image')->store(
                'profiles',
                'public'
            );

            $user->profile_image = $path;
        }

        $user->update([
            'name'          => $request->name,
            'postal_code'   => $request->postal_code,
            'address'       => $request->address,
            'building_name' => $request->building_name,
        ]);

        return redirect()
            ->route('mypage.index')
            ->with('success', 'プロフィールを更新しました');
    }

}