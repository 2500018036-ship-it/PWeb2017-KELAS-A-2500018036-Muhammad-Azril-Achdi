<?php
$mahasiswa = [];

function hitungRataRata($data)
{
    if (count($data) == 0) {
        return 0;
    }

    $total = 0;

    foreach ($data as $mhs) {
        $total += $mhs['nilai'];
    }

    return $total / count($data);
}

function nilaiTertinggi($data)
{
    if (count($data) == 0) {
        return "-";
    }

    $tertinggi = $data[0];

    foreach ($data as $mhs) {
        if ($mhs['nilai'] > $tertinggi['nilai']) {
            $tertinggi = $mhs;
        }
    }

    return $tertinggi['nama'] . " (" . $tertinggi['nilai'] . ")";
}

function tentukanGrade($nilai)
{
    if ($nilai >= 85) {
        return "A";
    } elseif ($nilai >= 70) {
        return "B";
    } elseif ($nilai >= 60) {
        return "C";
    } elseif ($nilai >= 50) {
        return "D";
    } else {
        return "E";
    }
}

if (isset($_POST['submit'])) {

    $namaArray = $_POST['nama'];
    $nilaiArray = $_POST['nilai'];

    for ($i = 0; $i < count($namaArray); $i++) {
        if (!empty($namaArray[$i])) {
            $mahasiswa[] = [
                'nama' => $namaArray[$i],
                'nilai' => $nilaiArray[$i]
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tugas PHP Array & Function</title>
</head>

<body>

    <div class="container">

        <div class="card">
            <h2>Pengelolaan Nilai Mahasiswa</h2>

            <form method="POST">

                <?php for ($i = 1; $i <= 5; $i++) : ?>

                    <div class="form-group">
                        <input type="text"
                            name="nama[]"
                            placeholder="Nama Mahasiswa <?= $i ?>"
                            required>

                        <input type="number"
                            name="nilai[]"
                            placeholder="Nilai"
                            min="0"
                            max="100"
                            required>
                    </div>

                <?php endfor; ?>

                <button type="submit" name="submit">
                    Proses Data
                </button>

            </form>
        </div>

        <?php if (count($mahasiswa) > 0) : ?>

            <div class="card">

                <h3>Hasil Data</h3>

                <table>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                        <th>Grade</th>
                    </tr>

                    <?php foreach ($mahasiswa as $index => $mhs) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $mhs['nama'] ?></td>
                            <td><?= $mhs['nilai'] ?></td>
                            <td><?= tentukanGrade($mhs['nilai']) ?></td>
                        </tr>
                    <?php endforeach; ?>

                </table>

                <div class="hasil">
                    <p><strong>Rata-rata Nilai :</strong>
                        <?= number_format(hitungRataRata($mahasiswa), 2) ?>
                    </p>

                    <p><strong>Nilai Tertinggi :</strong>
                        <?= nilaiTertinggi($mahasiswa) ?>
                    </p>
                </div>

            </div>

        <?php endif; ?>

    </div>

</body>

</html>