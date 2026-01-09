<?php
include "koneksi.php";

$keywordBuku = "";
if(isset($_GET['cari_buku'])) {
    $keywordBuku = $_GET['cari_buku'];
}

$keywordPenerbit = "";
if(isset($_GET['cari_penerbit'])) {
    $keywordPenerbit = $_GET['cari_penerbit'];
}

$sql = "SELECT b.*, p.namaPenerbit 
        FROM buku b
        JOIN penerbit p ON b.penerbitID = p.IDPenerbit
        WHERE b.namaBuku LIKE '%$keywordBuku%'
        ORDER BY b.IDBuku ASC";
$result = mysqli_query($koneksi, $sql);

$sqlPenerbit = "SELECT * FROM penerbit 
                WHERE namaPenerbit LIKE '%$keywordPenerbit%' 
                OR alamat LIKE '%$keywordPenerbit%'
                OR kota LIKE '%$keywordPenerbit%'
                ORDER BY IDPenerbit ASC";
$dataPenerbit = mysqli_query($koneksi, $sqlPenerbit);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Toko Buku</title>
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
            border-bottom: 3px solid #6e89ffff;
            padding-bottom: 10px;
            display: inline-block;
        }

        .search-form {
            margin: 25px 0;
            display: flex;
            gap: 10px;
            max-width: 500px;
        }

        .search-form input[type="text"] {
            flex: 1;
            padding: 12px 20px;
            border: 2px solid #ddd;
            border-radius: 25px;
            font-size: 15px;
            transition: all 0.3s;
        }

        .search-form input[type="text"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.2);
        }

        .search-form button {
            padding: 12px 30px;
            background: #764ba2 ;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .search-form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .search-form .clear-btn {
            padding: 12px 20px;
            background: #f44336;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .search-form .clear-btn:hover {
            background: #da190b;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(244, 67, 54, 0.4);
        }

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

        .btn {
            display: inline-block;
            padding: 10px 25px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .btn-add:hover {
            box-shadow: 0 5px 15px rgba(17, 153, 142, 0.4);
        }

        .navigation {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
            text-align: center;
        }

        .navigation a {
            color: #303651ff;
            text-decoration: none;
            font-weight: 600;
            margin: 0 15px;
            transition: all 0.3s;
            font-size: 15px;
        }

        .navigation a:hover {
            color: #564ec2ff;
            text-decoration: underline;
        }

        .section {
            margin: 40px 0;
        }

        .search-info {
            background: #e3f2fd;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            color: #1976d2;
            font-weight: 500;
            display: inline-block;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 22px;
            }

            .search-form {
                flex-direction: column;
            }

            .search-form button,
            .search-form .clear-btn {
                width: 100%;
            }

            table th, table td {
                padding: 10px;
                font-size: 13px;
            }

            .navigation a {
                display: block;
                margin: 10px 0;
            }
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="navigation">
            <a href="admin.php">🔧 Halaman Admin</a> 
        </div>

        <div class="section">
            <h2>📚 Daftar Buku</h2>
            <form method="GET" class="search-form">
                <input type="text" name="cari_buku" placeholder="🔍 Cari nama buku..." value="<?= htmlspecialchars($keywordBuku) ?>">
                <button type="submit">Cari</button>
                <?php if($keywordBuku != ""): ?>
                    <a href="index.php" class="clear-btn">✖ Reset</a>
                <?php endif; ?>
            </form>

            <?php if($keywordBuku != ""): ?>
                <div class="search-info">
                    📌 Menampilkan hasil pencarian untuk: <strong>"<?= htmlspecialchars($keywordBuku) ?>"</strong>
                </div>
            <?php endif; ?>

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
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) : 
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($row['IDBuku']) ?></td>
                            <td><?= htmlspecialchars($row['kategori']) ?></td>
                            <td><?= htmlspecialchars($row['namaBuku']) ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($row['stock']) ?></td>
                            <td><?= htmlspecialchars($row['namaPenerbit']) ?></td>
                        </tr>
                        <?php 
                            endwhile;
                        } else {
                            echo '<tr><td colspan="6" class="empty-state">Tidak ada data buku yang ditemukan</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section">
            <h2>🏢 Data Penerbit</h2>
            
            <form method="GET" class="search-form">
                <input type="text" name="cari_penerbit" placeholder="🔍 Cari nama penerbit, alamat, atau kota..." value="<?= htmlspecialchars($keywordPenerbit) ?>">
                <button type="submit">Cari</button>
                <?php if($keywordPenerbit != ""): ?>
                    <a href="index.php" class="clear-btn">✖ Reset</a>
                <?php endif; ?>
            </form>

            <?php if($keywordPenerbit != ""): ?>
                <div class="search-info">
                    📌 Menampilkan hasil pencarian untuk: <strong>"<?= htmlspecialchars($keywordPenerbit) ?>"</strong>
                </div>
            <?php endif; ?>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Penerbit</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>No Telp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(mysqli_num_rows($dataPenerbit) > 0) {
                            while($d = mysqli_fetch_array($dataPenerbit)){
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($d['IDPenerbit']); ?></td>
                            <td><?= htmlspecialchars($d['namaPenerbit']); ?></td>
                            <td><?= htmlspecialchars($d['alamat']); ?></td>
                            <td><?= htmlspecialchars($d['kota']); ?></td>
                            <td><?= htmlspecialchars($d['noTelp']); ?></td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo '<tr><td colspan="5" class="empty-state">Tidak ada data penerbit ditemukan</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>