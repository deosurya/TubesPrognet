<!-- DONE (gabisa tambah saja) -->

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
    <!-- <div class="navbar">
        <div class="logout">
            <a id="logout-button" onclick="return confirm('Yakin untuk logout?')">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div> -->

    <!-- navbar-sidebar.php -->
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
            {{-- <a href="#" class="nav-link">Details</a> --}}
        </nav>
        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Tambah Data Mahasiswa</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a href="#">Daftar Mahasiswa</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="./add-mahasiswa.php">Tambah Data</a>
                        </li>
                    </ul>
                </div>
                <div class="tombol-group">
                    <!-- <a href="./mahasiswa.php" class="btn-tambah-data">
                    <i class='bx bx-plus'></i>
                    <span class="text">Tambah Data</span>
                </a> -->
                    <button type="submit" class="btn-tambah-data" id="tambahDataButton" form="mahasiswaForm">
                        <i class="bx bx-plus"></i>
                        <span class="text">Tambah Data</span>
                    </button>
                    <a href="/Dashboard" class="btn-tambah-data">
                        <i class='bx bx-arrow-back'></i>
                        <span class="text">Kembali</span>
                    </a>
                </div>
            </div>
            <div class="table-data">
                <div class="data">
                    <form id="mahasiswaForm">
                        <table class="table table-bordered bg-white text-dark">
                            <tr>
                                <td class="text-center">
                                    <label class="col-form-label">NIM</label>
                                </td>
                                <td>
                                    <input type="text" name="nim" class="form-control" value="">
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">
                                    <label class="col-form-label">Nama</label>
                                </td>
                                <td>
                                    <input type="text" name="nama" class="form-control" value="">
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">
                                    <label class="col-form-label">Alamat</label>
                                </td>
                                <td>
                                    <input type="text" name="alamat" class="form-control" value="">
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">
                                    <label class="col-form-label">Tanggal Lahir</label>
                                </td>
                                <td>
                                    <input type="date" name="lahir" class="form-control"
                                        value="{{ old('lahir') ? old('lahir') : date('Y-m-d') }}">
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">
                                    <label class="col-form-label">Agama</label>
                                </td>
                                <td>
                                    <select class="form-select" id="agama" name="agama_id"
                                        aria-label="Default select example">
                                        <option selected>Pilih Agama</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </main>
    </section>
</body>

<script src="..\resource\javascript\script.js"></script>
<script src="https://kit.fontawesome.com/5798d03461.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
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

    axios.get('https://api-group3-prognet.manpits.xyz/api/agama', {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(function(response) {
            // Handle successful response
            const agamaOptions = response.data;
            const selectElement = document.getElementById('agama');

            for (const agamaOption of agamaOptions) {
                const optionElement = document.createElement('option');
                optionElement.value = agamaOption.id;
                optionElement.textContent = agamaOption.agama;
                selectElement.appendChild(optionElement);
            }
        })
        .catch(function(error) {
            // Handle error
            console.error(error);
        });

    document.getElementById('mahasiswaForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Get form data
        const formData = new FormData(event.target);

        // Convert form data to JSON
        const data = Object.fromEntries(formData.entries());

        // Validate data
        if (!data.lahir) {
            alert('Tanggal Lahir is required');
            return;
        }

        if (!data.agama_id) {
            alert('Agama is required');
            return;
        }


        const url = 'https://api-group3-prognet.manpits.xyz/api/mahasiswa';

        // Get token from localStorage
        const token = localStorage.getItem('token');

        axios.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(function(response) {
                // Handle successful response
                const mahasiswa = response.data;

                for (const mhs of mahasiswa) {
                    if (mhs.nim == data.nim) {
                        alert('NIM ' + data.nim + ' sudah ada!');
                        return;
                    }
                }

                axios.post(url, data, {
                        headers: {
                            'Authorization': 'Bearer ' + token
                        }
                    })
                    .then(function(response) {
                        // Handle successful response
                        console.log(response);
                        window.location.href = "/Dashboard";
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
</script>

</html>
