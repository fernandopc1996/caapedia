<div>
    <div x-data="appFooterComponent('{{ $startTime }}', {{ $mode }})">
        <div>
            <span x-text="getTime()" class="select-none"></span>
        </div>
    </div>
    <script>
        function appFooterComponent(startTime, mode) {
            return {
                time: new Date(startTime),
                mode: mode, 
                interval: null,
                init() {
                    this.startTimer();
                    // Escuta o evento de atualização de modo
                    window.addEventListener('timer-mode-updated', (event) => {
                        const { startTime, mode } = event.detail;
                        this.time = new Date(startTime); 
                        this.mode = mode; 
                        this.startTimer(); 
                    });
                },
                startTimer() {
                    clearInterval(this.interval);

                    if (this.mode === 0) {
                        // Pausado, sem atualização do tempo
                        return;
                    }
                    
                    let increment;
                    let intervalTime;

                    if (this.mode === 1) {
                        // Velocidade 1 - cada 100 ms = 1/10 hora (3600000/10 ms)
                        increment = 3600000 / 10; 
                        intervalTime = 100 * 1.3; 
                    } else if (this.mode === 2) {
                        // Velocidade 2 - cada 1000 ms = 1 dia (86400000 ms)
                        increment = 86400000;
                        intervalTime = 1000; 
                    }

                    // Inicia o intervalo de atualização do tempo
                    this.interval = setInterval(() => {
                        this.time = new Date(this.time.getTime() + increment);

                        window.dispatchEvent(new CustomEvent('virtual-time-tick', {
                            detail: {
                                currentTime: this.time.getTime()
                            }
                        }));

                    }, intervalTime); 
                },
                getTime() {
                    if (this.mode === 1) {
                        // Retorna apenas a data no modo 1 (Velocidade 1)
                        return this.formatDateTime(this.time);
                    }
                    // Retorna data e hora nos outros modos
                    return this.formatDate(this.time);
                },
                formatDate(date) {
                    return moment.utc(date).locale('{{ str_replace('_', '-', app()->getLocale()) }}').format('DD MMMM, YYYY');
                },
                formatDateTime(date) {
                    return moment.utc(date).locale('{{ str_replace('_', '-', app()->getLocale()) }}').format('DD MMMM, YYYY HH:mm:ss');
                },
                cleanup() {
                    clearInterval(this.interval); 
                }
            }
        }
    </script>
</div>
