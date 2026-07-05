<?php

namespace Tests\Feature;

use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_dosen_registration_saves_jurusan(): void
    {
        $response = $this->post('/register', [
            'role' => 'dosen',
            'fullname' => 'Dosen Test',
            'nip' => '1987654321',
            'nidn' => '0987654321',
            'pendidikan_terakhir' => 'S2',
            'jurusan_id' => 'Informatika',
            'tempat_lahir_dosen' => 'Jakarta',
            'tanggal_lahir_dosen' => '1990-01-01',
            'alamat_dosen' => 'Jl. Test',
        ]);

        $response->assertRedirect('/login');
        $this->assertGuestSession();
        $this->assertDatabaseHas('table_dosen', [
            'Fullname' => 'Dosen Test',
            'Jurusan_id' => 'Informatika',
        ]);
    }

    public function test_kelas_create_shows_dosen_names(): void
    {
        Dosen::create([
            'Fullname' => 'Budi Santoso',
            'NIP' => '197001011234',
            'NIDN' => '0011223344',
            'Pendidikan_Terakhir' => 'S2',
            'Jurusan_id' => 'Informatika',
            'Tempat_Lahir' => 'Jakarta',
            'Tanggal_Lahir' => '1970-01-01',
            'Alamat' => 'Jl. Dosen',
        ]);

        MataKuliah::create([
            'Jurusan_Id' => 1,
            'Kode_Mata_Kuliah' => 'IF101',
            'Nama_Mata_Kuliah' => 'Pemrograman Dasar',
            'SKS' => 3,
            'Dosen_Id' => 1,
        ]);

        $response = $this
            ->withSession(['user' => ['id' => 1, 'role' => 'dosen', 'name' => 'Budi Santoso']])
            ->get('/kelas-create');

        $response->assertOk();
        $response->assertSee('Budi Santoso');
        $response->assertSee('Dashboard');
    }

    public function test_dashboard_and_kelas_index_are_user_friendly(): void
    {
        $dosen = Dosen::create([
            'Fullname' => 'Siti Aminah',
            'NIP' => '197001019999',
            'NIDN' => '0099887766',
            'Pendidikan_Terakhir' => 'S2',
            'Jurusan_id' => 'Sistem Informasi',
            'Tempat_Lahir' => 'Bandung',
            'Tanggal_Lahir' => '1972-02-02',
            'Alamat' => 'Jl. Dosen Dua',
        ]);

        $mataKuliah = MataKuliah::create([
            'Jurusan_Id' => 1,
            'Kode_Mata_Kuliah' => 'SI201',
            'Nama_Mata_Kuliah' => 'Basis Data',
            'SKS' => 3,
            'Dosen_Id' => $dosen->id,
        ]);

        Kelas::create([
            'kode_kelas' => 'SI201-A',
            'kode_mata_kuliah' => $mataKuliah->id,
            'kode_dosen' => $dosen->id,
            'hari' => 'senin',
            'jam' => '08:00 - 09:40',
            'tahun_ajaran' => '2026/2027',
            'ruang_kelas' => 'R101',
            'jumlah_max' => 30,
            'semester' => 'ganjil',
        ]);

        $session = ['user' => ['id' => $dosen->id, 'role' => 'dosen', 'name' => 'Siti Aminah']];

        $this->withSession($session)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Sistem Informasi Akademik')
            ->assertSee('Tambah Kelas');

        $this->withSession($session)
            ->get('/kelas')
            ->assertOk()
            ->assertSee('Siti Aminah')
            ->assertSee('Basis Data')
            ->assertSee('Dashboard');
    }

    public function test_mata_kuliah_pages_show_related_names(): void
    {
        $dosen = Dosen::create([
            'Fullname' => 'Rina Wijaya',
            'NIP' => '198001011111',
            'NIDN' => '0011002200',
            'Pendidikan_Terakhir' => 'S3',
            'Jurusan_id' => 'Informatika',
            'Tempat_Lahir' => 'Medan',
            'Tanggal_Lahir' => '1980-01-01',
            'Alamat' => 'Jl. Akademik',
        ]);

        $jurusan = Jurusan::create([
            'Kode_Jurusan' => 'IF',
            'Nama_Jurusan' => 'Informatika',
        ]);

        MataKuliah::create([
            'Jurusan_Id' => $jurusan->id,
            'Kode_Mata_Kuliah' => 'IF301',
            'Nama_Mata_Kuliah' => 'Rekayasa Perangkat Lunak',
            'SKS' => 3,
            'Dosen_Id' => $dosen->id,
        ]);

        $session = ['user' => ['id' => $dosen->id, 'role' => 'dosen', 'name' => 'Rina Wijaya']];

        $this->withSession($session)
            ->get('/matakuliah-create')
            ->assertOk()
            ->assertSee('Rina Wijaya')
            ->assertSee('Informatika')
            ->assertSee('Dashboard');

        $this->withSession($session)
            ->get('/matakuliah')
            ->assertOk()
            ->assertSee('Rina Wijaya')
            ->assertSee('Informatika')
            ->assertSee('Rekayasa Perangkat Lunak');
    }

    public function test_main_data_lists_have_dashboard_navigation(): void
    {
        $dosen = Dosen::create([
            'Fullname' => 'Ari Pratama',
            'NIP' => '198501012222',
            'NIDN' => '0022334455',
            'Pendidikan_Terakhir' => 'S2',
            'Jurusan_id' => 'Informatika',
            'Tempat_Lahir' => 'Bogor',
            'Tanggal_Lahir' => '1985-01-01',
            'Alamat' => 'Jl. Dosen Tiga',
        ]);

        Mahasiswa::create([
            'nama' => 'Nadia Putri',
            'nim' => 'M001',
            'nisn' => 'N001',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2004-01-01',
            'alamat' => 'Jl. Mahasiswa',
        ]);

        $jurusan = Jurusan::create([
            'Kode_Jurusan' => 'TI',
            'Nama_Jurusan' => 'Teknik Informatika',
        ]);

        MataKuliah::create([
            'Jurusan_Id' => $jurusan->id,
            'Kode_Mata_Kuliah' => 'TI101',
            'Nama_Mata_Kuliah' => 'Algoritma',
            'SKS' => 3,
            'Dosen_Id' => $dosen->id,
        ]);

        $session = ['user' => ['id' => $dosen->id, 'role' => 'dosen', 'name' => 'Ari Pratama']];

        $this->withSession($session)
            ->get('/dosen')
            ->assertOk()
            ->assertSee('Data Dosen')
            ->assertSee('Dashboard')
            ->assertSee('Tambah Dosen');

        $this->withSession($session)
            ->get('/mahasiswa')
            ->assertOk()
            ->assertSee('Data Mahasiswa')
            ->assertSee('Dashboard')
            ->assertSee('Tambah Mahasiswa');

        $this->withSession($session)
            ->get('/matakuliah')
            ->assertOk()
            ->assertSee('Data Mata Kuliah')
            ->assertSee('Dashboard')
            ->assertSee('Tambah Mata Kuliah')
            ->assertSee('Ari Pratama')
            ->assertSee('Teknik Informatika');
    }

    private function assertGuestSession(): void
    {
        $this->assertFalse(session()->has('user'));
    }
}
