<?php
class BaseController extends Controller {
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout() {
		if (!is_null($this->layout)) {
			$this->layout = View::make($this->layout);
		}
	}
	public function delVietnamesesImg($value) {
		$marTViet = array(
			" ", "  ",
		);
		$marKoDau = array(
			"_", "_");
		return str_replace($marTViet, $marKoDau, $value);
	}
	public function getAliasImg($value) {
		$value = $this->delVietnamesesImg($value);
		$value = str_replace(array("  ", "__", " "), "_", $value);
		return $value;
	}
	public function delVietnameses($value) {
		$marTViet = array("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă",
			"ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề"
			, "ế", "ệ", "ể", "ễ",
			"ì", "í", "ị", "ỉ", "ĩ",
			"ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ"
			, "ờ", "ớ", "ợ", "ở", "ỡ",
			"ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
			"ỳ", "ý", "ỵ", "ỷ", "ỹ",
			"đ",
			"À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă"
			, "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
			"È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
			"Ì", "Í", "Ị", "Ỉ", "Ĩ",
			"Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ"
			, "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
			"Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
			"Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
			"Đ",
			"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L"
			, "M", "N", "O", "P", "Q",
			"R", "S", "T", "U", "V", "W", "X", "Y", "Z",
			"'", ",", "~", "@", "#", "$", "%", "^", "&", "*", ";", "/", "\\", "|", "`", "!", "(", ")", ">", "<", "=",
			"+", "{", "}", "[", "]", "?",
			"--",
			"---",
			"----",
		);
		$marKoDau = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a"
			, "a", "a", "a", "a", "a", "a",
			"e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
			"i", "i", "i", "i", "i",
			"o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o"
			, "o", "o", "o", "o", "o",
			"u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
			"y", "y", "y", "y", "y",
			"d",
			"A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A"
			, "A", "A", "A", "A", "A",
			"E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
			"I", "I", "I", "I", "I",
			"O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O"
			, "O", "O", "O", "O", "O",
			"U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
			"Y", "Y", "Y", "Y", "Y",
			"D",
			"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l"
			, "m", "n", "o", "p", "q",
			"r", "s", "t", "u", "v", "w", "x", "y", "z",
			"-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-",
			"-", "-", "-", "-", "-", "-",
			"-", "-", "-");
		return str_replace($marTViet, $marKoDau, $value);
	}
	public function getAlias($value) {
		for ($i = 1; $i <= 5; $i++) {
			$value = $this->delVietnameses($value);
			$value = str_replace(array("  ", "--", "---", " ", "__", "_"), "-", $value);
		}
		return $value;
	}
	public function redirect404Page() {
		return View::make('user.body.404');
	}
}