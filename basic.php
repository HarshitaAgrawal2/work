<!DOCTYPE html>
<html>
<body>

<?php
$date=date_create("2013-03-15");
date_sub($date,date_interval_create_from_date_string("1 days"));
echo date_format($date,"Y-m-d");
?>


<?php
$date=date_create("2013-03-15");
date_add($date,date_interval_create_from_date_string("50 days"));
echo date_format($date,"Y-m-d");
?>

</body>
</html>