<?php
class OrdersD96AReader
{
    private $segmentTerminator = "'";
    private $elementSeparator = '+';
    private $componentSeparator = ':';

    public function parseFile(string $path): array
    {
        if (!is_file($path)) {
            throw new InvalidArgumentException("File not found: {$path}");
        }
        $content = file_get_contents($path);
        return $this->parse($content);
    }

    public function parse(string $content): array
    {
        $segments = explode($this->segmentTerminator, $content);
        $result = [];
        foreach ($segments as $segment) {
            $segment = trim($segment);
            if ($segment === '') {
                continue;
            }
            $parts = explode($this->elementSeparator, $segment);
            $tag = array_shift($parts);
            $elements = [];
            foreach ($parts as $part) {
                $elements[] = explode($this->componentSeparator, $part);
            }
            $result[] = [
                'tag' => $tag,
                'elements' => $elements,
            ];
        }
        return $result;
    }
}
