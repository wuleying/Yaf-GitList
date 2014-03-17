<?php

/**
 * 时间类
 *
 * @author $Author: 5590548@qq.com $
 *
 */

namespace Local\Util;

class String
{

	/**
	 * 随机生成一个长度为 $length 的字符串，默认是 4
	 *
	 * @param integer $length
	 * @return string
	 *
	 */
	public static function randString($length = 4)
	{
		$arr = array(
			'1',
			'2',
			'3',
			'4',
			'5',
			'6',
			'7',
			'8',
			'9',
			'0',
			'a',
			'b',
			'c',
			'd',
			'e',
			'f',
			'g',
			'h',
			'i',
			'j',
			'k',
			'l',
			'm',
			'n',
			'o',
			'p',
			'q',
			'r',
			's',
			't',
			'u',
			'v',
			'w',
			'x',
			'y',
			'z',
			'A',
			'B',
			'C',
			'D',
			'E',
			'F',
			'G',
			'H',
			'I',
			'J',
			'K',
			'L',
			'M',
			'N',
			'O',
			'P',
			'Q',
			'R',
			'S',
			'T',
			'U',
			'V',
			'W',
			'X',
			'Y',
			'Z'
		);
		$salt = '';
		for ($i = 0; $i < $length; $i++)
		{
			$salt .= $arr[rand(0, 61)];
		}
		return $salt;
	}

}