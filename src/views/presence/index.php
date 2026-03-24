<!DOCTYPE html>
<html>
<head>
<title>Scan présence</title>

<style>
body{
    font-family: Arial;
    text-align:center;
    margin-top:100px;
}

input{
    font-size:25px;
    padding:10px;
    width:300px;
}
</style>

</head>
<body>


<h2>Scanner la carte membre</h2>

<form method="POST" action="<?= BASE_URL ?>index.php?controller=presence&action=scan">
    
    <input type="text"
           name="numcarte"
           autofocus
           placeholder="Scanner la carte..."
           autocomplete="off">

</form>

<?php if(isset($message)): ?>
    <h3><?= $message ?></h3>
<?php endif; ?>

</body>
</html>