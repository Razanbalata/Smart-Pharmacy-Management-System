@extends('layouts.pharma')


@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold">
        🤖 PharmaSmart AI Assistant
    </h1>


    <div id="messages" class="mt-6 space-y-4"></div>


    <form 
        id="chatForm"
        class="mt-6 flex gap-2"
    >

        @csrf

        <input 
            id="message"
            name="message"
            class="border rounded-xl flex-1 p-3"
            placeholder="Ask about your pharmacy..."
        >


        <button 
            type="submit"
            class="bg-primary text-white px-5 rounded-xl"
        >
            Send
        </button>

    </form>


</div>



<script>

const form = document.getElementById('chatForm');

const input = document.getElementById('message');

const messages = document.getElementById('messages');


form.addEventListener('submit', async (e)=>{

    e.preventDefault();


    let text = input.value;


    if(!text) return;



    messages.innerHTML += `
        <div>
            <b>You:</b> ${text}
        </div>
    `;


    input.value = "";



    let response = await fetch(
        "{{ route('ai.chat.message') }}",
        {

            method:"POST",

            headers:{

                "Content-Type":"application/json",

                "X-CSRF-TOKEN":
                "{{ csrf_token() }}"

            },


            body:JSON.stringify({

                message:text

            })

        }
    );



    let result = await response.json();



    messages.innerHTML += `
        <div class="bg-gray-100 p-3 rounded-xl">

            <b>AI:</b>

            ${result.data.message}

        </div>
    `;


});


</script>


@endsection