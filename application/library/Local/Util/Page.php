<?php

/**
 * Page 类
 *
 * @author $Author: 5590548@qq.com $
 *
 */

namespace Local\Util;

class Page
{

	/**
	 * 面包屑导航
	 *
	 * @param array	$data
	 * @return string
	 *
	 */
	public static function breadCrumb($data = array())
	{
		$str = '';
		if (!empty($data))
		{
			$count = count($data);
			$i = 1;
			foreach ($data as $key => $value)
			{
				if ($count == $i)
				{
					$str .= "<li class=\"active\">{$value}</li>";
				}
				else
				{
					if ($key)
					{
						$str .= "<li><a href=\"{$key}\">{$value}</a></li>";
					}
					else
					{
						$str .= "<li class=\"active\">{$value}</li>";
					}
				}
				$i++;
			}
		}
		return $str;
	}

	/**
	 * 分页类
	 *
	 * @param integer $currentPage
	 * @param integer $totalPage
	 * @param string $url
	 * @param integer $half
	 * @return string
	 *
	 */
	public static function pageNav($currentPage, $totalPage, $url, $half = 3)
	{
		$html = '';
		if ($totalPage > 1)
		{
			if ($currentPage > $totalPage)
			{
				$currentPage = $totalPage;
			}

			$html .= '<ul class="pagination pagination-lg">';
			$html .= "<li" . ((1 == $currentPage) ? ' class="disabled"' : '') . "><a href=\"{$url}/page/1\">&laquo;</a></li>";

			$begin = 1;
			if ($currentPage > ($half + 1))
			{
				$begin = $currentPage - $half;
			}
			$end = $begin + $half * 2;
			if ($end > $totalPage)
			{
				$end = $totalPage;
				$begin = $end - $half * 2;
			}
			if ($begin < 1)
			{
				$begin = 1;
			}

			for ($i = $begin; $i <= $end; $i++)
			{
				if ($i == $currentPage)
				{
					$html .= "<li class=\"active\"><a href=\"\">{$i}</a></li>";
				}
				else
				{
					$html .= "<li><a href=\"{$url}/page/{$i}\">{$i}</a></li>";
				}
			}
			$html .= "<li" . (($totalPage == $currentPage) ? ' class="disabled"' : '') . "><a href=\"{$url}/page/{$totalPage}\">&raquo;</a></li>";
			$html .= '</ul>';
		}
		return $html;
	}

	/**
	 * 显示表单元素
	 *
	 * @param string $name
	 * @param mixed $value
	 * @param integer $type  (0.文本,1.密码,2.单选,3.多选,4.文本域)
	 *
	 */
	public static function displayFormElement($name, $value, $type = 0)
	{
		$formElement = '';
		if (empty($name))
		{
			return $formElement;
		}

		switch ($type)
		{
			case 1 :
				$formElement .= "<input type=\"password\" class=\"form-control\" name=\"{$name}\" value=\"{$value}\" />";
				break;
			case 2 :
				$formElement .= "<input type=\"radio\" name=\"{$name}\" value=\"1\" ". ($value ? 'checked' : '') . " /> 是 ";
				$formElement .= "<input type=\"radio\" name=\"{$name}\" value=\"0\" ". (!$value ? 'checked' : '') . " /> 否 ";
				break;
			case 3 :
				break;
			case 4 :
				$formElement .= "<textarea class=\"form-control\" rows=\"3\" name=\"{$name}\">{$value}</textarea>";
				break;
			default :
				$formElement .= "<input type=\"text\" class=\"form-control\" name=\"{$name}\" value=\"{$value}\" />";
		}
		return $formElement;
	}

}