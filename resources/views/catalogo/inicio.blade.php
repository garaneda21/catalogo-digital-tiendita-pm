{{-- Con extends definimos la estructura descrita en layouts --}}
@extends('layouts/estructura')

@section('titulo_catalogo')
  Tiendita PM
@endsection

@section('contenido_catalogo')
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
@endsection