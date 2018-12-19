<?php
namespace App\Helpers;

class Helper
{

    /**
     * Generates random set of alphanumeric code
     * @return string 
     */
    public static function generateCode($multiplier = 12){
            $first = "";
            $second = "";
            $alpha = "ABCDEFGHIJKLMNOPQRSTUPWXYZabcdefghijklmanopqrstuvwxyz0123456789";
            
            for($i = 0; $i < $multiplier; $i++){
                $rand = rand(0,strlen($alpha) - 1);
                $first .= substr($alpha,$rand, 1);
            }
    
            for($i = 0; $i < $multiplier; $i++){
                $rand = rand(0,strlen($alpha) - 1);
                $second .= substr($alpha,$rand, 1);
            }
            
            return $first.$second;
            
    }

    /**
     * Gets enum values from a column in a given table
     * @param string $table
     * @param string $column
     * @return array $enum
     */
    public static function getEnumValues($table, $column){
        $type = DB::select( DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$column'") )[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enum = array_add($enum, $v, $v);
        }
        return $enum;
    }

    /**
     * Writes content of a json file to a new php file in array format
     * @param string $filepath
     * @param string $outputpath
     * @param string $node
     */
    public function writeJsonToFileAsArray($filepath, $outputpath, $node = 'countries'){
        $raw = file_get_contents($filepath);
        $result = json_decode($raw,true);
        $prepared = "<?php \nreturn [ \n\t\t";
        foreach($result[$node] as $key => $value){
            $prepared.=$this->arrayToString($value)." , \n\t\t";
        }
        $prepared = trim($prepared, ', ');
        $prepared.= '];';
        file_put_contents($outputpath, $prepared);

    }

    /**
     * Prepares the array to be in string format while maintaining array format
     * @param array $array
     * @return string $result
     */
    public function arrayToString($array){
        $result = '[';
        foreach($array as $key => $value){
            $key = $key == 'phoneCode' ? 'd_code' : $key;
            $key = $key == 'sortname' ? 'sort_name' : $key;
            $value = is_numeric($value) ? (int)$value : "\"$value\"";
            $result.="'$key' => $value , ";
        }
        $result = trim($result, ', ');
        $result.=']';
        return $result;
    }

    /**
     * Creates nginx config file with a defined template
     * @param string $outputpath
     * @param string $filename
     * @param array $server_names
     * @return boolean
     */
    public static function createNginxConfig($outputpath, $filename, $server_names = []){

        $path = __DIR__.'/../../nginx.conf'; // template configuration path
        if(empty($filename) || file_exists($outputpath.$filename)){
            return false;
        }
        try{
            $raw = file_get_contents($path);
            $concat = 'server_name ';

            if(count($server_names) > 0){
                foreach($server_names as $key => $value){
                    $concat.=$value.' ,';
                }
                $concat = trim($concat, ' ,');
                $concat.=';';
                $processed = preg_replace('/server_name .+;/',$concat,$raw, 1);
                file_put_contents($outputpath.$filename, $processed);
                return file_exists($outputpath.$filename);
            }else{
                return false;
            }
        }catch(\Exception $e){

            return false;

        }
        
    } 
    
    /**
     * Edits an already existing nginx config file and adds subdomain servernames
     * @param string $path
     * @param array $server_names
     * @return boolean
     */
    public static function editNginxConfig($path, $server_names = [], $replace_all = false){
        try{
            $raw = file_get_contents($path);
            $concat = 'server_name ';

            // gets matched group
            preg_match('/server_name (.+);/', $raw, $re);          
            $concat = $replace_all ? $concat :  $concat.$re[1].', ';

            // Gets all the found domains and puts them in an array
            $checker = self::trimArrayValues(explode(',', $re[1]));
            
            if(count($server_names) > 0){
                foreach($server_names as $key => $value){
                    /**
                     * if replace_all is false and the domain is contained
                     * in the array it skips adding that domain
                     */
                    if(in_array(trim($value), $checker) && !$replace_all)continue;
                    $concat.=$value.', ';
                }
                $concat = trim($concat, ', ');
                $concat.=';';
                $processed = preg_replace('/server_name .+;/',$concat,$raw, 1);
                file_put_contents($path, $processed);
                return file_exists($path);
            }

            return false;
            
        }catch(\Exception $e){
            return false;
        }
    }


    /**
     * Trims all white spaces in array values
     * @param array $array
     * @return array
     */
    private static function trimArrayValues($array = []){
        foreach($array as $key => $value){
            $array[$key] = trim($value);
        }
        return $array;
    }

    /**
     * Gets the url the request is coming from
     * @return string
     */
    public static function getRequestHost(){
        $scheme = request()->getScheme()."://";
        $host = request()->getHost();
        $port = request()->getPort() == 80 ? '' : ":".request()->getPort();
        return $scheme.$host.$port;
    }


}
