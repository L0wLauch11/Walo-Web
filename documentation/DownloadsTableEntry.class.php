<?php

class DownloadsTableEntry {
    public string $fileUrl;
    public string $fileVersion;

    public function __construct($fileUrl, $fileVersion = null) {
        $this->fileUrl = $fileUrl;

        if ($fileVersion == null) {
            if (preg_match('/-(\d+\.\d+(?:\.\d+)?)(?=\D*$)/', basename($fileUrl), $matches)) {
                $this->fileVersion = $matches[1];
            } else {
                $this->fileVersion = 'latest';
            }
        } else {
            $this->fileVersion = $fileVersion;
        }
    }

    public function getFileUrl(): string {
        return $this->fileUrl;
    }

    public function getFileVersion(): string {
        return $this->fileVersion;
    }

    public function getFileName(): string {
        return basename($this->fileUrl);
    }

    public function getFileDate(): string {
        return date('F j, Y H:i', filemtime($_SERVER['DOCUMENT_ROOT'].'/'.$this->fileUrl));
    }
}