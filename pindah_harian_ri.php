<?php
$tanggal = $_POST['tanggal'];
$unit = $_POST['unit'];
include "koneksii2.php";
$no = 1;
$sql = "CALL sensusHarianRI ($unit, '" . $tanggal . "');";
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
    foreach ($outp[3] as $data) {
        echo "
                                                        <tr>
                                                        <td>" . $no . "</td>
                                                        <td>" . $data['tanggal'] . "</td>
                                                        <td>" . $data['norm'] . "</td>
                                                        <td>" . $data['nama'] . "</td>
                                                        <td>" . $data['sex'] . "</td>
                                                        <td>" . $data['usia'] . "</td>
                                                        <td>" . $data['alamat'] . "</td>
                                                        <td>" . $data['unit'] . "</td>
                                                        <td>" . $data['kelas'] . "</td>
                                                        <td>" . $data['jaminan'] . "</td>
                                                        <td>" . $data['dpjp'] . "</td>
                                                        <td>" . $data['icd'] . "</td>
                                                        </tr>";
        $no++;
    }
}

mysqli_close($conn);
