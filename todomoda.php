<?php
session_start();
require 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>TodoModa - Accesorios</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <div class="logo">TODOMODA</div>
  <nav>
    <span class="rojo">NAVIDAD 🎄</span>
    <span>NUEVO!</span>
    <span>ACCESORIOS</span>
    <span>#TMB 🍒</span>
    <span>LICENCIAS</span>
    <span>REGALABLES</span>
    <span>INFANTIL</span>
    <span>GIFT CARD</span>
  </nav>
  <div class="iconos">🔍 📷 <a href="index.php">👤</a> ♡ 🛍️
  <?php if(isset($_SESSION['id'])): ?>
    <a href="panel_usuario.php" class="cerrar">Mi perfil</a>
    <a href="logout.php" class="cerrar">Cerrar sesión</a>
  <?php else: ?>
    <a href="index.php" class="cerrar">Iniciar sesión</a>
  <?php endif; ?>
</div>
</header>

<h1 class="titulo-tienda">Accesorios</h1>


<div class="cajas">

  <div class="prod">
    <img src="img/aros.webp" alt="Aros">
    <h3>Aros</h3>
    <p>Aros Colgantes Cortos de mariposa y zirconia.</p>
    <div class="precio">$15.900</div>
    <span class="btn-falso">Ver producto</span>
  </div>

  <div class="prod">
    <img src="img/balsamo.webp" alt="Bálsamo labial">
    <h3>Bálsamo labial Brownie Dough</h3>
    <p>Bálsamo labial súper glossy con llavero y charms de ositos y cafecitos.</p>
    <div class="precio">$18.900</div>
    <span class="btn-falso">Ver producto</span>
  </div>

  <div class="prod">
    <img src="img/brochas.webp" alt="Brochas">
    <h3>Brochas Love</h3>
    <p>Set de 5 brochas de maquillaje con glitter.</p>
    <div class="precio">$10.900</div>
    <span class="btn-falso">Ver producto</span>
  </div>

  <div class="prod">
    <img src="img/máscara.webp" alt="Máscara de pestañas">
    <h3>Máscara de pestañas Fun proof</h3>
    <p>Máscara de pestañas Fun proof con efecto waterproof alargadora.</p>
    <div class="precio">$12.900</div>
    <span class="btn-falso">Ver producto</span>
  </div>

  <div class="prod">
    <img src="img/necesser.webp" alt="Necesser">
    <h3>Necessaires</h3>
    <p>Porta Cosméticos vinilo navideño con tag.</p>
    <div class="precio">$29.000</div>
    <span class="btn-falso">Ver producto</span>
  </div>

  <div class="prod">
    <img src="img/rubor.webp" alt="Rubor">
    <h3>Tinta & rubor efecto jelly</h3>
    <p>Tinta y rubor efecto jelly, de acabado glowy para labios y mejillas.</p>
    <div class="precio">$14.900</div>
    <span class="btn-falso">Ver producto</span>
  </div>

</div>

<footer>
  <b>Gracias por comprar y confiar en nosotras 💖</b><br>
</footer>

</body>
</html>