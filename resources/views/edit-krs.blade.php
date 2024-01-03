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



    <!-- CONTENT -->
    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
            {{-- <a href="#" class="nav-link">Details</a> --}}
        </nav>
        <main>
            <div class="head-title">
                <div class="left">
                    <h1 id="daftar-mahasiswa">Kartu Rencana Studi</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">KRS</a>
                        </li>
                    </ul>
                </div>
                <<div class="tombol-group">
                    <a href="/krs" class="btn-tambah-data">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn-tambah-data" id="tambahDataButton" form="krsForm">
                        <i class="fas fa-edit"></i> Simpan Perubahan
                    </button>
                    <button type="button" class="btn-tambah-data" id="hapus-data" style="background-color: red;">
                        <i class="fas fa-trash"></i> Hapus Data
                    </button>

            </div>
            </div>
            <div class="table-data">
                <div class="data">
                    <form id="krsForm">
                        <table class="table table-bordered bg-white text-dark">
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
                        </table>
                    </form>
                </div>
            </div>
        </main>
</body>

<script src="..\resource\javascript\script.js"></script>
<script src="https://kit.fontawesome.com/5798d03461.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var krsId = window.location.pathname.split('/').pop();

    axios.get('https://api-group3-prognet.manpits.xyz/api/krs/' + krsId, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(function(response) {

            editedkrs = response.data;
            // Pre-fill the form with the existing data of the mahasiswa
            document.querySelector('input[name="tahun"]').value = response.data.tahun;

            // Get the semester select element
            var semesterSelect = document.querySelector('select[name="semester"]');

            // Loop through the options
            for (var i = 0; i < semesterSelect.options.length; i++) {
                // If the option's value matches the semester of the mahasiswa, select this option
                if (semesterSelect.options[i].value === response.data.semester) {
                    semesterSelect.options[i].selected = true;
                    break;
                }
            }
        })
        .catch(function(error) {
            // Handle error
            console.error(error);
        });


    document.getElementById('krsForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var tahun = document.querySelector('input[name="tahun"]').value;
        var semester = document.querySelector('select[name="semester"]').value;

        var data = {
            tahun: tahun,
            semester: semester,
        };

        var token = localStorage.getItem('token');

        // Get the ID of the mahasiswa that is being edited from the URL
        var krsId = window.location.pathname.split('/').pop();

        const url = 'https://api-group3-prognet.manpits.xyz/api/krs/';

        axios.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(function(response) {
                // Handle successful response
                const krs = response.data;

                for (const krss of krs) {
                    if ((krss.tahun == data.tahun) && (krss.semester == data.semester) && (data.tahun != editedkrs.tahun) && (data.semester != editedkrs.semester)) {
                        alert('Tahun ajaran ' + data.tahun + ' ' + data.semester + ' sudah ada!');
                        return;
                    }
                }
                axios.put(url + krsId, data, {
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
            })
            .catch(function(error) {
                console.error(error);
            });
    });


    document.getElementById('hapus-data').addEventListener('click', function(event) {
        event.preventDefault();

        var krsId = window.location.pathname.split('/').pop();

        // Show confirmation dialog before deleting
        if (confirm("Yakin ingin menghapus data?")) {
            axios.delete('https://api-group3-prognet.manpits.xyz/api/krs/' + krsId, {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    }
                })
                .then(function(response) {
                    // Handle successful deletion
                    console.log(response);
                    window.location.href = "/krs";
                })
                .catch(function(error) {
                    // Handle deletion error
                    console.error(error);
                });
        }
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
