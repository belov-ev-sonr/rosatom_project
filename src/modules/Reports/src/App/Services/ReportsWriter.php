<?php
namespace Rosatom\Reports\App\Services;

class ReportsWriter
{
    private const TMP_DIR = '/tmp';

    public function writeFile(string $report): string
    {
        $fileName = $this->getFileName();
        $filePath = $this->getFilePath().'/' .$fileName;
        file_put_contents($filePath, $report);

        return $filePath;
    }

    private function getLinkForDownload(string $fileName): string
    {
        return 'http://' .$_SERVER['SERVER_NAME'] .':' .$_SERVER['SERVER_PORT'] .'/tmp/' .$fileName;
    }

    private function getFilePath(): string
    {
        return $_SERVER['DOCUMENT_ROOT'] .self::TMP_DIR;
    }

    private function getFileName(): string
    {
        return uniqid('xml_report_').'.xml';
    }
}
