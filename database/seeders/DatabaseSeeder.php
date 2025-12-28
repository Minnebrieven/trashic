<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
Use Exception;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        try {
            $userSeeder = DB::table('users')->where('name', 'Zeta')->get();
            $userSeederID = $userSeeder[0]->id;
            $adminSeederID = DB::table('users')->where('name', 'administrator')->get();
            $adminSeederID = $adminSeederID[0]->id;
            $managerSeederID = DB::table('users')->where('name', 'administrator')->get();
            $managerSeederID = $managerSeederID[0]->id;
            $staffSeederID = DB::table('users')->where('name', 'staff')->get();
            $staffSeederID = $staffSeederID[0]->id;
        }
        catch(Exception $e) {
            $userSeederID = DB::table('users')->insertGetID(['name' => 'Zeta','email' => 'zeta123@gmail.com', 'password' => Hash::make('zeta123'), 'role' => 'pelanggan']);
            $adminSeederID = DB::table('users')->insertGetID(['name' => 'admin','email' => 'admin@gmail.com', 'password' => Hash::make('admin123'), 'role' => 'admin' ]);
            $managerSeederID = DB::table('users')->insertGetID(['name' => 'manager','email' => 'manager@gmail.com', 'password' => Hash::make('manager123'), 'role' => 'manager']);
            $staffSeederID = DB::table('users')->insertGetID(['name' => 'staff','email' => 'staff@gmail.com', 'password' => Hash::make('staff123'), 'role' => 'staff']);
        }

        // try {
        //     $userSeeder = DB::table('users')->where('name', 'Test User')->get();
        //     $userSeederID = $userSeeder[0]->id;
        //     $adminSeederID = DB::table('users')->where('name', 'administrator')->get();
        //     $adminSeederID = $adminSeederID[0]->id;
        //     $managerSeederID = DB::table('users')->where('name', 'administrator')->get();
        //     $managerSeederID = $managerSeederID[0]->id;
        //     $staffSeederID = DB::table('users')->where('name', 'staff')->get();
        //     $staffSeederID = $staffSeederID[0]->id;
        // }
        // catch(Exception $e) {
        //     $userSeederID = DB::table('users')->insertGetID(['name' => 'Test User','email' => 'test@example.com', 'password' => Hash::make('testuser123'), 'role' => 'pelanggan']);
        //     $adminSeederID = DB::table('users')->insertGetID(['name' => 'admin','email' => 'admin@gmail.com', 'password' => Hash::make('admin123'), 'role' => 'admin' ]);
        //     $managerSeederID = DB::table('users')->insertGetID(['name' => 'manager','email' => 'manager@gmail.com', 'password' => Hash::make('manager123'), 'role' => 'manager']);
        //     $staffSeederID = DB::table('users')->insertGetID(['name' => 'staff','email' => 'staff@gmail.com', 'password' => Hash::make('staff123'), 'role' => 'staff']);
        // }

        // Start of Seeding Master Data
        try {
            $jenisSampahOrganik = DB::table('jenis_sampah')->where('nama', 'Organik')->get();
            $jenisSampahOrganikID = $jenisSampahOrganik[0]->id;
        }
        catch(Exception $e) {
            $jenisSampahOrganikID = DB::table('jenis_sampah')->insertGetID(['nama' => 'Organik',]);
        }

        try {
            $jenisSampahNonOrganik = DB::table('jenis_sampah')->where('nama', 'Non Organik')->get();
            $jenisSampahNonOrganikID = $jenisSampahNonOrganik[0]->id;
        }
        catch(Exception $e) {
            $jenisSampahNonOrganikID = DB::table('jenis_sampah')->insertGetID(['nama' => 'Non Organik',]);
        }
        
        try {
            $metodePembayaranCOD = DB::table('metode_pembayaran')->where('nama', 'Cash On Delivery')->get();
            $$metodePembayaranCODID = $metodePembayaranCOD[0]->id;
        }
        catch(Exception $e) {
            $metodePembayaranCODID = DB::table('metode_pembayaran')->insertGetId(['nama' => 'Cash On Delivery',]);
        }
        
        // End of Seeding Master Data

        // Start of Kategori Sampah Seed
        try {
            $kategoriKertas = DB::table('kategori_sampah')->where('nama', 'Kertas')->get();
            $kategoriKertasID = $kategoriKertas[0]->id;
        } catch (Exception $e) {
            $kategoriKertasID = DB::table('kategori_sampah')->insertGetId([
                'nama' => 'Kertas',
                'jenis_sampah_id' => $jenisSampahNonOrganikID,
            ]);
        }

        try {
            $kategoriPlastik = DB::table('kategori_sampah')->where('nama', 'Plastik')->get();
            $kategoriPlastikID = $kategoriPlastik[0]->id;
        } catch (Exception $e) {
            $kategoriPlastikID = DB::table('kategori_sampah')->insertGetId([
                'nama' => 'Plastik',
                'jenis_sampah_id' => $jenisSampahNonOrganikID,
            ]);
        }

        try {
            $kategoriLogam = DB::table('kategori_sampah')->where('nama', 'Logam')->get();
            $kategoriLogamID = $kategoriLogam[0]->id;
        } catch (Exception $e) {
            $kategoriLogamID = DB::table('kategori_sampah')->insertGetId([
                'nama' => 'Logam',
                'jenis_sampah_id' => $jenisSampahNonOrganikID,
            ]);
        }

        try {
            $kategoriPecahBelah = DB::table('kategori_sampah')->where('nama', 'Pecah Belah')->get();
            $kategoriPecahBelahID = $kategoriPecahBelah[0]->id;
        } catch (Exception $e) {
            $kategoriPecahBelahID = DB::table('kategori_sampah')->insertGetId([
                'nama' => 'Pecah Belah',
                'jenis_sampah_id' => $jenisSampahNonOrganikID,
            ]);
        }

        try {
            $kategoriCair = DB::table('kategori_sampah')->where('nama', 'Cair')->get();
            $kategoriCairID = $kategoriCair[0]->id;
        } catch (Exception $e) {
            $kategoriCairID = DB::table('kategori_sampah')->insertGetId([
                'nama' => 'Cair',
                'jenis_sampah_id' => $jenisSampahOrganikID,
            ]);
        }

        try {
            $kategoriLainLainNonOrganik = DB::table('kategori_sampah')->where('nama', 'Lain - Lain Non Organik')->get();
            $kategoriLainLainNonOrganikID = $kategoriLainLainNonOrganik[0]->id;
        } catch (Exception $e) {
            $kategoriLainLainNonOrganikID = DB::table('kategori_sampah')->insertGetId([
                'nama' => 'Lain - Lain Non Organik',
                'jenis_sampah_id' => $jenisSampahNonOrganikID,
            ]);
        }

        // End of Kategori Sampah Seed

        // Start of Sampah Seed
        try {
            $sampahDus = DB::table('sampah')->where('nama', 'Dus')->get();
            $sampahDusID = $sampahDus[0]->id;
        } catch (Exception $e) {
            $sampahDusID = DB::table('sampah')->insertGetId([
                'nama' => 'Dus',
                'kategori_sampah_id' => $kategoriKertasID,
                'satuan' => 'kg',
                'harga' => 1200,
                'score' => 25,
                'coin' => 10
            ]);
        }

        try {
            $sampahKertasPutih = DB::table('sampah')->where('nama', 'Kertas Putih/HVS')->get();
            $sampahKertasPutihID = $sampahKertasPutih[0]->id;
        } catch (Exception $e) {
            $sampahKertasPutihID = DB::table('sampah')->insertGetId([
                'nama' => 'Kertas Putih/HVS',
                'kategori_sampah_id' => $kategoriKertasID,
                'satuan' => 'kg',
                'harga' => 1500,
                'score' => 25,
                'coin' => 10
            ]);
        }

        try {
            $sampahKoranUtuh = DB::table('sampah')->where('nama', 'Kertas Koran Utuh')->get();
            $sampahKoranUtuhID = $sampahKoranUtuh[0]->id;
        } catch (Exception $e) {
            $sampahKoranUtuhID = DB::table('sampah')->insertGetId([
                'nama' => 'Kertas Koran Utuh',
                'kategori_sampah_id' => $kategoriKertasID,
                'satuan' => 'kg',
                'harga' => 2500,
                'score' => 25,
                'coin' => 10
            ]);
        }

        try {
            $sampahDuplekKartonBoncos = DB::table('sampah')->where('nama', 'Duplek/Kartor/Kertas Boncos')->get();
            $sampahDuplekKartonBoncosID = $sampahDuplekKartonBoncos[0]->id;
        } catch (Exception $e) {
            $sampahDuplekKartonBoncosID = DB::table('sampah')->insertGetId([
                'nama' => 'Duplek/Kartor/Kertas Boncos',
                'kategori_sampah_id' => $kategoriKertasID,
                'satuan' => 'kg',
                'harga' => 500,
                'score' => 25,
                'coin' => 10
            ]);
        }

        try {
            $sampahPlastikGelasA = DB::table('sampah')->where('nama', 'Gelas A (Kondisi Bersh)')->get();
            $sampahPlastikGelasAID = $sampahPlastikGelasA[0]->id;
        } catch (Exception $e) {
            $sampahPlastikGelasAID = DB::table('sampah')->insertGetId([
                'nama' => 'Gelas A (Kondisi Bersh)',
                'kategori_sampah_id' => $kategoriPlastikID,
                'satuan' => 'kg',
                'harga' => 3000,
                'score' => 50,
                'coin' => 25
            ]);
        }

        try {
            $sampahKaleng = DB::table('sampah')->where('nama', 'Kaleng')->get();
            $sampahKalengID = $sampahKaleng[0]->id;
        } catch (Exception $e) {
            $sampahKalengID = DB::table('sampah')->insertGetId([
                'nama' => 'Kaleng',
                'kategori_sampah_id' => $kategoriLogamID,
                'satuan' => 'kg',
                'harga' => 1000,
                'score' => 50,
                'coin' => 25
            ]);
        }

        try {
            $sampahBelingBening = DB::table('sampah')->where('nama', 'Botol Beling Bening')->get();
            $sampahBelingBeningID = $sampahBelingBening[0]->id;
        } catch (Exception $e) {
            $sampahBelingBeningID = DB::table('sampah')->insertGetId([
                'nama' => 'Botol Beling Bening',
                'kategori_sampah_id' => $kategoriPecahBelahID,
                'satuan' => 'kg',
                'harga' => 150,
                'score' => 50,
                'coin' => 25
            ]);
        }

        try {
            $sampahMesinCuci = DB::table('sampah')->where('nama', 'Mesin Cuci')->get();
            $sampahMesinCuciID = $sampahMesinCuci[0]->id;
        } catch (Exception $e) {
            $sampahMesinCuciID = DB::table('sampah')->insertGetId([
                'nama' => 'Mesin Cuci',
                'kategori_sampah_id' => $kategoriLainLainNonOrganikID,
                'satuan' => 'Pcs/Satuan',
                'harga' => 25000,
                'score' => 100,
                'coin' => 50
            ]);
        }

        try {
            $sampahMinyakJelantah = DB::table('sampah')->where('nama', 'Minyak Jelantah')->get();
            $sampahMinyakJelantahID = $sampahMinyakJelantah[0]->id;
        } catch (Exception $e) {
            $sampahMinyakJelantahID = DB::table('sampah')->insertGetId([
                'nama' => 'Minyak Jelantah',
                'kategori_sampah_id' => $kategoriCairID,
                'satuan' => 'Pcs/Satuan',
                'harga' => 5500,
            ]);
        }

        // End of Sampah Seed

        // Start of Rekening Seed
        $rekeningID = DB::table('rekening')->insertGetId([
            'user_id' => $userSeederID,
            'nomor_rekening' => '2025030501',
            'saldo' => 0,
            'score' => 0,
            'coin' => 15000
        ]);
        // End of Rekening Seed
        

        // Start of Setoran Seed
        $setoranID = DB::table('setoran')->insertGetId([
            'rekening_id' => $rekeningID,
            'total_harga' => 14000,
            'total_score' => 200,
            'total_coin' => 95
        ]);
        // End of Setoran Seed

        // Start of Detail Setoran Seed
        DB::table('detail_setoran')->insert([
            'setoran_id' => $setoranID,
            'sampah_id' => $sampahKoranUtuhID,
            'jumlah' => 2,
        ]);
        DB::table('detail_setoran')->insert([
            'setoran_id' => $setoranID,
            'sampah_id' => $sampahPlastikGelasAID,
            'jumlah' => 3,
        ]);
        // End of Detail Setoran Seed

        // Start of Setoran Log Transaksi Seed
        $logTransaksiSetoranID = DB::table('log_transaksi')->insertGetId([
            'rekening_id' => $rekeningID,
            'setoran_id' => $setoranID,
            'status' => 'diterima'
        ]);
        // End of Setoran Log Transaksi Seed


        // Start of Penarikan Seed
        $penarikanID = DB::table('penarikan')->insertGetId([
            'rekening_id' => $rekeningID,
            'total_harga' => 5000,
            'metode_pembayaran_id' => $metodePembayaranCODID
        ]);
        // End of Penarikan Seed

        // Start of Penarikan Log Transaksi Seed
        $logTransaksiPenarikanID = DB::table('log_transaksi')->insertGetId([
            'rekening_id' => $rekeningID,
            'penarikan_id' => $penarikanID,
            'status' => 'diterima'
        ]);
        // End of Penarikan Log Transaksi Seed

        // Start of Kategori Berita Seed
        try {
            $kategoriBerita = DB::table('kategori_berita')->where('nama', 'Lingkungan')->get();
            $kategoriBeritaID = $kategoriBerita[0]->id;
        } catch (\Throwable $th) {
            $kategoriBeritaID = DB::table('kategori_berita')->insertGetId([
                'nama' => 'Lingkungan'
            ]);
        }
        // End of Kategori Berita Seed

        // Start of Berita Seed
        DB::table('berita')->insert([
            'kategori_berita_id' => $kategoriBeritaID,
            'user_id' => $userSeederID,
            'judul' => 'Gunung Sampah di Desa ABC',
            'deskripsi' => 'tumpukan sampah yang menggunug di desa ABC menganggu aktifitas sehari-hari warga desa',
        ]);
        // End of Berita Seed

        // Start of Hadiah Seed
        $voucherBelanjaID = DB::table('hadiah')->insertGetId([
            'nama' => 'Voucher Belanja Indomaret Rp. 500.000,00-',
            'coin_diperlukan' => 1000000,
            'stok' => '4',
            'gambar' => 'hadiah_20250502_09-57-41.png',
        ]);

        $uangTunaiID = DB::table('hadiah')->insertGetId([
            'nama' => 'Uang Tunai Rp. 50.000,00-',
            'coin_diperlukan' => 10000,
            'stok' => '10',
            'gambar' => 'hadiah_20250502_09-58-41.jpg',
        ]);
        // End of Hadiah Seed

        $penukaranHadiahID = DB::table('penukaran')->insertGetId([
            'rekening_id' => $rekeningID,
            'hadiah_id' => $uangTunaiID,
        ]);
    }
}
