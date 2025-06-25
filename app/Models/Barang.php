<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['nama_barang', 'stok']; // Make sure you have all the fields that need to be mass-assigned

    // Laravel will automatically handle 'created_at' and 'updated_at' if they are present in the table
}

