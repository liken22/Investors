<?php

function fill_file_individual($rep_number, $file){
fwrite($file, "<head>\n" );
fwrite($file, "<meta http-equiv='refresh' content='0;URL=http://www.corporatemerchantsolutions.com/index.php?ind_number=$rep_number'>\n" );
fwrite($file, "</head>\n" );
fwrite($file, "<body>\n" );
fwrite($file, "</html>" );
}

function fill_file_corporate($rep_number, $file){
fwrite($file, "<head>\n" );
fwrite($file, "<meta http-equiv='refresh' content='0;URL=http://www.corporatemerchantsolutions.com/index.php?REP_NUMBER=$rep_number'>\n" );
fwrite($file, "</head>\n" );
fwrite($file, "<body>\n" );
fwrite($file, "</html>" );
}

?>