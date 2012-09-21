<?php
if($argc < 2)
{
	printf('Usage : php %s in.srt time_difference [out.srt]%s', $argv[0], PHP_EOL);
	exit;
}

$begin = microtime(TRUE);

$in = $argv[1];
$out = isset($argv[3]) ? $argv[3] : $in;
$difference = $argv[2];

if(!is_readable($in))
{
	echo $in.' is not readable, aborting...'.PHP_EOL;
	exit;
}
if(!is_writable($out))
{
	echo $out.' is not writable, aborting...'.PHP_EOL;
	exit;
}

$contents = file($in, FILE_IGNORE_NEW_LINES);
$count = 0;


foreach($contents as $nbr => $line)
{
	if(strpos($line, '-->') === FALSE)
	{
		continue;
	}
	
	$count++;
	
	list($from, $to) = array_map(function($e)
	{
		return substr(trim($e), 0, 8);
	}, explode('-->', $line));
	
	$synched_from_time = date('H:i:s', strtotime($from) + $difference);
	$synched_to_time = date('H:i:s', strtotime($to) + $difference);
	
	$contents[$nbr] = str_replace(array($from, $to), array($synched_from_time, $synched_to_time), $line);
}

file_put_contents($out, implode(PHP_EOL, $contents));
$end = microtime(TRUE);

echo 'Subtitle processed successfully, synched '.$count.' lines in '.($end - $begin).' seconds'.PHP_EOL;

