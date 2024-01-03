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
                            <a class="active" href="#">Tambah Mata Kuliah</a>
                        </li>
                    </ul>
                </div>
                <div class="tombol-group">
                    <button type="submit" class="btn-tambah-data" id="tambahDataButton" form="matakuliahForm">
                        <i class="bx bx-plus"></i>
                        <span class="text">Tambah Data</span>
                    </button>
                    <a href="/matakuliah" class="btn-tambah-data">
                        <i class='bx bx-arrow-back'></i>
                        <span class="text">Kembali</span>
                    </a>
                </div>
            </div>

            <div class="table-data">
                <div class="data">
                    <table class="table table-bordered bg-white text-dark">
                        <form id="matakuliahForm">
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
                        </form>
                    </table>
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

    document.getElementById('matakuliahForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Get form data
        const formData = new FormData(event.target);

        // Convert form data to JSON
        const data = Object.fromEntries(formData.entries());

        // Validate data
        if (!data.kode) {
            alert('Kode is required');
            return;
        }

        if (!data.namamatakuliah) {
            alert('Mata Kuliah is required');
            return;
        }

        if (!data.sks) {
            alert('SKS is required');
            return;
        }

        if (!data.semester) {
            alert('Semester is required');
            return;
        }


        const url = 'https://api-group3-prognet.manpits.xyz/api/matakuliah';

        // Get token from localStorage
        const token = localStorage.getItem('token');

        axios.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(function(response) {
                // Handle successful response
                const matakuliah = response.data;

                for (const matkul of matakuliah) {
                    if (matkul.kode == data.kode) {
                        alert('Kode ' + data.kode + ' sudah ada!');
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
</script>

</html>
