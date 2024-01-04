<!-- MASIH BERMASALAH DI BAGIAN AMBIL DATANYA, NGGA MAU TAMPIL DIA, DAN TOMBOL KEMBALI + PERBARUI DATA TU NGGA MAU JUGA AKU TIDAK PAHAM :) -->

<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        if (localStorage.getItem('token') == null) {
            window.location.href = '/';
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KRS</title>
    <link rel="stylesheet" type="text/css" href="/resource/styles/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">SIMAKKU</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="/Dashboard">
                    <i class='bx bxs-group'></i>
                    <span class="text">Daftar Mahasiswa</span>
                </a>
            </li>
            <li>
                <a href="/matakuliah">
                    <i class='bx bxs-book-open'></i>
                    <span class="text">Mata Kuliah</span>
                </a>
            </li>
            <li>
                <a href="/krs">
                    <i class='bx bx-sitemap'></i>
                    <span class="text">KRS</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a id="logout-button" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>


    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
        </nav>

        <main>
            <div class="head-title">
                <div class="left">
                    <h2>Kartu Hasil Studi</h2>
                    <ul class="breadcrumb">
                        <li>
                            <a href="">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a href="">KRS</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>

                        <li>
                            <a class="active" href="#">Detail</a>
                        </li>
                    </ul>
                </div>
                <div class="tombol-group">
                    <a id="kembali" class="btn-tambah-data">
                        <i class="fas fa-arrow-left"></i>
                        <span class="text">Kembali</span>
                    </a>
                </div>
            </div>

            <br>
            <p id="head-nama"></p>
            <p id="head-nim"></p>
            <p id="tahun-ajaran"></p>
            <p id="semester"></p>
            <p id="ips"></p>

            <div class="table-data">
                <div class="data">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Matakuliah</th>
                                <th>Nilai</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </section>
</body>

<script src="..\..\resource\javascript\script.js"></script>
<script src="https://kit.fontawesome.com/5798d03461.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var totalSks = 0;
    var totalNilai = 0;
    var pathParts = window.location.pathname.split('/');
    var krsId = pathParts[pathParts.length - 2];
    var mhsId = pathParts[pathParts.length - 1];

    var kembali = document.getElementById('kembali');
    kembali.href = '/khs/' + mhsId;

    document.getElementById('logout-button').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default action

        // Show confirmation dialog
        if (confirm('Are you sure you want to log out?')) {
            axios.get('https://api-group3-prognet.manpits.xyz/api/logout', {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem(
                            'token') // Use the token from local storage
                    }
                })
                .then(function(response) {
                    // Handle successful logout (e.g., redirect to login page)
                    console.log(response.data);
                    localStorage.removeItem('token'); // Remove the token from local storage
                    window.location.href = '/'; // Redirect to login page
                })
                .catch(function(error) {
                    // Handle logout error
                    console.error(error.response.data);
                });
        }
    });


    axios.get('https://api-group3-prognet.manpits.xyz/api/detilkrs', {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token') // Include token from localStorage
            }
        })
        .then(function(response) {
            // Handle successful response
            var detail = response.data;
            var tableBody = document.querySelector('tbody');

            var rowIndex = 1;
            detail.forEach(function(dtl, index) {
                if (dtl.mahasiswa_id == mhsId && dtl.krs_id == krsId) {
                    var row = document.createElement('tr');
                    var iterationCell = document.createElement('td');
                    var kodeMatkulCell = document.createElement('td');
                    var namaMatkulCell = document.createElement('td');
                    var nilaiCell = document.createElement('td');
                    var gradeCell = document.createElement('td');

                    let grade;
                    switch (true) {
                        case (dtl.nilai >= 80 && dtl.nilai <= 100):
                            grade = 'A';
                            break;
                        case (dtl.nilai >= 75 && dtl.nilai < 80):
                            grade = 'B+';
                            break;
                        case (dtl.nilai >= 69 && dtl.nilai < 75):
                            grade = 'B';
                            break;
                        case (dtl.nilai >= 60 && dtl.nilai < 69):
                            grade = 'C+';
                            break;
                        case (dtl.nilai >= 55 && dtl.nilai < 60):
                            grade = 'C';
                            break;
                        case (dtl.nilai >= 50 && dtl.nilai < 55):
                            grade = 'D+';
                            break;
                        case (dtl.nilai >= 44 && dtl.nilai < 50):
                            grade = 'D';
                            break;
                        default:
                            grade = 'E';
                    }

                    iterationCell.textContent = rowIndex;
                    rowIndex++;
                    nilaiCell.textContent = dtl.nilai;
                    gradeCell.textContent = grade;

                    axios.get('https://api-group3-prognet.manpits.xyz/api/matakuliah/' + dtl
                            .matakuliah_id, {
                                headers: {
                                    'Authorization': 'Bearer ' + localStorage.getItem(
                                        'token') // Include token from localStorage
                                }
                            })
                        .then(function(response) {
                            // Handle successful response
                            var matakuliah = response.data;

                            // Set the kodeMatkul and namaMatkul values
                            kodeMatkulCell.textContent = matakuliah.kode;
                            namaMatkulCell.textContent = matakuliah.namamatakuliah;

                            let poin;
                            switch (true) {
                                case (dtl.nilai >= 80 && dtl.nilai <= 100):
                                    poin = 4;
                                    break;
                                case (dtl.nilai >= 75 && dtl.nilai < 80):
                                    poin = 3.5;
                                    break;
                                case (dtl.nilai >= 69 && dtl.nilai < 75):
                                    poin = 3;
                                    break;
                                case (dtl.nilai >= 60 && dtl.nilai < 69):
                                    poin = 2.5;
                                    break;
                                case (dtl.nilai >= 55 && dtl.nilai < 60):
                                    poin = 2;
                                    break;
                                case (dtl.nilai >= 50 && dtl.nilai < 55):
                                    poin = 1.5;
                                    break;
                                case (dtl.nilai >= 44 && dtl.nilai < 50):
                                    poin = 1;
                                    break;
                                default:
                                    poin = 0;
                            }
                            totalSks += parseInt(matakuliah.sks);
                            totalNilai += poin * parseInt(matakuliah.sks);
                            console.log(totalNilai);
                            console.log(totalSks);
                        })
                        .catch(function(error) {
                            // Handle error
                            console.error(error.response.data);
                        });

                    row.appendChild(iterationCell);
                    row.appendChild(kodeMatkulCell);
                    row.appendChild(namaMatkulCell);
                    row.appendChild(nilaiCell);
                    row.appendChild(gradeCell);

                    tableBody.appendChild(row);
                }
            });
        })
        .then(function() {
            displayDetails();
        })
        .catch(function(error) {
            // Handle error
            console.error(error);
        });


    // Move the block inside a function
    function displayDetails() {
        axios.get('https://api-group3-prognet.manpits.xyz/api/mahasiswa/' + mhsId, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token') // Include token from localStorage
                }
            })
            .then(function(response) {
                // Handle successful response
                var mahasiswa = response.data;

                axios.get('https://api-group3-prognet.manpits.xyz/api/krs/' + krsId, {
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem(
                                'token') // Include token from localStorage
                        }
                    })
                    .then(function(response) {
                        // Handle successful response
                        var krs = response.data;

                        ips = totalNilai / totalSks;

                        // Display the tahun ajaran details
                        var tahunAjaranElement = document.createElement('p');
                        var headnamaElement = document.createElement('p');
                        var headnimElement = document.createElement('p');
                        var semesterElement = document.createElement('p');
                        var ipsElement = document.createElement('p');

                        tahunAjaranElement.textContent = 'Tahun Ajaran : ' + krs.tahun;
                        headnamaElement.textContent = 'Nama : ' + mahasiswa.nama;
                        headnimElement.textContent = 'NIM : ' + mahasiswa.nim;
                        semesterElement.textContent = 'Semester : ' + krs.semester;
                        ipsElement.textContent = 'IPS : ' + ips.toFixed(2);

                        var HeaderElement = document.getElementById('tahun-ajaran');
                        var HeaderElement = document.getElementById('semester');
                        var HeaderElement = document.getElementById('head-nama');
                        var HeaderElement = document.getElementById('head-nim');
                        var HeaderElement = document.getElementById('ips');

                        HeaderElement.appendChild(headnamaElement);
                        HeaderElement.appendChild(headnimElement);
                        HeaderElement.appendChild(tahunAjaranElement);
                        HeaderElement.appendChild(semesterElement);
                        HeaderElement.appendChild(ipsElement);
                    })
                    .catch(function(error) {
                        // Handle error
                        console.error(error);
                    });
            })
            .catch(function(error) {
                // Handle error
                console.error(error);
            });
    }

</script>
</html>
