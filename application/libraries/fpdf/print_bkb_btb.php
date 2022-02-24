<?php
require('fpdf.php');

class print_bkb_btb extends FPDF
{
	protected $javascript;
	protected $n_js;

	function IncludeJS($script, $isUTF8 = false)
	{
		if (!$isUTF8)
			$script = utf8_encode($script);
		$this->javascript = $script;
	}

	function _putjavascript()
	{
		$this->_newobj();
		$this->n_js = $this->n;
		$this->_put('<<');
		$this->_put('/Names [(EmbeddedJS) ' . ($this->n + 1) . ' 0 R]');
		$this->_put('>>');
		$this->_put('endobj');
		$this->_newobj();
		$this->_put('<<');
		$this->_put('/S /JavaScript');
		$this->_put('/JS ' . $this->_textstring($this->javascript));
		$this->_put('>>');
		$this->_put('endobj');
	}

	function _putresources()
	{
		parent::_putresources();
		if (!empty($this->javascript)) {
			$this->_putjavascript();
		}
	}

	function _putcatalog()
	{
		parent::_putcatalog();
		if (!empty($this->javascript)) {
			$this->_put('/Names <</JavaScript ' . ($this->n_js) . ' 0 R>>');
		}
	}

	function SetDash($black = null, $white = null)
	{
		if ($black !== null)
			$s = sprintf('[%.3F %.3F] 0 d', $black * $this->k, $white * $this->k);
		else
			$s = '[] 0 d';
		$this->_out($s);
	}

	function AutoPrint($printer = '')
	{
		// Open the print dialog
		if ($printer) {
			$printer = str_replace('\\', '\\\\', $printer);
			$script = "var pp = getPrintParams();";
			$script .= "pp.interactive = pp.constants.interactionLevel.full;";
			$script .= "pp.printerName = '$printer'";
			$script .= "print(pp);";
		} else
			$script = 'print(true);';
		$this->IncludeJS($script);
	}
}
