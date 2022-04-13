<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <img src="<?php echo base_url(); ?>assets/logo/mdba_logo.svg" alt="" srcset="">
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-title'>Menu</li>
                <li class="sidebar-item">
                    <a href="<?php echo base_url('home'); ?>" class='sidebar-link'>
                        <!-- <i data-feather="home" width="20"></i> -->
                        <span>Dashboard</span>
                    </a>
                </li>
                <!-- <li class="sidebar-title">Setting dan Konfigurasi</li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>Setting dan Konfigurasi</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="component-alert.html">Master Perusahaan</a>
                        </li>
                        <li>
                            <a href="component-badge.html">Entity Pajak</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Master Cabang</a>
                        </li>
                        <li>
                            <a href="component-buttons.html">Format Penomoran</a>
                        </li>
                        <li>
                            <a href="component-card.html">Counter Dokumen</a>
                        </li>
                        <li>
                            <a href="component-carousel.html">Grup Pengguna</a>
                        </li>
                        <li>
                            <a href="component-dropdowns.html">User</a>
                        </li>
                        <li>
                            <a href="component-list-group.html">Konfigurasi Persetujuan</a>
                        </li>
                        <li>
                            <a href="component-modal.html">Konfigurasi Aplikasi</a>
                        </li>
                        <li>
                            <a href="component-navs.html">Konfigurasi Menu</a>
                        </li>
                        <li>
                            <a href="component-pagination.html">Versioning</a>
                        </li>
                        <li>
                            <a href="component-progress.html">Beri Persetujuan</a>
                        </li>
                        <li>
                            <a href="component-spinners.html">Setting Mandatory</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-title">Umum</li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>Umum</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="component-alert.html">Alasan</a>
                        </li>
                        <li>
                            <a href="component-badge.html">Mata Uang</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Tipe Pajak</a>
                        </li>
                        <li>
                            <a href="component-buttons.html">Master Kurs Mata Uang</a>
                        </li>
                        <li>
                            <a href="component-card.html">Konversi Mata Uang</a>
                        </li>
                        <li>
                            <a href="component-carousel.html">Geo Tree</a>
                        </li>
                    </ul>
                </li> -->
                <li class="sidebar-title">Inventori</li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <!-- <i data-feather="triangle" width="20"></i> -->
                         <span>Master</span>
                    </a>
                    <ul class="submenu ">
                    <li>
                            <a href="<?= base_url();?>master?id=1">Master Inventori</a>
                        </li>
                        <li>
                            <a href="<?= base_url();?>kendaraan?id=1">Master Kendaraan</a>
                        </li>
                        <!--<li>
                            <a href="component-alert.html">Satuan</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Gudang</a>
                        </li>
                        <li>
                            <a href="component-buttons.html">Tipe Kategori Produk</a>
                        </li>
                        <li>
                            <a href="component-card.html">Kategori Produk</a>
                        </li>
                        <li>
                            <a href="component-carousel.html">Produk</a>
                        </li>
                        <li>
                            <a href="component-dropdowns.html">Setting Harga per Cabang</a>
                        </li>
                        <li>
                            <a href="component-list-group.html">Tipe Kendaraan</a>
                        </li>
                        <li>
                            <a href="component-modal.html">Kendaraan</a>
                        </li>
                        <li>
                            <a href="component-navs.html">Ekspedisi</a>
                        </li>
                        <li>
                            <a href="component-list-group.html">Mutasi Internal Depo</a>
                        </li>
                        <li>
                            <a href="component-navs.html">Pemusnahan Produk</a>
                        </li>
                        <li>
                            <a href="component-pagination.html">Mutasi Anak Kendaraan</a>
                        </li>
                        <li>
                            <a href="component-spinners.html">Cari Serial Number</a>
                        </li> -->
                    </ul> 
                <!-- </li> -->
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <!-- <i data-feather="triangle" width="20"></i> -->
                        <span>BKB dan BTB</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="<?php echo base_url('home/btbDepot'); ?>">BTB Depot</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('home/bkbDepot'); ?>">BKB Depot</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('home/btbDistribusi'); ?>">BTB Distribusi</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('home/bkbDist'); ?>">BKB Distribusi</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('home/btbSupplier'); ?>">BTB Supplier</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('home/bkbSupplier'); ?>">BKB Supplier</a>
                        </li>
                        <!-- <li>
                            <a href="component-dropdowns.html">BTB Supplier (OTM)</a>
                        </li> -->
                     </ul>
                </li>
                <!-- <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'> -->
                        <!-- <i data-feather="triangle" width="20"></i> -->
                        <!-- <span>Dispenser</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="<?php echo base_url('home/btbDispenser'); ?>">BTB (Bukti Terima Barang)</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('home/bkbDispenser'); ?>">BKB (Bukti Keluar Barang)</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="<?php echo base_url('home/sjp'); ?>" class='sidebar-link'> -->
                        <!-- <i data-feather="home" width="20"></i> -->
                        <!-- <span>Surat Jalan Pelanggan</span> -->
                    <!-- </a> -->
                <!-- </li> -->
                <!-- <li class="sidebar-item  has-sub"> -->
                    <!-- <a href="#" class='sidebar-link'> -->
                        <!-- <i data-feather="triangle" width="20"></i> -->
                        <!-- <span>Stock Gudang</span> -->
                    <!-- </a> -->
                    <!-- <ul class="submenu "> -->

                        <!-- <li>
                            <a href="component-progress.html">Lihat History Lot</a>
                        </li>
                        <li>
                            <a href="component-badge.html">Tipe Stok</a>
                        </li>
                        <li>
                            <a href="component-pagination.html">Koreksi Stok</a>
                        </li>
                        <li>
                            <a href="component-modal.html">Lihat Stok</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('home/inventTbg'); ?>">Tutup Buku Gudang</a>
                        </li>
                        <li>
                            <a href="component-spinners.html">Balik Transaksi Gudang</a>
                        </li> -->
                        <!-- <li>
                            <a href="<?php echo base_url('home/stokMorphing'); ?>">Stok Morphing</a>
                        </li>
                    </ul>
                </li> -->
                <!-- <li class="sidebar-title">Manajemen Pelanggan</li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>Manajemen Pelanggan</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="component-alert.html">Tempo Pembayaran</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Pemrosesan Invoice</a>
                        </li>
                        <li>
                            <a href="component-buttons.html">Jenis Pembayaran</a>
                        </li>
                        <li>
                            <a href="component-card.html">Segmentasi Harga</a>
                        </li>
                        <li>
                            <a href="component-carousel.html">Tipe Kategori Pelanggan</a>
                        </li>
                        <li>
                            <a href="component-dropdowns.html">Kategori Pelanggan</a>
                        </li>
                        <li>
                            <a href="component-list-group.html">Pembayaran</a>
                        </li>
                        <li>
                            <a href="component-modal.html">Reverse Pembayaran</a>
                        </li>
                        <li>
                            <a href="component-navs.html">View AR</a>
                        </li>
                        <li>
                            <a href="component-list-group.html">Dokumen Perubahan Pelanggan</a>
                        </li>
                        <li>
                            <a href="component-navs.html">Hirarki Pelanggan</a>
                        </li>
                        <li>
                            <a href="component-pagination.html">Lihat Pelanggan</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-title">Employee</li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>Employee</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="component-alert.html">Grup Employee</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Employee</a>
                        </li>
                        <li>
                            <a href="component-buttons.html">Departemen</a>
                        </li>
                        <li>
                            <a href="component-card.html">Divisi</a>
                        </li>
                        <li>
                            <a href="component-carousel.html">Tim</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-title">Management Prinsipal</li>
                <li class="sidebar-item">
                    <a href="index.html" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>Supplier</span>
                    </a>
                </li> -->
                <li class="sidebar-title">Kasir dan Bank</li>
                <!-- <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <span>Bank</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="component-alert.html">Bank</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Saldo Kas Bank</a>
                        </li>
                    </ul>
                </li> -->
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <span>Transaksi</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="<?php echo base_url('home/cashierBTU'); ?>">BTU (Bukti Terima Uang)</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('home/cashierBKU'); ?>">BKU (Bukti Keluar Uang)</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('home/cashierSettlement'); ?>">Saldo Kas Sementara Ver. 2</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('home/cashierClosing'); ?>">Closing</a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <span>Auto Transaksi</span>
                    </a>
                    <ul class="submenu ">
                        <li> 
                             <a href="<?php echo base_url('auto/autoTransfer'); ?>">Transaksi Auto</a> 
                             <a href="<?php echo base_url('home/cashierAuto'); ?>">Transaksi Auto Tunai</a>
                        </li>
                        <li>
                            <a href="http://192.168.4.95/wo_cashier/">Transaksi Auto Kredit</a>
                        </li>
                    </ul>
                </li> -->
                <!-- <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <span>Cek/Giro</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="component-alert.html">Penerimaan Cek/Giro</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Penyetoran Cek/Giro</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Kliring Cek/Giro</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Tolakan Cek/Giro</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Lihat Cek/Giro</a>
                        </li>
                    </ul>
                </li>  -->
                <li class="sidebar-title">Distribusi dan Penjualan</li> 
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <span>Penjualan</span>
                    </a>
                    <ul class="submenu ">
                        <!-- <li>
                            <a href="component-alert.html">Sales Order (SO)</a>
                        </li>
                        <li>
                            <a href="component-alert.html">Koreksi Status SO</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Delivery Order (DO)</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">DO Blank</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Lihat DO</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Cetak DO</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Koreksi DO</a>
                        </li>-->
                        <li>
                            <a href="<?php echo base_url('home/prosesSuratTugas'); ?>">Proses Surat Tugas</a>
                        </li>
                        <!-- <li>
                            <a href="component-breadcrumb.html">Surat Tugas</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Feedback Surat Tugas</a>
                        </li>  -->
                        <li>
                            <a href="<?php echo base_url('home/permintaanBrg'); ?>">Permintaan Barang (PB)</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <span>Distribusi</span>
                    </a>
                    <ul class="submenu ">
                        <!-- <li>
                            <a href="component-alert.html">Dist. Channel</a>
                        </li> -->
                        <!-- <li>
                            <a href="component-breadcrumb.html">Kalender</a>
                        </li> -->
                        <!-- <li>
                            <a href="component-breadcrumb.html">Kalender Periodik</a>
                        </li> -->
                        <li>
                            <a href="<?php echo base_url('home/rute'); ?>">Rute</a>
                        </li>
                        <!-- <li>
                            <a href="component-breadcrumb.html">Sumber PO</a>
                        </li> -->
                        <!-- <li>
                            <a href="component-breadcrumb.html">Organisasi Penjualan</a>
                        </li> -->
                        <!-- <li>
                            <a href="component-breadcrumb.html">Lihat Produk Sewa</a>
                        </li> -->
                        <!-- <li>
                            <a href="component-breadcrumb.html">Sisa Stok Pelanggan</a>
                        </li> -->
                        <!-- <li>
                            <a href="component-breadcrumb.html">Settlement Dist Ver. 2</a>
                        </li> -->
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="<?php echo base_url('home/konversiPpnDo'); ?>" class='sidebar-link'>
                        <!-- <i data-feather="home" width="20"></i> -->
                        <span>Konversi PPN DO</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?php echo base_url('home/konversiInvoice'); ?>" class='sidebar-link'>
                        <!-- <i data-feather="home" width="20"></i> -->
                        <span>Konversi Invoice Correction</span>
                    </a>
                </li>
                <!-- <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>Invoice</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="component-alert.html">Invoice</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Proses Invoice</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Debit Note/Memo Debet</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Credit Note/Memo Credit</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Tukar Faktur</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>Setting</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="component-alert.html">Setting Harga</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Setting Promo</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Tipe Penjualan</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Tipe Item Penjualan</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Konfigurasi FOC Pelanggan</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Setting Diskon Pelanggan</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Koreksi No. Seri Pelanggan</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Alasan</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-title">Finance</li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>Finance</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="component-alert.html">Nomor Akun</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Nomor Sub Akun</a>
                        </li>
                        <li>
                            <a href="component-buttons.html">Kategori Jurnal</a>
                        </li>
                        <li>
                            <a href="component-card.html">Entri Jurnal</a>
                        </li>
                        <li>
                            <a href="component-carousel.html">Voucher Penerimaan Kas</a>
                        </li>
                        <li>
                            <a href="component-alert.html">Voucher Pengeluaran Kas</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Tipe Periode Akunting</a>
                        </li>
                        <li>
                            <a href="component-buttons.html">Kalender Akunting</a>
                        </li>
                        <li>
                            <a href="component-card.html">Setup Periode Kalender Akunting</a>
                        </li>
                        <li>
                            <a href="component-carousel.html">Ledger</a>
                        </li>
                        <li>
                            <a href="component-card.html">Master Kurs Mata Uang</a>
                        </li>
                        <li>
                            <a href="component-carousel.html">Konversi Mata Uang</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-title">Faktur Pajak</li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>Faktur Pajak</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="component-alert.html">Konfigurasi Faktur Pajak</a>
                        </li>
                        <li>
                            <a href="component-breadcrumb.html">Konfigurasi Fakut Pajak Pelanggan</a>
                        </li>
                        <li>
                            <a href="component-buttons.html">Faktur Pajak</a>
                        </li>
                        <li>
                            <a href="component-card.html">Proses Faktur Pajak</a>
                        </li>
                    </ul>
                </li>  -->
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>