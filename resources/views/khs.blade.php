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
    <link rel="stylesheet" type="text/css" href="..\resource\styles\styles.css">
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

    <!-- CONTENT -->
    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
        </nav>

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1 id="daftar-mahasiswa">Biodata Mahasiswa</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a href="">Daftar Mahasiswa</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="">Biodata Mahasiswa</a>
                        </li>
                    </ul>
                </div>
                <div class="tombol-group">
                    <a href="/Dashboard" class="btn-tambah-data">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="table-data">
                <div class="data">
                    <table>
                        <tbody>
                            <tr>
                                <td class="label">Nama</td>
                                <td class="data" id="nama"></td>
                            </tr>
                            <tr>
                                <td class="label">NIM</td>
                                <td class="data" id="nim"></td>
                            </tr>
                            <tr>
                                <td class="label">Alamat</td>
                                <td class="data" id="alamat"></td>
                            </tr>
                            <tr>
                                <td class="label">Tanggal Lahir</td>
                                <td class="data" id="lahir"></td>
                            </tr>
                            <tr>
                                <td class="label">Agama</td>
                                <td class="data" id="agama"></td>
                            </tr>
                            <tr>
                                <td class="label">IPK</td>
                                <td class="data" id="ipk"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <br>
            <br>
            <br>

            <div class="left">
                <h1 id="daftar-mahasiswa">Kartu Hasil Studi</h1>
            </div>
            <div class="table-data">
                <div class="data">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tahun Ajaran</th>
                                <th>Semester</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="list-krs">
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </section>
</body>

<script src="../resource/javascript/script.js"></script>
<script src="https://kit.fontawesome.com/5798d03461.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var mahasiswaId = window.location.pathname.split('/').pop();
    var token = localStorage.getItem('token');

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

    axios.get('https://api-group3-prognet.manpits.xyz/api/mahasiswa/' + mahasiswaId, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(function(response) {
            // Store the agama_id of the mahasiswa
            const mahasiswaData = response.data;
            const mahasiswaAgamaId = response.data.agama_id;

            // Fetch the agama options
            return axios.get('https://api-group3-prognet.manpits.xyz/api/agama', {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    }
                })
                .then(function(response) {
                    // Handle successful response
                    const agamas = response.data;

                    document.getElementById('nama').textContent = mahasiswaData.nama;
                    document.getElementById('nim').textContent = mahasiswaData.nim;
                    document.getElementById('alamat').textContent = mahasiswaData.alamat;
                    const birthDate = new Date(mahasiswaData.lahir);
                    const options = {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    };
                    document.getElementById('lahir').textContent = birthDate.toLocaleDateString('id-ID',
                        options);

                    for (const agama of agamas) {
                        if (agama.id == mahasiswaAgamaId) {
                            document.getElementById('agama').textContent = agama.agama;
                        }
                    }

                    return axios.get('https://api-group3-prognet.manpits.xyz/api/detilkrs', {
                            headers: {
                                'Authorization': 'Bearer ' + localStorage.getItem('token')
                            }
                        })
                        .then(function(response) {
                            const krs = response.data;

                            return axios.get('https://api-group3-prognet.manpits.xyz/api/matakuliah', {
                                    headers: {
                                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                                    }
                                })
                                .then(function(response) {
                                    const matakuliah = response.data;

                                    let totalSks = 0;
                                    let totalNilai = 0;

                                    for (const krss of krs) {
                                        for (const matakuliahs of matakuliah) {
                                            if ((krss.matakuliah_id == matakuliahs.id) && (krss
                                                    .mahasiswa_id == mahasiswaId)) {
                                                totalSks += parseInt(matakuliahs.sks);


                                                let grade;
                                                switch (true) {
                                                    case (krss.nilai >= 80 && krss.nilai <= 100):
                                                        grade = 4;
                                                        break;
                                                    case (krss.nilai >= 75 && krss.nilai < 80):
                                                        grade = 3.5;
                                                        break;
                                                    case (krss.nilai >= 69 && krss.nilai < 75):
                                                        grade = 3;
                                                        break;
                                                    case (krss.nilai >= 60 && krss.nilai < 69):
                                                        grade = 2.5;
                                                        break;
                                                    case (krss.nilai >= 55 && krss.nilai < 60):
                                                        grade = 2;
                                                        break;
                                                    case (krss.nilai >= 50 && krss.nilai < 55):
                                                        grade = 1.5;
                                                        break;
                                                    case (krss.nilai >= 44 && krss.nilai < 50):
                                                        grade = 1;
                                                        break;
                                                    default:
                                                        grade = 0;
                                                }
                                                totalNilai += grade * parseInt(matakuliahs.sks);
                                            }
                                        }
                                    }
                                    const ipk = totalNilai / totalSks;
                                    document.getElementById('ipk').textContent = ipk.toFixed(2);
                                })
                        })
                });
        })
        .catch(function(error) {
            // Handle error
            console.error(error);
        });


    axios.get('https://api-group3-prognet.manpits.xyz/api/krs', {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token') // Include token from localStorage
            }
        })
        .then(function(response) {
            // Handle successful response
            var krs = response.data;
            var tableBody = document.querySelector('#list-krs');

            krs.sort(function(a, b) {
                // Sort by tahun
                var tahunComparison = a.tahun.localeCompare(b.tahun);
                if (tahunComparison !== 0) {
                    return tahunComparison;
                }

                // Sort by semester
                var semesterA = a.semester.toLowerCase();
                var semesterB = b.semester.toLowerCase();
                if (semesterA === 'ganjil' && semesterB === 'genap') {
                    return 1;
                } else if (semesterA === 'genap' && semesterB === 'ganjil') {
                    return -1;
                } else {
                    return semesterA.localeCompare(semesterB);
                }
            });

            krs.forEach(function(krs, index) {
                var row = document.createElement('tr');
                var iterationCell = document.createElement('td');
                var tahunCell = document.createElement('td');
                var semesterCell = document.createElement('td');
                var actionCell = document.createElement('td');

                iterationCell.textContent = index + 1;

                if (krs.semester.toLowerCase() == 'ganjil') {
                    tahunCell.textContent = krs.tahun + ' / ' + (parseInt(krs.tahun) + 1);
                } else {
                    tahunCell.textContent = (parseInt(krs.tahun) - 1) + ' / ' + krs.tahun;
                }

                semesterCell.textContent = krs.semester;

                // Create "Detail" button
                var detailButton = document.createElement('button');
                detailButton.textContent = 'Detail';
                detailButton.className = 'btn-table-detail';
                detailButton.addEventListener('click', function() {
                    // Handle click event
                    window.location.href = '/detilkhs/' + krs.id + '/' + mahasiswaId;
                });

                // Add buttons to "Aksi" cell
                actionCell.appendChild(detailButton);

                row.appendChild(iterationCell);
                row.appendChild(tahunCell);
                row.appendChild(semesterCell);
                row.appendChild(actionCell);

                tableBody.appendChild(row);
            });
        })
        .catch(function(error) {
            // Handle error
            console.error(error);
        });
</script>
