<?
header("Content-type: text/css");

$font_family = 'Helvetica, Arial, sans-serif';
$font_size = '0.9em';
$border = '1px solid';
?>

.form {
    width:100%;
	display: flex;
	flex-direction: column;
	align-items: center;
}

select {
    width: 100%;
    padding: 16px 20px;
    border: none;
    border-radius: 4px;
    background-color: #f1f1f1;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    background-color: #f1f1f1;
}


input[type=button], input[type=submit], input[type=reset] {
    width: 100%;
    background-color: #EA9C63;
    border: none;
    color: #1c1b1a;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}

table {
font-family: <?=$font_family?>;
font-size: <?=$font_size?>;
}

th {
font-family: <?=$font_family?>;
font-size: <?=$font_size?>;
background: #667;
color: #FFF;
padding: 2px 6px;
border-collapse: separate;
border: <?=$border?> #000;
}

tr, td {
font-family: <?=$font_family?>;
font-size: <?=$font_size?>;
border: <?=$border?> rgb(26, 24, 24);
}

.adres {
	font-family: <?=$font_family?>;
	font-size: <?=$font_size?>;
    background-color: rgba(236, 234, 228, 0.582);
    border-radius: 20px;
    padding: 20px;
}

iframe{
    border-radius: 10px;
}

.error{
    font-size: 150pt;
}
span.error>p {
    font-size: 40pt;
    color: rgb(15, 180, 10);
}