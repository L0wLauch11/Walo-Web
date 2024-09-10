<?php

class DownloadsTableEntry {
    public $fileUrl;
    public $fileVersion;

    public function __construct($fileUrl, $fileVersion = null) {
        $this->fileUrl = $fileUrl;

        if ($fileVersion == null) {
            if (preg_match('/-(\d+\.\d+(?:\.\d+)?)(?=[^\d]*$)/', basename($fileUrl), $matches)) {
                $this->fileVersion = $matches[1];
            } else {
                $this->fileVersion = 'latest';
            }
        } else {
            $this->fileVersion = $fileVersion;
        }
    }

    public function getFileUrl() {
        return $this->fileUrl;
    }

    public function getFileVersion() {
        return $this->fileVersion;
    }

    public function getFileName() {
        return basename($this->fileUrl);
    }

    public function getFileDate() {
        return date('F j, Y H:i', filemtime($_SERVER['DOCUMENT_ROOT'].'/'.$this->fileUrl));
    }
}