<p>Click here to reset your password: </p>

<?php

$link =  route('candidate-reset', $token);

?>

<a href="{{ $link }}"> {{ $link }} </a>