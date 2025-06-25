<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .hero {
            background: url('{{ asset('images/ml.jpg') }}') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 120px 0;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            color: black;
            text-shadow: none;
        }
        .hero p {
            font-size: 1.2rem;
            margin-top: 20px;
            text-shadow: 1px 1px 3px rgba(254, 254, 254, 0.5);
        }
        .card {
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
        }
        .form-label {
            font-weight: bold;
        }
        footer {
            background: #f8f9fa;
            padding: 20px 0;
            text-align: center;
            font-size: 14px;
        }
        .form-check-inline {
            margin-right: 10px;
        }

        .enrollment-steps {
    background-color: rgba(23, 162, 184, 0.1);
    border-left: 4px solid #17a2b8;
    padding: 10px 15px;
    margin-top: 8px;
}

.step-number {
    background-color: #17a2b8;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    /* styling untuk nomor langkah */
}
    </style>
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100vh; background: url('{{ asset('images/ml.jpg') }}') no-repeat center center fixed; background-size: cover;">

    <div class="card shadow p-4" style="width: 100%; max-width: 1000px;">
        <h4 class="text-center mb-4">Form Registrasi</h4>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <!-- Form Input -->
            <div class="col-md-6">
                <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control" required value="{{ old('nim') }}">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <!-- **UBAH** bagian input foto -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Foto & Face ID</label>
                        <div class="input-group">
          
                            <button type="button" class="btn btn-outline-light" onclick="openCameraCapture()" 
                                    title="Ambil foto dengan ESP32CAM">📷</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="refreshPhoto()" 
                                    title="Refresh foto" id="refresh-btn" style="display: none;">🔄</button>
                        </div>

                        <div class="enrollment-steps">
                            <div class="text-info mb-2">
                                <strong>📋 Panduan Mendaftarkan Wajah:</strong>
                            </div>
                            <div class="step-item">
                                <span class="step-number">1</span>
                                <strong>Klik icon kamera</strong> (📷) di atas
                            </div>
                            <div class="step-item">
                                <span class="step-number">2</span>
                                <strong>Klik "Start Stream"</strong> di halaman websocket ESP32CAM
                            </div>
                            <div class="step-item">
                                <span class="step-number">3</span>
                                <strong>Klik "Enroll Face"</strong> hingga wajah dikenali sistem
                            </div>
                            <div class="step-item">
                                <span class="step-number">4</span>
                                <strong>Klik "Stop Stream"</strong> pada websocket
                            </div>
                            <div class="step-item">
                                <span class="step-number">5</span>
                                <strong>Tutup tab websocket</strong> dan kembali ke form ini
                            </div>
                           
                        </div>
                        
                        <!-- **TAMBAH**: Face ID Display -->
                        <div id="face-id-display" class="mt-2" style="display: none;">
                            <div class="alert alert-info p-2">
                                <strong>Face ID:</strong> <span id="detected-face-id">-</span> |
                        
                            </div>
                        </div>
                        
                        <div id="photo-preview-container" style="display: none;" class="mt-2">
                            <img id="photo-preview" class="photo-preview" alt="Preview foto">
                            <p class="mt-1 text-success small">Foto berhasil diambil dari ESP32CAM</p>
                        </div>
                    </div>
                        <div id="photo-preview-container" style="display: none;" class="mt-2">
                            <img id="photo-preview" class="photo-preview" alt="Preview foto">
                            <p class="mt-1 text-success small">Foto berhasil diambil dari ESP32CAM</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" required>
                            <label class="form-check-label">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" required>
                            <label class="form-check-label">Perempuan</label>
                        </div>
                    </div>

                    <input type="hidden" name="captured_image" id="captured_image">
                    <button type="submit" class="btn btn-primary w-100">Daftar</button>
                </form>
            </div>

            <script>
                // Configuration - ganti dengan IP address ESP32-CAM dan NodeMCU Anda
                const ESP32_CAM_IP = "172.20.10.5";
                const ESP32_CAM_PORT = "80";
                const NODEMCU_IP = "172.20.10.2"; // IP NodeMCU ESP8266
                const NODEMCU_PORT = "80";

                // Face ID mapping
                const FACE_ID_NAMES = {
                    0: "Unknown",
                    1: "Person 1",
                    2: "Person 2", 
                    3: "Person 3",
                    4: "Person 4",
                    5: "Person 5",
                    6: "Person 6",
                    7: "Person 7"
                };

                // Polling interval untuk mengecek Face ID baru
                let faceIDPollingInterval;
                let lastReceivedFaceID = -1;
                let isWaitingForFaceDetection = false;

                // Fungsi untuk membuka kamera ESP32-CAM
                function openCameraCapture() {
                const cameraUrl = `http://${ESP32_CAM_IP}:${ESP32_CAM_PORT}`;
                
                const cameraWindow = window.open(cameraUrl, '_blank', 'width=800,height=600,scrollbars=yes,resizable=yes');
                
                if (!cameraWindow) {
                    alert('Popup diblokir! Silakan izinkan popup untuk mengakses kamera ESP32-CAM atau buka secara manual: ' + cameraUrl);
                    return;
                }
                
                showCameraConnectedMessage(); // **UBAH DARI showLoadingMessage()**
                checkCameraConnection(cameraUrl);
                
                }

               

           



            function stopFaceDetection() {
            isWaitingForFaceDetection = false;
            
            // Stop polling
            if (faceIDPollingInterval) {
                clearInterval(faceIDPollingInterval);
            }
            
            // Kembali ke status awal
            showCameraConnectedMessage();
        }

        

                function showCameraConnectedMessage() {
        const container = document.getElementById('photo-preview-container');
        if (container) {
            container.style.display = 'block';
            container.innerHTML = `
            <div class="text-center p-3">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Connecting...</span>
                </div>
                <p class="mt-2 text-success small">✅ ESP32-CAM Terhubung!</p>
                <p class="small text-info">Memulai deteksi wajah...</p>
                <button type="button" class="btn btn-sm btn-warning mt-2" onclick="stopFaceDetection()">
                    Stop Detection
                </button>
            </div>
        `;
        
        // **TAMBAH**: Mulai deteksi wajah otomatis
        startFaceDetection();
    }
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
                    startFaceDetection(); // **TAMBAH**: Auto start detection
                })
                .catch((error) => {
                    console.error('Error mengakses ESP32-CAM:', error);
                    updateConnectionStatus(false);
                });
            }

            function startFaceDetection() {
            isWaitingForFaceDetection = true;
            console.log('Starting face detection...');
            
           
            
            // Mulai polling Face ID
            startFaceIDPolling();
            
            // Reset NodeMCU untuk memastikan data fresh
            resetNodeMCUData();
        }

                // Fungsi untuk update status koneksi
                function updateConnectionStatus(isConnected) {
                    const container = document.getElementById('photo-preview-container');
                    if (container) {
                        if (isConnected) {
                            container.innerHTML = `
                                <div class="alert alert-success" role="alert">
                                    <strong>✅ ESP32-CAM Terhubung!</strong><br>
                                    
                                    
                                    
                                </div>
                            `;
                        } else {
                            container.innerHTML = `
                                <div class="alert alert-warning" role="alert">
                                    <strong>⚠️ Tidak dapat terhubung ke ESP32-CAM</strong><br>
                                    Pastikan ESP32-CAM sudah aktif dan terhubung ke WiFi yang sama.<br>
                                    
                                </div>
                            `;
                        }
                        
                        const refreshBtn = document.getElementById('refresh-btn');
                        if (refreshBtn) {
                            refreshBtn.style.display = 'inline-block';
                        }
                    }
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
                    if (!isWaitingForFaceDetection) {
                        return; // Jangan proses jika tidak sedang menunggu deteksi
                    }
                    try {
                        const response = await fetch(`http://${NODEMCU_IP}:${NODEMCU_PORT}/detection`, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                            }
                        });
                        
                        if (response.ok) {
                            const data = await response.json();
                            
                            if (data.last_face_id !== undefined && data.last_face_id !== lastReceivedFaceID) {
                            lastReceivedFaceID = data.last_face_id;
                            
                            if (data.is_enrolled === true && data.last_face_id > 0) {
                                handleEnrolledFace(data.last_face_id, data.last_detection_time);
                            } else {
                                handleNewFaceID(data.last_face_id, data.last_detection_time);
                            }
                            
                            // **TAMBAH**: Hentikan deteksi setelah mendapat hasil
                            isWaitingForFaceDetection = false;
                            if (faceIDPollingInterval) {
                                clearInterval(faceIDPollingInterval);
                            }
                        }
                        }
                    } catch (error) {
                        console.error('Error checking Face ID from NodeMCU:', error);
                        updateFaceDetectionStatus('Error: Cannot connect to NodeMCU', 'danger');
                    }
                }

                // **TAMBAH FUNGSI BARU** - Update tampilan Face ID
