<?php

class View
{
	function generate($content_view, $main, $data = null)
	{	
		if(is_array($data))
			extract($data);

		include 'app/view/'.$main;
	}
}
