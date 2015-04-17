<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 4/5/2015
 * Time: 8:40 AM
 */

class OpenSms_Helper_Html {
    public static function TextEditorFor($name, $value = '', array $htmlAttributes = null){
        $html = "<input type='text' value='$value' name='$name'";
        if($htmlAttributes == null) return $html.'/>';
        foreach($htmlAttributes as $k => $v)
            $html.= " $k='$v'";
        echo html_entity_decode($html.'/>');
    }

    public static function TextAreaFor($name, $value = '', array $htmlAttributes = null){
        $html = "<textarea name='$name'";
        if($htmlAttributes != null)
            foreach($htmlAttributes as $k => $v)
                $html.= " $k='$v'";
        $html.">$value</textarea>";

        echo html_entity_decode($html);
    }

    public static function SelectFor($name, array $options, $selectedValue = null,
                                     $valuePath = null, $displayPath = null, array $htmlAttributes = null){
        $html = "<select name='$name'";
        if($htmlAttributes != null) {
            foreach ($htmlAttributes as $k => $v) {
                $html .= " $k='$v'";
            }
        }

        $html .= '><option></option>';

        foreach($options as $option){
            if(isset($valuePath)) {
                $value = $option->{$valuePath};
            }
            else {
                $value = $option;
            }
            if(isset($displayPath)) {
                $display = $option->{$displayPath};
            }
            else {
                $display = $option;
            }

            $html .= "
            <option value='$value' ".(strtolower($value) == strtolower($selectedValue)?' selected':'').">
                 $display
            </option>
            ";
        }


        $html .= '</select>';

        echo (html_entity_decode($html));
    }
} 