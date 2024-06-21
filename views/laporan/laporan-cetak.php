<?php

use app\components\Helper;

?>
<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>
<div>
    <table border='1' id="customers" width="100%">
        <thead>
            <tr>
                <th width='5%'>No</th>
                <th style="text-align: center;">Nama</th>
                <th style="text-align: center;">Nip</th>
                <th style="text-align: center;">Kehadiran</th>
                <th style="text-align: center;">Datang Telat</th>
                <th style="text-align: center;">Pulang Cepat</th>
                <th style="text-align: center;">Kelebihan Jam Kerja</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($model as $itemAbsen) {
            ?>

                <tr>
                    <td><?= $no ?></td>
                    <td><?= $itemAbsen->nip_nik ?></td>
                    <td><?= $itemAbsen->nip_nik ?></td>
                    <td>20</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            <?php $no++;
            } ?>
        </tbody>
    </table>
</div>