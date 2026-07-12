@extends('layouts.pharma')

@section('content')
    <div class="max-w-6xl mx-auto p-4 sm:p-6 h-[calc(100vh-100px)] flex flex-col font-sans">

        <!-- Header -->
        <div class="flex items-center justify-between pb-4 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-primary/10 text-primary rounded-2xl text-2xl animate-pulse">
                    🤖
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">PharmaSmart AI</h1>
                    <p class="text-xs text-green-500 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 inline-block animate-ping"></span>
                        Online & ready to help
                    </p>
                </div>
            </div>
        </div>

        <!-- Chat Messages Container -->
        <div id="messages" class="flex-1 overflow-y-auto my-4 pl-2 space-y-4 scrollbar-thin scrollbar-thumb-gray-200">

            @if ($conversation && $conversation->messages->count())
                @foreach ($conversation->messages as $message)
                    @if ($message->role === 'user')
                        <div class="flex items-start gap-2.5 max-w-[85%] ml-auto justify-end">

                            <div class="bg-primary text-white p-3.5 rounded-2xl rounded-tr-none shadow-sm text-sm">
                                {{ $message->content }}
                            </div>


                            <div
                                class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs">
                                You
                            </div>

                        </div>
                    @else
                        <div class="flex items-start gap-2.5 max-w-[85%]">

                            <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
                                🤖
                            </div>


                            <div class="bg-gray-100 p-3.5 rounded-2xl rounded-tl-none shadow-sm text-sm">

                                <p class="font-semibold text-xs text-gray-400 mb-1">
                                    PharmaSmart AI
                                </p>

                                {{ $message->content }}

                            </div>

                        </div>
                    @endif
                @endforeach
            @else
                <!-- Welcome Message -->

                <div class="flex items-start gap-2.5 max-w-[85%]">

                    <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
                        🤖
                    </div>


                    <div class="bg-gray-100 p-3.5 rounded-2xl rounded-tl-none shadow-sm text-sm">

                        Welcome to your smart assistant! How can I help manage your pharmacy today?

                    </div>

                </div>
            @endif


        </div>

        <!-- Message Form Input -->
        <form id="chatForm" class="relative mt-auto">
            @csrf
            <div
                class="relative flex items-center bg-white border border-gray-200 focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 rounded-2xl shadow-sm transition-all duration-200">

                <input id="message" name="message" type="text" autocomplete="off"
                    class="w-full py-4 pr-4 pl-16 bg-transparent text-sm text-gray-700 placeholder-gray-400 focus:outline-none"
                    placeholder="Ask about your pharmacy...">

                <button type="submit"
                    class="absolute right-2 p-2.5 bg-primary hover:bg-primary-dark text-white rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center group">
                    <!-- Icon Send (SVG) -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 transform group-hover:translate-x-0.5 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </form>

    </div>

    <script>
        const form = document.getElementById('chatForm');
        const input = document.getElementById('message');
        const messages = document.getElementById('messages');
        let conversationId = null; // To track the current conversation
        // Helper function to auto-scroll to the latest message
        const scrollToBottom = () => {
            messages.scrollTop = messages.scrollHeight;
        };

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            let text = input.value.trim();
            if (!text) return;

            // 1. Append User Message (Aligned to the right)
            messages.innerHTML += `
        <div class="flex items-start gap-2.5 max-w-[85%] ml-auto justify-end">
            <div class="bg-primary text-white p-3.5 rounded-2xl rounded-tr-none shadow-sm text-sm leading-relaxed order-1">
                ${text}
            </div>
            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs shadow-sm font-bold flex-shrink-0 order-2">
                You
            </div>
        </div>
    `;

            input.value = "";
            scrollToBottom();

            // 2. Append Loading Animation (Typing Indicator)
            const loadingId = 'loading-' + Date.now();
            messages.innerHTML += `
        <div id="${loadingId}" class="flex items-start gap-2.5 max-w-[85%] animate-fade-in">
            <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-sm shadow-sm flex-shrink-0">
                🤖
            </div>
            <div class="bg-gray-100 text-gray-800 p-4 rounded-2xl rounded-tl-none shadow-sm flex items-center gap-1">
                <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></span>
                <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce [animation-delay:0.2s]"></span>
                <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce [animation-delay:0.4s]"></span>
            </div>
        </div>
    `;
            scrollToBottom();

            try {
                let response = await fetch("{{ route('ai.chat.message') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        message: text,
                        conversation_id: conversationId
                    })
                });

                let result = await response.json();

                conversationId = result.data.conversation_id; // Update conversation ID for subsequent messages

                // Remove loading indicator
                document.getElementById(loadingId).remove();

                // 3. Append AI Response
                messages.innerHTML += `
            <div class="flex items-start gap-2.5 max-w-[85%]">
                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-sm shadow-sm flex-shrink-0">
                    🤖
                </div>
                <div class="bg-gray-100 text-gray-800 p-3.5 rounded-2xl rounded-tl-none shadow-sm text-sm leading-relaxed">
                    <p class="font-semibold text-xs text-gray-400 mb-1">PharmaSmart AI</p>
                    ${result.data.message}
                </div>
            </div>
        `;

            } catch (error) {
                document.getElementById(loadingId).remove();
                // Network Error Handling
                messages.innerHTML += `
            <div class="text-center text-xs text-red-500 bg-red-50 py-2 rounded-xl">
                Sorry, something went wrong. Please try again later.
            </div>
        `;
            }

            scrollToBottom();
        });
    </script>
@endsection
