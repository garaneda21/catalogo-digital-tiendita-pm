<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Descubre los mejores productos de belleza en Tiendita PM. Perfumes, skincare, maquillaje y más. ¡Compra directo por WhatsApp!">
  <title>Tiendita PM</title>

  <style> 
  /* Estos estilos son para la barra nav de las categorias */
    nav ul {
      list-style: none;
      display: flex;
      gap: 1rem;
    }
    nav li {
      position: relative;
    }
    nav ul ul {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      padding: 0.5rem;
    }
    nav li:hover > ul {
      display: block;
    }
    nav a {
      text-decoration: none;
    }

    /*Los siguientes son estilos que entregó el chatgpt xdd*/
* { 
    margin: 0; 
    padding: 0; 
    box-sizing: border-box; 
    font-family: 'Roboto', sans-serif; 
}
body { 
    background-color: #fff8f2; 
    color: #333; 
}
header {
    background-color: #ff914d; 
    padding: 1rem 2rem; 
    display: flex; 
    justify-content: space-between; 
    align-items: center; 
}
header h1 { 
    color: white; 
    font-size: 1.8rem; 
}
nav a { 
    margin-left: 1.5rem; 
    color: white; 
    text-decoration: none; 
    font-weight: 500; 
}
.hero { 
    background: linear-gradient(to right, #ffc3a0, #ffafbd); 
    padding: 4rem 2rem; 
    text-align: center; 
}
.hero h2 { 
    font-size: 2rem; 
    margin-bottom: 1rem; 
}
.hero p { 
    font-size: 1.2rem; 
    margin-bottom: 2rem; 
}
.hero button { 
    background-color: #ff6f00; 
    color: white; 
    border: none; 
    padding: 1rem 2rem; 
    font-size: 1rem; 
    border-radius: 10px; 
    cursor: pointer; 
}
.destacados, .categorias, .beneficios, footer { 
    padding: 2rem; 
}
.section-title { 
    font-size: 1.6rem; 
    margin-bottom: 1rem; 
}
.productos, .items { 
    display: flex; 
    gap: 1rem; 
    flex-wrap: wrap; 
}
.producto, .categoria, .beneficio { 
    background: white; 
    padding: 1rem; 
    border-radius: 10px; 
    box-shadow: 0 0 10px rgba(0,0,0,0.1); 
    flex: 1 1 calc(33% - 1rem); 
    min-width: 200px; 
}
.producto img, .categoria img { 
    width: 100%; 
    border-radius: 8px; 
}
.producto h3, .categoria h3 { 
    margin: 0.5rem 0; 
}
footer { 
    background-color: #ff914d; 
    color: white; 
    text-align: center; 
}
footer p { 
    padding: 1rem 0; 
}
@media (max-width: 768px) {
  .producto, .categoria, .beneficio { flex: 1 1 100%; }
}
  </style>
</head>
<body>
  <header>
    <h1>Tiendita PM</h1>
    <nav>
      <ul>
        <li><input type="text" placeholder="Buscar producto"></li>
        <li><a href="/">Inicio</a></li>
        <li>
          <a href="#categorias">Categorías</a>
          <ul>
            <li><a href="#">Perfumes</a></li>
            <li><a href="#">Skincare</a></li>
            <li><a href="#">Maquillaje</a></li>
            <li><a href="#">Ropa</a></li>
            <li><a href="#">Carteras</a></li>
          </ul>
        </li>
        <li><a href="#Nosotros">Nosotros</a></li>
        <li><a href="#contacto">Contacto</a></li>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <h2>Descubre tu belleza con Tiendita PM ✨</h2>
    <p>Perfumes, skincare, maquillaje y más. ¡Compra con confianza!</p>
    <button href="catalogo.html">Ver catálogo</button>
    <button onclick="window.open('https://wa.me/56912345678?text=Hola%20Tiendita%20PM%2C%20vi%20tu%20cat%C3%A1logo%20y%20me%20interesa%20un%20producto%20%F0%9F%98%8A')">Comprar por WhatsApp</button>
  </section>

  <section class="destacados" id="catalogo">
    <h3 class="section-title">Productos Destacados</h3>
    <div class="productos">
      <div class="producto">
        <img src="https://via.placeholder.com/250x250?text=Perfume+1" alt="Perfume">
        <h3>Perfume Floral</h3>
        <p>$12.990</p>
      </div>
      <div class="producto">
        <img src="https://via.placeholder.com/250x250?text=Maquillaje" alt="Maquillaje">
        <h3>Paleta de Sombras</h3>
        <p>$9.990</p>
      </div>
      <div class="producto">
        <img src="https://via.placeholder.com/250x250?text=Skincare" alt="Skincare">
        <h3>Kit Skincare</h3>
        <p>$14.990</p>
      </div>
    </div>
  </section>

  <section class="categorias">
    <h3 class="section-title">Categorías</h3>
    <div class="items">
      <div class="categoria">
        <img src="https://via.placeholder.com/250x150?text=Perfumes" alt="Perfumes">
        <h3>Perfumes</h3>
      </div>
      <div class="categoria">
        <img src="https://via.placeholder.com/250x150?text=Maquillaje" alt="Maquillaje">
        <h3>Maquillaje</h3>
      </div>
      <div class="categoria">
        <img src="https://via.placeholder.com/250x150?text=Skincare" alt="Skincare">
        <h3>Skincare</h3>
      </div>
    </div>
  </section>

  <footer id="contacto">
    <p>Contáctanos por WhatsApp o síguenos en redes sociales.</p>
    <p>© 2025 Tiendita PM - Todos los derechos reservados</p>
  </footer>
</body>
</html>
