<!-- LANJUTAN DARI MASALAH DETILKRS-MAHASISWA SIH INI, TAPI NGAMBIL DATA SAMA MEMPERBARUI DATA DIA MAU CUMA TOMBOL KEMBALINYA NGGA BERFUNGSI -->

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
                <<div class="tombol-group">
                    <a id="back" class="btn-tambah-data">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn-tambah-data" id="tambahDataButton" form="detilkrsForm">
                        <i class="fas fa-edit"></i> Simpan Perubahan
                    </button>

                    <!-- <button type="button" class="btn-hapus-data" style="background-color: red;">
                        <i class="fas fa-trash"></i> Hapus Data
                    </button> -->
            </div>
            <div class="table-data">
                <div class="data">
                    <table class="table table-bordered bg-white text-dark">
                        <form id="detilkrsForm">
                            <tr>
                                <td class="text-center">
                                    <label class="col-form-label">Matakuliah</label>
                                </td>
                                <td>
                                    <select class="form-select" id="matakuliah" name="matakuliah_id"
                                        aria-label="Default select example">
                                        <option selected>Pilih Matakuliah</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">
                                    <label class="col-form-label">Nilai</label>
                                </td>
                                <td>
                                    <input type="number" name="nilai" class="form-control" value="">
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
        </main>
    </section>

    <!-- <div class="content">
        <div class="content">
            <table class="table table-bordered bg-white text-dark">
                <form id="detilkrsForm">

                    <tr>
                        <td class="text-center">
                            <label class="col-form-label">Matakuliah</label>
                        </td>
                        <td>
                            <select class="form-select" id="matakuliah" name="matakuliah_id" aria-label="Default select example">
                                <option selected>Pilih Matakuliah</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <label class="col-form-label">Nilai</label>
                        </td>
                        <td>
                            <input type="number" name="nilai" class="form-control" value="">
                        </td>
                    </tr>

                    <div class="tombol-group">
                        <a id="back" class="tambah-data">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="tambah-data" id="tambahDataButton">
                            <i class="fas fa-edit"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </table>

            <td></td>

        </div>
    </div> -->
    </div>
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

    async function fetchData() {
        const detilkrsId = window.location.pathname.split('/').pop();
        var mhsId;
        var krsId;
        var matkulId;

        document.getElementById('back').addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = "/detilkrs/" + krsId + "/" + mhsId;
        });

        try {
            const response = await axios.get('https://api-group3-prognet.manpits.xyz/api/detilkrs/' + detilkrsId, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });

            mhsId = response.data.mahasiswa_id;
            krsId = response.data.krs_id;
            matkulId = response.data.matakuliah_id;
            document.querySelector('input[name="nilai"]').value = response.data.nilai;

            const matakuliahResponse = await axios.get('https://api-group3-prognet.manpits.xyz/api/matakuliah', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });

            const krsResponse = await axios.get('https://api-group3-prognet.manpits.xyz/api/krs/' + krsId, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });

            const matakuliahs = matakuliahResponse.data;
            const krs = krsResponse.data;

            var semesterChoice;

            if (krs.semester == "Ganjil") {
                semesterChoice = 1;
            } else {
                semesterChoice = 0;
            }

            const selectElement = document.getElementById('matakuliah');

            for (const matakuliah of matakuliahs) {
                if ((matakuliah.semester % 2) == semesterChoice) {
                    const optionElement = document.createElement('option');
                    optionElement.value = matakuliah.id;
                    optionElement.textContent = matakuliah.namamatakuliah;
                    selectElement.appendChild(optionElement);
                }
            }

            selectElement.value = matkulId;
        } catch (error) {
            console.error(error.response.data);
        }

        document.getElementById('detilkrsForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            const formData = new FormData(event.target);
            formData.append('mahasiswa_id', mhsId);
            formData.append('krs_id', krsId);
            const data = Object.fromEntries(formData.entries());
            const url = 'https://api-group3-prognet.manpits.xyz/api/detilkrs/';
            const token = localStorage.getItem('token');

            axios.get(url, {
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                })
                .then(function(response) {
                    // Handle successful response
                    const detilkrs = response.data;

                    for (const dkrs of detilkrs) {
                        if (dkrs.mahasiswa_id == data.mahasiswa_id) {
                            if (dkrs.matakuliah_id == data.matakuliah_id && data.matakuliah_id != matkulId) {
                                alert('Mata kuliah tersebut sudah diambil!');
                                return;
                            }
                        }
                    }
                    axios.put(url + detilkrsId, data, {
                        headers: {
                            'Authorization': 'Bearer ' + token
                        }
                    })
                    .then(function(response) {
                        // Handle successful response
                        console.log(response);
                        window.location.href = "/detilkrs/" + krsId + "/" + mhsId;
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

        try {
            const mahasiswaResponse = await axios.get('https://api-group3-prognet.manpits.xyz/api/mahasiswa/' +
                mhsId, {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    }
                });

            var mahasiswa = mahasiswaResponse.data;

            const krsResponse = await axios.get('https://api-group3-prognet.manpits.xyz/api/krs/' + krsId, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });

            var krs = krsResponse.data;

            var tahunAjaranElement = document.createElement('p');
            tahunAjaranElement.textContent = mahasiswa.nama + ' - ' + krs.tahun + ' - Semester ' + krs.semester;

            var HeaderElement = document.getElementById('tahun-ajaran');
            HeaderElement.appendChild(tahunAjaranElement);
        } catch (error) {
            console.error(error);
        }
    }

    fetchData();
</script>
