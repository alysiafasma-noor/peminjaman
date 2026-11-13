<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    public const STATUS_MENUNGGU = 'menunggu';
    public const STATUS_DISETUJUI = 'disetujui';
    public const STATUS_SEDANG_DIPINJAM = 'sedang_dipinjam';
    public const STATUS_SUDAH_DIKEMBALIKAN = 'sudah_dikembalikan';
    public const STATUS_DITOLAK = 'ditolak';

    protected $fillable = [
        'id_alat',
        'id_kategori',
        'id_user',
        'jumlah_pinjam',
        'alasan_peminjaman',
        'tanggal_dipinjam',
        'tanggal_dikembalikan',
        'status',
        'pesan',
    ];

    public function Alat()
    {
        return $this->belongsTo(Alat::class, 'id_alat','id');
    }
    public function Kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori','id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'id_user','id');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_DISETUJUI, self::STATUS_SEDANG_DIPINJAM => 'Sedang Dipinjam',
            self::STATUS_SUDAH_DIKEMBALIKAN => 'Sudah Dikembalikan',
            self::STATUS_DITOLAK => 'Ditolak',
            default => 'Menunggu',
        };
    }
}
