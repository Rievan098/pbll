<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowedItem;

class BorrowController extends Controller
{
    public function returnItem($id)
    {
        $item = BorrowedItem::find($id);
        if ($item) {
            $item->status = 'dikembalikan';
            $item->returned_at = now();
            $item->save();
        }
        return redirect()->back()->with('success', 'Barang berhasil dikembalikan.');
    }
}
