<?php



for($i=1;$i<1000000;$i++)

{
	if(($i%20)== 0)
	{
		print 'QP';
		print ',';
	}

	else if(($i%4)== 0)
	{
		print 'Q';
		print ',';
	}
	else if(($i%5)== 0)
	{
		print 'P';
		print ',';
	}
	else
	{ 
		print$i;
		print',';

	}

}


?>
/*問題２
１から１００００までなので
１回ループするたびに＄iの値を1増やすfor文を使えばいいと思いました。

＄iの値を指定された数値で割ったときにあまりが0になれば、指定された倍数で指定された文字列を表示できると考えました。

気づき：ループは上から下に繰り返されるため、”20の倍数でPQを表示させる命令”は”５の倍数でPを表示させる命令”より上に書かないと20の倍数でQPが表示されない点

https://gist.github.com/anonymous/2b65df9c12a78e7c92ea
*/