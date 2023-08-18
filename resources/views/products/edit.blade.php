<x-app-layout>
    <div class="container mx-auto">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit product</h2>
                <form action="{{ route('products.update',$product->id) }}" method="POST">
                    @csrf
                    @method("PATCH")
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name',$product->name) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type product name" required="">
                        </div>

                        <div class="w-full">
                            <label for="code"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code</label>
                            <input type="number" name="code" id="code" value="{{ old('code',$product->code) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="CODE123" required="">
                        </div>
                        <div class="w-full">
                            <label for="qty"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Qty</label>
                            <input type="number" name="qty" id="qty" value="{{ old('qty',$product->qty) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter Quantity" required="">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                            <input type="number" name="price" id="price" value="{{ old('price',$product->price) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="$2999" required="">
                        </div>
                    </div>
                    <button type="submit"
                        class="my-5 bg-blue-600 text-white py-3 font-semibold text-sm w-full rounded-sm hover:bg-blue-700">
                        Update
                    </button>
                </form>
            </div>
        </section>
    </div>
</x-app-layout>