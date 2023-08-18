<x-app-layout>
    @if (session("success"))

    <div id="alert-border-1"
        class="flex items-center p-4 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-50 dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800"
        role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <div class="ml-3 text-sm font-medium">
            {{ session("success") }}
        </div>
        <button type="button"
            class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
            data-dismiss-target="#alert-border-1" aria-label="Close">
            <span class="sr-only">Dismiss</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>

    @endif

    <div class="container mx-auto mt-48">

        <div class="flex items-center justify-end mb-5">
            @if (auth()->user()->is_admin)

            <a href="{{ route('products.create') }}" type="button"
                class="bg-blue-600 px-5 text-sm py-2 text-white font-semibold rounded-sm shadow-sm hover:bg-blue-700">
                Add Product
            </a>
            @endif
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

                            <a href="{{ route('products.edit',$product->id) }}"
                                class="bg-blue-600 px-5 py-2 text-white font-semibold rounded-sm shadow-sm hover:bg-blue-700">
                                Edit
                            </a>

                            <form action="{{ route('products.destroy',$product->id) }}" method="POST">
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

                    @empty

                    <p class="text-center font-bold text-red-700 text-lg my-5">No Products Found!</p>

                    @endforelse
                </tbody>
            </table>
        </div>


        {{ $products->links() }}



    </div>
</x-app-layout>