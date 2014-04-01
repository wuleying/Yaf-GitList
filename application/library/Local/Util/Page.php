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
	 * 显示面包屑导航
	 *
	 * @param string $title
	 * @param array $breadCrumb
	 * @param boolean $isAdmin
	 * @return string
	 *
	 */
	public static function dispayBreadCrumb($title, $breadCrumb = array(), $isAdmin = FALSE)
	{
		if ($isAdmin)
		{
			$breadCrumbArray[ADMINURL] = '控制台';
		}
		else
		{
			$breadCrumbArray[SYSTEMURL] = '首页';
		}
		// 面包屑导航
		if (empty($breadCrumb))
		{
			$breadCrumbArray[] = $title;
		}
		else
		{
			foreach ($breadCrumb as $key => $value)
			{
				$breadCrumbArray[$key] = $value;
			}
		}
		return self::breadCrumb($breadCrumbArray);
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
				$formElement .= "<input type=\"radio\" name=\"{$name}\" value=\"1\" " . ($value ? 'checked' : '') . " /> 是 ";
				$formElement .= "<input type=\"radio\" name=\"{$name}\" value=\"0\" " . (!$value ? 'checked' : '') . " /> 否 ";
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

	/**
	 * 显示分类选择框
	 *
	 * @Param array $categoryList
	 * @param integer $selected
	 * @param integer $parentid
	 * @param integer $level
	 * @return string
	 *
	 */
	public static function displayCategorySelector(& $categoryList, $selected = 0, $parentid = 0, $level = 0)
	{
		$html = '';
		if ($categoryList[$parentid])
		{
			foreach ($categoryList[$parentid] as $categoryid => $categoryname)
			{
				$prefix = '';
				if ($level)
				{
					$prefix = implode('', array_fill(0, $level, '--'));
				}
				$current = ($selected == $categoryid) ? 'selected' : '';
				$html .= "<option value=\"{$categoryid}\" {$current}>{$prefix}{$categoryname}</option>\n";
				$html .= self::displayCategorySelector($categoryList, $selected, $categoryid, $level + 1);
			}
		}

		return $html;
	}

	/**
	 * 消息页面
	 *
	 * @param string $message
	 * @param string $url
	 * @param integer $time
	 * @param string $template
	 *
	 */
	public static function displayMessage($message, $url = '', $time = 3, $template = 'error/message.php')
	{
		$request = new \Yaf\Request\Simple();
		if(empty($url))
		{
			$url = $request->getServer()['HTTP_REFERER'];
		}

		$view = new \Yaf\View\Simple($request);
		$view->setScriptPath(\Yaf\Registry::get('config')->application->view->path);
		$view->assign('message', $message);
		$view->assign('url', $url);
		$view->assign('time', $time);
		$view->display($template);
		exit();
	}

	/**
	 * 错误信息页面
	 *
	 * @param type $message
	 * @param type $url
	 * @param type $time
	 *
	 */
	public static function displayError($message, $url = '', $time = 3)
	{
		self::displayMessage($message, $url, $time, 'error/errormessage.php');
	}

}