<?php
//namespace TSite\Shared
//{
	class StringMethods{
		
		public static function GetStringLenght($str){
			return strlen($str);	
		}
		
		public static function GetWordCount($str){
			return str_word_count($str);
		}
		
		public static function MakeSave($string){
            if(empty($string)) return $string;
			return addslashes(htmlentities($string));
		}
		
		public static function GetRaw($string){
			return stripslashes(html_entity_decode($string));	
		}
		
		public static function Encode($string){
			return 	md5(StringMethods::MakeSave($string));
		}

        public static function  AlfaNumeric() {return "023456789ABCDEFGHJKLMNOPQRSTUVWXYZ";}

        public static function Numeric() {return  "0123456789";}

        public static function Alpherbet() {return "ABCDEFGHIJKLMNOPQRSTUVWXYZ";}
        
        public static function GetRandomString($length, $valid_chars = "023456789ABCDEFGHJKLMNOPQRSTUVWXYZ"){
            // start with an empty random string
            $random_string = "";

            // count the number of chars in the valid chars string so we know how many choices we have
            $num_valid_chars = strlen($valid_chars);

            // repeat the steps until we've created a string of the right length
            for ($i = 0; $i < $length; $i++)
            {
                // pick a random number from 1 up to the number of valid chars
                $random_pick = mt_rand(1, $num_valid_chars);

                // take the random character out of the string of valid chars
                // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
                $random_char = $valid_chars[$random_pick-1];

                // add the randomly-chosen char onto the end of our string so far
                $random_string .= $random_char;
            }

            // return our finished random string
            return $random_string;
        }
	}
//?>