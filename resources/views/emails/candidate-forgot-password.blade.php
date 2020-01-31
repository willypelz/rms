<p>Click here to reset your password: </p>

<?php

$link =  url('password/reset', $token);

?>

<a href="{{ $link }}"> {{ $link }} </a>