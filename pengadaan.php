<?php
include "koneksi.php";

$sql = "SELECT b.namaBuku, p.namaPenerbit, b.stock
        FROM buku b
        JOIN penerbit p ON b.penerbitID = p.IDPenerbit
        ORDER BY b.stock ASC
        LIMIT 1";

$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengadaan Buku</title>
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
            padding: 40px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .page-header h1 {
            color: #333;
            font-size: 36px;
            margin-bottom: 10px;
            background: #667eea;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-header p {
            color: #666;
            font-size: 16px;
        }

        .alert-box {
            background:  #f5576c;
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.3);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .alert-box .icon {
            font-size: 32px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .alert-box .content h2 {
            font-size: 24px;
            margin-bottom: 5px;
            border: none;
            padding: 0;
            display: block;
            color: white;
        }

        .alert-box .content p {
            font-size: 14px;
            opacity: 0.9;
        }

        .books-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
            margin: 30px 0;
        }

        .book-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 2px solid #f0f0f0;
            position: relative;
            overflow: hidden;
        }

        .book-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background:  #667eea ;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
            border-color: #586eccff;
        }

        .book-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .book-icon {
            font-size: 32px;
            background: #764ba2;
            padding: 12px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 10px rgba(102, 126, 234, 0.3);
        }

        .book-title {
            flex: 1;
        }

        .book-title h3 {
            color: #333;
            font-size: 20px;
            margin-bottom: 3px;
            font-weight: 700;
        }

        .book-info {
            margin: 15px 0;
        }

        .info-row {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f5f5f5;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #667eea;
            min-width: 120px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .info-value {
            color: #555;
            font-size: 15px;
            font-weight: 500;
        }

        .stock-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 14px;
            background: #f5576c;
            color: white;
        }

        @keyframes glow {
            0%, 100% { box-shadow: 0 3px 10px rgba(245, 87, 108, 0.3); }
            50% { box-shadow: 0 5px 20px rgba(245, 87, 108, 0.5); }
        }

        .navigation {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #f0f0f0;
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 14px 35px;
            background:  #667eea ;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
            font-size: 15px;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state-icon {
            font-size: 80px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            color: #666;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #999;
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 25px;
            }

            .page-header h1 {
                font-size: 28px;
            }

            .books-container {
                grid-template-columns: 1fr;
            }

            .alert-box {
                flex-direction: column;
                text-align: center;
            }

            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .info-label {
                min-width: auto;
            }
        }

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

        .book-card {
            animation: fadeIn 0.5s ease-out;
        }

        .book-card:nth-child(1) { animation-delay: 0.1s; }
        .book-card:nth-child(2) { animation-delay: 0.2s; }
        .book-card:nth-child(3) { animation-delay: 0.3s; }
        .book-card:nth-child(4) { animation-delay: 0.4s; }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>📦 Pengadaan Buku</h1>
            <p>Daftar buku yang perlu segera diadakan (stok menipis)</p>
        </div>

        <div class="alert-box">
            <div class="icon">⚠️</div>
            <div class="content">
                <h2>Buku yang perlu dibeli (stok paling sedikit)</h2>
                <p>Berikut adalah daftar buku yang stoknya menipis dan perlu segera diadakan</p>
            </div>
        </div>

        <div class="books-container">
            <?php
            // Simulasi data - ganti dengan query database Anda
            // include "koneksi.php";
            // $query = "SELECT b.*, p.namaPenerbit FROM buku b 
            //           JOIN penerbit p ON b.penerbitID = p.IDPenerbit 
            //           ORDER BY b.stock ASC LIMIT 10";
            // $result = mysqli_query($koneksi, $query);
            
            // Contoh data untuk preview
            $books = [
                [
                    'namaBuku' => 'Bisnis Online',
                    'namaPenerbit' => 'Penerbit Informatika',
                    'stock' => 9
                ]
            ];
            
            if(empty($books)) {
                echo '<div class="empty-state">
                        <div class="empty-state-icon">📚</div>
                        <h3>Tidak Ada Buku yang Perlu Diadakan</h3>
                        <p>Semua buku memiliki stok yang cukup</p>
                      </div>';
            } else {
                foreach($books as $index => $book) {
            ?>
            <div class="book-card">
                <div class="book-card-header">
                    <div class="book-icon">📖</div>
                    <div class="book-title">
                        <h3><?= htmlspecialchars($book['namaBuku']) ?></h3>
                    </div>
                </div>
                
                <div class="book-info">
                    <div class="info-row">
                        <div class="info-label">
                            <span>🏢</span>
                            <span>Penerbit</span>
                        </div>
                        <div class="info-value"><?= htmlspecialchars($book['namaPenerbit']) ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">
                            <span>📦</span>
                            <span>Sisa Stok</span>
                        </div>
                        <div class="info-value">
                            <span class="stock-badge"><?= htmlspecialchars($book['stock']) ?> unit</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                }
            }
            ?>
        </div>

        <div class="navigation">
            <a href="index.php" class="btn">⬅️ Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>