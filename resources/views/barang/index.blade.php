@extends('layouts.user')

@section('title', 'Daftar Barang ')

@section('content')

<style>
    body {
        background: url('/images/ml.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', sans-serif;
    }

    .card-custom {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        background-color: rgba(255, 255, 255, 0.95);
    }

    .status-tersedia {
        color: green;
        font-weight: bold;
    }

    .status-habis {
        color: red;
        font-weight: bold;
    }

    .table thead {
        background-color: #007bff;
        color: white;
    }

    .btn-outline-primary {
        background-color: white;
    }

    .search-box {
        border-radius: 20px;
        padding: 8px 15px;
        border: 1px solid #ddd;
        width: 100%;
        max-width: 300px;
    }

    .table th {
        cursor: pointer;
        position: relative;
    }

    .table th:hover {
        background-color: #0056b3;
    }

    .sort-icon {
        margin-left: 5px;
    }

    .pagination {
        margin-top: 20px;
    }

    .pagination .page-link {
        color: #007bff;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-camera {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }

    .btn-camera:hover {
        background-color: #218838;
        border-color: #1e7e34;
        color: white;
    }

    .instruction-box {
    background-color: #ffffff;
    border: 2px solid #dee2e6;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    max-width: 800px;
    margin: 0 auto 20px auto;
}

.camera-section {
    max-width: 600px;
    margin: 0 auto;
}

.camera-button {
    background-color: #28a745;
    border-color: #28a745;
    color: white;
    padding: 10px 15px;
    border-radius: 8px;
}

.camera-button:hover {
    background-color: #218838;
    border-color: #1e7e34;
}

.photo-preview {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.btn-outline-danger {
    background-color: white;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
}
    
</style>



<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
            ← Kembali ke Dashboard
        </a>
        
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="btn btn-outline-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>
</form>
    </div>

    
    <div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <!-- Kotak instruksi -->
            <div class="instruction-box text-center mb-1 text-dark">
            <h6 class="text-dark">Halo {{ auth()->user()->name ?? 'User' }}!</h6>
            <p class="mb-0">Klik ikon kamera untuk memulai pengenalan wajah</p>
            <small class="text-muted">Sistem akan mengenali wajah Anda untuk membuka pintu</small>
        </div>
            
            <!-- Section kamera -->
            <div class="camera-section mb-4">
                <div class="input-group">
                    <!-- input dan button kamera -->
                </div>
                <!-- photo preview container -->
            </div>
        </div>
    </div>
    
    
</div>
                        
                        <div class="input-group">
                            <input type="text" name="image" id="image" class="form-control" readonly placeholder="JIKA PINTU SUDAH TERBUKA SILAHKAN KLIK TOMBOL SILANG(X) PADA WEBSOCKET" style="background-color: #f8f9fa; cursor: not-allowed;">
                            <button type="button"  onclick="openCameraCapture()" title="Ambil foto dengan ESP32CAM">
                                📷
                            </button>
                            
                        </div>
                        <div id="photo-preview-container" style="display: none;" class="mt-2">
                            <img id="photo-preview" class="photo-preview" alt="Preview foto">
                            <p class="mt-1 text-success small">Foto berhasil diambil dari ESP32CAM</p>
                        </div>
                    </div>
                        </div>
                        <div id="photo-preview-container" style="display: none;" class="mt-2">
                            <img id="photo-preview" class="photo-preview" alt="Preview foto">
                            <p class="mt-1 text-success small">Anda akan mendapatkan id jika wajah di kenali</p>
                        </div>
                    </div>
                    <div class="text-center mb-4 text-dark">
        <h2 class="fw-bold">Daftar Barang</h2>
        <p class="text-dark">List daftar barang yang tersedia di bawah ini</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="card card-custom p-4">
        <div class="mb-3">
            <input type="text" id="searchInput" class="search-box" placeholder="Cari barang..." onkeyup="searchTable()">
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle" id="barangTable">
                <thead>
                    <tr>
                        <th onclick="sortTable(0)">NO <i class="fas fa-sort sort-icon"></i></th>
                        <th onclick="sortTable(1)">Nama Barang <i class="fas fa-sort sort-icon"></i></th>
                        <th onclick="sortTable(2)">Stok <i class="fas fa-sort sort-icon"></i></th>
                        <th onclick="sortTable(3)">Status <i class="fas fa-sort sort-icon"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $index => $barang)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->stok }}</td>
                            <td>
                                @if ($barang->stok > 0)
                                    <span class="status-tersedia">Tersedia</span>
                                @else
                                    <span class="status-habis">Habis</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-muted">Belum ada data barang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $barangs->links() }}
        </div>
    </div>
