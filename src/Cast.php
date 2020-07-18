<?php

    namespace Fyi\Jakob;

    class Cast
    {
        public function __construct()
        { }

        public static function emptyStringIfNull($str)
		{
			if ($str == null)
			{
				return "";
			}

			return $str;
		}

		public static function boolVal($mixed)
		{
			if (($mixed == 1 || $mixed == true) && $mixed != "false")
			{
				return true;
			}

			return false;
		}

		public static function percentval($number, $decemals = 2, $appendSymbol = true)
		{
			$percent = number_format($number, $decemals, '.', '');
			if ($appendSymbol)
			{
				$percent .= "%";
			}

			return $percent;
		}

		public static function formatDateDmy($date)
		{
			return date("d.m.Y", $date);
		}

    }