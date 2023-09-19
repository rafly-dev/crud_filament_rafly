<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = ['transId', 'nama pelanggan', 'jenis barang', 'harga satuan', 'jumlah', 'total'];
}
