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
            <li>
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
            <li class="active">
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


    <!-- <div class="container">
        <div class="sidebar">
            <img src="..\..\resource\logo.png" alt="Logo">
            <a href="/Dashboard">Daftar Mahasiswa</a>
            <a href="/matakuliah">Mata Kuliah</a>
            <a href="/krs">KRS</a>
        </div> -->

    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
            {{-- <a href="#" class="nav-link">Details</a> --}}
        </nav>

        <main>
            <div class="head-title">
                <div class="left">
                    <h3 id="tahun-ajaran"></h3><br>
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
                    <a class="btn-tambah-data" id="tambah">
                        <i class="bx bx-plus"></i>
                        <span class="text">Tambah Data</span>
                    </a>
                    <a id="kembali" class="btn-tambah-data">
                        <i class="fas fa-arrow-left"></i>
                        <span class="text">Kembali</span>
                    </a>
                </div>
            </div>


            <div class="table-data">
                <div class="data">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Matakuliah</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </section>

    <!-- <div class="content">
            <a id="kembali" class="tambah-data">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <a id="tambah" class="tambah-data">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
            <h3 id="tahun-ajaran"></h3>
            <table>
                Data Mahasiswa
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Matakuliah</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div> -->
</body>

<script src="..\..\resource\javascript\script.js"></script>
<script src="https://kit.fontawesome.com/5798d03461.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var pathParts = window.location.pathname.split('/');
    var krsId = pathParts[pathParts.length - 2];
    var mhsId = pathParts[pathParts.length - 1];


    var kembali = document.getElementById('kembali');
    kembali.href = '/detilkrs/' + krsId;

    var tambah = document.getElementById('tambah');;
    tambah.href = '/add-detilkrs/' + krsId + '/' + mhsId;

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
                    var actionCell = document.createElement('td');

                    iterationCell.textContent = rowIndex;
                    rowIndex++;
                    nilaiCell.textContent = dtl.nilai;

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
                        })
                        .catch(function(error) {
                            // Handle error
                            console.error(error.response.data);
                        });

                    // Create "Edit" button
                    var editButton = document.createElement('button');
                    editButton.textContent = 'Edit';
                    editButton.className = 'btn-table-edit';
                    editButton.addEventListener('click', function() {
                        // Handle click event
                        window.location.href = '/edit-detilkrs/' + dtl.id;
                    });

                    // Create "Delete" button
                    var deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Delete';
                    deleteButton.className = 'btn-table-delete';
                    deleteButton.addEventListener('click', function() {
                        // Handle click event
                        var confirmation = confirm('Are you sure you want to delete this data?');
                        if (confirmation) {
                            axios.delete('https://api-group3-prognet.manpits.xyz/api/detilkrs/' + dtl.id, {
                                    headers: {
                                        'Authorization': 'Bearer ' + localStorage.getItem(
                                            'token') // Include token from localStorage
                                    }
                                })
                                .then(function(response) {
                                    // Handle successful delete
                                    console.log(response.data);
                                    // Refresh the page or update the table
                                    window.location.reload();
                                })
                                .catch(function(error) {
                                    // Handle delete error
                                    console.error(error.response.data);
                                });
                        }
                    });

                    // Add buttons to "Aksi" cell
                    actionCell.appendChild(editButton);
                    actionCell.appendChild(deleteButton);

                    row.appendChild(iterationCell);
                    row.appendChild(kodeMatkulCell);
                    row.appendChild(namaMatkulCell);
                    row.appendChild(nilaiCell);
                    row.appendChild(actionCell);

                    tableBody.appendChild(row);
                }
            });
        })
        .catch(function(error) {
            // Handle error
            console.error(error);
        });


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

                    // Display the tahun ajaran details
                    var tahunAjaranElement = document.createElement('p');
                    tahunAjaranElement.textContent = mahasiswa.nama + ' - ' + krs.tahun + ' - Semester ' +
                        krs
                        .semester;

                    var HeaderElement = document.getElementById('tahun-ajaran');
                    HeaderElement.appendChild(tahunAjaranElement);
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
</script>

</html>
