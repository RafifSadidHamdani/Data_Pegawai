<!DOCTYPE html>
<html>

<body>

<h1>Hello GFG </h1>

<?php
use App\Models\Employee;
	$data = Employee::all()->toSql();
    echo $data;
?>

</body>
</html>
