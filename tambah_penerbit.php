<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penerbit</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #d6d7d9ff;
            min-height: 100vh;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 600px;
            width: 100%;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 40px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-header h2 {
            color: #333;
            font-size: 28px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
            display: inline-block;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #666;
            font-size: 14px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-group input[type="text"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.2);
        }

        .form-group input[type="text"]:hover {
            border-color: #b8c5f2;
        }

        /* Button Styles */
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }

        .btn-submit {
            background: #14a957ff;
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(17, 153, 142, 0.4);
        }

        .btn-back {
            background: #4846d4ff;
            color: white;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 33, 125, 0.4);
        }

        /* Required indicator */
        .required {
            color: #f44336;
            margin-left: 3px;
        }

        /* Info text */
        .info-text {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }

        /* Input Icons */
        .input-icon {
            margin-right: 5px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 25px;
            }

            .page-header h2 {
                font-size: 24px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h2>🏢 Tambah Data Penerbit</h2>
            <p>Lengkapi formulir di bawah untuk menambahkan penerbit baru</p>
        </div>

        <form method="POST">
            <div class="form-group">
                <label for="IDBuku">
                    <span class="input-icon">🔖</span>
                    ID Penerbit
                    <span class="required">*</span>
                </label>
                <input type="text" id="IDPenerbit" name="IDPenerbit" placeholder="Masukan ID Penerbit" required>
                <p class="info-text">Contoh: SP001</p>
            </div>

            <div class="form-group">
                <label for="nama">
                    <span class="input-icon">🏷️</span>
                    Nama Penerbit
                    <span class="required">*</span>
                </label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Penerbit" required>
                <p class="info-text">Contoh: Gramedia, Erlangga, Mizan</p>
            </div>

            <div class="form-group">
                <label for="alamat">
                    <span class="input-icon">📍</span>
                    Alamat
                    <span class="required">*</span>
                </label>
                <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat Lengkap" required>
                <p class="info-text">Masukkan alamat lengkap kantor penerbit</p>
            </div>

            <div class="form-group">
                <label for="kota">
                    <span class="input-icon">🏙️</span>
                    Kota
                    <span class="required">*</span>
                </label>
                <input type="text" id="kota" name="kota" placeholder="Masukkan Kota" required>
                <p class="info-text">Contoh: Jakarta, Bandung, Surabaya</p>
            </div>

            <div class="form-group">
                <label for="telp">
                    <span class="input-icon">📞</span>
                    No Telp
                    <span class="required">*</span>
                </label>
                <input type="text" id="telp" name="telp" placeholder="Masukkan Nomor Telepon" required>
                <p class="info-text">Contoh: 021-12345678 atau 081234567890</p>
            </div>

            <div class="button-group">
                <button type="submit" name="simpan" class="btn btn-submit">
                    ✅ Simpan Data
                </button>
                <a href="admin.php" class="btn btn-back">
                    ⬅️ Kembali
                </a>
            </div>
        </form>
    </div>
    <?php
    if(isset($_POST['simpan'])){
        $IDPenerbit = $_POST['IDPenerbit'];
        $nama   = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $kota   = $_POST['kota'];
        $telp   = $_POST['telp'];

        $query = mysqli_query($koneksi, "INSERT INTO penerbit(IDPenerbit, namaPenerbit, alamat, kota, noTelp)
                                         VALUES('$IDPenerbit', '$nama', '$alamat', '$kota', '$telp')");

        if($query){
            echo "<script>alert('Berhasil ditambahkan'); window.location='admin.php';</script>";
        } else {
            echo "<script>alert('Gagal: " . mysqli_error($koneksi) . "');</script>";
        }
    }
    ?>
</body>
</html>