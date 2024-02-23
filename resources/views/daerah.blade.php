@extends('master')

@section('css')

@endsection

@section('konten')
<div class="container-xl">
    <div class='row'>
        <div class="col-12 col-lg-4 col-md-12">
            <div class="form-label">Silahkan Pilih Provinsi</div>
            <select class="searchProvinsi form-control" onchange="getDaerah(this)" id="searchProvinsi" name="searchProvinsi"></select>
        </div>

        <div class="col-12 col-lg-4 col-md-12">
            <div class="form-label">Silahkan Pilih Kabupaten</div>
            <select class="searchDaerah form-control" onchange="getDapil(this)" id="searchDaerah" name="searchDaerah"></select>
        </div>

        <div class="col-12 col-lg-4 col-md-12">
            <div class="form-label">Silahkan Pilih Dapil</div>
            <select class="searchDapil form-control" id="searchDapil" name="searchDapil"></select>
        </div>

        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <div id="chartPusat"></div>
                    <span id="timedata">Data diambil pada pukul : </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-12 col-md-12 mt-3">
            <h2>Alokasi kursi pada dapil ini : <span id="kursiDapil">-</span> Kursi</h2>
            <div id="tableOverview" class="col-12 col-lg-12 col-md-12  row">

            </div>
        </div>

        <div class="col-12 col-lg-12 col-md-12 mt-3 row">
            <h2>Detail Perolehan Suara</h2>
            <span>*)Nama Calon Legislatif yang ditebalkan merupakan Calon Legislatif yang terpilih (melalui perhitungan Sainte Lague)</span>
            <div id="tableCaleg" class="col-12 col-lg-12 col-md-12  row">

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

    var idPartai = [];
    var namaPartai = [];
    var nomorUrut = [];
    var warna = [];
    var namaPartaiNasional = [];
    var nomorUrutNasional = [];
    var warnaNasional = [];
    var dataPartai;
    var dataTable;
    var dataCaleg;
    var kursiDapil = 0;
    var dataSuaraPartai = [];
    var kodeProvinsi = 11;
    var kodeDaerah = 01;

    $(document).ready(function() {

        $.ajax({
            url: `https://sirekap-obj-data.kpu.go.id/pemilu/partai.json`,
            dataType: 'json',
            success: function(data) {
                dataPartai = data;
                for (var key in data) {
                    if (data.hasOwnProperty(key)) {
                        var item = data[key];

                        namaPartai.push(item.nama);
                        nomorUrut.push(item.nomor_urut);
                        warna.push(item.warna);
                        idPartai.push(item.id_pilihan)

                        if (!item.is_aceh) {
                            namaPartaiNasional.push(item.nama);
                            nomorUrutNasional.push(item.nomor_urut);
                            warnaNasional.push(item.warna);
                        }
                    }
                }

                //console.log("Nama Partai:", namaPartai);
                //console.log("Warna Partai Nasional:", warnaNasional);
            },
            error: function(xhr, status, error) {
                console.error('Failed to load data:', status, error);
            }
        });

        $.ajax({
            url: 'https://sirekap-obj-data.kpu.go.id/wilayah/pemilu/ppwp/0.json',
            dataType: 'json',
            success: function(data) {
                // Populate options using Chosen.js
                data.forEach(function(item) {
                    if(item.nama!='Luar Negeri' && item.nama!='DKI JAKARTA'){
                        $('#searchProvinsi').append('<option value="' + item.kode + '">' + item.nama + '</option>');
                    }
                });

                // Initialize Chosen.js
                $('#searchProvinsi').chosen({
                    search_contains: true // Enable search for partial matches
                });

                $('#searchProvinsi').trigger('change');

            },
            error: function(xhr, status, error) {
                console.error('Failed to load data:', status, error);
            }
        });

        $('#searchDaerah').chosen({
            search_contains: true // Enable search for partial matches
        });

        $('#searchDapil').chosen({
            search_contains: true // Enable search for partial matches
        });




        $('#searchDapil').on('change', function() {
            $('#tableCaleg').html("<span>Sedang Memuat Data...</span>");
            $('#tableOverview').html("<span>Sedang Memuat Data...</span>");
            var selectedValue = $(this).val();
            var selectedText = $(this).find('option:selected').text();
            //console.log('Nilai yang dipilih: ', selectedValue);

            getSuaraDapil(selectedValue);

            var namadaerah = $('#searchDaerah').find('option:selected').text();
            getKursiDapil(namadaerah,selectedText);

            setTimeout(function (){
                getCalegDapil(selectedValue);
            }, 1000);

        });

    });

    function getDaerah(sel){
            kodeProvinsi = sel.value;
            $('#searchDaerah').empty();
            $.ajax({
                url: `https://sirekap-obj-data.kpu.go.id/wilayah/pemilu/ppwp/${kodeProvinsi}.json`,
                dataType: 'json',
                success: function(data) {
                    // Populate options using Chosen.js
                    data.forEach(function(item) {
                        $('#searchDaerah').append('<option value="' + item.kode + '">' + item.nama + '</option>');
                    });

                    // Initialize Chosen.js
                    $('#searchDaerah').chosen({
                        search_contains: true // Enable search for partial matches
                    });

                    $("#searchDaerah").trigger("chosen:updated");

                    $('#searchDaerah').trigger('change');

                },
                error: function(xhr, status, error) {
                    console.error('Failed to load data:', status, error);
                }
            });
    }

    function getDapil(sel){
            kodeDaerah = sel.value;
            $('#searchDapil').empty();
            $.ajax({
                url: `https://sirekap-obj-data.kpu.go.id/wilayah/pemilu/pdprdk/${kodeProvinsi}/${kodeDaerah}.json`,
                dataType: 'json',
                success: function(data) {
                    // Populate options using Chosen.js
                    data.forEach(function(item) {
                        $('#searchDapil').append('<option value="' + item.kode_dapil + '">' + item.nama_dapil + '</option>');
                    });

                    // Initialize Chosen.js
                    $('#searchDapil').chosen({
                        search_contains: true // Enable search for partial matches
                    });

                    $("#searchDapil").trigger("chosen:updated");

                    getSuaraDapil(data[0].kode_dapil);

                    var namadaerah = $('#searchDaerah').find('option:selected').text();

                    getKursiDapil(namadaerah,data[0].nama_dapil);

                    setTimeout(function (){
                        getCalegDapil(data[0].kode_dapil);
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    console.error('Failed to load data:', status, error);
                }
            });
    }

    function getSuaraDapil(kode){
        $.ajax({
            url: `https://sirekap-obj-data.kpu.go.id/pemilu/hhcd/pdprdk/${kodeProvinsi}/${kodeDaerah}/${kode}.json`,
            dataType: 'json',
            success: function(data) {
                dataTable = data.table
                delete data.chart.persen;
                dataSuaraPartai.splice(0, dataSuaraPartai.length);

                for (var key in data.chart) {
                    if (data.chart.hasOwnProperty(key)) {
                        dataSuaraPartai.push({ label: key, suara: data.chart[key] });
                    }
                }

                // Membuat array dari objek data untuk digunakan oleh ApexCharts
                var seriesData = Object.keys(data.chart).map(function(key) {
                    return data.chart[key];
                });

                var persen = data.progres.progres/data.progres.total*100;
                $('#timedata').html(`Versi Data : ${data.ts} WIB, Jumlah TPS masuk ${data.progres.progres}/${data.progres.total} (${persen.toFixed(2)}%)`)

                if(kodeProvinsi==11){
                    var options = {
                        chart: {
                            type: 'bar',
                            height: 400,
                            animations: {
                                enabled: true
                            }
                        },
                        series: [{
                            name: 'Jumlah Suara',
                            data: seriesData
                        }],
                        xaxis: {
                            categories: namaPartai,
                            labels: {
                                show: false
                            }
                        },
                        plotOptions: {
                            bar: {
                                distributed: true
                            }
                        },
                        colors: warna,
                        dataLabels: {
                            enabled: false,
                        }
                    };
                }else{
                    var options = {
                        chart: {
                            type: 'bar',
                            height: 400,
                            animations: {
                                enabled: true
                            }
                        },
                        series: [{
                            name: 'Jumlah Suara',
                            data: seriesData
                        }],
                        xaxis: {
                            categories: namaPartaiNasional,
                            labels: {
                                show: false
                            }
                        },
                        plotOptions: {
                            bar: {
                                distributed: true
                            }
                        },
                        colors: warnaNasional,
                        dataLabels: {
                            enabled: false,
                        }
                    };
                }

                 if (window.chartPusat) {
                    // Menggunakan destroy() hanya jika chartPusat adalah instance dari ApexCharts
                    if (window.chartPusat instanceof ApexCharts) {
                        window.chartPusat.destroy();
                    }
                }

                var chart = new ApexCharts(document.querySelector("#chartPusat"), options);
                chart.render();

                window.chartPusat = chart;
            },
            error: function(xhr, status, error) {
                console.error('Failed to load data:', status, error);
            }
        });
    }

    function getKursiDapil(kode,namadapil){
        var noDapil = namadapil.match(/\d+/);
        $.ajax({
            url: `{{ URL::to('/') }}/dapil/daerah/${kode}`,
            dataType: 'json',
            success: function(data) {
                var dapil = 'dapil_' + noDapil;
                kursiDapil = data[dapil]
                $('#kursiDapil').html(data[dapil]);
            },
            error: function(xhr, status, error) {
                console.error('Failed to load data:', status, error);
            }
        });
    }

    function getCalegDapil(kode){
        $.ajax({
            url: `https://sirekap-obj-data.kpu.go.id/pemilu/caleg/partai/${kode}.json`,
            dataType: 'json',
            success: function(data) {
                //console.log("dataTable")
                //console.log(dataTable)
                dataCaleg = data;
                var html = '';
                for(i=0;i<idPartai.length;i++){
                    if(data[`${idPartai[i]}`]){
                        var suaraTotal = dataTable[`${idPartai[i]}`]['jml_suara_total'];
                        var suaraPartai = dataTable[`${idPartai[i]}`]['jml_suara_partai'];

                        html += `<div class="col-lg-6 mt-3">
                                    <div class="card" style="height:100%">
                                        <div class="card-body">
                                            <h3 class="card-title" style="margin-bottom:0px !important"><b>${namaPartai[i]} <span id="kursi${idPartai[i]}"></span></b></h3>
                                            <span style="font-size:12px">Total Suara : ${suaraTotal}</span>
                                            <table class="table table-sm table-borderless mt-1">
                                            <thead>
                                                <tr>
                                                <th>Nama Calon Legislatif</th>
                                                <th class="text-end">Jumlah Suara</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;

                                for (var key in data[`${idPartai[i]}`]) {

                                    if (data[`${idPartai[i]}`].hasOwnProperty(key)) {
                                        var obj = data[`${idPartai[i]}`][key];
                                        var persenSuara = parseFloat(dataTable[`${idPartai[i]}`][key])/parseFloat(suaraTotal)*100;
                                        //console.log(dataTable[`${idPartai[i]}`][key])
                                        html += `<tr id="${key}">
                                                    <td>
                                                        <div class="progressbg">
                                                        <div class="progress progressbg-progress">
                                                            <div class="progress-bar bg-primary-lt" style="width: ${persenSuara}%" role="progressbar" aria-valuenow="${persenSuara}" aria-valuemin="0" aria-valuemax="100" aria-label="${persenSuara}% Complete">
                                                            </div>
                                                        </div>
                                                        <div class="progressbg-text" style="white-space: pre-wrap;font-size:12px">${obj.nama}</div>
                                                        </div>
                                                    </td>
                                                    <td class="w-1 fw-bold text-end">${dataTable[`${idPartai[i]}`][key]}</td>
                                                </tr>`;
                                    }
                                }

                                    html +=  `</tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>`
                    }
                }

                $('#tableCaleg').html(html);
                hitungSainteLague();
            },
            error: function(xhr, status, error) {
                console.error('Failed to load data:', status, error);
            }
        });
    }

    function hitungSainteLague(){
        const parlement = saintLague(kursiDapil, dataSuaraPartai);
        var html = '';
        var urut = 1;
        html += `<div class="col-lg-12 mt-1">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-sm table-borderless mt-1">
                                            <thead>
                                                <tr>
                                                <th>Nama Calon Legislatif</th>
                                                <th>Partai</th>
                                                <th class="text-end">Jumlah Suara</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;
        for(i=0;i<parlement.length;i++){
            if(parlement[i].kursi!=0){
                //console.log(parlement[i].label,' ',parlement[i].kursi);
                $(`#kursi${parlement[i].label}`).html(`<mark style="background-color:#a4e5bb">(${parlement[i].kursi} Kursi)</mark>`);

                var topKeys = findTopKeys(dataTable[`${parlement[i].label}`],parlement[i].kursi);

                for(j=0;j<topKeys.length;j++){
                    //console.log(`ID Caleg Lolos : ${topKeys[j][0]}, Nama :  ${dataCaleg[parlement[i].label][topKeys[j][0]]['nama']}, Suara : ${dataTable[parlement[i].label][topKeys[j][0]]}, Partai : ${dataPartai[parlement[i].label]['nama']}`)
                    makeRowBold(`${topKeys[j][0]}`)
                    html += `<tr>
                                <td class="w-1 fw-bold">${urut}. ${dataCaleg[parlement[i].label][topKeys[j][0]]['nama']}</td>
                                <td class="w-1 fw-bold">${dataPartai[parlement[i].label]['nama']}</td>
                                <td class="w-1 fw-bold text-end">${dataTable[parlement[i].label][topKeys[j][0]]}</td>
                            </tr>`;
                    urut++;
                }
            }
        }

        html +=  `</tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>`;
        $('#tableOverview').html(html);
    }

    function findTopKeys(obj, n) {
        // Menghapus kunci jml_suara_total dan jml_suara_partai jika ada
        delete obj.jml_suara_total;
        delete obj.jml_suara_partai;

        // Mengambil semua kunci dan nilai objek sebagai array
        var entries = Object.entries(obj);

        // Mengurutkan array berdasarkan nilai dalam urutan menurun
        entries.sort((a, b) => b[1] - a[1]);

        // Mengambil n kunci dengan nilai tertinggi
        var topKeys = entries.slice(0, n);

        // Mengembalikan array kunci dengan nilai tertinggi
        return topKeys;
    }

    function makeRowBold(trId) {
        var trElement = document.getElementById(trId);
        if (trElement) {
            trElement.style.fontWeight = "900";
        } else {
            console.error("Row with id " + trId + " not found.");
        }
    }

</script>
@endsection