</div>

<script>
function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("barangTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        var found = false;
        for (var j = 1; j < 4; j++) {
            td = tr[i].getElementsByTagName("td")[j];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }
        tr[i].style.display = found ? "" : "none";
    }
}

function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("barangTable");
    switching = true;
    dir = "asc";

    while (switching) {
        switching = false;
        rows = table.rows;

        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];

            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }

        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}


                const ESP32_CAM_IP = "172.20.10.5";
                const ESP32_CAM_PORT = "80";
                const NODEMCU_IP = "172.20.10.2"; // IP NodeMCU ESP8266
                const NODEMCU_PORT = "80";

                const CURRENT_USER_NAME = "{{ auth()->user()->name ?? 'Guest' }}"; // Mendapatkan nama user yang login
                const CURRENT_USER_ID = "{{ auth()->user()->id ?? 0 }}"; 

                // Face ID mapping
                const FACE_ID_NAMES = {
                    0: CURRENT_USER_NAME,
                    1: CURRENT_USER_NAME, // Gunakan nama user yang login untuk Face ID 1
                    2: CURRENT_USER_NAME, // Atau sesuaikan dengan mapping Face ID yang sesuai
                    3: CURRENT_USER_NAME,
                    4: CURRENT_USER_NAME,
                    5: CURRENT_USER_NAME,
                    6: CURRENT_USER_NAME,
                    7: CURRENT_USER_NAME
                };

                // Polling interval untuk mengecek Face ID baru
                let faceIDPollingInterval;
                let lastReceivedFaceID = -1;

                // Fungsi untuk membuka kamera ESP32-CAM
                function openCameraCapture() {
                    const cameraUrl = `http://${ESP32_CAM_IP}:${ESP32_CAM_PORT}`;
                    
                    const cameraWindow = window.open(cameraUrl, '_blank', 'width=800,height=600,scrollbars=yes,resizable=yes');
                    
                    if (!cameraWindow) {
                        alert('Popup diblokir! Silakan izinkan popup untuk mengakses kamera ESP32-CAM atau buka secara manual: ' + cameraUrl);
                        return;
                    }
                    
                    showLoadingMessage();
                    checkCameraConnection(cameraUrl);
                    
                    waitForStreamActive();
                }

                async function checkStreamStatus() {
    try {
        const response = await fetch(`http://${ESP32_CAM_IP}:${ESP32_CAM_PORT}/status`);
        // Cek apakah endpoint stream tersedia
    } catch (error) {
        return false;
    }
}
              

                async function waitForStreamActive() {
    let streamCheckInterval = setInterval(async () => {
        try {
            // Cek apakah stream endpoint tersedia
            const response = await fetch(`http://${ESP32_CAM_IP}:${ESP32_CAM_PORT}/stream`, {
                method: 'HEAD',
                mode: 'no-cors'
            });
            
            // Jika stream aktif, mulai Face ID polling
            console.log('Stream detected, starting Face ID polling...');
            clearInterval(streamCheckInterval);
            startFaceIDPolling();
            updateStreamStatus(true);
            
        } catch (error) {
            console.log('Stream not active yet, waiting...');
            updateStreamStatus(false);
        }
    }, 2000); // Cek setiap 2 detik
    
    // Timeout setelah 30 detik
    setTimeout(() => {
        clearInterval(streamCheckInterval);
        console.log('Stream check timeout');
    }, 30000);
}


               
 

                
                

                // Fungsi untuk mengecek koneksi ke ESP32-CAM
                function checkCameraConnection(url) {
                    fetch(url, { 
                        method: 'HEAD',
                        mode: 'no-cors'
                    })
                    .then(() => {
                        console.log('ESP32-CAM dapat diakses');
                        updateConnectionStatus(true);
                    })
                    .catch((error) => {
                        console.error('Error mengakses ESP32-CAM:', error);
                        updateConnectionStatus(false);
                    });
                }

                

                // Fungsi untuk memulai polling Face ID dari NodeMCU
                function startFaceIDPolling() {
                    console.log('Starting Face ID polling from NodeMCU...');
                    
                    // Clear existing interval
                    if (faceIDPollingInterval) {
                        clearInterval(faceIDPollingInterval);
                    }
                    
                    // Start polling every 1 second
                    faceIDPollingInterval = setInterval(() => {
                        checkForNewFaceID();
                    }, 1000);
                }

                // Fungsi untuk mengecek Face ID baru dari NodeMCU
                async function checkForNewFaceID() {
                    try {
                        const response = await fetch(`http://${NODEMCU_IP}:${NODEMCU_PORT}/detection`, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                            }
                        });
                        
                        if (response.ok) {
                            const data = await response.json();
                            
                            if (data.last_face_id !== undefined && data.last_face_id !== lastReceivedFaceID && data.last_face_id >= 0) {
                                lastReceivedFaceID = data.last_face_id;
                                handleNewFaceID(data.last_face_id, data.last_detection_time);
                            }
                        }
                    } catch (error) {
                        console.error('Error checking Face ID from NodeMCU:', error);
                        updateFaceDetectionStatus('Error: Cannot connect to NodeMCU', 'danger');
                    }
                }

                function validateUserAccess(faceID) {
    // Jika Face ID adalah 0 (Unknown), tolak akses
    if (faceID === 0) {
        return {
            isValid: false,
            message: "Wajah tidak dikenali. Akses ditolak.",
            userName: "Unknown User"
        };
    }

    if (faceID >= 0 && faceID <= 7) {
        return {
            isValid: true,
            message: "Wajah dikenali. Akses diterima.",
            userName: CURRENT_USER_NAME
        };
    }
    
    // Face ID tidak valid
    return {
        isValid: false,
        message: "Face ID tidak valid.",
        userName: "Invalid"
    };
}

                // Fungsi untuk menangani Face ID baru
                function handleNewFaceID(faceID, timestamp) {
                    console.log(`New Face ID received: ${faceID}`);
                    
                    const faceName = FACE_ID_NAMES[faceID] || `Unknown (ID: ${faceID})`;
                    const dateTime = new Date(timestamp || Date.now()).toLocaleString();
                    
                    // Update status deteksi wajah
                    if (validation.isValid) {
                        updateFaceDetectionStatus(`✅ ${validation.message}`, 'success');
                    
                    // Update input field dengan informasi Face ID
                    const imageInput = document.getElementById('image');
                    if (imageInput) {
                        imageInput.value = `Face ID: ${faceID} - ${faceName} (${dateTime})`;
                        imageInput.style.backgroundColor = '#d4edda'; // Light green background
                    }
                    
                    // Show face detection result
                    showFaceDetectionResult(faceID, faceName, dateTime, true);

                    sendAccessLog(faceID, validation.userName, 'success');
                    } else {
        updateFaceDetectionStatus(`❌ ${validation.message}`, 'danger');
        
        // Update input field dengan pesan error
        const imageInput = document.getElementById('image');
        if (imageInput) {
            imageInput.value = `Akses ditolak - ${validation.message} (${dateTime})`;
            imageInput.style.backgroundColor = '#f8d7da'; // Light red background
        }
        
        // Show error message
        showFaceDetectionResult(faceID, validation.userName, dateTime, false);
        
        // **TAMBAHAN: Kirim notifikasi akses ditolak ke server (opsional)**
        sendAccessLog(faceID, validation.userName, 'failed');
    }
}
                    
                // Fungsi untuk update status deteksi wajah
                function showFaceDetectionResult(faceID, userName, dateTime, isSuccess) {
    const container = document.getElementById('photo-preview-container');
    if (container) {
        const alertClass = isSuccess ? 'alert-success' : 'alert-danger';
        const icon = isSuccess ? '✅' : '❌';
        const status = isSuccess ? 'AKSES DITERIMA' : 'AKSES DITOLAK';
        
        container.innerHTML = `
            <div class="alert ${alertClass}" role="alert">
                <h5>${icon} ${status}</h5>
                <hr>
                <p><strong>Nama:</strong> ${userName}</p>
                <p><strong>Face ID:</strong> ${faceID}</p>
                <p><strong>Waktu:</strong> ${dateTime}</p>
                <p><strong>User Login:</strong> ${CURRENT_USER_NAME}</p>
                ${isSuccess ? 
                    '<p class="mb-0"><small class="text-success">Pintu akan terbuka secara otomatis.</small></p>' :
                    '<p class="mb-0"><small class="text-danger">Silakan coba lagi atau hubungi administrator.</small></p>'
                }
                <div class="mt-3">
                    <button class="btn btn-secondary btn-sm" onclick="refreshPhoto()">Reset Deteksi</button>
                </div>
            </div>
        `;
    }
}

