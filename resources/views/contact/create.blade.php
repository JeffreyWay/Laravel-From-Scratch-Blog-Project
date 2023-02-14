<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Contact us!</h1>

                <form method="POST" action="/contact" class="mt-10">
                    @csrf

                    <x-form.input name="first_name" required />
                    <x-form.input name="last_name" required />
                    <x-form.input name="email" type="email" required />
                    <x-form.input name="bday" type="date" />
                    <x-form.input name="additional_text" required />

                    <x-form.button>Send</x-form.button>
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
