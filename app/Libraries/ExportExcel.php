<?php
namespace App\Libraries;

class ExportExcel {

    protected $ci;

    public function __construct() {
        // $this->ci   = & get_instance();
        $this->path = 'file_upload/temp_export_excel/';

        @mkdir($this->path);
    }

    public function export($data = array(), $file_name = 'export', $html = '', $orientation = 'P', $output = 'D') {

        $file_name .= '_' . date('Ymd_His') . '.xls';
        $file_name = str_replace(' ', '_', $file_name);
        $font      = 'THSarabunNew';
        $file_path = $this->path . $file_name;

        header('Content-Type: application/force-download');
        header('Content-disposition: attachment; filename=' . $file_name);



        if ($orientation == 'L') {
            ?>
            <style>        

            </style>
            <?php

        }
        $this->defaultCSS();
        $html = str_replace('<table  ', '<table border="1" ', $html);
        echo "<html>";
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-UTF-8\">";
        echo "<body>";
        echo $html;
        echo "</body>";
        echo "</html>";



        $data['filename_pdf'] = $file_name . '.xls';
        $data['path']         = $file_path;

        return $data;
    }

    private function createFile($path = '') {
        if (!is_dir($path)) {
            $oldmask = umask(0);
            mkdir($path, 0777);
            umask($oldmask);
        }
    }

    public function defaultCSS() {
        ?>
        <style>        

        </style>
        <?php

    }

}

/* End of file ExportCSV.php */
/* Location: ./application/libraries/ExportCSV.php */
