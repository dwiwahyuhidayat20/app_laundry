<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Tanggal Masuk</th>
                            <th>Kode Transaksi</th>
                            <th>Konsumen</th>
                            <th>Paket</th>
                            <th>Berat (KG)</th>
                            <th>Grand Total</th>
                            <th>Tanggal Ambil</th>
                            <th>Status Bayar</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>

                            <?php $no = 1;
                            foreach ($data as $row) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->tgl_masuk ?></td>
                                    <td><?= $row->kode_transaksi ?></td>
                                    <td><?= $row->nama_konsumen ?></td>
                                    <td><?= $row->nama_paket ?></td>
                                    <td><?= $row->berat ?></td>
                                    <td><?= "Rp." . number_format($row->grand_total, 0, '.', '.') ?></td>
                                    <td><?= $row->tgl_ambil ?></td>
                                    <td><?= $row->bayar ?></td>
                                    <td>
                                        <?= $row->status ?>
                                        <?php
                                        if ($row->status == "Baru") { ?>
                                            <select name="status" class="badge badge-danger status">
                                                <option value="<?= $row->kode_transaksi ?>Baru" selected>Baru</option>
                                                <option value="<?= $row->kode_transaksi ?>Proses">Proses</option>
                                                <option value="<?= $row->kode_transaksi ?>Selesai">Selesai</option>
                                            </select>
                                        <?php } else if ($row->status == "Proses") { ?>
                                            <select name="status" class="badge badge-warning status">
                                                <option value="<?= $row->kode_transaksi ?>Baru">Baru</option>
                                                <option value="<?= $row->kode_transaksi ?>Proses" selected>Proses</option>
                                                <option value="<?= $row->kode_transaksi ?>Selesai">Selesai</option>
                                            </select>
                                        <?php  } else { ?>
                                            <button class="btn btn-success btn-sm dropdown-toggle">Selesai</button>
                                        <?php }
                                        ?>
                                    </td>

                                    <?php
                                    if ($row->status == "Selesai") { ?>
                                        <td>
                                            <a href="<?= base_url() ?>transaksi/detail/<?= $row->kode_transaksi ?>" class="btn btn-warning btn-sm">Detail</a>
                                        </td>
                                    <?php  } else { ?>
                                        <td>
                                            <a href="<?= base_url() ?>transaksi/detail/<?= $row->kode_transaksi ?>" class="btn btn-warning btn-sm">Detail</a>
                                            <a href="<?= base_url() ?>transaksi/edit_transaksi/<?= $row->kode_transaksi ?>" class="btn btn-info btn-sm">Edit</a>
                                        </td>
                                    <?php }
                                    ?>


                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- <script src="/admin/vendor/jquery/jquery.min.js"></script> -->

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script>
        $('.status').change(function() {
        var status = $(this).val();
        var kt = status.substr(0,13);
        var stt = status.substr(13,10);
        
        $.ajax({    
            url : '<?= base_url('transaksi/update_status/') ?>',
            method : 'post',
            data : { kt:kt, stt:stt }


        });
            location.reload();
    });


    // $('#berat').keyup(function(){
    //     var berat = $(this).val();
    //     var harga = document.getElementById('harga').value;
    //     $('#grand_total').val(berat * harga);
    // });
</script>

</body>

</html>