function updateFaceIDDisplay(faceID, status, isEnrolled) {
    const displayDiv = document.getElementById('face-id-display');
    const faceIDSpan = document.getElementById('detected-face-id');
    const statusSpan = document.getElementById('face-status');
    
    if (displayDiv && faceIDSpan && statusSpan) {
        displayDiv.style.display = 'block';
        faceIDSpan.textContent = faceID;
        statusSpan.textContent = status;
        
        // Update styling berdasarkan status
        if (isEnrolled) {
            displayDiv.className = 'mt-2 alert alert-success p-2';
        } else {
            displayDiv.className = 'mt-2 alert alert-warning p-2';
        }
    }
}

                function showFaceDetectionResult(faceImage, status, dateTime) {
                    const container = document.getElementById('photo-preview-container');
                    if (container) {
                        let alertClass = status === 'Not Enrolled' ? 'alert-warning' : 'alert-info';
                        let icon = status === 'Not Enrolled' ? '⚠️' : '📸';
                        
                       
                    }
                }

                async function resetNodeMCUData() {
                    try {
                        await fetch(`http://${NODEMCU_IP}:${NODEMCU_PORT}/reset`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ action: 'reset_detection' })
                        });
                        console.log('NodeMCU data reset successfully');
                    } catch (error) {
                        console.error('Error resetting NodeMCU data:', error);
                    }
                }

                // Fungsi untuk menangani Face ID baru
                function handleNewFaceID(faceID, timestamp) {
    console.log(`Face detected but not enrolled: ${faceID}`);
    
    const dateTime = new Date(timestamp || Date.now()).toLocaleString();
    
    
    
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.value = `Face detected but not enrolled (${dateTime})`;
        imageInput.style.backgroundColor = '#fff3cd';
    }
    
    showFaceDetectionResult(null, 'Not Enrolled', dateTime);
}


                // Fungsi untuk update status deteksi wajah
                function updateFaceDetectionStatus(message, type = 'info') {
                    const statusElement = document.getElementById('face-detection-status');
                    if (statusElement) {
                        const badgeClass = type === 'success' ? 'bg-success' : 
                                          type === 'danger' ? 'bg-danger' : 'bg-info';
                        statusElement.innerHTML = `<span class="badge ${badgeClass}">${message}</span>`;
                    }
                }

            

                function handleEnrolledFace(faceID, timestamp) {
    console.log(`Enrolled Face ID received: ${faceID}`);
    
    const faceName = FACE_ID_NAMES[faceID] || `Person ${faceID}`;
    const dateTime = new Date(timestamp || Date.now()).toLocaleString();
    
    updateFaceDetectionStatus(`Enrolled Face: ${faceName}`, 'success');
    updateFaceIDDisplay(faceID, `Enrolled - ${faceName}`, true); // **TAMBAH**
    
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.value = `Face ID: ${faceID} - ${faceName} (${dateTime})`;
        imageInput.style.backgroundColor = '#d4edda';
    }
    
    showEnrolledFaceResult(faceID, faceName, dateTime);
}

                // TAMBAH FUNGSI BARU: Tampilkan hasil face yang sudah di-enroll
                function showEnrolledFaceResult(faceID, faceName, dateTime) {
                    const container = document.getElementById('photo-preview-container');
                    if (container) {
                        container.innerHTML = `
                            <div class="alert alert-success" role="alert">
                                <h5 class="alert-heading">🎯 Enrolled Face Recognized!</h5>
                                <hr>
                                <p><strong>Face ID:</strong> ${faceID}</p>
                                <p><strong>Identity:</strong> ${faceName}</p>
                                <p><strong>Recognized at:</strong> ${dateTime}</p>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Face successfully recognized</small>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="resetFaceDetection()">
                                        Detect Again
                                    </button>
                                </div>
                            </div>
                        `;
                    }
                }

                // Fungsi untuk reset deteksi wajah
                async function resetFaceDetection() {
                    try {
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
                // **TAMBAH**: Reset flag
                isWaitingForFaceDetection = false;
                
                const container = document.getElementById('photo-preview-container');
                const refreshBtn = document.getElementById('refresh-btn');
                
                if (container) {
                    container.style.display = 'none';
                    container.innerHTML = '';
                }
                
                if (refreshBtn) {
                    refreshBtn.style.display = 'none';
                }
                
                const imageInput = document.getElementById('image');
            
                
                resetFaceDetection();
            }

                // Fungsi untuk mengecek status NodeMCU
                async function checkForNewFaceID() {
                    if (!isWaitingForFaceDetection) {
                        return;
                    }
                    
                    try {
                        const response = await fetch(`http://${NODEMCU_IP}:${NODEMCU_PORT}/detection`, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            timeout: 5000 // **TAMBAH**: timeout 5 detik
                        });
                        
                        if (response.ok) {
                            const data = await response.json();
                            console.log('Data received from NodeMCU:', data); // **TAMBAH**: Debug log
                            
                            if (data.last_face_id !== undefined && data.last_face_id !== lastReceivedFaceID) {
                                lastReceivedFaceID = data.last_face_id;
                                
                                if (data.is_enrolled === true && data.last_face_id > 0) {
                                    handleEnrolledFace(data.last_face_id, data.last_detection_time);
                                } else {
                                    handleNewFaceID(data.last_face_id, data.last_detection_time);
                                }
                                
                                // Stop detection setelah mendapat hasil
                                isWaitingForFaceDetection = false;
                                if (faceIDPollingInterval) {
                                    clearInterval(faceIDPollingInterval);
                                }
                            }
                        } else {
                            console.error('NodeMCU response not OK:', response.status);
                        }
                    } catch (error) {
                        console.error('Error checking Face ID from NodeMCU:', error);
                        updateFaceDetectionStatus('Error: Cannot connect to NodeMCU', 'danger');
                    }
                }

                // **TAMBAH FUNGSI BARU** - Cek status NodeMCU
                async function checkNodeMCUStatus() {
                    try {
                        const response = await fetch(`http://${NODEMCU_IP}:${NODEMCU_PORT}/status`, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            timeout: 3000
                        });
                        
                        if (response.ok) {
                            const data = await response.json();
                            console.log('NodeMCU Status:', data);
                            return true;
                        }
                        return false;
                    } catch (error) {
                        console.error('NodeMCU not accessible:', error);
                        return false;
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
                        window.openCameraCapture = openCameraCapture;
                        window.refreshPhoto = refreshPhoto;
                        window.resetFaceDetection = resetFaceDetection;
                        window.startFaceDetection = startFaceDetection; // **TAMBAH**
                        window.stopFaceDetection = stopFaceDetection;   // **TAMBAH**
                        window.autoDetectESP32IP = autoDetectESP32IP;
                        window.getESP32CamIP = getESP32CamIP;
                        
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
        </div>
    </div>
</body>
</html>