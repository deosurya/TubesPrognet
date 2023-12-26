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
    <link rel="stylesheet" type="text/css" href="resource\styles\styles.css">
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
                    <h1 id="mata-kuliah"> Mata Kuliah</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Mata Kuliah</a>
                        </li>
                    </ul>
                </div>
                <a href="add-matakuliah" class="btn-tambah-data">
                    <i class='bx bx-plus'></i>
                    <span class="text">Tambah Data</span>
                </a>
            </div>
            <div class="table-data">
                <div class="data">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Mata Kuliah</th>
                                <th>Semester</th>
                                <th>SKS</th>
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
</body>

<script src="resource/javascript/script.js"></script>
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

    axios.get('https://api-group3-prognet.manpits.xyz/api/matakuliah', {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token') // Include token from localStorage
            }
        })
        .then(function(response) {
            // Handle successful response
            var mahasiswa = response.data;
            var tableBody = document.querySelector('tbody');

            mahasiswa.forEach(function(matkul, index) {
                var row = document.createElement('tr');
                var iterationCell = document.createElement('td');
                var kodeCell = document.createElement('td');
                var namaCell = document.createElement('td');
                var sksCell = document.createElement('td');
                var semesterCell = document.createElement('td');
                var actionCell = document.createElement('td');

                iterationCell.textContent = index + 1;
                kodeCell.textContent = matkul.kode;
                namaCell.textContent = matkul.namamatakuliah;
                sksCell.textContent = matkul.sks;
                semesterCell.textContent = matkul.semester;

                // Create "Edit" button
                var editButton = document.createElement('button');
                editButton.textContent = 'Edit';
                editButton.className = 'btn-table-edit';
                editButton.addEventListener('click', function() {
                    // Handle click event
                    window.location.href = '/edit-matakuliah/' + matkul.id;
                });

                // Create "Delete" button
                var deleteButton = document.createElement('button');
                deleteButton.textContent = 'Delete';
                deleteButton.className = 'btn-table-delete';
                deleteButton.addEventListener('click', function() {
                    // Handle click event
                    var confirmation = confirm('Are you sure you want to delete this data?');
                    if (confirmation) {
                        axios.delete('https://api-group3-prognet.manpits.xyz/api/matakuliah/' + matkul
                                .id, {
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
                row.appendChild(kodeCell);
                row.appendChild(namaCell);
                row.appendChild(semesterCell);
                row.appendChild(sksCell);
                row.appendChild(actionCell);

                tableBody.appendChild(row);
            });
        })
        .catch(function(error) {
            // Handle error
            console.error(error);
        });
</script>

</html>
