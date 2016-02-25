<?php
function getAuthorization()
{
	/* $apikey="otbw53s4dlg9uA7op2PTtzeOiyIE4S19";
		$secretkey="H92-VNN11!mmu7Zz"; */

	$apikey=Session::get('api_key');
	$secretkey=Session::get('secret_key');
	// 		dd(Session::info());
	$ts=date('Y-m-d H:i:s O',time());
	$str="abcdefghijklmnopqrstuvwxyz0123456789";
	$nonce=substr(str_shuffle($str),10);
	$hash=base64_encode(md5($apikey.$secretkey.$ts.$nonce));
	return  "api_key=$apikey,ts=$ts,nonce=$nonce, X-Security-Sign=$hash";
	// 		dd($tes);
}
function setApiUrl($doUrl,$params=null)
{
	$apiUrl=Config('api.apiUrl');
	$url=Config("api.".$doUrl);
	if($url)
	{
		
	
		if(is_string($params))
		{
			$url .=$params;
		}elseif(is_array($params))
		{
			foreach ($params as $k=>$v)
			{
				$find="{".$k."}";
				$url=str_replace($find,$v,$url);
			}
		}
		return $apiUrl.$url;
	}
		//clear session
		Session::flush();
		//regenerate new session
		Session::regenerate();
		return redirect("/login")->with('error',"the url is forbidden");
}

function dealResponse($response)
{
	$data=array();
	if(empty($response))
	{
		$data['flag']="error";
		$data['msg']='result is null';
		return $data;
	}
	if(in_array($response->code,Config('codes.success') ))
	{
// 		dd($response);
		$data['flag']="success";
		$data['paging']=isset($response->body->paging)?$response->body->paging:array();
		$data['data']=isset($response->body->data)?$response->body->data:$response->body;
		$data['msg']="Successfully";
		return $data;
	}
	else 
	{
		$data['flag']='error';
		$data['msg']=isset($response->body->message)?$response->body->message:"error code is :".$response->code;
		return $data;
	}
}
function dealResData($data)
{
	if($data['flag'] == 'success')
	{
		unset($data['paging']);
	}
	return $data;
}
function unsetParam()
{
	$params=func_get_args();
	$data=array_shift($params);
	if($data['flag'] == 'success')
	{
		if(empty($params)) return $data;
		foreach($params as $v)
		{
			if(isset($data[$v])) unset($data[$v]);
		}
	}
	return $data;
}
//create pageLink
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
