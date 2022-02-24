<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STOK MORPHING <?= $document; ?></title>
    <style>
        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
            /* background-color: #4CAF50; */
            color: black;
        }
    </style>
</head>

<body>
    <table style="width: 100%;">
        <tr>
            <td><b>TIRTA VARIA INTIPRATAMA</b></td>
            <td align="right"><b>HALAMAN : 1</b></td>
        </tr>
    </table>
    <div style="text-align:center">
        <h3> STOK MORPHING</h3>
    </div>
    <?php
    foreach ($load as $value) {
        $gudang = $value->gudang;
        $keterangan = $value->keterangan;
        $dokumen = $value->szDocId;
        $tanggal = date("d/m/Y", strtotime($value->refTanggal));
        $tipe = $value->stok;
        $noRef = $value->refOld;
    }
    ?>
    <table style="width: 100%;">
        <tr>
            <td>NAMA GUDANG</td>
            <td>: <?= $gudang; ?></td>
            <td>DOKUMEN ID</td>
            <td>: <?= $dokumen; ?></td>
        </tr>
        <tr>
            <td>NO. REFERENSI</td>
            <td>: <?= $noRef; ?></td>
            <td>TANGGAL</td>
            <td>: <?= $tanggal; ?></td>
        </tr>
        <tr>
            <td>KETERANGAN</td>
            <td>: <?= $keterangan; ?></td>
            <!-- <td></td>
            <td></td> -->
        </tr>
    </table>
    <br>
    <table id="table">
        <thead>
            <tr>
                <th>NO.</th>
                <th>PRODUK</th>
                <th>SATUAN</th>
                <th>QTY</th>
                <th>-></th>
                <th>PRODUK KE</th>
                <th>SATUAN KE</th>
                <th>QTY KE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($load as $value) { ?>
                <tr>
                    <td scope="row" align="center"><?= $no; ?></td>
                    <td align="center"><?= $value->szId; ?> - <?= $value->produk; ?></td>
                    <td align="center"><?= $value->satuan; ?></td>
                    <td align="center"><?= $value->decQty; ?></td>
                    <td>-></td>
                    <td align="center"><?= $value->kodeKe; ?> - <?= $value->produkKe; ?></td>
                    <td align="center"><?= $value->satuanKe; ?></td>
                    <td align="center"><?= $value->decQtyTo; ?></td>
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    <br><br>
    <table style="width: 100%;">
        <tr>
            <td align="center">DIBUAT OLEH, </td>
            <td align="center">DIPERIKSA OLEH, </td>
            <td align="center">DIKETAHUI OLEH, </td>
        </tr>
        <tr>
            <td><br><br><br><br></td>
            <td><br><br><br><br></td>
            <td><br><br><br><br></td>
        </tr>
        <tr>
            <td align="center">(WAREHOUSE ADMIN)</td>
            <td align="center">(CHECKER)</td>
            <td align="center">(DRIVER)</td>
        </tr>
    </table>
    <br>
    <div style="text-align:center">
        <p style="font-size: 11px;"> <?= $this->session->userdata('user_nama'); ?>, <?= date("d F Y / H:i:s"); ?></p>
    </div>
</body>

</html>