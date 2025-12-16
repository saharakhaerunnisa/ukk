<?php
include "koneksi.php";

$IDBuku = $_GET['id'];

$sql = "SELECT * FROM buku WHERE IDBuku='$IDBuku'";
$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $kategori   = $_POST['kategori'];
    $namaBuku   = $_POST['namaBuku'];
    $harga      = $_POST['harga'];
    $stock      = $_POST['stock'];
    $penerbitID = $_POST['penerbitID'];

    $query = "UPDATE buku SET 
                kategori='$kategori',
                namaBuku='$namaBuku',
                harga='$harga',
                stock='$stock',
                penerbitID='$penerbitID'
              WHERE IDBuku='$IDBuku'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data buku berhasil diperbarui'); window.location='admin.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #d6d7d9ff;;
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

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="number"]:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.2);
        }

        .form-group select {
            cursor: pointer;
            background-color: white;
        }

        .form-group input[type="text"]:hover,
        .form-group input[type="number"]:hover,
        .form-group select:hover {
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
            <h2>📚 Edit Data Buku</h2>
            <p>Lengkapi formulir di bawah untuk menambahkan buku baru</p>
        </div>

        <form method="POST">
            <div class="form-group">
                <label for="IDBuku">
                    <span class="input-icon">🔖</span>
                    ID Buku
                    <span class="required">*</span>
                </label>
                <input type="text" id="IDBuku" name="IDBuku" value="<?= $data['IDBuku'] ?>" required>
                <p class="info-text">Contoh: BK001</p>
            </div>

            <div class="form-group">
                <label for="kategori">
                    <span class="input-icon">📁</span>
                    Kategori
                    <span class="required">*</span>
                </label>
                <input type="text" id="kategori" name="kategori" value="<?= $data['kategori'] ?>" required>
                <p class="info-text">Contoh: Fiksi, Non-Fiksi, Pendidikan</p>
            </div>

            <div class="form-group">
                <label for="namaBuku">
                    <span class="input-icon">📖</span>
                    Nama Buku
                    <span class="required">*</span>
                </label>
                <input type="text" id="namaBuku" name="namaBuku" value="<?= $data['namaBuku'] ?>" required>
            </div>

            <div class="form-group">
                <label for="harga">
                    <span class="input-icon">💰</span>
                    Harga
                    <span class="required">*</span>
                </label>
                <input type="number" id="harga" name="harga" value="<?= $data['harga'] ?>" min="0" required>
                <p class="info-text">Masukkan harga dalam rupiah</p>
            </div>

            <div class="form-group">
                <label for="stock">
                    <span class="input-icon">📦</span>
                    Stock
                    <span class="required">*</span>
                </label>
                <input type="number" id="stock" name="stock"  min="0" value="<?= $data['stock'] ?>"  required>
            </div>

            <div class="form-group">
                <label for="penerbitID">
                    <span class="input-icon">🏢</span>
                    Penerbit
                    <span class="required">*</span>
                </label>
                <select id="penerbitID" name="penerbitID" required>
                    <option value="">-- Pilih Penerbit --</option>
                    <?php
                    $result = mysqli_query($koneksi, "SELECT * FROM penerbit ORDER BY namaPenerbit ASC");
                    while ($p = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . htmlspecialchars($p['IDPenerbit']) . "'>" . 
                             htmlspecialchars($p['namaPenerbit']) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="button-group">
                <button type="submit" name="submit" class="btn btn-submit">
                    ✅ Edit Data
                </button>
                <a href="admin.php" class="btn btn-back">
                    ⬅️ Kembali
                </a>
            </div>
        </form>
    </div>
</body>
</html>
