<?php
	ini_set('display_errors', 1);
	$first_row = true;
	ini_set('auto_detect_line_endings', true);
	if(($handle = fopen('hd2013.csv', 'r')) !== FALSE)
	{
		while ($row = fgetcsv($handle, ","))
		{
			if($first_row)
			{
				$column_heading = $row;
				$first_row = false;
			}
			else
			{
				$record = array_combine($column_heading, $row);
				$records[] = $record;
			}
		}
		fclose($handle);
	}

function makeTable($record)
{
	echo '<table>';
	foreach($record as $key => $value)
	{
		echo '<tr>';
		echo '<th>' .$key . '</th>';
		echo '<td>' . $value . '</td>';
		echo '</tr>';
	}
	echo '</table>';
}


if(empty($_GET))
{
	$count = 0;
	foreach($records as $record)
	{
		echo '<a href=?row=' . $count . '>' .  $record['INSTNM']  . '</a><br>';
		$count++;
	}
}
else{
makeTable($records[$_GET['row']]);
}
?>

