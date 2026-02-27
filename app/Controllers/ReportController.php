<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ReportController extends BaseController
{
    public function __construct()
    {
        $this->checkLogin();
    }

    public function stock()
    {
        $db = \Config\Database::connect();

        $data = $db->query("
            SELECT 
                items.kode_barang,
                items.nama_barang,
                locations.name AS lokasi,
                stocks.qty
            FROM stocks
            JOIN items ON items.id = stocks.item_id
            JOIN locations ON locations.id = stocks.location_id
            ORDER BY items.nama_barang
        ")->getResultArray();

        $export = $this->request->getGet('export');

        if ($export == 'pdf') {
            return $this->exportStockPDF($data);
        }

        return view('reports/stock', ['data' => $data]);
    }
    public function mutation()
    {
        $from = $this->request->getGet('from');
        $to   = $this->request->getGet('to');
        $export = $this->request->getGet('export');

        $db = \Config\Database::connect();

        $builder = $db->table('stock_transfers st')
            ->select('
                st.tanggal,
                lf.name as dari,
                lt.name as ke,
                i.nama_barang,
                d.qty
            ')
            ->join('stock_transfer_details d', 'd.transfer_id = st.id')
            ->join('items i', 'i.id = d.item_id')
            ->join('locations lf', 'lf.id = st.from_location_id')
            ->join('locations lt', 'lt.id = st.to_location_id');

        if ($from && $to) {
            $builder->where('DATE(st.tanggal) >=', $from);
            $builder->where('DATE(st.tanggal) <=', $to);
        }

        $data = $builder->orderBy('st.tanggal', 'DESC')->get()->getResultArray();

        if ($export == 'excel') {
            return $this->exportExcel($data);
        }

        if ($export == 'pdf') {
            return $this->exportPDF($data);
        }

        return view('reports/mutation', ['data' => $data]);
    }
    private function exportExcel($data)
    {
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=laporan_mutasi.xls");

        echo "Tanggal\tDari\tKe\tItem\tQty\n";

        foreach ($data as $row) {
            echo "{$row['tanggal']}\t{$row['dari']}\t{$row['ke']}\t{$row['nama_barang']}\t{$row['qty']}\n";
        }

        exit;
    }
    private function exportPDF($data)
    {
        $dompdf = new \Dompdf\Dompdf();

        $html = view('reports/pdf_mutation', ['data' => $data]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $dompdf->stream("laporan_mutasi.pdf", ["Attachment" => true]);
    }
    public function stockIn()
    {
        $db = \Config\Database::connect();

        $data = $db->query("
            SELECT 
                si.tanggal,
                si.supplier,
                l.name AS lokasi,
                i.nama_barang,
                d.qty
            FROM stock_ins si
            JOIN stock_in_details d ON d.stock_in_id = si.id
            JOIN items i ON i.id = d.item_id
            JOIN locations l ON l.id = si.location_id
            ORDER BY si.tanggal DESC
        ")->getResultArray();

        $export = $this->request->getGet('export');

        if ($export == 'pdf') {
            return $this->exportStockInPDF($data);
        }
        return view('reports/stockin', ['data' => $data]);
    }
    public function stockCard()
    {
        $itemId = $this->request->getGet('item');

        if (!$itemId) {
            return "Pilih item dulu.";
        }

        $db = \Config\Database::connect();

        $data = $db->query("
            SELECT 
                tanggal,
                masuk,
                keluar
            FROM (
                SELECT 
                    si.tanggal,
                    d.qty as masuk,
                    0 as keluar
                FROM stock_ins si
                JOIN stock_in_details d ON d.stock_in_id = si.id
                WHERE d.item_id = $itemId

                UNION ALL

                SELECT 
                    st.tanggal,
                    0 as masuk,
                    d.qty as keluar
                FROM stock_transfers st
                JOIN stock_transfer_details d ON d.transfer_id = st.id
                WHERE d.item_id = $itemId
            ) as movements
            ORDER BY tanggal ASC
        ")->getResultArray();

        $export = $this->request->getGet('export');

        if ($export == 'pdf') {
            return $this->exportStockCardPDF($data);
        }

        return view('reports/stockcard', ['data' => $data]);
    }
    private function exportStockPDF($data)
    {
        $dompdf = new \Dompdf\Dompdf();

        $html = view('reports/pdf_stock', ['data' => $data]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $dompdf->stream("laporan_posisi_stok.pdf", ["Attachment" => true]);
    }
    private function exportStockInPDF($data)
    {
        $dompdf = new \Dompdf\Dompdf();

        $html = view('reports/pdf_stockin', ['data' => $data]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $dompdf->stream("laporan_penerimaan.pdf", ["Attachment" => true]);
    }
    private function exportStockCardPDF($data)
    {
        $dompdf = new \Dompdf\Dompdf();

        $html = view('reports/pdf_stockcard', ['data' => $data]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("kartu_stok.pdf", ["Attachment" => true]);
    }
}
