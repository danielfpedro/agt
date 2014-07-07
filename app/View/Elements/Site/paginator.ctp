<?php
	echo $this->Paginator->prev('&laquo; Anterior', array('style'=> 'margin-right: 10px','class'=> 'paginator-side', 'escape'=> false));
	echo "&nbsp;";
	echo $this->Paginator->numbers(array('class'=> 'paginator-number'));
	echo "&nbsp;";
	echo $this->Paginator->next('Próxima &raquo;', array('style'=> 'margin-left: 10px', 'class'=> 'paginator-side', 'escape'=> false));
?>