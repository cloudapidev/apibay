<?php
function populate($formName,$data=false)
{
			$data = (array)json_decode($data);
			

				if (is_array($data) && count($data)) {
					$buff = "<script type='text/javascript'>\n".
									"// Post back for form '{$formName}'\n".
									"var _pp{$formName} = new Array();\n";
					foreach ($data as $key => $value) {
						$value2 = str_replace("\r", "", str_replace("\n", "\\n", addslashes($value)));
						$buff .= 
									"_pp{$formName}['{$key}'] = '{$value2}';\n";
					}

					$buff .= "
		theForm = eval('document.{$formName}');
		if (theForm != undefined) {
			for (i = 0; i < theForm.elements.length; i++) {
				theElem = theForm.elements[i];

				if (_pp{$formName}[theElem.name] != undefined || _pp{$formName}[theElem.name+'[]']) {
					switch (theElem.type) {
						case 'text': case 'select-one': case 'textarea':  case 'hidden':
							theElem.value = _pp{$formName}[theElem.name];
						break;
						case 'radio': case 'checkbox': 
							if (theElem.value == _pp{$formName}[theElem.name]) {
								theElem.checked = true;
							}
						break;
					}
				}
			}
		}
		</script>\n";
		
					echo $buff;
				}
};


function openCSV($database){
	//echo public_path();
	$file = __DIR__."/database/{$database}.csv";
	 $csv = array_map('str_getcsv', file($file));
    $headers = $csv[0];
    unset($csv[0]);
    $rowsWithKeys = array();
    foreach ($csv as $row) {
        $newRow = array();
				$id = "";
        foreach ($headers as $k => $key) {

						if($k == "id")
							$id = $row[$k];
							
            $newRow[$key] = $row[$k];
        }
				
        $rowsWithKeys[$id] = $newRow;
    }
		
		if(count($rowsWithKeys))
    return $rowsWithKeys;
	}


function getData($database,$id){
	$data = openCSV($database,$id);
	return $data[$id];
	
}