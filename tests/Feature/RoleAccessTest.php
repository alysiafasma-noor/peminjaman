<?php

namespace Tests\Feature;

use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_user_management(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
        ]);

        $response = $this->actingAs($admin)->get('/user');

        $response->assertOk();
    }

    public function test_peminjam_cannot_access_user_management(): void
    {
        $peminjam = User::factory()->create([
            'role' => User::ROLE_PEMINJAM,
        ]);

        $response = $this->actingAs($peminjam)->get('/user');

        $response->assertForbidden();
    }

    public function test_petugas_can_access_approval_but_not_user_management(): void
    {
        $petugas = User::factory()->create([
            'role' => User::ROLE_PETUGAS,
        ]);

        $response = $this->actingAs($petugas)->get('/approval');
        $response->assertOk();

        $blocked = $this->actingAs($petugas)->get('/user');
        $blocked->assertForbidden();
    }

    public function test_peminjam_can_access_loan_form_but_not_crud_pages(): void
    {
        $peminjam = User::factory()->create([
            'role' => User::ROLE_PEMINJAM,
        ]);

        $allowed = $this->actingAs($peminjam)->get('/alat/lihat');
        $allowed->assertOk();

        $blocked = $this->actingAs($peminjam)->get('/kategori');
        $blocked->assertForbidden();
    }

    public function test_admin_can_access_loan_submission_page(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
        ]);

        $response = $this->actingAs($admin)->get('/peminjaman/ajukan');

        $response->assertOk();
    }

    public function test_petugas_can_access_return_monitoring_but_peminjam_cannot(): void
    {
        $petugas = User::factory()->create([
            'role' => User::ROLE_PETUGAS,
        ]);

        $petugasAccess = $this->actingAs($petugas)->get('/pengembalian');
        $petugasAccess->assertOk();

        $peminjam = User::factory()->create([
            'role' => User::ROLE_PEMINJAM,
        ]);

        $peminjamAccess = $this->actingAs($peminjam)->get('/pengembalian');
        $peminjamAccess->assertForbidden();
    }

    public function test_petugas_can_mark_item_as_returned_and_peminjam_cannot(): void
    {
        $peminjam = User::factory()->create([
            'role' => User::ROLE_PEMINJAM,
        ]);

        $petugas = User::factory()->create([
            'role' => User::ROLE_PETUGAS,
        ]);

        $peminjaman = Peminjaman::create([
            'id_user' => $peminjam->id,
            'id_alat' => 1,
            'id_kategori' => 1,
            'tanggal_dipinjam' => now()->toDateString(),
            'tanggal_dikembalikan' => null,
            'status' => 'sedang_dipinjam',
        ]);

        $forbidden = $this->actingAs($peminjam)->post("/pengembalian/{$peminjaman->id}/kembalikan");
        $forbidden->assertForbidden();

        $allowed = $this->actingAs($petugas)->post("/pengembalian/{$peminjaman->id}/kembalikan");
        $allowed->assertRedirect('/pengembalian');

        $peminjaman->refresh();
        $this->assertSame('sudah_dikembalikan', $peminjaman->status);
        $this->assertNotNull($peminjaman->tanggal_dikembalikan);
    }

    public function test_pengajuan_peminjaman_disimpan_sebagai_menunggu_dan_terisi_otomatis_berdasarkan_user_login(): void
    {
        $kategori = Kategori::create(['nama_kategori' => 'Elektronik']);
        $alat = Alat::create([
            'nama_alat' => 'Laptop',
            'id_kategori' => $kategori->id,
            'stok' => 5,
        ]);

        $peminjam = User::factory()->create([
            'role' => User::ROLE_PEMINJAM,
        ]);

        $response = $this->actingAs($peminjam)->post('/peminjaman/ajukan', [
            'id_alat' => $alat->id,
            'tanggal_dipinjam' => now()->addDay()->toDateString(),
            'jumlah_pinjam' => 2,
            'alasan_peminjaman' => 'Untuk kegiatan praktik',
        ]);

        $response->assertRedirect('/pengembalian/saya');

        $this->assertDatabaseHas('peminjamen', [
            'id_user' => $peminjam->id,
            'id_alat' => $alat->id,
            'id_kategori' => $kategori->id,
            'jumlah_pinjam' => 2,
            'alasan_peminjaman' => 'Untuk kegiatan praktik',
            'status' => 'menunggu',
        ]);
    }

    public function test_admin_dapat_menolak_pengajuan_dengan_pesan_alasan(): void
    {
        $kategori = Kategori::create(['nama_kategori' => 'Laboratorium']);
        $alat = Alat::create([
            'nama_alat' => 'Proyektor',
            'id_kategori' => $kategori->id,
            'stok' => 2,
        ]);

        $peminjam = User::factory()->create([
            'role' => User::ROLE_PEMINJAM,
        ]);

        $peminjaman = Peminjaman::create([
            'id_user' => $peminjam->id,
            'id_alat' => $alat->id,
            'id_kategori' => $kategori->id,
            'tanggal_dipinjam' => now()->addDay()->toDateString(),
            'jumlah_pinjam' => 1,
            'alasan_peminjaman' => 'Butuh untuk presentasi',
            'status' => 'menunggu',
        ]);

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
        ]);

        $response = $this->actingAs($admin)->post("/approval/{$peminjaman->id}/reject", [
            'pesan' => 'Stok alat sedang habis untuk hari ini.',
        ]);

        $response->assertRedirect('/approval');

        $peminjaman->refresh();
        $this->assertSame('ditolak', $peminjaman->status);
        $this->assertSame('Stok alat sedang habis untuk hari ini.', $peminjaman->pesan);
    }
}
