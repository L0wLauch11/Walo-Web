<?php

include_once 'DownloadsTableEntry.class.php';

class DownloadsTable {
    public $entries = [];

    public function addEntry($fileUrl) {
        $entry = new DownloadsTableEntry($fileUrl);
        array_push($this->entries, $entry);

        return $this;
    }

    public function addEntries($entries) {
        foreach ($entries as $entry) {
            array_push($this->entries, $entry);
        }

        return $this;
    }

    public function addEntriesFromFolder($folder, $fileExtension) {
        $files = glob($_SERVER['DOCUMENT_ROOT']."$folder/*.$fileExtension");

        usort($files, function($a, $b) {
            return filemtime($b) - filemtime($a);
        });

        foreach ($files as $file) {
            $filename = basename($file);
            $fileUrl = "$folder/$filename";

            $entry = new DownloadsTableEntry($fileUrl);
            array_push($this->entries, $entry);
        }

        return $this;
    }

    public function render() {
        $table = '';
        
        $table .= <<<HTML
            <table class="downloads-table">
                <tr class="row-darker">
                    <th>Datei</th>
                    <th>Version</th>
                    <th>Datum</th>
                    <th style="font-weight: normal;">DL</th>
                </tr>
        HTML;

        $second = false;
        foreach ($this->entries as $entry) {
            $isSecond = $second ? 'class="row-darker"' : '';

            $table .= <<<HTML
                <tr $isSecond>
                    <td>{$entry->getFileName()}</td>
                    <td>{$entry->getFileVersion()}</td>
                    <td>{$entry->getFileDate()}</td>
                    <td>
                        <a href="{$entry->getFileUrl()}">
                            <img src="/assets/icon/icon-download.png" alt="">
                        </a>
                    </td>
                </tr>
            HTML;

            $second = !$second;
        }

        $table .= '</table>';

        return $table;
    }
}