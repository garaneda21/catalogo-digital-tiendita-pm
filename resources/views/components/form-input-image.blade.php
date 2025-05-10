@props(['imagen_actual' => null])

<input type="file" id="imagen" name="imagen" accept="image/*" onchange="previewDeImagen(event)"
    class="block w-full rounded-md bg-white text-sm text-gray-700 border file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">

@if ($imagen_actual)
    <img id="preview" src="{{ asset($imagen_actual) }}" alt="Vista previa"
        class="mt-2 w-40 h-40 object-cover border rounded-lg">
@else
    <img id="preview" src="{{ asset('images/placeholder.png') }}" alt="Vista previa"
        class="mt-2 w-40 h-40 object-cover border rounded-lg hidden">
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
