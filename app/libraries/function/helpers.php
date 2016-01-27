<?php
 function pagesLink($totalCount,$page,$limit=10,$showpage=5)
	{
		$countPages=ceil($totalCount/$limit);
		if($countPages <=1) return false;
		$startp=1;
		$flag=floor($showpage/2);
		if($countPages <= $showpage)
		{
			$startp=1;$endP=$countPages;
		}elseif($countPages >$showpage )
		{
			if($page <= $flag)
			{
				$startp=1;$endP=5;
			}elseif($page > $countPages-$flag)
			{
				$startp=$countPages-4;
				$endP=$countPages;
			}else
			{
				$startp=$page-2;
				$endP=$page+2;
			}
				
		}
		$last=$startp-1;
		$last =($last<1)?1:$last;
		$next=$endP+1;
		$next =($next>$countPages)?$countPages:$next;
	ob_start()	
	?>
	
		<div class="col-xs-12">
		<nav class="pull-right">
			<ul class="pagination" id='creatpage'>
				<?php if($last !=$page ): ?>
					<li class="disabled"><a name="<?=$last?>" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
				<?php endif;?>
				<?php 
					for($i=$startp;$i<=$endP;$i++)
					{
						$class=($page == $i)?"active":"default";
						echo '	<li class="'.$class.'"><a href="#"  name="'.$i.'">'.$i.'<span class="sr-only">(current)</span></a></li>';
					}
				?>
				<?php if($next != $page):?>
					<li class="disabled"><a name="<?=$next?>" href="#"  aria-label="Next"><span aria-hidden="false">&raquo;</span></a></li>
				<?php endif;?>
			</ul>
		</nav>
	</div>

		<?php 
		return ob_get_clean();
	}

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
// 		echo public_path();
	 	$file = app_path()."/Http/database/{$database}.csv";
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


	function getData($database,$id=1){
		$data = openCSV($database);
		return $data[$id];
	
}
