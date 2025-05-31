<flux:main>
    <div class="bg-white dark:bg-azul-oscuro shadow-xl rounded-2xl p-8 border dark:border-gray-700 min-h-full">        
        <section class="w-full">
            @include('partials.settings-heading')
        
            <x-settings.layout :heading="__('Apariencia')" :subheading=" __('Actualiza la apariencia para tu cuenta')">
                <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                    <flux:radio value="light" icon="sun">{{ __('Claro') }}</flux:radio>
                    <flux:radio value="dark" icon="moon">{{ __('Oscuro') }}</flux:radio>
                    <flux:radio value="system" icon="computer-desktop">{{ __('Sistema') }}</flux:radio>
                </flux:radio.group>
            </x-settings.layout>
        </section>
    </div>
</flux:main>
