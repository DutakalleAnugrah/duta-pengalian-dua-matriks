<?php
$b1 = isset($_POST['b1']) ? (int)$_POST['b1'] : 0;
$k1 = isset($_POST['k1']) ? (int)$_POST['k1'] : 0;
$b2 = isset($_POST['b2']) ? (int)$_POST['b2'] : 0;
$k2 = isset($_POST['k2']) ? (int)$_POST['k2'] : 0;

$pesan = '';
$langkah = 1;

if ($b1 > 0 && $k1 > 0 && $b2 > 0 && $k2 > 0) {
    if ($k1 == $b2) {
        $langkah = 2;
    } else {
        $pesan = 'Kolom matriks 1 harus sama dengan baris matriks 2. Silakan input ulang.';
    }
}

if ($langkah == 2 && isset($_POST['m1']) && isset($_POST['m2'])) {
    $langkah = 3;
}

if ($langkah == 3) {
    $m1 = $_POST['m1'];
    $m2 = $_POST['m2'];
    $nb = $b1;
    $nk = $k2;
    $mh = [];

    for ($i = 0; $i < $nb; $i++) {
        for ($j = 0; $j < $nk; $j++) {
            $mh[$i][$j] = 0;
            for ($k = 0; $k < $k1; $k++) {
                $mh[$i][$j] = $mh[$i][$j] + ((float)$m1[$i][$k] * (float)$m2[$k][$j]);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Perkalian Matriks</title>
</head>
<body>

<h2>Perkalian Dua Matriks</h2>

<?php if ($pesan != '') { ?>
    <p><b><?php echo $pesan; ?></b></p>
<?php } ?>

<?php if ($langkah == 1) { ?>

    <form method="post">
        <p>Baris Matriks 1: <input type="number" name="b1" min="1" required></p>
        <p>Kolom Matriks 1: <input type="number" name="k1" min="1" required></p>
        <p>Baris Matriks 2: <input type="number" name="b2" min="1" required></p>
        <p>Kolom Matriks 2: <input type="number" name="k2" min="1" required></p>
        <button type="submit">Lanjut</button>
    </form>

<?php } ?>

<?php if ($langkah == 2) { ?>

    <form method="post">
        <input type="hidden" name="b1" value="<?php echo $b1; ?>">
        <input type="hidden" name="k1" value="<?php echo $k1; ?>">
        <input type="hidden" name="b2" value="<?php echo $b2; ?>">
        <input type="hidden" name="k2" value="<?php echo $k2; ?>">

        <h3>Matriks 1 (<?php echo $b1; ?> x <?php echo $k1; ?>)</h3>
        <?php for ($i = 0; $i < $b1; $i++) { ?>
            <p>
            <?php for ($j = 0; $j < $k1; $j++) { ?>
                <input type="number" step="any" name="m1[<?php echo $i; ?>][<?php echo $j; ?>]" size="4" required>
            <?php } ?>
            </p>
        <?php } ?>

        <h3>Matriks 2 (<?php echo $b2; ?> x <?php echo $k2; ?>)</h3>
        <?php for ($i = 0; $i < $b2; $i++) { ?>
            <p>
            <?php for ($j = 0; $j < $k2; $j++) { ?>
                <input type="number" step="any" name="m2[<?php echo $i; ?>][<?php echo $j; ?>]" size="4" required>
            <?php } ?>
            </p>
        <?php } ?>

        <button type="submit">Hitung</button>
    </form>

<?php } ?>

<?php if ($langkah == 3) { ?>

    <h3>Matriks 1</h3>
    <table border="1" cellpadding="5">
        <?php for ($i = 0; $i < $b1; $i++) { ?>
            <tr>
                <?php for ($j = 0; $j < $k1; $j++) { ?>
                    <td><?php echo $m1[$i][$j]; ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>

    <h3>Matriks 2</h3>
    <table border="1" cellpadding="5">
        <?php for ($i = 0; $i < $b2; $i++) { ?>
            <tr>
                <?php for ($j = 0; $j < $k2; $j++) { ?>
                    <td><?php echo $m2[$i][$j]; ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>

    <h3>Matriks Hasil (<?php echo $nb; ?> x <?php echo $nk; ?>)</h3>
    <table border="1" cellpadding="5">
        <?php for ($i = 0; $i < $nb; $i++) { ?>
            <tr>
                <?php for ($j = 0; $j < $nk; $j++) { ?>
                    <td><?php echo $mh[$i][$j]; ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>

    <p><a href="">Hitung lagi</a></p>

<?php } ?>

</body>
</html>