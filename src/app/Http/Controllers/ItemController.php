<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
      $query = Item::query();

      if (Auth::check()) {
        $query->where('user_id', '!=', Auth::id());
      }

      $items = $query->get();

      return view('items.index', compact('items'));
    }
}
