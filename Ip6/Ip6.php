<?php
class Ip6 {
    private $id;
    private $prefixe;
    private $longueur;

    public function __construct(int $id, String $prefixe, int $longueur){
        $this->id = $id;
        $this->prefixe = $prefixe;
        $this->longueur = $longueur; 
    }
    public function getPrefixe():String{
        return $this->prefixe;
    }
    public function getLongueur():int{
        return $this->longueur;
    }
    public function getId():int{
        return $this->id;
    }
    public function displayPrefixeCIDR():String{
        return $this->prefixe."/".$this->longueur;
    }
    public function prefixeDecondense():String{
        $hex = unpack("H*hex", inet_pton($this->prefixe));         
        $prefixe = substr(preg_replace("/([A-f0-9]{4})/", "$1:", $hex['hex']), 0, -1);
        return $prefixe;
    }
    public function prefixeExt():String{
        $prefixeExploded = str_replace(':', '', $this->prefixeDecondense());
        return $prefixeExploded;
    }
    public function prefixeCondense():String{
        return inet_ntop(hex2bin($this->prefixeExt()));
    }
    public function prefixeBin():String{
        $prefixeComplet = str_split($this->prefixeExt());
        $prefixeBin = "";
        foreach ((Array)$prefixeComplet as $char){
            if($char == "0") $char_bin = "0000";
            elseif($char == "1") $char_bin = "0001";
            elseif($char == "2") $char_bin = "0010";
            elseif($char == "3") $char_bin = "0011";
            elseif($char == "4") $char_bin = "0100";
            elseif($char == "5") $char_bin = "0101";
            elseif($char == "6") $char_bin = "0110";
            elseif($char == "7") $char_bin = "0111";
            elseif($char == "8") $char_bin = "1000";
            elseif($char == "9") $char_bin = "1001";
            elseif($char == "a" || $char == "A") $char_bin = "1010";
            elseif($char == "b" || $char == "B") $char_bin = "1011";
            elseif($char == "c" || $char == "C") $char_bin = "1100";
            elseif($char == "d" || $char == "D") $char_bin = "1101";
            elseif($char == "e" || $char == "E") $char_bin = "1110";
            elseif($char == "f" || $char == "F") $char_bin = "1111";
            $prefixeBin = $prefixeBin.$char_bin;
        }
        return $prefixeBin;
    }
    public static function ajouterUn(String &$nombreBin){
        $nombreBin_explode = str_split($nombreBin);
        $nombreBin_add = '';
            for($n=strlen($nombreBin)-1;$n>=0;$n--){
                if($nombreBin_explode[$n]=='0'){
                    $nombreBin_explode[$n]='1';
                    break;
                }
                elseif($nombreBin_explode[$n]=='1'){
                    $nombreBin_explode[$n]='0';
                }
            }
            for($n=0;$n<strlen($nombreBin);$n++){
                $nombreBin_add = $nombreBin_add.$nombreBin_explode[$n];
            }
        $nombreBin = $nombreBin_add;
    }
    public static function binHex(String $bin):String{
            if($bin == "0000") $char_hex = "0";
            elseif($bin == "0001") $char_hex = "1";
            elseif($bin == "0010") $char_hex = "2";
            elseif($bin == "0011") $char_hex = "3";
            elseif($bin == "0100") $char_hex = "4";
            elseif($bin == "0101") $char_hex = "5";
            elseif($bin == "0110") $char_hex = "6";
            elseif($bin == "0111") $char_hex = "7";
            elseif($bin == "1000") $char_hex = "8";
            elseif($bin == "1001") $char_hex = "9";
            elseif($bin == "1010") $char_hex = "a";
            elseif($bin == "1011") $char_hex = "b";
            elseif($bin == "1100") $char_hex = "c";
            elseif($bin == "1101") $char_hex = "d";
            elseif($bin == "1110") $char_hex = "e";
            elseif($bin == "1111") $char_hex = "f";
        return $char_hex;
    }
    public function sousReseaux(int $tailleSouhait):Array{
        $prefixe = str_split($this->prefixeBin());
        $calc = '';
        for($n=$this->longueur;$n!=$tailleSouhait;$n++){
            $calc = $calc.$prefixe[$n];
        }
        $toutaun = str_replace('0', '1', $calc);
        $i=1;
        $tableauSub[0] = $prefixe;
        do{
            self::ajouterUn($calc);
            $sub = str_split($calc);
            $prefixeSub = $prefixe;
            for($n=$this->longueur, $x=0;$n!=$tailleSouhait;$n++, $x++){
                $prefixeSub[$n] = $sub[$x];
            }
            $tableauSub[$i] = $prefixeSub;
            $i++;
        }
        while($calc != $toutaun);
        for($i=0;$i<count($tableauSub);$i++){
            for($temp = '', $l=0;$l<count($tableauSub[$i]);$l++){
                $temp = $temp.$tableauSub[$i][$l];
            }
            $tableauBin[$i]= $temp;
        }
        foreach($tableauBin as $binVal){
            $c1 = substr($binVal, 0, 4);
            $c2 = substr($binVal, 4, 4);
            $c3 = substr($binVal, 8, 4);
            $c4 = substr($binVal, 12, 4);
            $c5 = substr($binVal, 16, 4);
            $c6 = substr($binVal, 20, 4);
            $c7 = substr($binVal, 24, 4);
            $c8 = substr($binVal, 28, 4);
            $c9 = substr($binVal, 32, 4);
            $c10 = substr($binVal, 36, 4);
            $c11 = substr($binVal, 40, 4);
            $c12 = substr($binVal, 44, 4);
            $c13 = substr($binVal, 48, 4);
            $c14 = substr($binVal, 52, 4);
            $c15 = substr($binVal, 56, 4);
            $c16 = substr($binVal, 60, 4);
            $c17 = substr($binVal, 64, 4);
            $c18 = substr($binVal, 68, 4);
            $c19 = substr($binVal, 72, 4);
            $c20 = substr($binVal, 76, 4);
            $c21 = substr($binVal, 80, 4);
            $c22 = substr($binVal, 84, 4);
            $c23 = substr($binVal, 88, 4);
            $c24 = substr($binVal, 92, 4);
            $c25 = substr($binVal, 96, 4);
            $c26 = substr($binVal, 100, 4);
            $c27 = substr($binVal, 104, 4);
            $c28 = substr($binVal, 108, 4);
            $c29 = substr($binVal, 112, 4);
            $c30 = substr($binVal, 116, 4);
            $c31 = substr($binVal, 120, 4);
            $c32 = substr($binVal, 124, 4);
            $valeurHex = self::binHex($c1).self::binHex($c2).self::binHex($c3).self::binHex($c4).self::binHex($c5).self::binHex($c6).self::binHex($c7).self::binHex($c8).self::binHex($c9).self::binHex($c10).self::binHex($c11).self::binHex($c12).self::binHex($c13).self::binHex($c14).self::binHex($c15).self::binHex($c16).self::binHex($c17).self::binHex($c18).self::binHex($c19).self::binHex($c20).self::binHex($c21).self::binHex($c22).self::binHex($c23).self::binHex($c24).self::binHex($c25).self::binHex($c26).self::binHex($c27).self::binHex($c28).self::binHex($c29).self::binHex($c30).self::binHex($c31).self::binHex($c32);
            $temp_prefixe = inet_ntop(hex2bin($valeurHex));
            $tableauHex[]= new self (NULL,$temp_prefixe,$tailleSouhait);
        }
        return $tableauHex;
    }
}

