{{-- Esta define la estructura (header, footer) de las vistas que aparezcan en el sitio web  --}}
{{-- En este caso lo que variaría en cada pagina es el titulo (@yield('titulo')) y el 
contenido @yield('contenido_catalogo') --}}

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Descubre los mejores productos de belleza en Tiendita PM. Perfumes, skincare, maquillaje y más. ¡Compra directo por WhatsApp!">
  <title>@yield('titulo_catalogo')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
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

  @yield('contenido_catalogo')

  <footer id="contacto">
    <p>Contáctanos por WhatsApp o síguenos en redes sociales.</p>
    <p>© 2025 Tiendita PM - Todos los derechos reservados</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
