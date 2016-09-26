<?php
	function setImage($filename,$url) {
		if (isImage($filename)) {
			return getObject($url);
		} else {
			if (isDoc($filename)) {
				return getObject(getDocIcon(),'250','250');
			}
			elseif (isExcel($filename)) {
				return getObject(getExcelIcon(),'250','250');
			} 
			elseif (isPDF($filename)) {
				return getObject(getPDFIcon(),'250','250');
			}
			elseif (isRAR($filename)) {
				return getObject(getRARIcon(),'250','250');
			}
			else {
				return getObject(getFileIcon(),'250','250');
			}
		}
	}

	function getObject($file,$width = '',$height = '') {
		// return '<img src="'.$file.'" width="'.$width.'" height="'.$height.'" />';
		return $file;
	}

	function getFileIcon() {
		return asset('public/assets/system/media/images/file_icon.gif');
	}

	function getDocIcon() {
		return asset('public/assets/system/media/images/doc_icon.png');
	}

	function getExcelIcon() {
		return asset('public/assets/system/media/images/excel_icon.png');
	}

	function getPDFIcon() {
		return asset('public/assets/system/media/images/pdf_icon.png');
	}

	function getRARIcon() {
		return asset('public/assets/system/media/images/rar_icon.png');
	}

	function isImage($filename) {
		if (in_array(getExtension($filename),imageType())) {
			return true;
		}
		return false;
	}

	function isDoc($filename) {
		if (in_array(getExtension($filename),docType())) {
			return true;
		}
		return false;
	}

	function isExcel($filename) {
		if (in_array(getExtension($filename),excelType())) {
			return true;
		}
		return false;
	}

	function isPDF($filename) {
		if (in_array(getExtension($filename),pdfType())) {
			return true;
		}
		return false;
	}

	function isRAR($filename) {
		if (in_array(getExtension($filename),rarType())) {
			return true;
		}
		return false;
	}

	function imageType() {
		return [
			'png','jpg','jpeg','gif'
		];
	}

	function docType() {
		return [
			'docx','doc'
		];
	}

	function excelType() {
		return [
			'xls','xlsx','csv'
		];
	}

	function pdfType() {
		return [
			'pdf'
		];
	}

	function rarType() {
		return [
			'rar'
		];
	}

	function getExtension($filename) {
		return isset(explode('.',$filename)[1]) ? strtolower(explode('.',$filename)[1]) : '';
	}

?>