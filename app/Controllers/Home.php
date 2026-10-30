<?php

namespace App\Controllers;

use App\Models\SiswaModel;

class Home extends BaseController
{
    public function index()
    {
        $siswaModel = new SiswaModel();
        
        // Mengambil data dengan pagination (7 data per halaman)
        $data['siswa'] = $siswaModel->paginate(7);
        $data['pager'] = $siswaModel->pager;
        
        return view('siswa_views', $data);
    }

    public function tambah()
    {
        $siswaModel = new SiswaModel();
        
        $siswaModel->save([
            'nis'   => $this->request->getPost('nis'),
            'nama'  => $this->request->getPost('nama'),
            'kelas' => $this->request->getPost('kelas'),
        ]);
        
        return redirect()->to(base_url());
    }

    public function edit($id)
    {
        $siswaModel = new SiswaModel();

        $siswaModel->update($id, [
            'nis'   => $this->request->getPost('nis'),
            'nama'  => $this->request->getPost('nama'),
            'kelas' => $this->request->getPost('kelas'),
        ]);

        return redirect()->to(base_url());
    }

    public function hapus($id)
    {
        $siswaModel = new SiswaModel();
        $siswaModel->delete($id);
        
        return redirect()->to(base_url());
    }

    // Fungsi untuk Hapus Massal (Bulk Delete berdasarkan checkbox yang dicentang)
    public function hapus_semua()
    {
        $siswaModel = new SiswaModel();
        $idSiswa = $this->request->getPost('id_siswa');

        if (!empty($idSiswa)) {
            foreach ($idSiswa as $id) {
                $siswaModel->delete($id);
            }
        }

        return redirect()->to(base_url());
    }
}