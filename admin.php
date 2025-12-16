<?php
include "koneksi.php";


if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM buku WHERE IDBuku='$id'");
    header("Location: admin.php");
    exit;
}

if(isset($_GET['id']) && !isset($_GET['hapus'])){
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM penerbit WHERE IDPenerbit='$id'");
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Data</title>
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
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 30px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
            display: inline-block;
        }

        /* Table Styles */
        .table-wrapper {
            overflow-x: auto;
            margin: 25px 0;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        table th {
            background: #764ba2;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
            color: #555;
        }

        table tr:hover {
            background-color: #f8f9ff;
            transition: all 0.2s;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        /* Action Links */
        .action-links a {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-block;
            margin: 2px;
        }

        .action-links .edit-btn {
            background: #4CAF50;
            color: white;
        }

        .action-links .edit-btn:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(76, 175, 80, 0.3);
        }

        .action-links .delete-btn {
            background: #f44336;
            color: white;
        }

        .action-links .delete-btn:hover {
            background: #da190b;
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(244, 67, 54, 0.3);
        }

        /* Buttons and Links */
        .btn {
            display: inline-block;
            padding: 10px 25px;
            background: #764ba2;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
            margin: 10px 5px;
            font-size: 14px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-add {
            background:  #14a957ff;
        }

        .btn-add:hover {
            box-shadow: 0 5px 15px rgba(17, 153, 142, 0.4);
        }

        .btn-back {
            background: #4846d4ff;
        }

        .btn-back:hover {
            box-shadow: 0 5px 15px rgba(25, 33, 125, 0.4);
        }

        /* Navigation */
        .navigation {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
            text-align: center;
        }

        /* Section Spacing */
        .section {
            margin: 40px 0;
        }

        .button-group {
            margin: 20px 0;
        }

        /* Header with icon */
        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header h1 {
            color: #333;
            font-size: 36px;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #666;
            font-size: 16px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 22px;
            }

            table th, table td {
                padding: 10px;
                font-size: 13px;
            }

            .action-links a {
                display: block;
                margin: 5px 0;
                text-align: center;
            }

            .btn {
                display: block;
                margin: 10px 0;
                text-align: center;
            }
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
            font-style: italic;
        }

        /* Alert Style */
        .alert {
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>🔧 Admin Panel</h1>
            <p>Kelola data buku dan penerbit</p>
        </div>

        <!-- Kelola Data Buku -->
        <div class="section">
            <h2>📚 Kelola Data Buku</h2>
            
            <div class="button-group">
                <a href="tambah_buku.php" class="btn btn-add">+ Tambah Buku Baru</a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID Buku</th>
                            <th>Kategori</th>
                            <th>Nama Buku</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Penerbit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT b.*, p.namaPenerbit 
                                FROM buku b
                                JOIN penerbit p ON b.penerbitID = p.IDPenerbit
                                ORDER BY b.IDBuku ASC";
                        $result = mysqli_query($koneksi, $sql);

                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)): 
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($row['IDBuku']) ?></td>
                            <td><?= htmlspecialchars($row['kategori']) ?></td>
                            <td><?= htmlspecialchars($row['namaBuku']) ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($row['stock']) ?></td>
                            <td><?= htmlspecialchars($row['namaPenerbit']) ?></td>
                            <td class="action-links">
                                <a href="edit_buku.php?id=<?= $row['IDBuku'] ?>" class="edit-btn">✏️ Edit</a>
                                <a href="admin.php?hapus=<?= $row['IDBuku'] ?>" class="delete-btn" onclick="return confirm('Yakin ingin menghapus buku ini?')">🗑️ Hapus</a>
                            </td>
                        </tr>
                        <?php 
                            endwhile;
                        } else {
                            echo '<tr><td colspan="7" class="empty-state">Belum ada data buku</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Data Penerbit -->
        <div class="section">
            <h2>🏢 Data Penerbit</h2>
            
            <div class="button-group">
                <a href="tambah_penerbit.php" class="btn btn-add">+ Tambah Penerbit</a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Penerbit</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>No Telp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = mysqli_query($koneksi, "SELECT * FROM penerbit ORDER BY IDPenerbit ASC");
                        
                        if(mysqli_num_rows($data) > 0) {
                            while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($d['IDPenerbit']); ?></td>
                            <td><?= htmlspecialchars($d['namaPenerbit']); ?></td>
                            <td><?= htmlspecialchars($d['alamat']); ?></td>
                            <td><?= htmlspecialchars($d['kota']); ?></td>
                            <td><?= htmlspecialchars($d['noTelp']); ?></td>
                            <td class="action-links">
                                <a href="edit_penerbit.php?id=<?= $d['IDPenerbit']; ?>" class="edit-btn">✏️ Edit</a>
                                <a href="admin.php?id=<?= $d['IDPenerbit']; ?>" class="delete-btn" onclick="return confirm('Yakin ingin menghapus penerbit ini?')">🗑️ Hapus</a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo '<tr><td colspan="6" class="empty-state">Belum ada data penerbit</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="navigation">
            <a href="index.php" class="btn btn-back">⬅️ Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>