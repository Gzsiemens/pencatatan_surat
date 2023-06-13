<!DOCTYPE html>
<html>

<head>
    <title>Surat Keluar</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>SMK PENERBANGAN</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Surat Keluar</h3>
            </div>
        </div>
        <hr>
        <div class="row">

            <div class="col-xs-12 ">
                <h4>Tanggal Surat: {{$surat->letter_date_o}}</h4>
            </div>

        </div>

        <div class="row">

            <div class="col-xs-6 text-left">
                <h4>No Surat: {{$surat->reference_number_o}}</h4>
            </div>
            <div class="col-xs-6 text-left">
                <h4>Kepada: {{$surat->to}}</h4>
            </div>
        </div>



        <div class="row">
            <div class="col-xs-6 text-left">
                <h4>Kode Surat: {{$surat->description_letter_code}}</h4>
            </div>
            <div class="col-xs-6 text-left">
                <h4>Status: {{$surat->status}}</h4>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-6 text-left">
                <h4>Perihal: {{$surat->description_o}}</h4>
            </div>
            <div class="col-xs-6 text-left">
                <h4>Keterangan Disposisi: {{$surat->status_description}}</h4>
            </div>

        </div>
    </div>
</body>

</html>
