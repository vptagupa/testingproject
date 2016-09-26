<?php namespace App\Libraries;
use App\Libraries\pdf\TCPDF;
class PDF extends TCPDF{
    
    public $font = 9;

    public $hasMargin = false;

    public $fontFamily = 'helvetica';

    public $customFont = '';

    public function outputHtml($html,$title = 'Report',$resolution = 'LETTER',$O = 'L'){
            
        if (empty($this->customFont)) {
            $this->SetFont($this->fontFamily,'',$this->font);
        } else {
              $this->SetFont($this->addTTFfont(app_path($this->customFont)),'',$this->font);
        }
        
        // if ($this->hasMargin) {
           $this->SetMargins(50, 50, 50, true);
        // }

        if (!empty($resolution) && !empty($O)){
            $this->setPageUnit('pt');
            $this->AddPage($O,$resolution);
        }
        else {
            $this->AddPage();
        }

       
        $this->setTitle($title);
        $this->writeHTML($html);
        $this->output();
    }

    public function outputData($title = 'Report',$resolution = ''){
        $this->SetFont('helvetica','',9);
        if (!empty($resolution)){
            $pdf->setPageUnit('pt');
            $pdf->SetMargins(0,8);
            $pdf->AddPage('L',$resolution);
        }
        else {
            $this->AddPage();
        }
        $this->setTitle($title);
        $this->output();
    }

    private $tds = '';
    private $ths = '';
    private $trs = '';
    private $table = '';


    public function setTd($data,$width = '',$style = '',$align = 'left',$colspan = '1') 
    {
        $this->tds .='<td '.($style ? 'style="'.$style.'"' : '').' '.($width ? 'width="'.$width.'"' : '').' align="'.$align.'" colspan="'.$colspan.'">'.$data.'</td>';
        return $this;
    }

    public function setRow() 
    {
        $this->trs .= "<tr>".$this->tds."</tr>";
        $this->tds = '';
        return $this;
    }

    public function setTh($data,$width = '',$align = 'left') 
    {
        $this->ths .='<th '.($width ? 'width="'.$width .'"': '').'  align="'.$align.'"><b>'.$data.'</b></th>';
        return $this;
    }

    public function setHeader()
    {
        return "<thead><tr>".$this->ths."</tr></thead>";
    }

    public function setTable($width)
    {
        $data = '<table cellspacing="0" cellpadding="1" border="1" width="'.$width.'">'.
            $this->setHeader().
            "<tbody>".
                $this->trs.
            "</tbody>".
            "</table>";
        $this->clearTable();
        return $data;
    }

    public function clearTable()
    {
        $this->trs = '';
        $this->tds = '';
        $this->ths = '';
    }
}



?>