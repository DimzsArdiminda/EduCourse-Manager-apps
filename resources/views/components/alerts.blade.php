@if(session('success'))
        <div class="mt-15 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('success') }}
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.closest('.relative').style.display='none';">
                    <path d="M14.348 14.849a1 1 0 0 1-1.414 0L10 11.414l-2.934 2.935a1 1 0 1 1-1.414-1.414L8.586 10 5.651 7.065a1 1 0 1 1 1.414-1.414L10 8.586l2.934-2.935a1 1 0 1 1 1.414 1.414L11.414 10l2.934 2.935a1 1 0 0 1 0 1.414z"/>
                </svg>
            </span>
        </div>
    @elseif(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            @if(is_array(session('error')))
                <ul>
                    @foreach(session('error') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @else
                {{ session('error') }}
            @endif
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.closest('.relative').style.display='none';">
                    <path d="M14.348 14.849a1 1 0 0 1-1.414 0L10 11.414l-2.934 2.935a1 1 0 1 1-1.414-1.414L8.586 10 5.651 7.065a1 1 0 1 1 1.414-1.414L10 8.586l2.934-2.935a1 1 0 1 1 1.414 1.414L11.414 10l2.934 2.935a1 1 0 0 1 0 1.414z"/>
                </svg>
            </span>
        </div>
    @endif