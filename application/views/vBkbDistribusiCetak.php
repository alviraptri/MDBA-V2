<!DOCTYPE html>
<html>

<head>
    <title>Data BKB DISTRIBUSI <?= $bkb; ?>
    </title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/style.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/font-awesome.css'; ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url() . 'assets/css/jquery.dataTables.min.css'; ?>" rel="stylesheet">
    <style>
        body,
        html {
            /* font-family: Tahoma; */
            font-family: sans-serif;
            font-size: 12px;
            margin-top: 12px;
            margin-left: 3px;
            margin-right: 2px;
        }

        .break {
            page-break-before: always;
            top: 100%;
        }
    </style>
</head>

<body onload="window.print()">
    <?php
    $row = count($data);
    foreach ($data as $val) {
        $company = $val->company;
        $warehouse = $val->warehouse;
        $employee = $val->szEmployeeId;
        $employeeName = $val->employee;
        $vehicle = $val->szVehicleId;
        $vehicleName = $val->vehicle;
        $description = $val->szDescription;
        $bkbId = $val->szDocId;
        $date = date('d/m/Y', strtotime($val->dtmDoc));
        $pbId = $val->szDocPRId;
        $user = $this->session->userdata('user_name');
    }
    ?>

    <?php
    if ($row <= '3') { ?>
        <div class="break">
            <!-- /////////////////////////////////////////////////////P/////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <table style="float:left;">
                <tr>
                    <td colspan="3" style="text-align: left;">
                        <?= $company; ?>
                    </td>
                    <td colspan="3" style="text-align: right;">
                        HALAMAN 1
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align: center;">
                        &nbsp;<b style="font-size:15px;">BUKTI KELUAR BARANG (FRM.WO.01)
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align: left;width: 20px;">
                        NAMA GUDANG
                    </td>
                    <td colspan="2" style="text-align: left;">
                        : <?= $warehouse; ?>
                    </td>
                    <td style="text-align: left; width: 15px;">
                        DOKUMEN ID
                    </td>
                    <td colspan="2" style="text-align: left;width:50px;">
                        : <?= $bkbId ?>
                    </td>
                </tr>


                <tr>
                    <td colspan="2" style="text-align: left;width: 20px;">
                        PENGEMUDI
                    </td>
                    <td colspan="2" style="text-align: left;">
                        : <?= $employee; ?> - <?= $employeeName; ?>
                    </td>
                    <td style="text-align: left;width: 15px;">
                        TANGGAL
                    </td>
                    <td colspan="2" style="text-align: left;">
                        : <?= $date; ?>
                    </td>
                </tr>


                <tr>
                    <td colspan="2" style="text-align: left;width: 20px;">
                        KENDARAAN
                    </td>
                    <td colspan="2" style="text-align: left;font-size:11px;">
                        : <?= $vehicle; ?> - <?= $vehicleName; ?>
                    </td>
                    <td style="text-align: left; width:15px;">
                        NO. PB
                    </td>
                    <td colspan="2" style="text-align: left;white-space: nowrap;font-size:9px;">
                        : <?= $pbId; ?>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left;width: 20px;">
                        KETERANGAN
                    </td>
                    <td colspan="5" style="text-align: left;font-size:11px;">
                        : <?= $description; ?>
                    </td>
                </tr>
                <tr>

                <tr>
                    <td style="width:20px; border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;"></td>
                    <td style="border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;">
                        <center>NO</center>
                    </td>
                    <td style="border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;">
                        <center>KODE</center>
                    </td>
                    <td style="border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;">
                        <center>NAMA PRODUK</center>
                    </td>
                    <td style="border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;">
                        <center>SATUAN</center>
                    </td>
                    <td style="border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;">
                        <center>JUMLAH</center>
                    </td>
                    <td style="border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;">
                        <center>KETERANGAN</center>
                    </td>
                    <td style="width:20px; border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;"></td>
                </tr>

                <?php
                $no = 1;
                foreach ($data as $val) { ?>
                    <tr>
                        <td style="width:20px;"></td>
                        <td>
                            <center><?= $no ?></center>
                        </td>
                        <td>
                            <center><?= $val->szProductId; ?></center>
                        </td>
                        <td>
                            <center><?= $val->product; ?></center>
                        </td>
                        <td>
                            <center><?= $val->szUomId; ?></center>
                        </td>
                        <td>
                            <center><?= (int)$val->decQty; ?></center>
                        </td>
                        <td>
                            <center></center>
                        </td>
                        <td style="width:20px;"></td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
                    <tr>
                        <td style="width:20px; border-top: 0.4px dashed #000000;"></td>
                        <td style="border-top: 0.4px dashed #000000;"></td>
                        <td style="border-top: 0.4px dashed #000000;"></td>
                        <td style="border-top: 0.4px dashed #000000;"></td>
                        <td style="border-top: 0.4px dashed #000000;"></td>
                        <td style="border-top: 0.4px dashed #000000;"></td>
                        <td style="border-top: 0.4px dashed #000000;"></td>
                        <td style="width:20px;border-top: 0.4px dashed #000000;"></td>
                    </tr>

                <tr>
                    <td style="width:20px;"></td>
                    <td style="width: 2200px;" colspan="2">
                        <center>DIINPUT OLEH,</center>
                    </td>
                    <td style="width: 115px;">
                        <center>DISERAHKAN OLEH,</center>
                    </td>
                    <td style="width: 115px;">
                        <center>DITERIMA OLEH,</center>
                    </td>
                    <td style="width: 115px;">
                        <center>DIPERIKSA OLEH,</center>
                    </td>
                    <td style="width: 330px;font-size: 11px;" colspan="3">
                        <center></center>
                    </td>
                    <td style="width:20px;"></td>
                </tr>
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <tr>
                    <td style="width:20px;"></td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center>

                        </center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style="width:20px;"></td </tr>
                    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <tr>
                    <td style="width:20px;"></td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center>

                        </center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style="width:20px;"></td </tr>
                    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <tr>
                    <td colspan="10">
                        <br>
                    </td>
                </tr>
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <tr>
                    <td style="width:20px;"></td>
                    <td style=" width: 220px;width: 115px;" colspan="2">
                        <center>( WAREHOUSE ADMIN )</center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center>( CHECKER (DLM) )</center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center>( DRIVER )</center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center>( CHECKER (LR) )</center>
                    </td>
                    <td style=" width: 115px;width: 115px;" colspan="3">
                        <center></center>
                    </td>
                    <td style="width:20px;"></td>
                </tr>

                <tr>
                    <td>

                    </td>
                    <td style="white-space: nowrap;" colspan="7">
                        <br><i> TANGGAL PRINT : <?php echo DATE('Y-m-d H:i:s'); ?>, <?= strtoupper($this->session->userdata('user_nik')); ?> <?= strtoupper($this->session->userdata('user_nama')); ?></i>
                    </td>
                    <td>

                    </td>
                </tr>

            </table>
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        </div>
    <?php
    } else {
    ?>
        <div class="break">
            <!-- /////////////////////////////////////////////////////P/////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <table style="float:left;">
                <tr>
                    <td colspan="3" style="text-align: left;">
                        <?= $company; ?>
                    </td>
                    <td colspan="3" style="text-align: right;">
                        HALAMAN 1
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align: center;">
                        &nbsp;<b style="font-size:15px;">BUKTI KELUAR BARANG (FRM.WO.01)
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align: left;width: 20px;">
                        NAMA GUDANG
                    </td>
                    <td colspan="2" style="text-align: left;">
                        : <?= $warehouse; ?>
                    </td>
                    <td style="text-align: left; width: 15px;">
                        DOKUMEN ID
                    </td>
                    <td colspan="2" style="text-align: left;width:50px;">
                        : <?= $bkbId ?>
                    </td>
                </tr>


                <tr>
                    <td colspan="2" style="text-align: left;width: 20px;">
                        PENGEMUDI
                    </td>
                    <td colspan="2" style="text-align: left;">
                        : <?= $employee; ?> - <?= $employeeName; ?>
                    </td>
                    <td style="text-align: left;width: 15px;">
                        TANGGAL
                    </td>
                    <td colspan="2" style="text-align: left;">
                        : <?= $date; ?>
                    </td>
                </tr>


                <tr>
                    <td colspan="2" style="text-align: left;width: 20px;">
                        KENDARAAN
                    </td>
                    <td colspan="2" style="text-align: left;font-size:11px;">
                        : <?= $vehicle; ?> - <?= $vehicleName; ?>
                    </td>
                    <td style="text-align: left; width:15px;">
                        NO. PB
                    </td>
                    <td colspan="2" style="text-align: left;white-space: nowrap;font-size:9px;">
                        : <?= $pbId; ?>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left;width: 20px;">
                        KETERANGAN
                    </td>
                    <td colspan="5" style="text-align: left;font-size:11px;">
                        : <?= $description; ?>
                    </td>
                </tr>
                <tr>

                <tr>
                    <td style="width:20px; border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;"></td>
                    <td style="border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;">
                        <center>NO</center>
                    </td>
                    <td style="border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;">
                        <center>KODE</center>
                    </td>
                    <td style="border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;">
                        <center>NAMA PRODUK</center>
                    </td>
                    <td style="border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;">
                        <center>SATUAN</center>
                    </td>
                    <td style="border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;">
                        <center>JUMLAH</center>
                    </td>
                    <td style="border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;">
                        <center>KETERANGAN</center>
                    </td>
                    <td style="width:20px;border-bottom: 0.4px dashed #000000; border-top: 0.4px dashed #000000;"></td>
                </tr>

                <?php
                $no = 1;
                foreach ($data as $val) { ?>
                    <tr>
                        <td style="width:20px;"></td>
                        <td>
                            <center><?= $no ?></center>
                        </td>
                        <td>
                            <center><?= $val->szProductId; ?></center>
                        </td>
                        <td>
                            <center><?= $val->product; ?></center>
                        </td>
                        <td>
                            <center><?= $val->szUomId; ?></center>
                        </td>
                        <td>
                            <center><?= (int)$val->decQty; ?></center>
                        </td>
                        <td>
                            <center></center>
                        </td>
                        <td style="width:20px;"></td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
                    <tr>
                        <td style="width:20px; border-top: 0.4px dashed #000000;"></td>
                        <td style="border-top: 0.4px dashed #000000;"></td>
                        <td style="border-top: 0.4px dashed #000000;"></td>
                        <td style="border-top: 0.4px dashed #000000;"></td>
                        <td style="border-top: 0.4px dashed #000000;"></td>
                        <td style="border-top: 0.4px dashed #000000;"></td>
                        <td style="border-top: 0.4px dashed #000000;"></td>
                        <td style="width:20px;border-top: 0.4px dashed #000000;"></td>
                    </tr>

            </table>
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        </div>

        <div class="break">
            <!-- /////////////////////////////////////////////////////P/////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <table style="float:left;">
                <tr>
                    <td colspan="3" style="text-align: left;">
                        <?= $company; ?>
                    </td>
                    <td colspan="3" style="text-align: right;">
                        HALAMAN 2
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align: center;">
                        &nbsp;<b style="font-size:15px;">BUKTI KELUAR BARANG (FRM.WO.01)
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align: left;width: 20px;">
                        NAMA GUDANG
                    </td>
                    <td colspan="2" style="text-align: left;">
                        : <?= $warehouse; ?>
                    </td>
                    <td style="text-align: left; width: 15px;">
                        DOKUMEN ID
                    </td>
                    <td colspan="2" style="text-align: left;width:50px;">
                        : <?= $bkbId ?>
                    </td>
                </tr>


                <tr>
                    <td colspan="2" style="text-align: left;width: 20px;">
                        PENGEMUDI
                    </td>
                    <td colspan="2" style="text-align: left;">
                        : <?= $employee; ?> - <?= $employeeName; ?>
                    </td>
                    <td style="text-align: left;width: 15px;">
                        TANGGAL
                    </td>
                    <td colspan="2" style="text-align: left;">
                        : <?= $date; ?>
                    </td>
                </tr>


                <tr>
                    <td colspan="2" style="text-align: left;width: 20px;">
                        KENDARAAN
                    </td>
                    <td colspan="2" style="text-align: left;font-size:11px;">
                        : <?= $vehicle; ?> - <?= $vehicleName; ?>
                    </td>
                    <td style="text-align: left; width:15px;">
                        NO. PB
                    </td>
                    <td colspan="2" style="text-align: left;white-space: nowrap;font-size:9px;">
                        : <?= $pbId; ?>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left;width: 20px;">
                        KETERANGAN
                    </td>
                    <td colspan="5" style="text-align: left;font-size:11px;">
                        : <?= $description; ?>
                    </td>
                </tr>
                <tr>

                <tr>
                    <td style="width:20px; border-bottom: 0.4px dashed #000000;"></td>
                    <td style="border-bottom: 0.4px dashed #000000;">
                        <center>NO</center>
                    </td>
                    <td style="border-bottom: 0.4px dashed #000000;">
                        <center>KODE</center>
                    </td>
                    <td style="border-bottom: 0.4px dashed #000000;">
                        <center>NAMA PRODUK</center>
                    </td>
                    <td style="border-bottom: 0.4px dashed #000000;">
                        <center>SATUAN</center>
                    </td>
                    <td style="border-bottom: 0.4px dashed #000000;">
                        <center>JUMLAH</center>
                    </td>
                    <td style="border-bottom: 0.4px dashed #000000;">
                        <center>KETERANGAN</center>
                    </td>
                    <td style="width:20px;"></td>
                </tr>

                <tr>
                    <td style="width:20px;"></td>
                    <td style="width: 2200px;" colspan="2">
                        <center>DIINPUT OLEH,</center>
                    </td>
                    <td style="width: 115px;">
                        <center>DISERAHKAN OLEH,</center>
                    </td>
                    <td style="width: 115px;">
                        <center>DITERIMA OLEH,</center>
                    </td>
                    <td style="width: 115px;">
                        <center>DIPERIKSA OLEH,</center>
                    </td>
                    <td style="width: 330px;font-size: 11px;" colspan="3">
                        <center></center>
                    </td>
                    <td style="width:20px;"></td>
                </tr>
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <tr>
                    <td style="width:20px;"></td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center>

                        </center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style="width:20px;"></td </tr>
                    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <tr>
                    <td style="width:20px;"></td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center>

                        </center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style="width:20px;"></td </tr>
                    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <tr>
                    <td colspan="10">
                        <br>
                    </td>
                </tr>
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <tr>
                    <td style="width:20px;"></td>
                    <td style=" width: 220px;width: 115px;" colspan="2">
                        <center>( WAREHOUSE ADMIN )</center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center>( CHECKER (DLM) )</center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center>( DRIVER )</center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center>( CHECKER (LR) )</center>
                    </td>
                    <td style=" width: 115px;width: 115px;" colspan="3">
                        <center></center>
                    </td>
                    <td style="width:20px;"></td>
                </tr>

                <tr>
                    <td>

                    </td>
                    <td style="white-space: nowrap;" colspan="7">
                        <br><i> TANGGAL PRINT : <?php echo DATE('Y-m-d H:i:s'); ?>, <?= strtoupper($this->session->userdata('user_nik')); ?> <?= strtoupper($this->session->userdata('user_nama')); ?></i>
                    </td>
                    <td>

                    </td>
                </tr>

            </table>
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        </div>
    <?php } ?>
</body>

</html>