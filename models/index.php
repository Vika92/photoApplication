<?php
class index{

    public function render($directoryName,$fileName,$params=null){
        $result = array();
        if(gettype($params) == "array") {
            foreach ($params as $key =>$param) {
                $result[$key] = $param;
            }
        }
        $url = str_replace(" ","", ROOT.'/views/ ' . $directoryName .' / '.$fileName.'.php');
        include $url;
        return $result;
    }


    /**
     * delete file from tmp directory
     * @param  string $photo
     * @param  string $directory
     * @return bool
     */
    public function deleteFiles($photo,$directory){

        if($photo){
            $path = "/template/images/". $directory . "/tmp/";

            unlink(ROOT . $path . $photo);
        }
        return true;

    }

    /**
     * Change the name of photo downloaded by user
     * @param string $background
     * @return string
     */
    public function prepareBackground($background){
        $array = explode(".", $background);
        return $background = uniqid("") . "." . $array[count($array)-1];
    }

    /**
     * Check input of string data
     * @param $str
     * @return string
     */
    public function checkString($str){
        return trim(strip_tags($str));
    }





}