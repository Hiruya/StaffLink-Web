<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $fillable = [
        'user_id', 'tanggal', 'waktu_masuk', 'waktu_keluar', 'waktu_kerja', 'keterangan', 'tipe'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Fungsi untuk ambil data rekap per user per tanggal (satu baris)
     */
    public static function getRekapHarian()
{
    $data = self::with('user')->get();

    return $data->groupBy(function ($item) {
            return $item->user_id . '|' . $item->tanggal;
        })
        ->map(function ($group) {
            $first = $group->first();
            $user = $first->user;

            $waktu_masuk = $group->whereNotNull('waktu_masuk')->min('waktu_masuk');
            $waktu_keluar = $group->whereNotNull('waktu_keluar')->max('waktu_keluar');

            if ($waktu_masuk && $waktu_keluar) {
                $masuk = \Carbon\Carbon::parse($waktu_masuk);
                $keluar = \Carbon\Carbon::parse($waktu_keluar);
                $waktu_kerja = $masuk->diff($keluar)->format('%H:%I:%S');
            } else {
                $waktu_kerja = '-';
            }

            return (object)[
                'user_id' => $first->user_id,
                'nama' => $user->name ?? '-',
                'tanggal' => $first->tanggal,
                'waktu_masuk' => $waktu_masuk,
                'waktu_keluar' => $waktu_keluar,
                'waktu_kerja' => $waktu_kerja,
            ];
        })->values(); // reset index jadi array biasa
}
}
