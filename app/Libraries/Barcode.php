<?php namespace App\Libraries;

use App\Libraries\pdf\TCPDF;

class Barcode {
    
    public function page($resolution=null){
        $pdf = new TCPDF;
        $pdf->SetFont('dejavusans','',9);
        if (!empty($resolution)){
            $pdf->setPageUnit('pt');
            $pdf->SetMargins(0,8);
            $pdf->AddPage('L',$resolution);
        }
        else
            $pdf->AddPage();
       
    }
    public function convert_pixels_to_units($value){
       return TCPDF::pixelsToUnits($value); 
    }
    public function output(){
        $pdf = new TCPDF;
         $pdf->output();
    }
    public function title($data){
        TCPDF::Cell(0,0,$data,0,0,'C');
         $this->Ln();
    }
    public function line($val=0){
         TCPDF::Ln($val);
    }
    
    public function table_header($header,$data,$footer){
        
        TCPDF::SetFillColor(219);

        TCPDF::SetTextColor('blue');

        TCPDF::SetDrawColor('white');

        TCPDF::SetLineWidth(0);
        TCPDF::Line(1,1,1,1);
        
        $pageNo=TCPDF::getPage();
        $pageW= TCPDF::getPageWidth($pageNo) /count($header);
       
        $w=array(20,10,70,10,40,40);
 
        $this->Ln();

        for($x=0;$x<=count($header)-1;$x++){
            TCPDF::Cell($w[$x],7,$header[$x],1,0,'C',1);
        }
        
         $this->Ln();
        for($x=0;$x<=count($data)-1;$x++){
            TCPDF::Cell($w[$x],7,$data[$x],1,0,'C',1);
        }
        
         $this->Ln();
        if (!empty($footer)) {
            for($x=0;$x<=count($footer)-1;$x++){
             TCPDF::Cell($w[$x],7,$footer[$x],1,0,'C',1);
            }
        }
      
       
    }
    public function html_Cell($width,$h=30,$text,$b=0,$ln=1,$al='L'){
     
            TCPDF::Cell($width,$h,$text, $b, $ln, $al, 1);
    }
    public function write_html($html,$w=null,$h=null,$ln=null,$al='C'){
            $pdf = new TCPDF;
            $pdf->writeHTML($html, true, false, true, false, $al);
    }
    public function header($width=null,$height=null){
         TCPDF::SetHeaderData('', '',' 001', 'dadsa', array(0,64,255), array(0,64,128));
         TCPDF::setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      
    }
    public function SetTitle($title){
        TCPDF:: SetTitle($title);
    }
    public function custom_barcodes($data,$title){
        $pdf = new TCPDF;
        $style = array(
            'position' => 'C',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 7,
            'stretchtext' => 1
        );
        // $this->write_html('<font size="4">'.$title.'</font>','','','','C');
       
        $pdf->write1DBarcode($data, 'C128', '', '', 100, 45, 4, $style, 'N');
        
    }
    public function barcodes($data){
       
        $style = array(
            'position' => 'C',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );
       
        $this->write_html('<font size="5">DEPARTMENT OF SOCIAL  WELFARE AND DEVELOPMENT</font>','','','','C');
        TCPDF::write1DBarcode($data, 'C128', '', '', 160, 15, 0.4, $style, 'N');
    }
    public function html_table($type=null,$data=null,$header=null,$footer=null){
        
        $body='';
        $td='';
        $GetMargin=TCPDF::getOriginalMargins();
        $xc=0;
      
       foreach($GetMargin as $m){
            
          $margin[$xc]=$m;
          $xc++;
       }
        $TotalMargin=$margin[0]+$margin[0];
 
        $Pagewidth= TCPDF::getPageWidth(TCPDF::getPage());
        
        $toTalBodyWidth=$Pagewidth-$TotalMargin;
        
       /*  foreach($header as $row) {
            $header_td='
                <tr>
                    <td width="10%">'.$row[0].'</td>
                    <td width="5%">'.$row[1].'</td>
                    <td width="50%">'.$row[2].'</td>
                    <td width="5%">'.$row[3].'</td>
                    <td width="15%">'.$row[4].'</td>
                    <td width="15%">'.$row[5].'</td>
                </tr>
            ';
            
        }
        */
        if($type == 'td'){
            foreach($data as $row) {
                
                $ln=count($row)-1;
                for($x=0;$x<=$ln;$x++){
                   $td=$td."<td>".$row[$x]."</td>";
                   
                }
         
                $body=$body."<tr>".$td."</tr>";
                $td='';
            }
        }else{
            $body=$data;
        }
        
        $start='<table border="1" ><tbody>';
        $end='</tbody></table>';
        $html=$start.$header.$body.$footer.$end;
        TCPDF::writeHTML($html, true, false, true, false, 'C');
       
    }
    public function footer_html($data){
        
        $start='<table border="1" ><tbody>';
        $end='</tbody></table>';
        $html=$start.$data.$end;
        
         TCPDF::writeHTML($html, true, false, true, true, 'C');
    
    }
    public function report_logo($path){
         TCPDF::Image($path,30,8,15,15);
    }
    //public function Footer() {
    //
    //     TCPDF::SetY(-15);
    //  
    //     TCPDF::SetFont('helvetica', 'b', 8);
    // 
    //    TCPDF::Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    //}
}



?>