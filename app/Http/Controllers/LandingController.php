<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Barang;

class LandingController extends Controller
{
    public function showLanding()
    {
        $barangs = Barang::where('stok', '>', 0)->get();
        $users = User::all();
        return view('landing', compact('barangs', 'users'));
    }
}
