<?php require "template/template_verifikator/header.php" ?>
<script>
    function printContent(el) {
        $('#tanggal_tampil').text($('#tanggal').val());
        $('#tanggal2_tampil').text($('#tanggal2').val());
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
<main>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">B. Data Pasien Berdasarkan Usia</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="export13.php" id="cari" method="post" class="form-inline">
                    <h5 class="m-0 font-weight-bold text-primary">Pilih Tanggal :</h5>
                    <div class="form-group mx-sm-3">
                        <input id="tanggal" name="tanggal" type="text" class="form-control" placeholder="Tanggal" style="text-align: center;" autocomplete="off" required />
                    </div>
                    <h5 class="m-0 font-weight-bold text-primary">s/d</h5>
                    <div class="form-group mx-sm-3">
                        <input id="tanggal2" name="tanggal2" type="text" class="form-control" placeholder="Tanggal" style="text-align: center;" autocomplete="off" required />
                    </div>
                    <button id="submit" type="submit" class="btn btn-primary">Cari</button>
                    <div class="form-group mx-sm-2">
                        <button id="submit2" type="submit" class="btn btn-primary">Export to Excel</button>
                    </div>
                    <div class="form-group">
                        <button id="print" onclick="printContent('tabel_usia')" class="btn btn-primary">Print</button>
                    </div>
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive" id="tabel_usia">
                    <p style="color:black; font-weight:bolder; font-size:larger">Tanggal : <span id="tanggal_tampil"></span> s/d <span id="tanggal2_tampil"></span></p>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</main>
<?php require "template/template_verifikator/footer.php" ?>
<script>
    $(function() {
        $('#tanggal').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    })

    $(function() {
        $('#tanggal2').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    })

    $('body').on('click', '#submit', function(e) {
        e.preventDefault();
        $('#tanggal_tampil').text($('#tanggal').val());
        $('#tanggal2_tampil').text($('#tanggal2').val());
        $('#loader-container').toggleClass('d-block')
        $('#tabel_usia').html('');
        var tanggal1 = $('#tanggal').val()
        var tanggal2 = $('#tanggal2').val()
        console.log(tanggal1, tanggal2)
        $.ajax({
            url: 'proses_datapasienUsia.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                tanggal2: tanggal2
            },
            dataType: 'html',
            success: function(data) {

                $('#tabel_usia').html(data);
                $('#loader-container').toggleClass('d-block');
                hitungJumlah()
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
    })

    function hitungJumlah() {
        var jumlah = 0;
        $("body #laborat tr")
            .not(":last")
            .each(function(e) {
                var cekAngka = parseInt($(this).find("td:eq(2)").text())
                var angkaKonversi = isNaN(cekAngka) ? 0 : cekAngka;
                jumlah += angkaKonversi;
            });
        $("#jumlah").text(jumlah);
    }
    hitungJumlah();
</script>