<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $items = [
            // Bahan Minuman
            ['kode_barang' => 'BM001', 'nama_barang' => 'Biji Kopi Arabica', 'kategori' => 'Minuman', 'satuan' => 'kg', 'minimum_stock' => 5],
            ['kode_barang' => 'BM002', 'nama_barang' => 'Susu UHT', 'kategori' => 'Minuman', 'satuan' => 'liter', 'minimum_stock' => 10],
            ['kode_barang' => 'BM003', 'nama_barang' => 'Syrup Vanilla', 'kategori' => 'Minuman', 'satuan' => 'botol', 'minimum_stock' => 5],
            ['kode_barang' => 'BM004', 'nama_barang' => 'Syrup Caramel', 'kategori' => 'Minuman', 'satuan' => 'botol', 'minimum_stock' => 5],
            ['kode_barang' => 'BM005', 'nama_barang' => 'Gula Pasir', 'kategori' => 'Minuman', 'satuan' => 'kg', 'minimum_stock' => 10],

            // Bahan Makanan
            ['kode_barang' => 'MK001', 'nama_barang' => 'Tepung Terigu', 'kategori' => 'Makanan', 'satuan' => 'kg', 'minimum_stock' => 10],
            ['kode_barang' => 'MK002', 'nama_barang' => 'Telur Ayam', 'kategori' => 'Makanan', 'satuan' => 'kg', 'minimum_stock' => 5],
            ['kode_barang' => 'MK003', 'nama_barang' => 'Mentega', 'kategori' => 'Makanan', 'satuan' => 'kg', 'minimum_stock' => 3],
            ['kode_barang' => 'MK004', 'nama_barang' => 'Keju Mozzarella', 'kategori' => 'Makanan', 'satuan' => 'kg', 'minimum_stock' => 3],
            ['kode_barang' => 'MK005', 'nama_barang' => 'Daging Sapi', 'kategori' => 'Makanan', 'satuan' => 'kg', 'minimum_stock' => 5],

            // Packaging
            ['kode_barang' => 'PK001', 'nama_barang' => 'Cup 12oz', 'kategori' => 'Packaging', 'satuan' => 'pcs', 'minimum_stock' => 100],
            ['kode_barang' => 'PK002', 'nama_barang' => 'Cup 16oz', 'kategori' => 'Packaging', 'satuan' => 'pcs', 'minimum_stock' => 100],
            ['kode_barang' => 'PK003', 'nama_barang' => 'Tutup Cup', 'kategori' => 'Packaging', 'satuan' => 'pcs', 'minimum_stock' => 100],
            ['kode_barang' => 'PK004', 'nama_barang' => 'Sedotan', 'kategori' => 'Packaging', 'satuan' => 'pcs', 'minimum_stock' => 200],
        ];

        $this->db->table('items')->insertBatch($items);
    }
}