<div class="flex flex-col items-center justify-center ">
    <h2 class="text-2xl font-semibold mb-4">Carregando recursos do jogo...</h2>

    <div class="w-3/4 bg-gray-200 rounded-full h-6 overflow-hidden">
        <div id="progressFill" class="h-full bg-green-500 transition-all duration-300 ease-in-out" style="width: 0%"></div>
    </div>

    <p class="mt-4 text-sm text-gray-700" id="progressText">0 / 0</p>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const preloadKey = 'caapedia_resources_preloaded';

            if (localStorage.getItem(preloadKey) === 'true') {
                window.location.href = "{{ route('story.events') }}";
                return;
            }

            const resources = @json($resources);
            const allResources = [
                ...(resources.images ?? []),
                ...(resources.audios ?? []),
                ...(resources.jsons ?? []),
                ...(resources.videos ?? []),
            ];

            let loaded = 0;
            const total = allResources.length;
            const progressFill = document.getElementById('progressFill');
            const progressText = document.getElementById('progressText');

            if (total === 0) {
                window.location.href = "{{ route('story.events') }}";
            }

            allResources.forEach(src => {
                let loader;

                if (/\.(png|jpg|jpeg|webp|gif|svg)$/i.test(src)) {
                    loader = new Image();
                    loader.src = src;
                } else if (/\.(mp3|wav|ogg)$/i.test(src)) {
                    loader = new Audio();
                    loader.src = src;
                } else if (/\.(mp4|webm|ogg)$/i.test(src)) {
                    loader = document.createElement('video');
                    loader.src = src;
                } else if (/\.(json)$/i.test(src)) {
                    fetch(src)
                        .then(() => handleLoad())
                        .catch(() => handleLoad());
                    return;
                } else {
                    handleLoad();
                    return;
                }

                loader.onload = loader.onerror = handleLoad;

                function handleLoad() {
                    loaded++;
                    const percent = (loaded / total) * 100;
                    progressFill.style.width = percent + '%';
                    progressText.innerText = `${loaded} / ${total}`;

                    if (loaded === total) {
                        localStorage.setItem(preloadKey, 'true');
                        window.location.href = "{{ route('story.events') }}";
                    }
                }
            });
        });
    </script>
</div>