<?php
namespace App\Helpers;

class Helper
{

    /**
     * Generates random set of alphanumeric code
     * @return string 
     */
    public static function generateCode(){
            $first = "";
            $second = "";
            $multiplier = 6;
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
}
