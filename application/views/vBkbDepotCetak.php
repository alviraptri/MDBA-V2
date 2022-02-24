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
            font-family: Tahoma;
            font-size: 10px;
            margin-top: 13px;
            margin-left: 3px;
            margin-right: 3px;
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
        $description = $val->szDescription;
        $bkbId = $val->szDocId;
        $date = date('d/m/Y', strtotime($val->dtmDoc));
        $user = $this->session->userdata('user_name');
        $depoTujuan = $val->depoTujuan;
        $depoKirim = $val->depoKirim;
        $partyId = $val->szPartyId;
    }
    ?>

    <?php
    if ($row <= '3' || $row == '3' ) { ?>

        <!-- <body> -->
        <div class="break">


            <!-- /////////////////////////////////////////////////////P/////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <table style="float:left;">
                <tr>
                    <td colspan="3" style="text-align: left;">
                        <?= $company; ?>
                    </td>
                    <td colspan="3" style="text-align: right;">
                        Halaman : 1
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: left;">
                        NAMA DEPO: <?= $depoKirim; ?>
                    </td>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: center;">
                        &nbsp;<b style="font-size:15px;">BUKTI KELUAR BARANG (FRM.WO.12)</b>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; width: 30px;">
                        NAMA GUDANG
                    </td>
                    <td colspan="3" style="text-align: left; width: 100px;">
                        : <?= $warehouse; ?>
                    </td>
                    <td style="text-align: left; ">
                        DOKUMEN ID
                    </td>
                    <td style="text-align: left;">
                        : <?= $bkbId; ?>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; width: 30px;">
                        KELUAR KE
                    </td>
                    <td colspan="3" style="text-align: left; width: 100px;">
                        : <?= $partyId; ?> - <?= $depoTujuan; ?>
                    </td>
                    <td style="text-align: left;">
                        TANGGAL
                    </td>
                    <td style="text-align: left;">
                        : <?= $date; ?>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left;width: 30px;">
                        KETERANGAN
                    </td>
                    <td colspan="5" style="text-align: left;">
                        : <?= $description; ?>
                    </td>
                </tr>

                <tr></tr>
                <tr></tr>
                <tr></tr>

                <tr>
                    <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;width: 1px;">
                        <center>
                            NO
                        </center>
                    </td>
                    <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                        <center>
                            KODE
                        </center>
                    </td>
                    <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                        <center>
                            NAMA PRODUK
                        </center>
                    </td>
                    <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                        <center>
                            SATUAN
                        </center>
                    </td>
                    <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                        <center>
                            JUMLAH
                        </center>
                    </td>
                    <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                        <center>
                            KETERANGAN
                        </center>
                    </td>
                </tr>
                <?php
                $no = 1;
                foreach ($data as $value) { ?>
                    <tr>
                        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                            <center>
                                <?= $no; ?>
                            </center>
                        </td>
                        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                            <center>
                                <?= $value->szProductId; ?>
                            </center>
                        </td>
                        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                            <center>
                                <?= $value->product; ?>
                            </center>
                        </td>
                        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                            <center>
                                <?= $value->szUomId; ?>
                            </center>
                        </td>
                        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                            <center>
                                <?= (int)$value->decQty; ?>
                            </center>
                        </td>
                        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">

                        </td>
                    </tr>
                <?php
                    $no++;
                }
                ?>

                <tr></tr>
                <tr></tr>
                <tr></tr>

                <tr>
                    <!-- <td style="width:100px;"></td> -->
                    <td style="width:300px;">
                        <center>DIINPUT OLEH,</center>
                    </td>
                    <td style="width: 300px;">
                        <center></center>
                    </td>
                    <td style="width: 300px;">
                        <center>DIPERIKSA OLEH,</center>
                    </td>
                    <td style="width: 300px;">
                        <center>DIKETAHUI OLEH,</center>
                    </td>
                    <td style="width:50px;"></td>
                    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                    <!-- <td style="width:20px;"></td>
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
                <td style=" width: 115px;width: 115px;">
                    <center></center>
                </td>
                <td style=" width: 115px;width: 115px;">
                    <center></center>
                </td>
                <td style="width:20px;"></td> -->
                </tr>

                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>

                <tr>
                    <!-- <td style="width:100px;"></td> -->
                    <td style="width:300px;">
                        <center>( WAREHOUSE ADMIN )</center>
                    </td>
                    <td style="width: 300px;">
                        <center></center>
                    </td>
                    <td style="width: 300px;">
                        <center>( CHECKER )</center>
                    </td>
                    <td style="width: 300px;">
                        <center>( DRIVER )</center>
                    </td>
                    <td style="width:50px;"></td>
                </tr>
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <tr>
                    <td style="width:50px;"></td>
                    <td style="width:300px;" rowspan="10">
                        <center></center>
                    </td>
                    <td style="width: 300px;">
                        <center></center>
                    </td>
                    <td style="width: 300px;" rowspan="5">
                        <center></center>
                    </td>
                    <td style="width: 300px;">
                        <center></center>
                    </td>
                    <td style="width:50px;"></td>
                    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                    <td style="width:20px;"></td>
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
                    <!-- <td style=" width: 115px;width: 115px;">
                    <center></center>
                </td>
                <td style=" width: 115px;width: 115px;">
                    <center></center>
                </td>
                <td style=" width: 115px;width: 115px;">
                    <center></center>
                </td> -->
                    <td style="width:20px;"></td>
                </tr>
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <tr>
                    <td style="width:50px;"></td>
                    <td style="width:100px;">

                    </td>
                    <td style="width: 300px;">

                    </td>
                    <td style="width: 300px;">

                    </td>
                    <td style="width: 300px;">

                    </td>
                    <td style="width:50px;"></td>
                    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                    <td style="width:20px;"></td>
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
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style="width:20px;"></td>
                </tr>
            </table>
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

        </div>
    <?php } else if ($row == '6'){
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
                        Halaman : 1
                    </td>
                </tr>

                <tr>
                    <td colspan="3" style="text-align: left;">
                        NAMA DEPO : <?= $depoKirim;?>
                    </td>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: center;">
                        &nbsp;<b style="font-size:15px;">BUKTI KELUAR BARANG (FRM.WO.12)</b>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; width: 30px;">
                        NAMA GUDANG
                    </td>
                    <td colspan="3" style="text-align: left; width: 100px;">
                        : <?= $warehouse; ?>
                    </td>
                    <td style="text-align: left; ">
                        DOKUMEN ID
                    </td>
                    <td style="text-align: left;">
                        : <?= $bkbId; ?>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; width: 30px;">
                        KELUAR KE
                    </td>
                    <td colspan="3" style="text-align: left; width: 100px;">
                        : <?= $partyId; ?> - <?= $depoTujuan; ?>
                    </td>
                    <td style="text-align: left;">
                        TANGGAL
                    </td>
                    <td style="text-align: left;">
                        : <?= $date; ?>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left;width: 30px;">
                        KETERANGAN
                    </td>
                    <td colspan="5" style="text-align: left;">
                        : <?= $description; ?>
                    </td>
                </tr>

                <tr></tr>
                <tr></tr>
                <tr></tr>

                <tr>
                    <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;width: 1px;">
                        <center>
                            NO
                        </center>
                    </td>
                    <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                        <center>
                            KODE
                        </center>
                    </td>
                    <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                        <center>
                            NAMA PRODUK
                        </center>
                    </td>
                    <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                        <center>
                            SATUAN
                        </center>
                    </td>
                    <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                        <center>
                            JUMLAH
                        </center>
                    </td>
                    <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                        <center>
                            KETERANGAN
                        </center>
                    </td>
                </tr>
                <?php
                $no = 1;
                foreach ($data as $value) { ?>
                    <tr>
                        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                            <center>
                                <?= $no; ?>
                            </center>
                        </td>
                        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                            <center>
                                <?= $value->szProductId; ?>
                            </center>
                        </td>
                        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                            <center>
                                <?= $value->product; ?>
                            </center>
                        </td>
                        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                            <center>
                                <?= $value->szUomId; ?>
                            </center>
                        </td>
                        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                            <center>
                                <?= $value->decQty; ?>
                            </center>
                        </td>
                        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">

                        </td>
                    </tr>
                <?php
                    $no++;
                }
                ?>

                <tr></tr>
                <tr></tr>
                <tr></tr>

                <!-- <tr>
    <td style="width:100px;"></td>
    <td style="width:300px;">
        <center>DIINPUT OLEH,</center>
    </td>
    <td style="width: 300px;">
        <center>DISERAHKAN OLEH</center>
    </td>
    <td style="width: 300px;">
        <center>DITERIMA OLEH,</center>
    </td>
    <td style="width: 300px;">
        <center>DIPERIKSA OLEH,</center>
    </td>
    <td style="width:50px;"></td> -->
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                <!-- <td style="width:20px;"></td>
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
    <td style=" width: 115px;width: 115px;">
        <center></center>
    </td>
    <td style=" width: 115px;width: 115px;">
        <center></center>
    </td>
    <td style="width:20px;"></td> -->
                </tr>

        </div>
        <div class="break">
            <!-- /////////////////////////////////////////////////////P/////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <table style="float:left;">
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>

                <tr>
                    <td colspan="3" style="text-align: left;">
                        <?= $company; ?>
                    </td>
                    <td colspan="3" style="text-align: right;">
                        Halaman : 1
                    </td>
                </tr>

                <tr>
                    <td colspan="3" style="text-align: left;">
                        DARI DEPO: <?= $depoKirim; ?>
                    </td>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: center;">
                        &nbsp;<b style="font-size:15px;">BUKTI KELUAR BARANG (FRM.WO.12)</b>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; width: 30px;">
                        NAMA GUDANG
                    </td>
                    <td colspan="3" style="text-align: left; width: 100px;">
                        : <?= $warehouse; ?>
                    </td>
                    <td style="text-align: left; ">
                        DOKUMEN ID
                    </td>
                    <td style="text-align: left;">
                        : <?= $bkbId; ?>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; width: 30px;">
                        KELUAR KE
                    </td>
                    <td colspan="3" style="text-align: left; width: 100px;">
                        : <?= $partyId; ?> - <?= $depoKirim; ?>
                    </td>
                    <td style="text-align: left;">
                        TANGGAL
                    </td>
                    <td style="text-align: left;">
                        : <?= $date; ?>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left;width: 30px;">
                        KETERANGAN
                    </td>
                    <td colspan="5" style="text-align: left;">
                        : <?= $description; ?>
                    </td>
                </tr>

                <tr></tr>
                <tr></tr>
                <tr></tr>


                <tr></tr>
                <tr></tr>
                <tr></tr>

                <tr>
                    <td style="width:100px;"></td>
                    <td style="width:300px;">
                        <center>DIINPUT OLEH,</center>
                    </td>
                    <td style="width: 300px;">
                        <center></center>
                    </td>
                    <td style="width: 300px;">
                        <center>DIPERIKSA OLEH,</center>
                    </td>
                    <td style="width: 300px;">
                        <center>DIKETAHUI OLEH,</center>
                    </td>
                    <td style="width:50px;"></td>
                    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                    <!-- <td style="width:20px;"></td>
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
                <td style=" width: 115px;width: 115px;">
                    <center></center>
                </td>
                <td style=" width: 115px;width: 115px;">
                    <center></center>
                </td>
                <td style="width:20px;"></td> -->
                </tr>

                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>

                <tr>
                    <td style="width:100px;"></td>
                    <td style="width:300px;">
                        <center>( WAREHOUSE ADMIN )</center>
                    </td>
                    <td style="width: 300px;">
                        <center></center>
                    </td>
                    <td style="width: 300px;">
                        <center>( CHECKER )</center>
                    </td>
                    <td style="width: 300px;">
                        <center>( DRIVER )</center>
                    </td>
                    <td style="width:50px;"></td>
                </tr>
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <tr>
                    <td style="width:50px;"></td>
                    <td style="width:300px;" rowspan="10">
                        <center></center>
                    </td>
                    <td style="width: 300px;">
                        <center></center>
                    </td>
                    <td style="width: 300px;" rowspan="5">
                        <center></center>
                    </td>
                    <td style="width: 300px;">
                        <center></center>
                    </td>
                    <td style="width:50px;"></td>
                    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                    <td style="width:20px;"></td>
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
                    <!-- <td style=" width: 115px;width: 115px;">
                    <center></center>
                </td>
                <td style=" width: 115px;width: 115px;">
                    <center></center>
                </td>
                <td style=" width: 115px;width: 115px;">
                    <center></center>
                </td> -->
                    <td style="width:20px;"></td>
                </tr>
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <tr>
                    <td style="width:50px;"></td>
                    <td style="width:100px;">

                    </td>
                    <td style="width: 300px;">

                    </td>
                    <td style="width: 300px;">

                    </td>
                    <td style="width: 300px;">

                    </td>
                    <td style="width:50px;"></td>
                    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                    <td style="width:20px;"></td>
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
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style=" width: 115px;width: 115px;">
                        <center></center>
                    </td>
                    <td style="width:20px;"></td>
                </tr>
            </table>
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        </div>
    <?php
    }
    else if ($row >6) { ?>
        <div class="break">


<!-- /////////////////////////////////////////////////////P/////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table style="float:left;">
    <tr>
        <td colspan="3" style="text-align: left;">
            <?= $company; ?>
        </td>
        <td colspan="3" style="text-align: right;">
            Halaman : 1
        </td>
    </tr>

    <tr>
        <td colspan="3" style="text-align: left;">
            NAMA DEPO : <?= $depoKirim;?>
        </td>
    </tr>

    <tr>
        <td colspan="6" style="text-align: center;">
            &nbsp;<b style="font-size:15px;">BUKTI KELUAR BARANG (FRM.WO.12)</b>
        </td>
    </tr>

    <tr>
        <td style="text-align: left; width: 30px;">
            NAMA GUDANG
        </td>
        <td colspan="3" style="text-align: left; width: 100px;">
            : <?= $warehouse; ?>
        </td>
        <td style="text-align: left; ">
            DOKUMEN ID
        </td>
        <td style="text-align: left;">
            : <?= $bkbId; ?>
        </td>
    </tr>

    <tr>
        <td style="text-align: left; width: 30px;">
            KELUAR KE
        </td>
        <td colspan="3" style="text-align: left; width: 100px;">
            : <?= $partyId; ?> - <?= $depoTujuan; ?>
        </td>
        <td style="text-align: left;">
            TANGGAL
        </td>
        <td style="text-align: left;">
            : <?= $date; ?>
        </td>
    </tr>

    <tr>
        <td style="text-align: left;width: 30px;">
            KETERANGAN
        </td>
        <td colspan="5" style="text-align: left;">
            : <?= $description; ?>
        </td>
    </tr>

    <tr></tr>
    <tr></tr>
    <tr></tr>

    <tr>
        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;width: 1px;">
            <center>
                NO
            </center>
        </td>
        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
            <center>
                KODE
            </center>
        </td>
        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
            <center>
                NAMA PRODUK
            </center>
        </td>
        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
            <center>
                SATUAN
            </center>
        </td>
        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
            <center>
                JUMLAH
            </center>
        </td>
        <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
            <center>
                KETERANGAN
            </center>
        </td>
    </tr>
    <?php
    $no = 1;
    // for ($value = 0 ; $value < 6 ; $value++) { 
    //     # code...
    // }
    foreach ($data as $value) { ?>
        <tr>
            <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                <center>
                    <?= $no; ?>
                </center>
            </td>
            <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                <center>
                    <?= $value->szProductId; ?>
                </center>
            </td>
            <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                <center>
                    <?= $value->product; ?>
                </center>
            </td>
            <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                <center>
                    <?= $value->szUomId; ?>
                </center>
            </td>
            <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">
                <center>
                    <?= $value->decQty; ?>
                </center>
            </td>
            <td style="border-bottom: 0.6px dashed #000000; border-top: 0.6px dashed #000000;">

            </td>
        </tr>
    <?php
        $no++;
    }
    ?>

    <tr></tr>
    <tr></tr>
    <tr></tr>

    <!-- <tr>
<td style="width:100px;"></td>
<td style="width:300px;">
<center>DIINPUT OLEH,</center>
</td>
<td style="width: 300px;">
<center>DISERAHKAN OLEH</center>
</td>
<td style="width: 300px;">
<center>DITERIMA OLEH,</center>
</td>
<td style="width: 300px;">
<center>DIPERIKSA OLEH,</center>
</td>
<td style="width:50px;"></td> -->
    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

    <!-- <td style="width:20px;"></td>
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
<td style=" width: 115px;width: 115px;">
<center></center>
</td>
<td style=" width: 115px;width: 115px;">
<center></center>
</td>
<td style="width:20px;"></td> -->
    </tr>

</div>
<div class="break">
<!-- /////////////////////////////////////////////////////P/////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table style="float:left;">
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>

    <tr>
        <td colspan="3" style="text-align: left;">
            <?= $company; ?>
        </td>
        <td colspan="3" style="text-align: right;">
            Halaman : 1
        </td>
    </tr>

    <tr>
        <td colspan="3" style="text-align: left;">
            DARI DEPO: <?= $depoKirim; ?>
        </td>
    </tr>

    <tr>
        <td colspan="6" style="text-align: center;">
            &nbsp;<b style="font-size:15px;">BUKTI KELUAR BARANG (FRM.WO.12)</b>
        </td>
    </tr>

    <tr>
        <td style="text-align: left; width: 30px;">
            NAMA GUDANG
        </td>
        <td colspan="3" style="text-align: left; width: 100px;">
            : <?= $warehouse; ?>
        </td>
        <td style="text-align: left; ">
            DOKUMEN ID
        </td>
        <td style="text-align: left;">
            : <?= $bkbId; ?>
        </td>
    </tr>

    <tr>
        <td style="text-align: left; width: 30px;">
            KELUAR KE
        </td>
        <td colspan="3" style="text-align: left; width: 100px;">
            : <?= $partyId; ?> - <?= $depoKirim; ?>
        </td>
        <td style="text-align: left;">
            TANGGAL
        </td>
        <td style="text-align: left;">
            : <?= $date; ?>
        </td>
    </tr>

    <tr>
        <td style="text-align: left;width: 30px;">
            KETERANGAN
        </td>
        <td colspan="5" style="text-align: left;">
            : <?= $description; ?>
        </td>
    </tr>

    <tr></tr>
    <tr></tr>
    <tr></tr>


    <tr></tr>
    <tr></tr>
    <tr></tr>

    <tr>
        <td style="width:100px;"></td>
        <td style="width:300px;">
            <center>DIINPUT OLEH,</center>
        </td>
        <td style="width: 300px;">
            <center></center>
        </td>
        <td style="width: 300px;">
            <center>DIPERIKSA OLEH,</center>
        </td>
        <td style="width: 300px;">
            <center>DIKETAHUI OLEH,</center>
        </td>
        <td style="width:50px;"></td>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

        <!-- <td style="width:20px;"></td>
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
    <td style=" width: 115px;width: 115px;">
        <center></center>
    </td>
    <td style=" width: 115px;width: 115px;">
        <center></center>
    </td>
    <td style="width:20px;"></td> -->
    </tr>

    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>

    <tr>
        <td style="width:100px;"></td>
        <td style="width:300px;">
            <center>( WAREHOUSE ADMIN )</center>
        </td>
        <td style="width: 300px;">
            <center></center>
        </td>
        <td style="width: 300px;">
            <center>( CHECKER )</center>
        </td>
        <td style="width: 300px;">
            <center>( DRIVER )</center>
        </td>
        <td style="width:50px;"></td>
    </tr>
    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <tr>
        <td style="width:50px;"></td>
        <td style="width:300px;" rowspan="10">
            <center></center>
        </td>
        <td style="width: 300px;">
            <center></center>
        </td>
        <td style="width: 300px;" rowspan="5">
            <center></center>
        </td>
        <td style="width: 300px;">
            <center></center>
        </td>
        <td style="width:50px;"></td>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

        <td style="width:20px;"></td>
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
        <!-- <td style=" width: 115px;width: 115px;">
        <center></center>
    </td>
    <td style=" width: 115px;width: 115px;">
        <center></center>
    </td>
    <td style=" width: 115px;width: 115px;">
        <center></center>
    </td> -->
        <td style="width:20px;"></td>
    </tr>
    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <tr>
        <td style="width:50px;"></td>
        <td style="width:100px;">

        </td>
        <td style="width: 300px;">

        </td>
        <td style="width: 300px;">

        </td>
        <td style="width: 300px;">

        </td>
        <td style="width:50px;"></td>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

        <td style="width:20px;"></td>
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
        <td style=" width: 115px;width: 115px;">
            <center></center>
        </td>
        <td style=" width: 115px;width: 115px;">
            <center></center>
        </td>
        <td style="width:20px;"></td>
    </tr>
</table>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
</div>
    <?php }
    ?>

</body>

</html>