// ==================== MODIFIKASI 6: Tambahkan fungsi log akses (opsional) ====================
// Tambahkan fungsi ini untuk mencatat aktivitas akses
async function sendAccessLog(faceID, userName, status) {
    try {
        // Kirim log ke server Laravel (sesuaikan dengan route yang ada)
        const response = await fetch('/api/access-log', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                face_id: faceID,
                user_name: userName,
                current_user: CURRENT_USER_NAME,
                current_user_id: CURRENT_USER_ID,
                status: status,
                timestamp: new Date().toISOString()
            })
        });
        
        if (response.ok) {
            console.log('Access log sent successfully');
        }
    } catch (error) {
        console.error('Error sending access log:', error);
    }
}

                // Fungsi untuk menampilkan hasil deteksi wajah
                function showFaceDetectionResult(faceID, faceName, dateTime) {
                    const container = document.getElementById('photo-preview-container');
                }

                // Fungsi untuk reset deteksi wajah
                async function resetFaceDetection() {
                    try {
                        if (streamCheckInterval) {
            clearInterval(streamCheckInterval);
        }
        isStreamActive = false;
                        // Reset NodeMCU
                        await fetch(`http://${NODEMCU_IP}:${NODEMCU_PORT}/reset`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            }
                        });
                        
                        // Reset local variables
                        lastReceivedFaceID = -1;
                        
                        // Clear input field
                        const imageInput = document.getElementById('image');
                        if (imageInput) {
                            imageInput.value = '';
                            imageInput.style.backgroundColor = '#f8f9fa';
                            imageInput.placeholder = 'Start stream hingga wajah dikenali';
                        }
                        
                        // Clear container
                        const container = document.getElementById('photo-preview-container');
                        if (container) {
                            container.style.display = 'none';
                            container.innerHTML = '';
                        }
                        
                        // Hide refresh button
                        const refreshBtn = document.getElementById('refresh-btn');
                        if (refreshBtn) {
                            refreshBtn.style.display = 'none';
                        }
                        
                        // Stop polling
                        if (faceIDPollingInterval) {
                            clearInterval(faceIDPollingInterval);
                        }
                        
                        console.log('Face detection reset successfully');
                        
                    } catch (error) {
                        console.error('Error resetting face detection:', error);
                        alert('Error resetting face detection. Please try again.');
                    }
                }

                // Fungsi untuk refresh foto (gabungan dari fungsi asli dan baru)
                function refreshPhoto() {
                    // Fungsi asli - reset status
                    const container = document.getElementById('photo-preview-container');
                    const refreshBtn = document.getElementById('refresh-btn');
                    
                    if (container) {
                        container.style.display = 'none';
                        container.innerHTML = '';
                    }
                    
                    if (refreshBtn) {
                        refreshBtn.style.display = 'none';
                    }
                    
                    // Reset input field
                    const imageInput = document.getElementById('image');
                    if (imageInput) {
                        imageInput.value = '';
                        imageInput.style.backgroundColor = '#f8f9fa';
                        imageInput.placeholder = 'Start stream hingga wajah dikenali';
                    }
                    
                    // Tambahan dari program pertama - reset face detection
                    resetFaceDetection();
                }

                // Fungsi untuk mengecek status NodeMCU
                async function checkNodeMCUStatus() {
                    try {
                        const response = await fetch(`http://${NODEMCU_IP}:${NODEMCU_PORT}/status`);
                        if (response.ok) {
                            const data = await response.json();
                            console.log('NodeMCU Status:', data);
                            return data;
                        }
                    } catch (error) {
                        console.error('Cannot connect to NodeMCU:', error);
                        return null;
                    }
                }

                // Fungsi untuk mendapatkan IP ESP32-CAM secara otomatis (dari program asli)
                function autoDetectESP32IP() {
                    console.log('Auto-detect ESP32-CAM IP feature - belum diimplementasikan');
                }

                // Fungsi untuk mendapatkan IP ESP32-CAM (dari program asli)
                function getESP32CamIP() {
                    return ESP32_CAM_IP;
                }

                // Event listener untuk inisialisasi
                document.addEventListener('DOMContentLoaded', function() {
                    // Make functions globally available
                    window.openCameraCapture = openCameraCapture;
                    window.refreshPhoto = refreshPhoto;
                    window.resetFaceDetection = resetFaceDetection;
                    window.autoDetectESP32IP = autoDetectESP32IP;
                    window.getESP32CamIP = getESP32CamIP;
                    
                    // Check NodeMCU status on page load
                    checkNodeMCUStatus().then(status => {
                        if (status) {
                            console.log('NodeMCU is online and ready');
                        } else {
                            console.log('NodeMCU is not accessible');
                        }
                    });
                    
                    console.log('Face ID detection system initialized');
                });

                // Cleanup interval on page unload
                window.addEventListener('beforeunload', function() {
                    if (faceIDPollingInterval) {
                        clearInterval(faceIDPollingInterval);
                    }
                });
</script>
@endsection