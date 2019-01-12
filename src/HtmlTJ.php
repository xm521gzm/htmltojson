<?php

namespace HtmlTj;

/**
 * Simple implementation of the XDG standard http://standards.freedesktop.org/basedir-spec/basedir-spec-latest.html
 *
 * Based on the python implementation https://github.com/takluyver/pyxdg/blob/master/xdg/BaseDirectory.py
 *
 * Class Xdg
 * @package ShopwareCli\Application
 */
class HtmlToJson
{
    public $text_tag = ['body',"html","meta","head","br"];
    public $text_tag_2 = ['strong',"span","b","h3"];


    /**
     * @return string
     */
    public function toJson($html)
    {

        $ret = $this->html_to_obj($html);
        return $ret;
        //$this->dump($ret);
    }


    function html_to_obj($html) {
        //$this->dump($html);
        $dom = new \DOMDocument();
        $libxml_previous_state = libxml_use_internal_errors(true);
        $dom->loadHTML("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />".$html);

        libxml_clear_errors();
        libxml_use_internal_errors($libxml_previous_state);
        $data = $this->element_to_obj($dom->documentElement,$ret);

        return($ret);

        //return $data;
    }

    function element_to_obj($element,&$ret) {
        //dump($element);
        //return;
        $obj = array( "tag" => $element->tagName );
        foreach ($element->attributes as $attribute) {
            $obj[$attribute->name] = $attribute->value;

        }


        //$ret[] = $obj;
        $noadd = 1;
        foreach ($element->childNodes as $subElement) {


            if ($subElement->nodeType == XML_TEXT_NODE) {

                $obj['html'] = $subElement->wholeText;
                $ret[] = $obj;
                $noadd = 0 ;


            }
            else {

                $this->element_to_obj($subElement,$ret);
                //$obj["children"][] =$tmp;
            }
        }



        // 去除无用元素
        if(in_array($obj['tag'],$this->text_tag)){
            $noadd = 0;
        }
        // 去除无用元素
        if(in_array($obj['tag'],$this->text_tag_2) && !isset($obj['html'])){
            $noadd = 0;
        }


        if($noadd == 1){
            $ret[] = $obj;

        }



        return $obj;
    }

    function img_to_obj($element){

        foreach ($element->attributes as $attribute) {
            $o[$attribute->name] = $attribute->value;
        }
        require $o;
    }

    /**
     * 打印函数
     *
     */

    function dump($var, $exit = true) {
        echo '<pre>';
        print_r ( $var );
        echo '</pre>';

    }




}
