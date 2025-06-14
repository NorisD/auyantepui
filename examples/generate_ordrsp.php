<?php
require_once __DIR__ . '/../src/OrdrspD96AWriter.php';

if ($argc < 3) {
    echo "Usage: php generate_ordrsp.php <input.json> <output.edi>\n";
    exit(1);
}

$writer = new OrdrspD96AWriter();
$json = file_get_contents($argv[1]);
$edi = $writer->generateFromJson($json);
file_put_contents($argv[2], $edi);
echo "Created: {$argv[2]}\n";
