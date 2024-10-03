<?php

namespace App\Http\Controllers;

use App\Models\detail_absenModel;
use App\Models\presensiModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class absensiController extends Controller
{
    public function tambah(Request $request)
    {

        // dd($request->all());
        $halo = [
            'id_siswa' => 'required',
            'tanggal' => 'required',
            'jam_masuk' => 'required',
            'keterangan' => 'required',
        ];

        $validasi = Validator::make($request->all(), $halo);

        // Jika validasi gagal
        if ($validasi->fails()) {
            return redirect()->route('admin_absensi')->with(Session::flash('kosong_tambah', true));
        }
        if (presensiModel::where('id_siswa', $request->id_siswa)
            ->where('tanggal', now()->toDateString())
            ->exists()
        ) {
            // Jika data presensi dengan id_siswa yang sama dan tanggal hari ini sudah ada
            return redirect()->route('admin_absensi')->with(Session::flash('sudah_ada', 'Data presensi untuk hari ini sudah ada.'));
        } else if (!empty($request->id_guru) && !empty($request->id_mapel)) {
            $detail = detail_absenModel::create([
                'id_guru' => $request->id_guru,
                'id_mapel' => $request->id_mapel,
                'keterangan' => $request->keterangan,
            ]);
        } else {
            $absensi = presensiModel::create([
                'id_siswa' => $request->id_siswa,
                'tanggal' => now()->toDateString(),
                'jam_masuk' => $request->jam_masuk,
                'jam_keluar' => $request->jam_keluar,
                'keterangan' => $request->keterangan,
                'id_detail' => $request->id_detail,
            ]);
            if ($absensi) {
                return redirect()->route('admin_absensi')->with(Session::flash('berhasil_tambah', true));
            }
        }
    }
    public function edit(Request $request, $id)
    {
        // Mencari absensi berdasarkan ID atau gagal jika tidak ditemukan
        $absensi = presensiModel::findOrFail($id);

        // Mendapatkan waktu saat ini dalam zona waktu Asia/Jakarta
        $currentTime = Carbon::now('Asia/Jakarta');

        // Mengatur jam keluar dengan waktu saat ini (jam:menit:detik)
        $absensi->jam_keluar = $currentTime->format('H:i:s'); // Format 'jam:menit:detik'

        // Menyimpan perubahan ke database
        $absensi->save();

        // Mengalihkan ke route 'admin_absensi' dengan pesan berhasil
        return redirect()->route('admin_absensi')->with('berhasil_edit', true);
    }
    public function hapus(Request $request, $id)
    {
        $absensi = presensiModel::findorFAil($id);

        $absensi->delete();

        return redirect()->route('admin_absensi')->with(Session::flash('berhasil_hapus', true));
    }

    public function exportExcelToday()
    {
        $presensi = presensiModel::whereDate('tanggal', now()->toDateString())->get();

        return $this->generateExcel($presensi, 'Presensi_Hari_Ini.xlsx');
    }

    // Export presensi bulan ini ke Excel
    public function exportExcelThisMonth()
    {
        $presensi = presensiModel::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->get();

        return $this->generateExcel($presensi, 'Presensi_Bulan_Ini.xlsx');
    }

    // Export presensi tahun ini ke Excel
    public function exportExcelThisYear()
    {
        $presensi = presensiModel::whereYear('tanggal', now()->year)->get();

        return $this->generateExcel($presensi, 'Presensi_Tahun_Ini.xlsx');
    }

    // Export presensi berdasarkan rentang bulan-tahun
    public function exportExcelMonthRange($startMonth, $startYear, $endMonth, $endYear)
    {
        $start = "$startYear-$startMonth-01";
        $end = "$endYear-$endMonth-31";

        $presensi = presensiModel::whereBetween('tanggal', [$start, $end])->get();

        return $this->generateExcel($presensi, "Presensi_{$startMonth}_{$startYear}_to_{$endMonth}_{$endYear}.xlsx");
    }

    // Fungsi untuk generate Excel
    private function generateExcel($presensi, $filename)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header kolom
        $sheet->setCellValue('A1', 'ID Siswa');
        $sheet->setCellValue('B1', 'Tanggal');
        $sheet->setCellValue('C1', 'Jam Masuk');
        $sheet->setCellValue('D1', 'Jam Keluar');
        $sheet->setCellValue('E1', 'Keterangan');

        // Memasukkan data presensi
        $row = 2;
        foreach ($presensi as $data) {
            $sheet->setCellValue("A{$row}", $data->id_siswa);
            $sheet->setCellValue("B{$row}", $data->tanggal);
            $sheet->setCellValue("C{$row}", $data->jam_masuk);
            $sheet->setCellValue("D{$row}", $data->jam_keluar);
            $sheet->setCellValue("E{$row}", $data->keterangan);
            $row++;
        }

        // Mengenerate file Excel
        $writer = new Xlsx($spreadsheet);
        $filePath = public_path($filename);
        $writer->save($filePath);

        // Download file
        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function exportPdfToday()
    {
        $presensi = presensiModel::whereDate('tanggal', now()->toDateString())->get();

        return $this->generatePdf($presensi, 'Presensi_Hari_Ini.pdf');
    }

    // Export presensi bulan ini ke PDF
    public function exportPdfThisMonth()
    {
        $presensi = presensiModel::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->get();

        return $this->generatePdf($presensi, 'Presensi_Bulan_Ini.pdf');
    }

    // Export presensi tahun ini ke PDF
    public function exportPdfThisYear()
    {
        $presensi = presensiModel::whereYear('tanggal', now()->year)->get();

        return $this->generatePdf($presensi, 'Presensi_Tahun_Ini.pdf');
    }

    // Export presensi berdasarkan rentang bulan-tahun
    public function exportPdfMonthRange($startMonth, $startYear, $endMonth, $endYear)
    {
        $start = "$startYear-$startMonth-01";
        $end = "$endYear-$endMonth-31";

        $presensi = presensiModel::whereBetween('tanggal', [$start, $end])->get();

        return $this->generatePdf($presensi, "Presensi_{$startMonth}_{$startYear}_to_{$endMonth}_{$endYear}.pdf");
    }

    // Fungsi untuk generate PDF
    private function generatePdf($presensi, $filename)
    {
        $pdf = Pdf::loadView('user.pdf', compact('presensi'));
        return $pdf->download($filename);
    }
}
