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

    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
            {{-- <a href="#" class="nav-link">Details</a> --}}
        </nav>
        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Detail Data Mahasiswa</h1>
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
                            <a class="active" href="./add-mahasiswa.php">Detail Data Mhs</a>
                        </li>
                    </ul>
                </div>
                <div class="tombol-group">
                    <a href="/Dashboard" class="btn-tambah-data">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </a>
                    <button type="submit" class="btn-tambah-data" id="editDataButton" form="mahasiswaForm">
                        <i class="fas fa-edit"></i> Simpan Perubahan
                    </button>
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
                                    <input type="date" name="lahir" class="form-control" value="{{ old('lahir') ? old('lahir') : date('Y-m-d') }}">
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">
                                    <label class="col-form-label">Agama</label>
                                </td>
                                <td>
                                    <select class="form-select" id="agama" name="agama_id" aria-label="Default select example">
                                        <option selected>Pilih Agama</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </main>
</body>

<script src="https://kit.fontawesome.com/5798d03461.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var mahasiswaId = window.location.pathname.split('/').pop();
    // Fetch the existing data of the mahasiswa
    axios.get('https://api-group3-prognet.manpits.xyz/api/mahasiswa/' + mahasiswaId, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(function(response) {
            // Pre-fill the form with the existing data of the mahasiswa
            document.querySelector('input[name="nim"]').value = response.data.nim;
            document.querySelector('input[name="nama"]').value = response.data.nama;
            document.querySelector('input[name="alamat"]').value = response.data.alamat;
            document.querySelector('input[name="lahir"]').value = response.data.lahir;
            document.querySelector('select[name="agama_id"]').value = response.data.agama_id;
        })
        .catch(function(error) {
            // Handle error
            console.error(error);
        });

    document.getElementById('mahasiswaForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var nim = document.querySelector('input[name="nim"]').value;
        var nama = document.querySelector('input[name="nama"]').value;
        var alamat = document.querySelector('input[name="alamat"]').value;
        var lahir = document.querySelector('input[name="lahir"]').value;
        var agama_id = document.querySelector('select[name="agama_id"]').value;

        var data = {
            nim: nim,
            nama: nama,
            alamat: alamat,
            lahir: lahir,
            agama_id: agama_id
        };

        console.log(data);

        var token = localStorage.getItem('token');

        // Get the ID of the mahasiswa that is being edited from the URL
        var mahasiswaId = window.location.pathname.split('/').pop();

        const url = 'https://api-group3-prognet.manpits.xyz/api/mahasiswa/' + mahasiswaId;

        axios.put(url, data, {
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
    });

    // Fetch the existing data of the mahasiswa
    axios.get('https://api-group3-prognet.manpits.xyz/api/mahasiswa/' + mahasiswaId, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(function(response) {
            // Store the agama_id of the mahasiswa
            const mahasiswaAgamaId = response.data.agama_id;

            // Fetch the agama options
            return axios.get('https://api-group3-prognet.manpits.xyz/api/agama', {
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

                        // If the agama_id of the mahasiswa matches the id of the agama, select this option
                        if (agamaOption.id === mahasiswaAgamaId) {
                            optionElement.selected = true;
                        }

                        selectElement.appendChild(optionElement);
                    }
                });
        })
        .catch(function(error) {
            // Handle error
            console.error(error);
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
