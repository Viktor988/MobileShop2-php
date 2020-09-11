<?php 

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
  ?>


<div id="formacela">

<h1 id="naslovprij">Prijava</h1>
<form action="#" method="post" >
<input type="text" class="prvit pa"id="pprvi" placeholder="E-mail" name="email"/>
<p id="prijavap"></p>

<div id="ja"><input type="password" class="prvit pd"id="ddrugi" placeholder="Lozinka" name="lozinka" autocomplete="off" maxlength="30" /><i class="fas fa-eye-slash" id="oko"></i><i class="fas fa-eye" id="oko2"></i></div>
<p id="prijavad"></p>

<input type="button" value="Prijava" id="dugprijava2"name="dugmeprijava"/>
</form>
</div>

<script
src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="assets/js/prijava.js"></script>

