@props(['imagen_actual' => null])

<flux:input type="file" id="imagen" name="imagen" accept="image/*" label="Imagen del Producto" onchange="previewDeImagen(event)" />

@if ($imagen_actual)
   <img id="preview" src="{{ asset($imagen_actual) }}" alt="Vista previa"
        class="w-40 h-40 object-cover border rounded-lg">
@else
    <img id="preview" src="{{ asset('images/placeholder.png') }}" alt="Vista previa"
        class="w-40 h-40 object-cover border rounded-lg hidden">
@endif

<script>
    function previewDeImagen(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>