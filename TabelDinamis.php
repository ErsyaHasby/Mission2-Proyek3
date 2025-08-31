<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class TabelDinamis extends Controller
{
    public function index()
    {
        $data_mahasiswa = [
            ['nim' => '072', 'nama' => 'Ersya', 'jurusan' => 'Teknik Informatika'],
            ['nim' => '082', 'nama' => 'Gema', 'jurusan' => 'Teknik Informatika'],
            ['nim' => '099', 'nama' => 'Bohan', 'jurusan' => 'Teknik Informatika'],
        ];

        $tabel = '
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                    </tr>
                </thead>
                <tbody>
        ';

        foreach ($data_mahasiswa as $mahasiswa) {
            $tabel .= '
                <tr>
                    <td>' . $mahasiswa['nim'] . '</td>
                    <td>' . $mahasiswa['nama'] . '</td>
                    <td>' . $mahasiswa['jurusan'] . '</td>
                </tr>
            ';
        }

        $tabel .= '
                </tbody>
            </table>
        ';

        return $tabel;
    }
}