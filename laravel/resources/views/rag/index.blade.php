@extends('layouts.catchly')

@section('content')
<div class="container mx-auto max-w-3xl px-6">
    <div class="bg-card border border-white/5 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-accent to-violet-500"></div>
        
        <h1 class="text-3xl font-grotesk font-bold text-white tracking-tight mb-2">Guía de Pesca IA</h1>
        <p class="text-gray-500 text-sm mb-8">Haz cualquier pregunta sobre pesca. Nuestra IA usará el conocimiento colectivo de la comunidad para responderte.</p>

        <div class="space-y-6">
            <div id="chat-container" class="space-y-4 max-h-96 overflow-y-auto mb-6 pr-2">
                <!-- Chat messages will appear here -->
                <div class="bg-black/30 border border-white/5 rounded-2xl rounded-tl-none p-4 text-sm text-gray-300 w-max max-w-[85%]">
                    ¡Hola! Soy el asistente de Catchly. ¿En qué te puedo ayudar hoy? ¿Buscas saber sobre señuelos, zonas de pesca o especies?
                </div>
            </div>

            <form id="rag-form" class="relative">
                @csrf
                <input type="text" id="question" name="question" required class="w-full bg-input border border-white/10 rounded-full pl-6 pr-32 py-4 text-white placeholder-gray-600 focus:outline-none focus:border-accent/50 focus:ring-1 focus:ring-accent/50 transition shadow-inner" placeholder="Escribe tu pregunta aquí...">
                <button type="submit" id="submit-btn" class="absolute right-2 top-2 bottom-2 px-6 rounded-full bg-accent hover:bg-cyan-400 text-dark font-bold transition shadow-[0_0_15px_rgba(34,211,238,0.4)]">Preguntar</button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('rag-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const questionInput = document.getElementById('question');
    const question = questionInput.value;
    const submitBtn = document.getElementById('submit-btn');
    const chatContainer = document.getElementById('chat-container');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    if (!question.trim()) return;

    // Add user message
    const userMsg = document.createElement('div');
    userMsg.className = 'bg-accent/10 border border-accent/20 rounded-2xl rounded-tr-none p-4 text-sm text-white ml-auto w-max max-w-[85%]';
    userMsg.textContent = question;
    chatContainer.appendChild(userMsg);
    
    questionInput.value = '';
    submitBtn.disabled = true;
    submitBtn.textContent = '...';
    
    // Add loading indicator
    const loadingMsg = document.createElement('div');
    loadingMsg.className = 'bg-black/30 border border-white/5 rounded-2xl rounded-tl-none p-4 text-sm text-gray-500 w-max max-w-[85%]';
    loadingMsg.textContent = 'Analizando capturas de la comunidad...';
    chatContainer.appendChild(loadingMsg);
    chatContainer.scrollTop = chatContainer.scrollHeight;

    try {
        const response = await fetch('{{ route('rag.ask') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ question: question })
        });
        
        chatContainer.removeChild(loadingMsg);
        
        if (response.ok) {
            const data = await response.json();
            const aiMsg = document.createElement('div');
            aiMsg.className = 'bg-black/30 border border-white/5 rounded-2xl rounded-tl-none p-4 text-sm text-gray-300 w-max max-w-[85%]';
            aiMsg.innerHTML = data.answer;
            chatContainer.appendChild(aiMsg);
        } else {
            const errorMsg = document.createElement('div');
            errorMsg.className = 'bg-red-500/10 border border-red-500/20 text-red-400 rounded-2xl rounded-tl-none p-4 text-sm w-max max-w-[85%]';
            errorMsg.textContent = 'Hubo un error al procesar tu pregunta.';
            chatContainer.appendChild(errorMsg);
        }
    } catch (error) {
        chatContainer.removeChild(loadingMsg);
        const errorMsg = document.createElement('div');
        errorMsg.className = 'bg-red-500/10 border border-red-500/20 text-red-400 rounded-2xl rounded-tl-none p-4 text-sm w-max max-w-[85%]';
        errorMsg.textContent = 'Error de conexión.';
        chatContainer.appendChild(errorMsg);
    }
    
    chatContainer.scrollTop = chatContainer.scrollHeight;
    submitBtn.disabled = false;
    submitBtn.textContent = 'Preguntar';
});
</script>
@endsection
