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
    <!-- Navbar atas -->
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
            <li class="active">
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
            {{-- <a href="#" class="nav-link">Details</a> --}}
        </nav>

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1 id="mata-kuliah"> Tambah Mata Kuliah</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a href="#">Mata Kuliah</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Detail Mata Kuliah</a>
                        </li>
                    </ul>
                </div>
                <div class="tombol-group">
                    <a href="/matakuliah" class="btn-tambah-data">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn-tambah-data" id="tambahDataButton" form="matakuliahForm">
                        <i class="fas fa-edit"></i> Simpan Perubahan
                    </button>
                </div>
            </div>

            <div class="table-data">
                <div class="data">
                    <form id="matakuliahForm">
                        <table class="table table-bordered bg-white text-dark">
                            <tr>
                                <td class="text-center">
                                    <label class="col-form-label">Kode</label>
                                </td>
                                <td>
                                    <input type="text" name="kode" class="form-control" value="">
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">
                                    <label class="col-form-label">Mata Kuliah</label>
                                </td>
                                <td>
                                    <input type="text" name="namamatakuliah" class="form-control" value="">
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">
                                    <label class="col-form-label">SKS</label>
                                </td>
                                <td>
                                    <input type="number" name="sks" class="form-control" value="">
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">
                                    <label class="col-form-label">Semester</label>
                                </td>
                                <td>
                                    <input type="number" name="semester" class="form-control" value="">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
</body>

</html>

<script src="..\resource\javascript\script.js"></script>
<script src="https://kit.fontawesome.com/5798d03461.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var matkulId = window.location.pathname.split('/').pop();
    // Fetch the existing data of the mahasiswa
    axios.get('https://api-group3-prognet.manpits.xyz/api/matakuliah/' + matkulId, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(function(response) {
            editedmatkul = response.data;
            // Pre-fill the form with the existing data of the mahasiswa
            document.querySelector('input[name="kode"]').value = editedmatkul.kode;
            document.querySelector('input[name="namamatakuliah"]').value = editedmatkul.namamatakuliah;
            document.querySelector('input[name="semester"]').value = editedmatkul.semester;
            document.querySelector('input[name="sks"]').value = editedmatkul.sks;
        })
        .catch(function(error) {
            // Handle error
            console.error(error);
        });

    document.getElementById('matakuliahForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var kode = document.querySelector('input[name="kode"]').value;
        var namamatakuliah = document.querySelector('input[name="namamatakuliah"]').value;
        var semester = document.querySelector('input[name="semester"]').value;
        var sks = document.querySelector('input[name="sks"]').value;

        var data = {
            kode: kode,
            namamatakuliah: namamatakuliah,
            semester: semester,
            sks: sks
        };

        var token = localStorage.getItem('token');

        // Get the ID of the mahasiswa that is being edited from the URL
        var matkulId = window.location.pathname.split('/').pop();

        const url = 'https://api-group3-prognet.manpits.xyz/api/matakuliah/';


        axios.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(function(response) {
                // Handle successful response
                const matakuliah = response.data;

                for (const matkul of matakuliah) {
                    if (matkul.kode == data.kode && data.kode != editedmatkul.kode) {
                        alert('Kode ' + data.kode + ' sudah ada!');
                        return;
                    }
                }
                axios.put(url + matkulId, data, {
                        headers: {
                            'Authorization': 'Bearer ' + token
                        }
                    })
                    .then(function(response) {
                        // Handle successful response
                        console.log(response);
                        window.location.href = "/matakuliah";
                    })
                    .catch(function(error) {
                        // Handle error
                        console.error(error);
                    });
            })
            .catch(function(error) {
                console.error(error);
            });
    });

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
</script>

</html>
