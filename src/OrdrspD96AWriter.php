<?php
class OrdrspD96AWriter
{
    private $segmentTerminator = "'";
    private $elementSeparator = '+';
    private $componentSeparator = ':';

    public function generateFromArray(array $order): string
    {
        $segments = [];
        $dateTime = date('ymd:Hi');
        $segments[] = "UNB+UNOA:1+SENDERID+RECEIVERID+{$dateTime}+000000001";
        $segments[] = 'UNH+1+ORDRSP:D:96A:UN';
        $segments[] = 'BGM+231+' . $order['order_number'] . '+29';
        $segments[] = 'DTM+137:' . $order['order_date'] . ':102';
        $segments[] = 'NAD+BY+' . $order['buyer'] . '::16';
        $segments[] = 'NAD+SE+' . $order['seller'] . '::16';
        foreach ($order['lines'] as $line) {
            $segments[] = 'LIN+' . $line['line_number'] . '++' . $line['item'] . ':IN';
            $segments[] = 'QTY+21:' . $line['quantity'];
        }
        $segments[] = 'UNS+S';
        $segments[] = 'UNT+' . (count($segments) + 1) . '+1';
        $segments[] = 'UNZ+1+000000001';
        return implode($this->segmentTerminator, $segments) . $this->segmentTerminator;
    }

    public function generateFromJson(string $json): string
    {
        $data = json_decode($json, true);
        if (!is_array($data)) {
            throw new InvalidArgumentException('Invalid JSON');
        }
        return $this->generateFromArray($data);
    }

    public function writeFile(array $order, string $path): void
    {
        $edi = $this->generateFromArray($order);
        file_put_contents($path, $edi);
    }
}
