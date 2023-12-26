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

    <!-- <div class="container">
        <div class="sidebar">
            <img src="resource\logo.png" alt="Logo">
            <a href="/Dashboard">Daftar Mahasiswa</a>
            <a href="/matakuliah">Mata Kuliah</a>
            <a href="/krs">KRS</a>
        </div> -->


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
            <li >
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



    <!-- CONTENT -->
    <section id="content">
        <nav>
            <i class='bx bx-menu' ></i>
            {{-- <a href="#" class="nav-link">Details</a> --}}
        </nav>

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                <h1 id="daftar-mahasiswa">Tambah Tahun KRS</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a href="#">KRS</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>

                    <li>
                        <a class="active" href="#">Tambah Tahun</a>
                    </li>
                </ul>
                </div>
                <div class="tombol-group">
                    <a href="/krs" class="btn-tambah-data">
                        <i class="fas fa-arrow-left"></i>
                        <span class="text">Kembali</span>
                    </a>
                    <button type="submit" class="btn-tambah-data" id="tambahDataButton" form="krsForm">
                        <i class="fas fa-plus"></i>
                        <span class="text">Tambah Data</span>
                    </button>
                </div>
            </div>

            <div class="table-data">
                <div class="data">
                <table class="table table-bordered bg-white text-dark">
                <form id="krsForm">
                    <tr>
                        <td class="text-center">
                            <label class="col-form-label">Tahun</label>
                        </td>
                        <td>
                            <input type="number" name="tahun" class="form-control" value="">
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <label class="col-form-label">Semester</label>
                        </td>
                        <td>
                            <select name="semester" class="form-control">
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </td>
                    </tr>

                    <!-- <div class="tombol-group">
                        <a href="/krs" class="tambah-data">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="button-style" id="tambahDataButton">
                            <i class="fas fa-plus"></i> Tambah Data
                        </button>
                    </div> -->
                </form>
            </table>
        </main>

    </section>
</body>

        <!-- <div class="content"> -->
            <!-- <table class="table table-bordered bg-white text-dark">
                <form id="krsForm">
                    <tr>
                        <td class="text-center">
                            <label class="col-form-label">Tahun</label>
                        </td>
                        <td>
                            <input type="number" name="tahun" class="form-control" value="">
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <label class="col-form-label">Semester</label>
                        </td>
                        <td>
                            <select name="semester" class="form-control">
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </td>
                    </tr>

                    <div class="tombol-group">
                        <a href="/krs" class="tambah-data">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="button-style" id="tambahDataButton">
                            <i class="fas fa-plus"></i> Tambah Data
                        </button>
                    </div>
                </form>
            </table> -->
<!--
            <td></td>

        </div>
    </div>
</body> -->

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

    document.getElementById('krsForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Get form data
        const formData = new FormData(event.target);

        // Convert form data to JSON
        const data = Object.fromEntries(formData.entries());

        // Validate data

        if (!data.tahun) {
            alert('Tahun is required');
            return;
        }

        if (!data.semester) {
            alert('Semester is required');
            return;
        }


        const url = 'https://api-group3-prognet.manpits.xyz/api/krs';

        // Get token from localStorage
        const token = localStorage.getItem('token');

        axios.post(url, data, {
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(function(response) {
                // Handle successful response
                console.log(response);
                window.location.href = "/krs";
            })
            .catch(function(error) {
                // Handle error
                console.error(error);
            });
    });
</script>

</html>
