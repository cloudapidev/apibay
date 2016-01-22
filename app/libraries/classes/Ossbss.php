<?php
namespace App\Libraries\Classes;
use Config,Session,Log;
class Ossbss {
	/**
	 * create the authorizataion
	 * @return string
	 */
	protected $_pageLimit=10;
	protected $_showpage=5;
	public function getAuthorization()
	{
		$apikey="oS3W4emReR55Ie9XI0mIC1fehANMlHXx";
		$secretkey="9EdYm8_o3nJE1Ne4";
		$ts=date('Y-m-d H:i:s O',time());
		$str="abcdefghijklmnopqrstuvwxyz0123456789";
		$nonce=substr(str_shuffle($str),10);
		$hash=base64_encode(md5($apikey.$secretkey.$ts.$nonce));
		return "api_key=$apikey,ts=$ts,nonce=$nonce, X-Security-Sign=$hash";
	}
	public function createPage($url,$totalCount,$page,$limit=10,$showpage=5)
	{
		$limit=empty($limit)?$this->_pageLimit:$limit;
		$countPages=ceil($totalCount/$limit);
		if($countPages <=1) return false;
		$showpage=empty($showpage)?$this->_showpage:$showpage;
		
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
	<div class="row">
		<div class="col-xs-12">
		<nav class="pull-right">
			<ul class="pagination" id='creatpage'>
			<!--  <li style="display: none"><?=$url;?></li>-->
				<?php if($last !=$page ): ?>
					<li class="disabled"><a name="<?=$last?>" href="<?=url($url,array('page'=>$last))?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
				<?php endif;?>
				<?php 
					for($i=$startp;$i<=$endP;$i++)
					{
						$class=($page == $i)?"active":"default";
						echo '	<li class="'.$class.'"><a href="'.url($url,array('page'=>$i)).'" name="'.$i.'">'.$i.'<span class="sr-only">(current)</span></a></li>';
					}
				?>
				<?php if($next != $page):?>
					<li class="disabled"><a name="<?=$next?>" href="<?=url($url,array('page'=>$next))?>" aria-label="Next"><span aria-hidden="false">&raquo;</span></a></li>
				<?php endif;?>
			</ul>
		</nav>
	</div>
</div>
		<?php 
		return ob_get_clean();
	}
}
