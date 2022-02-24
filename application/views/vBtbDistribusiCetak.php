<!DOCTYPE html>
<html>

<head>
    <title>Data BTB DISTRIBUSI <?= $btb; ?>
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
        $btbId = $val->szDocId;
        $date = date('d/m/Y', strtotime($val->dtmDoc));
        $user = $this->session->userdata('user_name');
        $branch = $val->branch;
        $stock = $val->szStockType;
    }
    ?>

    <?php
    if ($row != '8') { ?>

        <!-- <body> -->
        <div class="break">


            <!-- /////////////////////////////////////////////////////P/////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <table style="float:left;">
                <tr>
                    <td colspan="3" style="text-align: left;">
                        <?= $company; ?> - <?= $branch ?>
                    </td>
                    <td colspan="3" style="text-align: right;">
                        Halaman : 1
                    </td>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: center;">
                        &nbsp;<b style="font-size:15px;">BUKTI TERIMA BARANG (FRM.WO.12)</b>
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
                        : <?= $btbId; ?>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; width: 30px;">
                        PENGEMUDI
                    </td>
                    <td colspan="3" style="text-align: left; width: 100px;">
                        : <?= $employee; ?> - <?= $employeeName; ?>
                    </td>
                    <td style="text-align: left;">
                        TANGGAL
                    </td>
                    <td style="text-align: left;">
                        : <?= $date; ?>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; width: 30px;">
                        KENDARAAN
                    </td>
                    <td colspan="3" style="text-align: left; width: 100px;">
                        : <?= $vehicle; ?> - <?= $vehicleName; ?>
                    </td>
                    <td style="text-align: left; width: 30px;">
                        TIPE PERSEDIAAN
                    </td>
                    <td style="text-align: left; width: 30px;">
                        : <?= $stock; ?>
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
                        <td>
                            <center>
                                <?= $no; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= $value->szProductId; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= $value->product; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= $value->szUomId; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= (int)$value->decQty; ?>
                            </center>
                        </td>
                        <td>

                        </td>
                    </tr>
                <?php
                    $no++;
                }
                ?>


                <tr>
                    <td style="border-top: 0.6px dashed #000000;"></td>
                    <td style="border-top: 0.6px dashed #000000;"></td>
                    <td style="border-top: 0.6px dashed #000000;"></td>
                    <td style="border-top: 0.6px dashed #000000;"></td>
                    <td style="border-top: 0.6px dashed #000000;"></td>
                    <td style="border-top: 0.6px dashed #000000;"></td>
                </tr>
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
                        <center></center>
                    </td>
                    <td style="width:50px;">DIKETAHUI OLEH,</td>
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

                <tr>
                    <!-- <td style="width:3px;"></td> -->
                    <td style="width:500px;">
                        <center>( WAREHOUSE ADMIN )</center>
                    </td>
                    <td style="width: 300px;">
                        <center></center>
                    </td>
                    <td style="width: 300px;">
                        <center>( CHECKER )</center>
                    </td>
                    <td style="width: 300px;">
                        <center></center>
                    </td>
                    <td style="width:50px;">( DRIVER )</td>
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
    <?php } else {
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
                    <td colspan="6" style="text-align: center;">
                        &nbsp;<b style="font-size:15px;">BUKTI TERIMA BARANG (FRM.WO.12)</b>
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
                        : <?= $btbId; ?>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; width: 30px;">
                        PENGEMUDI
                    </td>
                    <td colspan="3" style="text-align: left; width: 100px;">
                        : <?= $employee; ?> - <?= $employeeName; ?>
                    </td>
                    <td style="text-align: left;">
                        TANGGAL
                    </td>
                    <td style="text-align: left;">
                        : <?= $date; ?>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; width: 30px;">
                        KENDARAAN
                    </td>
                    <td colspan="3" style="text-align: left; width: 100px;">
                        : <?= $vehicle; ?> - <?= $vehicleName; ?>
                    </td>
                    <td style="text-align: left; width: 30px;">
                        NO. PB
                    </td>
                    <td style="text-align: left; width: 30px;">
                        : <?= $pbId; ?>
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
                        <td>
                            <center>
                                <?= $no; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= $value->szProductId; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= $value->product; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= $value->szUomId; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= $value->decQty; ?>
                            </center>
                        </td>
                        <td>

                        </td>
                    </tr>
                <?php
                    $no++;
                }
                ?>

                <tr>
                    <td style="border-top: 0.6px dashed #000000;"></td>
                    <td style="border-top: 0.6px dashed #000000;"></td>
                    <td style="border-top: 0.6px dashed #000000;"></td>
                    <td style="border-top: 0.6px dashed #000000;"></td>
                    <td style="border-top: 0.6px dashed #000000;"></td>
                    <td style="border-top: 0.6px dashed #000000;"></td>
                </tr>
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

                <!-- <tr></tr>
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
        <center>( CHECKER (DLM) )</center>
    </td>
    <td style="width: 300px;">
        <center>( DRIVER )</center>
    </td>
    <td style="width: 300px;">
        <center>( CHECKER (LR) )</center>
    </td>
    <td style="width:50px;"></td>
</tr> -->
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- <tr>
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
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
    </td> -->
                <!-- <td style="width:20px;"></td>
</tr>  -->
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- <tr>
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
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
</table> -->
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

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
                    <td colspan="6" style="text-align: center;">
                        &nbsp;<b style="font-size:15px;">BUKTI TERIMA BARANG (FRM.WO.12)</b>
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
                        : <?= $btbId; ?>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; width: 30px;">
                        PENGEMUDI
                    </td>
                    <td colspan="3" style="text-align: left; width: 100px;">
                        : <?= $employee; ?> - <?= $employeeName; ?>
                    </td>
                    <td style="text-align: left;">
                        TANGGAL
                    </td>
                    <td style="text-align: left;">
                        : <?= $date; ?>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; width: 30px;">
                        KENDARAAN
                    </td>
                    <td colspan="3" style="text-align: left; width: 100px;">
                        : <?= $vehicle; ?> - <?= $vehicleName; ?>
                    </td>
                    <td style="text-align: left; width: 30px;">
                        NO. PB
                    </td>
                    <td style="text-align: left; width: 30px;">
                        : <?= $pbId; ?>
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
                        <center>DISERAHKAN OLEH</center>
                    </td>
                    <td style="width: 300px;">
                        <center>DITERIMA OLEH,</center>
                    </td>
                    <td style="width: 300px;">
                        <center>DIPERIKSA OLEH,</center>
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
                        <center>( CHECKER (DLM) )</center>
                    </td>
                    <td style="width: 300px;">
                        <center>( DRIVER )</center>
                    </td>
                    <td style="width: 300px;">
                        <center>( CHECKER (LR) )</center>
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
        </div>
    <?php
    }
    ?>

</body>

</html>