<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
include "koneksii2.php";
if (strlen($tanggal) < 1 || strlen($tanggal2) < 1) {
    echo "<script>alert('Pilih Format Tanggal Yang Benar')</script>";
} else {
    $no = 1;
    $sql = "CALL RL_3_13 ('" . $tanggal . "', '" . $tanggal2 . "');";
    $outp = array();
    // Execute multi query
    if (mysqli_multi_query($conn, $sql)) {
        do {
            // Store first result set
            if ($result = mysqli_store_result($conn)) {
                $outp[] = $result->fetch_all(MYSQLI_ASSOC);
                // Fetch one and one row
            }
        } while (mysqli_next_result($conn));
        foreach ($outp[0] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['item_gol'] . "</td>
            <td style='text-align: right;'>" . $data['sum_item'] . "</td>
            <td style='text-align: right;'>" . $data['sum_all'] . "</td>
            <td style='text-align: right;'>" . $data['sum_formula'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp[1] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['item_gol'] . "</td>
            <td style='text-align: right;'>" . $data['sum_item'] . "</td>
            <td style='text-align: right;'>" . $data['sum_all'] . "</td>
            <td style='text-align: right;'>" . $data['sum_formula'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp[2] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['item_gol'] . "</td>
            <td style='text-align: right;'>" . $data['sum_item'] . "</td>
            <td style='text-align: right;'>" . $data['sum_all'] . "</td>
            <td style='text-align: right;'>" . $data['sum_formula'] . "</td>
            </tr>";
            $no++;
        }
        echo "
        <tr>
        <td style='text-align: center;'>99</td>
        <td>TOTAL</td>
        <td id='jumlah1' style='text-align: right;'></td>
        <td id='jumlah2' style='text-align: right;'></td>
        <td id='jumlah3' style='text-align: right;'></td>
        </tr>";
    }
}

mysqli_close($conn);
