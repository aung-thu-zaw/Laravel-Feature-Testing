<x-app-layout>
    <div class="container mx-auto mt-48">
        <div class="flex items-center justify-end mb-5">
            <button type="button"
                class="bg-blue-600 px-5 text-sm py-2 text-white font-semibold rounded-sm shadow-sm hover:bg-blue-700">
                Add Product
            </button>
        </div>

        <div
            class="relative overflow-x-auto border shadow-sm rounded-sm mt-50 w-full mb-10 flex flex-col-reverse items-center justify-center">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Code
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Qty
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$product->name}}
                        </th>
                        <td class="px-6 py-4">
                            {{$product->code}}
                        </td>
                        <td class="px-6 py-4">
                            {{$product->qty}}
                        </td>
                        <td class="px-6 py-4">
                            $ {{$product->price}}
                        </td>
                        <td class="px-6 py-4 flex items-center space-x-5">
                            <form action="#" method="GET">
                                @csrf
                                <button type=" submit"
                                    class="bg-blue-600 px-5 py-2 text-white font-semibold rounded-sm shadow-sm hover:bg-blue-700">
                                    Edit
                                </button>
                            </form>

                            <form action="#" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type=" submit"
                                    class="bg-red-600 px-5 py-2 text-white font-semibold rounded-sm shadow-sm hover:bg-red-700"
                                    onclick="return confirm('Are you sure want to delete?');">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    {{ $products->links() }}

                    @empty

                    <p class="text-center font-bold text-red-700 text-lg my-5">No Products Found!</p>

                    @endforelse
                </tbody>
            </table>
        </div>



    </div>
</x-app-layout>
